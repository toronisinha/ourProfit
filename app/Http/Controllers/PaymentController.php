<?php

namespace App\Http\Controllers;
use App\Models\Loan;
use App\Models\Payment;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
   public function index(){
      $paymentList = Customer::join('payments', 'payments.customer_id', '=', 'customers.id')
               ->get(['payments.*', 'customers.name']);
               
      return view('payment.paymentList', [
         'paymentList' => $paymentList
      ]);
   }
  

   public function create(){
      
      return view('payment.create_payment', [
         'customers' => Customer::join('loans', 'loans.name', '=', 'customers.id')
         ->where('loans.status', '0')
         ->get(['customers.*'])
      ]);
   }

   public function store(Request $request){
      $data = $request->input();
      $payment = new Payment;
      $payment->customer_id = $data['name'];
      $payment->payment_amount = $data['payment_amount'];
      $payment->payment_date = $data['payment_date'];

      $payment->save();

      return redirect()->route('paymentList')->with('status', 'Payment added successfully');
   }
   public function edit($id){
      $data = DB::table('payments')->join('customers', 'customers.id', '=', 'payments.customer_id')
      ->where('payments.id', '=', $id)
      ->select('customers.name', 'payments.*')
      ->get();

      // $data = Payment::join('customers', 'customers.id', '=', 'payments.customer_id')
      //    ->where('payments.id', '=', $id)
      //    ->get('customers.name', 'payments.*');

         //  dd($data);
      return view('payment.edit_payment', [
         'payment' => $data
      ]);
   }

   public function update(Request $request, $id){
      $data = $request->input();

      $updateData = [
          'payment_amount' => $data['payment_amount'],
          'payment_date' => $data['payment_date']
      ];
        
      Payment::whereId($id)->update($updateData); 
    
      return redirect()->route('paymentList')->with('status', 'Payment has been updated successfully');
   }

   public function delete($id){
      
      Payment::whereId($id)->delete();
      return redirect()->route('paymentList')->with('status', 'Payment delete successfully');
   }
   
}
