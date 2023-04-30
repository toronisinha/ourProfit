@extends('layouts.app')

@section('mainpart')
    <div class="card my-4 px-0 container">

        <div class="card-header">
            <h3>{{ $title }}</h3>
        </div>

        <div class="card-body">

            @if ( !empty($item) )
            <form action={{ route('loan.update', [$item->id]) }} method="post" enctype="multipart/form-data">
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <select class="form-control" name="customer_id">
                        <option value="{{ $item->customer->id }}">{{ $item->customer->name}}</option>
                    </select>
                </div>

            @else
            <form action={{ route('loan.store') }} method="post" enctype="multipart/form-data">
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
                    <label class="form-label">Amount </label>
                    <input class="form-control" type="nambar"  value="{{ !empty($item) ? $item->amount : old('amount') }}" name="amount">
                </div>
                <div class="mb-3">
                    <label class="form-label">Parcentage %</label>
                    <input class="form-control" type="number"  value="{{ !empty($item) ? $item->percentage : old('percentage') }}" name="percentage">
                </div>
                <div class="mb-3">
                    <label class="form-label">Time Frame</label>
                    <select name="timeframe" id="" class="form-control">
                        <option value="7">7 Days</option>
                        <option value="15">15 Days</option>
                        <option value="30">Monthly</option>
                    </select>
                </div>
               
                <div class="mb-3">
                    <label class="form-label">Date</label>
                    <input class="form-control"  value="{{ !empty($item) ? $item->date_from : old('date_from') }}" type="date" name="date_from">
                </div>
            

                @if ( !empty($item) )
                    <button type="submit" class="btn btn-primary btn-block">Update Loan</button>
                @else
                    <button type="submit" class="btn btn-primary btn-block">Add Loan</button>
                @endif

            </form>

        </div>
    </div>
@endsection
