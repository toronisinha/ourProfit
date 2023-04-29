@extends('layouts.app')

@section('mainpart')
    <div class="card my-4 px-0 container">

        <div class="card-header">
            <h3>Update Payment</h3>
        </div>

        <div class="card-body">

            <form action={{ route('payment.update', [$payment[0]->id]) }} method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <select class="form-control" @readonly(true)>
                        <option value="{{ $payment[0]->customer_id }}">{{ $payment[0]->name}}</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Amount </label>
                    <input class="form-control" value={{ $payment[0]->payment_amount }} type="nambar" name="payment_amount">
                </div>
              
               
                <div class="mb-3">
                    <label class="form-label">Date</label>
                    <input class="form-control" type="date" value={{ $payment[0]->payment_date }} name="payment_date">
                </div>
               
                <button type="submit" class="btn btn-primary btn-block">Payment Update</button>
            </form>

        </div>
    </div>
@endsection