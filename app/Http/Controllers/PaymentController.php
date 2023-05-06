<?php

namespace App\Http\Controllers;
use App\Http\Requests\PaymentValidation;
use App\Models\Loan;
use App\Models\Payment;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
   public function index(){

      $data['paymentList'] =  Payment::with('customer')->get();  
      return view('payment.paymentList', $data);
   }
  

   public function create(Request $request){
      
      $data['title']= "Add Payment List";
      $data['customers']= Customer::all();

      $data['loans'] = [];
      $data['selectedCustomerId'] = '';
      $data['selectedLoanId'] = '';
      if ( $request->customer_id ) {
          $data['selectedCustomerId'] = $request->customer_id;
          $data['loans'] = Loan::where('customer_id', $request->customer_id)->get();
        //  dd($data);
      }
   
      return view('payment.create_update', $data);
      
   }

   public function store(PaymentValidation $request){

      try {

         DB::beginTransaction();

         $validationData = $request->validated();
         Payment::create($validationData);

         $loan = Loan::find($request->loan_id);
         $loan->paid_amount = $loan->paid_amount + $request->payment_amount;
         $loanAndProfit = $loan->amount + $loan->total_profit;
         if($loanAndProfit == $loan->paid_amount){
            $loan->status = 2;
         }else{$loan->status = 1;}
         $loan->save();

         DB::commit();
         return redirect()->route('payment.index')->with('success', 'Customer has been added successfully!');

      } catch ( \Exception $e ) {
          DB::rollBack();
         return redirect()->route('payment.index')->with('error', $e->getMessage());
      }

   }

   public function edit(Payment $payment, Request $request){

      $data['title'] = "Payment Update";
      $data['item']= $payment;

       $data['loans'] = Loan::where('customer_id', $payment->customer_id)->get();
       $data['selectedCustomerId'] = $payment->customer_id;
       $data['selectedLoanId'] = $payment->loan_id;

      return view('payment.create_update', $data);
   }

   public function update(Payment $payment, paymentValidation $request){

       try {

           DB::beginTransaction();

           $validationData = $request->validated();

           // minus from previous loan id
           $preLoan = Loan::find($payment->loan_id);
           $preLoan->paid_amount = $preLoan->paid_amount - $payment->payment_amount;
           $preLoan->save();

           // plus to selected loan id
           $loan = Loan::find($request->loan_id);
           $loan->paid_amount = $loan->paid_amount + $request->payment_amount;

           $loanAndProfit = $loan->amount + $loan->total_profit;
           if($loanAndProfit == $loan->paid_amount){
                $loan->status = 2;
            }else{$loan->status = 1;}
           $loan->save();


           // update payment table
           $payment->update($validationData);

           DB::commit();
           return redirect()->route('payment.index')->with('success', 'Payment has been updated successfully');

       } catch ( \Exception $e ) {
           DB::rollBack();
           return redirect()->route('payment.index')->with('error', $e->getMessage());
       }

   }

   public function destroy(Payment $payment){

       try {

           DB::beginTransaction();

           // minus from previous loan id
           $preLoan = Loan::find($payment->loan_id);
           $preLoan->paid_amount = $preLoan->paid_amount - $payment->payment_amount;
           $preLoan->save();

           // delete payment record
           $payment->delete();

           DB::commit();
           return redirect()->route('payment.index')->with('success', 'Payment has been deleted sucessfully');

       } catch ( \Exception $e ) {
           DB::rollBack();
           return redirect()->route('payment.index')->with('error', $e->getMessage());
       }

  }
}
