@extends('layouts.app')

@section('mainpart')
    <div style="margin: auto; width: 40%">
        <div class="card my-4 px-0 container">

            <div class="card-header text-center">
                <h3>Enter Payment Details</h3>
            </div>
    
            <div class="card-body">
    
                <form action={{ route('customer.store') }} method="post" enctype="multipart/form-data">
                    @csrf
    
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <select class="form-control" name="name" id="">
                            @foreach ($customers as $key=> $value )
                            <option value="">{{ $value->name }}</option> 
                            @endforeach
                            
                        </select>
                    
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Total Amount</label>
                        <input class="form-control" type="numbar" name="total_amount">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Paid amount</label>
                        <input class="form-control" type="number" name="paid_amount">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">date</label>
                        <input class="form-control" type="date" name="address">
                    </div>
                   
    
                    <button type="submit" class="btn btn-primary btn-block">Payment</button>
                </form>
    
            </div>
        </div>
    </div>
@endsection