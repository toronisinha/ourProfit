
@extends('layouts.app')

@section('mainpart')
    <div class="card my-4 px-0 container">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="card-header d-flex justify-content-between">
            <h3 class="position-relative"> Payment List</h3>
            <button class="btn btn-info "><a class="text-light text-decoration-none" href={{ route('payment.create') }}>Add Payment</a></button>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr class="text-center">
                        <th>SL</th>
                        <th>Name</th>
                        <th>Total Amount</th>
                        <th>Payment Date</th>
                        <th>Comments</th>
                        <th>Status</th>                      
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paymentList as $key => $payment)

                        <tr class="text-center">
                            <td>{{ ++$key }}</td>
                            <td>{{ $payment->customer->name }}</td>
                            <td>{{ $payment->payment_amount }}</td>
                            <td>{{ date('d-M-y', strtotime($payment->payment_date)) }}</td>
                            <td>{{ $payment->comments }}</td>
                            <td>
                                @if ($payment->status == 1)
                                    <span class="badge bg-success">Paid</span>
                                @else  
                                   <span class="badge bg-warning">Unpaid</span> 
                                @endif    
                            </td>
                            <td class="d-flex ">
                                <a href={{ route( 'payment.edit', [$payment->id] ) }} class="btn btn-primary btn-sm">Edit</a>
                                <a href={{ route( 'payment.destroy', [$payment->id] ) }} class="btn btn-danger btn-sm ">Delete</a>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="text-center">
                        <th colspan="2">Total amount</th>
                        <th> {{ $paymentList != null? $paymentList->sum('payment_amount') : 0 }} </th>  
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>


@endsection