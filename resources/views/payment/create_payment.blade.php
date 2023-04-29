@extends('layouts.app')

@section('mainpart')
    <div class="card my-4 px-0 container">

        <div class="card-header">
            <h3>Add Payment</h3>
        </div>

        <div class="card-body">

            <form action={{ route('payment.store') }} method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <select class="form-control" name="name" id="">
                        <option value="" disabled selected>Select Customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name}}</option>
                        @endforeach
                    </select>
                   
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Amount </label>
                    <input class="form-control" type="nambar" name="payment_amount">
                </div>
              
               
                <div class="mb-3">
                    <label class="form-label">Date</label>
                    <input class="form-control" type="date" name="payment_date">
                </div>
               
                <button type="submit" class="btn btn-primary btn-block">Payment</button>
            </form>

        </div>
    </div>
@endsection