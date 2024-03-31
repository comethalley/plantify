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

        $expenses = Expense::whereHas('farm', function ($query) use ($farmId) {
            $query->where('id', $farmId);
        })->get();

        $budget = Budget::where('farm_id', $farmId)->first();

        // Initialize variables
        $farm = null;
        $allottedBudget = null;
        $totalExpenses = null;
        $balance = null;

        if ($user->role_id == 2 || $user->role_id == 1) {
            $farm = Farm::all();
            $allottedBudget = Budget::sum('allotted_budget');
            $balance = Budget::sum('balance');
            $totalExpenses = $this->computeTotalExpenses();
        } else if ($user->role_id == 3) {
            $farm = Farm::where('farm_leader', $user->id)->get(); // Use get() instead of first()

            // Check if farms are found
            if ($farm->isEmpty()) {
                // Handle case where no farms are found for the user
                return redirect()->back()->with('error', 'You are not associated with any farms.');
            }

            // Retrieve other budget-related data for the user's farm
            $farmId = $farm->first()->id;
            $allottedBudget = Budget::where('farm_id', $farmId)->sum('allotted_budget');
            $totalExpenses = Budget::where('farm_id', $farmId)->sum('total_expenses');
            $balance = Budget::where('farm_id', $farmId)->value('balance');
            $expenses = Expense::where('farm_id', $farmId)->get();
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

    // public function saveExpense(Request $request)
    // {
    //     $request->validate([
    //         'description' => 'required|string|max:255',
    //         'amount' => 'required|numeric',
    //         'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'farm_id' => 'required|exists:farms,id', // Validate farm_id
    //     ]);

    //     $expense = new Expense;
    //     $expense->description = $request->input('description');
    //     $expense->amount = $request->input('amount');
    //     $expense->farm_id = auth()->user()->farm_id; // Associate expense with the selected farm

    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         $imageName = time() . '.' . $image->getClientOriginalExtension();
    //         $image->move(public_path('images/expenses'), $imageName);
    //         $expense->image_path = 'images/expenses/' . $imageName;
    //     }

    //     $expense->budget_id = 1;

    //     $expense->save();

    //     $budget = Budget::findOrFail(1);

    //     $totalExpenses = Expense::where('budget_id', $budget->id)->sum('amount');
    //     $budget->total_expenses = $totalExpenses;
    //     $budget->save();

    //     $budget->balance = $budget->allotted_budget - $budget->total_expenses;
    //     $budget->save();

    //     return response()->json(['success' => true, 'id' => $expense->id, 'image_url' => asset($expense->image_path)]);
    // }
    
    public function saveExpense(Request $request)
    {
        $user = auth()->user();
        // Validate the request data
        $validatedData = $request->validate([
            'farm_id' => 'required|exists:farms,id', // Ensure farm_id exists in farms table
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // Retrieve farm_id from the validated data
        $farmId = $validatedData['farm_id'];
    
        // Create a new Expense instance associated with the provided farm_id
        $expense = new Expense([
            'description' => $validatedData['description'],
            'amount' => $validatedData['amount'],
            'farm_id' => $farmId,
            'budget_id' => 9, // Assuming there's only one budget for now, adjust as needed
        ]);
    
        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/expenses'), $imageName);
            $expense->image_path = 'images/expenses/' . $imageName;
        }
    
        // Save the expense
        $expense->save();
    
        // Update the total expenses in the associated budget
        $budget = Budget::findOrFail($expense->budget_id); // Assuming budget id 1, update this as needed
        $totalExpenses = Expense::where('budget_id', $budget->id)->sum('amount');
        $budget->total_expenses = $totalExpenses;
        $budget->balance = $budget->allotted_budget - $budget->total_expenses;
        $budget->save();
    
        // Return a JSON response indicating success along with the ID of the newly created expense and its image URL if available
        return response()->json(['success' => true, 'id' => $expense->id, 'image_url' => asset($expense->image_path)]);
    }

    public function updateExpense(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'expense_id' => 'required|exists:expenses,id',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Find the expense by ID
        $expense = Expense::findOrFail($validatedData['expense_id']);
    
        // Update the expense data
        $expense->description = $validatedData['description'];
        $expense->amount = $validatedData['amount'];
    
        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/expenses'), $imageName);
            $expense->image_path = 'images/expenses/' . $imageName;
        }
    
        // Save the updated expense
        $expense->save();
    
        // Assuming you want to return a JSON response
        return response()->json(['success' => true]);
    }

    public function addBudget(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'farm_id' => 'required|exists:farms,id', // Ensure farm_id exists in farms table
                'allotted_budget' => 'required|numeric|min:0',
            ]);
    
            // Retrieve farm_id from the validated data
            $farmId = $validatedData['farm_id'];
    
            // Check if a budget already exists for the provided farm_id
            $existingBudget = Budget::where('farm_id', $farmId)->first();
    
            if ($existingBudget) {
                // If a budget already exists, update the allotted budget
                $existingBudget->allotted_budget += $validatedData['allotted_budget'];
                $existingBudget->save();
            } else {
                // If no budget exists, create a new budget
                $budget = new Budget();
                $budget->farm_id = $farmId;
                $budget->allotted_budget = $validatedData['allotted_budget'];
                $budget->balance = $validatedData['allotted_budget'];
                $budget->total_expenses = 0;
                $budget->save();
            }
    
            // Return a JSON response indicating success along with the allotted budget
            return response()->json([
                'status' => 'success',
                'message' => 'Budget added successfully!',
                'allotted_budget' => $existingBudget ? $existingBudget->allotted_budget : $budget->allotted_budget,
            ]);
        } catch (\Exception $e) {
            // Return a JSON response indicating error if validation fails or an exception occurs
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
            return response()->json([
                'allottedBudget' => $budget->allotted_budget,
                'balance' => $budget->balance,
                'totalExpenses' => $budget->total_expenses
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
