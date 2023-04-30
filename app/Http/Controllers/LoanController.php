<?php

namespace App\Http\Controllers;
use App\Http\Requests\LoanValidation;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Loan;

class LoanController extends Controller
{
    public function index(){
        
        $data['loans'] = Loan::with('customer')->get();
        return view('loans.loanList', $data);
    }

    public function create(){
        
        $data['title'] = "Add new Loan";
        $data['customers']= Customer::all();
        return view('loans.create_update', $data );
    }

    public function store(LoanValidation $request){
        try {

            $validatedData = $request->validated();
            $validatedData['day_profit'] = ($validatedData['amount'] * $validatedData['percentage']) / 3000;
            $validatedData['total_profit'] = $validatedData['day_profit'] * $validatedData['timeframe'];
            Loan::create($validatedData);

            return redirect()->route('loan.index')->with('success', 'Customer has been added successfully!');

        } catch ( \Exception $e ) {
            return redirect()->route('loan.index')->with('error', $e->getMessage());
        }
       
    }

    public function edit(Loan $loan, Request $request){
      
        $data['title'] = "Update Loan";
        $data['item'] = $loan;
        $data['customers'] = Customer::all();

        return view('loans.create_update', $data);
    }

    public function update(Loan $loan, LoanValidation $request){

        $validatedData = $request->validated();
        $validatedData['day_profit'] = ($validatedData['amount'] * $validatedData['percentage']) / 3000;
        $validatedData['total_profit'] = $validatedData['day_profit'] * $validatedData['timeframe'];

        $loan->update($validatedData);
		return redirect()->route('loan.index')->with('success', 'loan has been updated successfully');
        
    }

    public function destroy(Loan $loan){
        if ( $loan->delete() )
            return redirect()->route('loan.index')->with('success', 'Loan Deleted sucessfully');
        else
            return redirect()->route('loan.index')->with('error', 'Something wentddd wrong!');
    }
}
