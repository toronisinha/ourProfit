<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Loan;

class LoanController extends Controller
{
    public function index(){

//        $data = DB::table('loans')
//            ->join('customers', 'customers.id', '=', 'loans.name')
//            ->select('loans.*', 'customers.*')
//            ->get();
//        // $allLoanList = Loan::all();
//        // return view('loans.loanList',compact('allLoanList'));
//        return view('loans.loanList', ['allLoanList' => $data]);


        $data['loans'] = Loan::with('customer')->all();
        return view('loans.loanList', $data);
    }

    public function create(){
        return view('loans.create_loan', [
            'customers' => Customer::all()
        ]);
    }

    public function store(Request $request){
        $data = $request->input();
        $loan = new Loan;
            $loan->name = $data['name'];
            $loan->amount = $data['amount'];
            $loan->parcentage = $data['parcentage'];
            $loan->profit = ($data['amount'] * $data['parcentage']) / 100;
            $loan->total = $loan->profit + $data['amount'];
            $loan->date_from = $data['date_from'];
            $loan->time = $data['time'];
        
            $loan->save();
      
            return redirect()->route('loanList');
    }


    public function edit($id){
        $data = DB::table('loans')
            ->join('customers', 'customers.id', '=', 'loans.name')
            ->select('loans.amount', 'customers.name', 'loans.parcentage', 'loans.time',
            'loans.profit', 'loans.total', 'loans.date_to', 'loans.id')
            ->where('loans.name',"=","$id")
            ->get();   
        return view('loans.editloan', [
            'data' => $data
        ]);
        //   $data = Loan::find($id);
        // return view('loans.editloan', compact('data'));
    }

    public function update(Request $request, $id){

        $olddata = Loan::find($id);
        $data = $request->input();

        // $profit = $olddata->profit;
        // $total = $olddata->total;
        // $status = 0;
       
        // if( $olddata->profit == $data['paid'] ){
        //     $profit = 0;
        //     $total =($total - $data['paid']);
        // }

        // if( $olddata->total == $data['paid'] ){
        //     $profit = 0;
        //     $total = 0;
        // }
        // if($total == 0 && $profit == 0){
        //     $status = 1;
        // }
        $profit= ($data['amount'] * $data['parcentage']) / 100;
        $updateData = [
            'amount' => $data['amount'],
            'parcentage' => $data['parcentage'],
            'profit' => $profit,
            'total' =>$profit+ $data['amount'],
            'time' => $data['time']
                
        ];
     
        Loan::whereId($id)->update($updateData);
       
                
		return redirect()->route('loanList');
    }

    public function delete($id){

        Loan::whereId($id)->delete();
        return redirect()->route('loanList');
    }
}
