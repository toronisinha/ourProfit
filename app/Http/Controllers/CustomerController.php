<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index(){
        $allCustomer = Customer::all();
        return view('customers.customer_list', compact('allCustomer'));
    }
    public function create(){
        $data['title'] = "Add new Customer";
        return view('customers.create_update', $data);
    
    }

    public function store(CustomerValidation $request){

        try {

//            if ( $request->name=='Toroni' ) {
//                throw new \Exception('You can not use Toroni as a name', 403);
//            }

            $validatedData = $request->validated();
            $validatedData['status'] = 1;
            Customer::create($validatedData);

            return redirect()->route('customer.index')->with('success', 'Customer has been added successfully!');

        } catch ( \Exception $e ) {
            return redirect()->route('customer.index')->with('error', $e->getMessage());
        }
    }

    public function edit(Customer $customer, Request $request){
        $data['title'] = "Update Customer";
        $data['item'] = $customer;
        return view('customers.create_update', $data);
    }

    public function update(Customer $customer, CustomerValidation $request){

        $validatedData = $request->validated();
//        unset($validatedData['email']);
//        $data = [
//            'name' => $validatedData['name'],
//            'phone' => $request->phone,
//            'status' => 1
//        ];
//         $customer->update($data);
        $customer->update($validatedData);

		return redirect()->route('customer.index')->with('success', 'Customer has been updated successfully');
    }

    public function destroy(Customer $customer){
        if ( $customer->delete() )
            return redirect()->route('customer.index')->with('success', 'Customer Deleted sucessfully');
        else
            return redirect()->route('customer.index')->with('error', 'Something went wrong!');
    }


}
