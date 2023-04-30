
@extends('layouts.app')

@section('mainpart')
    <div class="card my-4 px-0 container">

        <div class="card-header">
            <h3>{{ $title }}</h3>
        </div>

        <div class="card-body">

            @if ( !empty($item) )
            <form action={{ route('payment.update', [$item->id]) }} method="post" enctype="multipart/form-data">
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">name: </label>
                    <select class="form-control"  name="customer_id" id="">
                        <option value="{{ $item->customer_id }}">{{ $item->customer->name }}</option>
                    </select>
                </div>
            @else
            <form action={{ route('payment.store') }} method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <select class="form-control" name="customer_id">
                        <option value="" disabled selected>Select Customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name}}</option>
                        @endforeach
                    </select>
                </div>
            @endif

                @csrf

                
                <div class="mb-3">
                    <label class="form-label">Amount: </label>
                    <input class="form-control" type="nambar"  value="{{ !empty($item) ? $item->payment_amount : old('payment_amount') }}" name="payment_amount">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Payment Date:</label>
                    <input class="form-control"  value="{{ !empty($item) ? $item->payment_date : old('payment_date') }}" type="date" name="payment_date">
                </div>
            

                @if ( !empty($item) )
                    <button type="submit" class="btn btn-primary btn-block">Update Payment</button>
                @else
                    <button type="submit" class="btn btn-primary btn-block">Add Payment</button>
                @endif

            </form>

        </div>
    </div>
@endsection
