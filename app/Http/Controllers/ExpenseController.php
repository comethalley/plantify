<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Expense;
use App\Models\Farm;
use App\Models\Budget;
use App\Models\User;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::all();
        $user = auth()->user();
        if ($user->role_id == 2 || $user->role_id == 1) {
            $farm = Farm::all();
            $allottedBudget = Budget::sum('allotted_budget');
            $balance = Budget::sum('balance');
            $totalExpenses = $this->computeTotalExpenses();
        } else if ($user->role_id == 3) {
            $userID = $user->id;
            $farm = Farm::where('farm_leader', $userID)->first();

            $allottedBudget = Budget::where('farm_id', $farm->id)->sum('allotted_budget');
            $totalExpenses = Budget::where('farm_id', $farm->id)->sum('total_expenses');
            $balance = Budget::where('farm_id', $farm->id)->value('balance');
        }

        return view("pages.expense.expense", [
            'expenses' => $expenses,
            'farm' => $farm,
            'allottedBudget' => $allottedBudget,
            'totalExpenses' => $totalExpenses,
            'balance' => $balance,
            'userRoleId' => $user->role_id,
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
            'budget_id' => 1, // Assuming there's only one budget for now, you may adjust this as needed
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
        $budget = Budget::findOrFail(1); // Assuming budget id 1, update this as needed
        $totalExpenses = Expense::where('budget_id', $budget->id)->sum('amount');
        $budget->total_expenses = $totalExpenses;
        $budget->balance = $budget->allotted_budget - $budget->total_expenses;
        $budget->save();

        // Return a JSON response indicating success along with the ID of the newly created expense and its image URL if available
        return response()->json(['success' => true, 'id' => $expense->id, 'image_url' => asset($expense->image_path)]);
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

        return response()->json([
            'allottedBudget' => $budget ? $budget->allotted_budget : 0,
            'balance' => $budget ? $budget->balance : 0,
            'totalExpenses' => $budget ? $budget->total_expenses : 0
        ]);
    }

    public function computeTotalExpenses()
    {
        // Compute total expenses
        $expensesTotal = Expense::sum('amount');

        // Update total expenses in the budget table
        $budget = Budget::first();
        $budget->total_expenses = $expensesTotal;
        $budget->save();

        return $expensesTotal;
    }
}
