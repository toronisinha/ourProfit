
@extends('layouts.app')

@section('mainpart')
    <div class="card my-4 px-0 container">

        <div class="card-header">
            <h3>{{ $title }}</h3>
        </div>

        <div class="card-body">

            @if ( empty($item) )
            <form action={{ route('payment.create') }} method="get" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <select class="form-control" name="customer_id" onchange="submit()">
                        <option value="" disabled selected>Select Customer</option>
                        @foreach($customers as $customer)
                            <option @selected($selectedCustomerId==$customer->id) value="{{ $customer->id }}">{{ $customer->name}}</option>
                        @endforeach
                    </select>
                </div>
            </form>
            @endif



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
                    <input type="hidden" name="customer_id" value="{{ $selectedCustomerId }}">
            @endif


                @csrf



                <div class="mb-3">
                    <label class="form-label">Select Loan</label>
                    <select class="form-control" name="loan_id">
                        <option value="" disabled selected>Select Loan</option>
                        @foreach($loans as $loan)
                            <option @selected($selectedLoanId==$loan->id) value="{{ $loan->id }}">{{ $loan->id}} | {{ $loan->amount }} | {{ \Carbon\Carbon::parse($loan->date_from)->format('d/m/Y') }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Amount: </label>
                    <input class="form-control" type="number"  value="{{ !empty($item) ? $item->payment_amount : old('payment_amount') }}" name="payment_amount">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Payment Date:</label>
                    <input class="form-control"  value="{{ !empty($item) ? \Carbon\Carbon::parse($item->payment_date)->format('Y-m-y') : old('payment_date') }}" type="date" name="payment_date">
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
