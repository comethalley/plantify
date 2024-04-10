<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Expense;
use App\Models\Farm;
use App\Models\Budget;
use App\Models\User;
use App\Models\Category;

class ExpenseController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $expenses = Expense::all();
        $user = auth()->user();
        $farmId = $user->farm_id;

        $expenses = Expense::with('category')->whereHas('farm', function ($query) use ($farmId) {
            $query->where('id', $farmId);
        })->get();

        $budget = Budget::where('farm_id', $farmId)->first();

        $farm = null;
        $allottedBudget = null;
        $totalExpenses = null;
        $balance = null;

        if ($user->role_id == 2 || $user->role_id == 1) {
            $expenses = Expense::all();
            $allottedBudget = Budget::sum('allotted_budget');
            $balance = Budget::sum('balance');
            $totalExpenses = $this->computeTotalExpenses();
        } else if ($user->role_id == 3) {
            $farm = Farm::where('farm_leader', $user->id)->get();

            if ($farm->isEmpty()) {
                return redirect()->back()->with('error', 'You are not associated with any farms.');
            }

            $farmId = $farm->first()->id;
            $allottedBudget = Budget::where('farm_id', $farmId)->sum('allotted_budget');
            $totalExpenses = Budget::where('farm_id', $farmId)->sum('total_expenses');
            $balance = Budget::where('farm_id', $farmId)->value('balance');
            $expenses = Expense::with('category')->where('farm_id', $farmId)->get();
        }

        return view("pages.expense.expense", [
            'expenses' => $expenses,
            'budget' => $budget,
            'farm' => $farm,
            'allottedBudget' => $allottedBudget,
            'totalExpenses' => $totalExpenses,
            'balance' => $balance,
            'userRoleId' => $user->role_id,
            'farmCategory' => $categories,
        ]);
    }
    
    public function store(Request $request)
    {
        $expense = new Expense();
        $expense->user = auth()->user();
        $expense->description = $request->description;
        $expense->amount = $request->amount;
    
        if (!$expense->budget_id && auth()->check() && auth()->user()->role_id == 3) {
            $expense->budget_id = auth()->user()->id;
        }
    
        $expense->save();
    
        return redirect()->route('expenses.index');
    }



    public function saveExpense(Request $request)
    {
        $user = auth()->user();
    
        $validatedData = $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string|max:255',
            'current_rdg' => 'required|numeric',
            'amount' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $farmId = $validatedData['farm_id'];
        $budget = Budget::where('farm_id', $farmId)->firstOrFail();
    
        // Check if the balance is enough for the expense
        if ($budget->balance < $validatedData['amount']) {
            return response()->json(['success' => false, 'message' => 'Your expenses cannot be saved due to low balance.']);
        }
    
        $expense = new Expense([
            'description' => $validatedData['description'],
            'amount' => $validatedData['amount'],
            'current_rdg' => $validatedData['current_rdg'],
            'farm_id' => $farmId,
            'budget_id' => $budget->id,
            'category_id' => $validatedData['category_id'],
        ]);
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/expenses'), $imageName);
            $expense->image_path = 'images/expenses/' . $imageName;
        }
    
        $expense->save();
    
        // Update budget details
        $budget->total_expenses += $validatedData['amount'];
        $budget->balance -= $validatedData['amount'];
        $budget->save();
    
        return response()->json(['success' => true, 'id' => $expense->id, 'image_url' => asset($expense->image_path)]);
    }

    public function getLastAmount(Request $request)
    {
        $farmId = $request->input('farm_id');
        $categoryId = $request->input('category_id');
    
        $lastExpense = Expense::where('farm_id', $farmId)
            ->where('category_id', $categoryId)
            ->orderBy('created_at', 'desc')
            ->first();
    
        if ($lastExpense) {
            return response()->json(['success' => true, 'lastAmount' => $lastExpense->current_rdg]);
        } else {
            return response()->json(['success' => false, 'message' => 'No expense found for this category.']);
        }
    }

    public function getExpensesByCategory(Request $request)
    {
        try {
            $farmId = $request->input('farm_id');
            $categoryId = $request->input('category_id');

            $expensesQuery = Expense::where('farm_id', $farmId);

            // If a category is selected, filter expenses by category
            if ($categoryId) {
                $expensesQuery->where('category_id', $categoryId);
            }

            $expenses = $expensesQuery->get();

            return response()->json($expenses);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch expenses by category. Please try again later.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function addBudget(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'farm_id' => 'required|exists:farms,id',
                'allotted_budget' => 'required|numeric|min:0',
            ]);
    
            $farmId = $validatedData['farm_id'];
    
            $existingBudget = Budget::where('farm_id', $farmId)->first();
    
            if ($existingBudget) {
                $existingBudget->allotted_budget += $validatedData['allotted_budget'];
                $existingBudget->balance += $validatedData['allotted_budget'];
                $existingBudget->save();
            } else {
                $budget = new Budget();
                $budget->farm_id = $farmId;
                $budget->allotted_budget = $validatedData['allotted_budget'];
                $budget->balance = $validatedData['allotted_budget'];
                $budget->total_expenses = 0;
                $budget->save();
            }
    
            return response()->json([
                'status' => 'success',
                'message' => 'Budget added successfully!',
                'allotted_budget' => $existingBudget ? $existingBudget->allotted_budget : $budget->allotted_budget,
                'balance' => $existingBudget ? $existingBudget->balance : $budget->balance,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add budget. Please try again later.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
    public function getDashboardData(Request $request)
    {
        $farmId = $request->input('farm_id');
        $budget = Budget::where('farm_id', $farmId)->first();
    
        if ($budget) {
            $totalExpenses = Expense::where('farm_id', $farmId)->sum('amount');
            
            $balance = $budget->allotted_budget - $totalExpenses;
    
            $budget->total_expenses = $totalExpenses;
            $budget->save();
    
            return response()->json([
                'allottedBudget' => $budget->allotted_budget,
                'balance' => $balance,
                'totalExpenses' => $totalExpenses,
            ]);
        } else {
            return response()->json([
                'allottedBudget' => 0,
                'balance' => 0,
                'totalExpenses' => 0
            ]);
        }
    }

    public function computeTotalExpenses()
    {
        $expensesTotal = Expense::sum('amount');

        $budget = Budget::first();
        if ($budget) {
            $budget->total_expenses = $expensesTotal;
            $budget->save();
        }

        return $expensesTotal;
    }
}
