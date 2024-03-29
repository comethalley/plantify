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
        }

        return view("pages.expense.expense", [
            'expenses' => $expenses,
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
        // Validate the incoming request data
        $validatedData = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create a new Expense instance
        $expense = new Expense([
            'description' => $validatedData['description'],
            'amount' => $validatedData['amount'],
            'farm_id' => auth()->user()->farm_id, // Associate expense with the authenticated user's farm
            'budget_id' => 9, // Assuming there's only one budget for now, you may adjust this as needed
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
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'category' => 'required',
                'description' => 'required|string|max:255',
                'amount' => 'required|numeric',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            // Find the expense by ID
            $expense = Expense::findOrFail($request->expense_id);
    
            // Update the expense details
            $expense->category_id = $validatedData['category']; // Assuming category ID is in the form data
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
    
            // Return a JSON response indicating success
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error updating expense: ' . $e->getMessage());
    
            // Return a JSON response with an error message
            return response()->json(['success' => false, 'message' => 'An unexpected error occurred. Please try again later.'], 500);
        }
    }

    public function addBudget(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'farm_id' => 'required|exists:farms,id',
                'allotted_budget' => 'required|numeric|min:0',
            ]);

            $existingBudget = Budget::where('farm_id', $validatedData['farm_id'])->first();

            if ($existingBudget) {

                $existingBudget->allotted_budget += $validatedData['allotted_budget'];
                $existingBudget->save();
            } else {
                $budget = new Budget();
                $budget->farm_id = $validatedData['farm_id'];
                $budget->allotted_budget = $validatedData['allotted_budget'];
                $budget->balance = $validatedData['allotted_budget'];
                $budget->total_expenses = 0;
                $budget->save();
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Budget added successfully!',
                'allotted_budget' => $existingBudget ? $existingBudget->allotted_budget : $budget->allotted_budget,
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
