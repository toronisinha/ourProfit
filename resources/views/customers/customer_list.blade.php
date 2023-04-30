@extends('layouts.app')

@section('mainpart')
    <div class="card my-4 px-0 container">

        <div class="card-header d-flex justify-content-between">
            <h3 class="position-relative">Customer List</h3>
            <button class="btn btn-info "><a class="text-light text-decoration-none" href={{ route('customer.create') }}>Add Customer</a></button>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Numbar</th>
                        <th>Address</th>
                        <th>Photo</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allCustomer as $key => $customer)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>{{ $customer->image }}</td>
                            
                            <td>
                                <a href={{ route('customer.edit', [$customer->id]) }} class="btn btn-primary btn-sm">Edit</a>
                                <a href={{ route('customer.destroy', [$customer->id]) }} class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
