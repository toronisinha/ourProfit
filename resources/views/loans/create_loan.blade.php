@extends('layouts.app')

@section('mainpart')
    <div class="card my-4 px-0 container">

        <div class="card-header">
            <h3>Add Loan</h3>
        </div>

        <div class="card-body">

            <form action={{ route('loan.store') }} method="post" enctype="multipart/form-data">
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
                    <input class="form-control" type="nambar" name="amount">
                </div>
                <div class="mb-3">
                    <label class="form-label">Parcentage %</label>
                    <input class="form-control" type="number" name="parcentage">
                </div>
                <div class="mb-3">
                    <label class="form-label">Time Frame</label>
                    <select name="time" id="" class="form-control">
                        <option value="7">7 Days</option>
                        <option value="15">15 Days</option>
                        <option value="30">Monthly</option>
                    </select>
                </div>
               
                <div class="mb-3">
                    <label class="form-label">Date</label>
                    <input class="form-control" type="date" name="date_from">
                </div>
               
                <button type="submit" class="btn btn-primary btn-block">Add Loan</button>
            </form>

        </div>
    </div>
@endsection