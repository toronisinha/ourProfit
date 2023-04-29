@extends('layouts.app')

@section('mainpart')
    <div class="card my-4 px-0 container">

        <div class="card-header">
            <h3>Edit Loan</h3>
        </div>

        <div class="card-body">

            <form action={{ route('loanUpdateStore', [$data[0]->id]) }} method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input class="form-control" placeholder={{ $data[0]->name }} va type="text" readonly>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Amount </label>
                    <input class="form-control" value={{ $data[0]->amount }} type="nambar" name="amount">
                </div>
                <div class="mb-3">
                    <label class="form-label">Parcentage %</label>
                    <input class="form-control" value={{ $data[0]->parcentage }} type="number" name="parcentage">
                </div>
                <div class="mb-3">
                    <label class="form-label">Time Frame</label>
                    <select name="time" id="" class="form-control">
                        <option value="7">7 Days</option>
                        <option value="15">15 Days</option>
                        <option selected value="30">Monthly</option>
                    </select>
                </div>
{{--                 
                <div class="mb-3">
                    <label class="form-label">Paid</label>
                    <select class="form-control" name="paid" id="">
                        <option value="0">No Paid</option>
                        <option value="{{ $data[0]->profit }}">Paid Profit <p>({{ $data[0]->profit }})</p></option>
                        <option value="{{ $data[0]->total }}">All Paid <p>({{ $data[0]->total }})</p></option>
                    </select>
                </div> --}}
                <div class="mb-3">
                    <label class="form-label"></label>
                    <input class="form-control" type="date" value={{ $data[0]->date_to }} name="date_to">
                </div>

                <button type="submit" class="btn btn-primary btn-block">Update Loan</button>
            </form>

        </div>
    </div>
@endsection