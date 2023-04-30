<?php

namespace App\Http\Controllers;
use App\Http\Requests\PaymentValidation;
use App\Models\Payment;
use App\Models\Customer;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
   public function index(){

      $data['paymentList'] =  Payment::with('customer')->get();  
      return view('payment.paymentList', $data);
   }
  

   public function create(){
      
      $data['title']= "Add Payment List";
      $data['customers']= Customer::all();
   
      return view('payment.create_update', $data);
      
   }

   public function store(PaymentValidation $request){

      try {

         $validationData = $request->validated();
         Payment::create($validationData);
         
         return redirect()->route('payment.index')->with('success', 'Customer has been added successfully!');

      } catch ( \Exception $e ) {
         return redirect()->route('payment.index')->with('error', $e->getMessage());
      }

   }

   public function edit(Payment $payment, Request $request){

      $data['title'] = "Payment Update";
      $data['item']= $payment;
      return view('payment.create_update', $data);
   }

   public function update(Payment $payment, paymentValidation $request, ){

      $validationData = $request->validated();

      if( $payment->update($validationData) )
         return redirect()->route('payment.index')->with('success', 'Payment has been updated successfully');
      else
         return redirect()->route('payment.index')->with('error', 'Payment has been updated successfully');
   
   }

   public function destroy(Payment $payment){
      if ( $payment->delete() )
          return redirect()->route('payment.index')->with('success', 'Payment has been deleted sucessfully');
      else
          return redirect()->route('payment.index')->with('error', 'Something wentddd wrong!');
  }
}
