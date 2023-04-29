<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;

class customerController extends Controller
{
    public function index(){

        $allCustomer = DB::table('customers')->get();
        return view('customers.customer_list', compact('allCustomer'));
    
    }
    public function create(){

        return view('customers.create_customer', 
         ['customers' => Customer::all()]);
    
    }

    public function store(Request $request){
       
          $data = new Customer;
 
          $data->name = $request->name;
          $data->email = $request->email;
          $data->address = $request->address;
          $data->phone_numbar = $request->phone_numbar;
   
          $data->save();
          
         return redirect()->route('customerList')->with('status', 'Customer added sucessfully');
        
  
    }

    public function edit($id){

        $customer = Customer::find($id);
        return view('customers.editCustomer', compact('customer'));
    }

    public function update(Request $request, $id){
        
        $data = $request->input();
        $updateData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_numbar' => $data['phone_numbar'],
            'address' => $data['address']
        ];
     
        Customer::whereId($id)->update($updateData);      
		return redirect()->route('customerList')->with('status', 'Customer Update sucessfully');
    }

    public function delete($id){
        Customer::whereId($id)->delete();
        return redirect()->route('customerList')->with('status', 'Customer Deleted sucessfully');
    }
}
