@extends('layouts.app')

@section('mainpart')
    <div class="card my-4 px-0 container">

        <div class="card-header">
            <h3>Update Customer</h3>
        </div>

        <div class="card-body">

            <form action={{ route('customer.update', [$customer->id]) }} method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input class="form-control" value="{{ $customer->name }}" type="text" name="name">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input class="form-control" value="{{ $customer->email }}" type="email" name="email">
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone Numbar</label>
                    <input class="form-control" value="{{ $customer->phone_numbar }}" type="number" name="phone_numbar">
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input class="form-control" value="{{ $customer->address }}" type="text" name="address">
                </div>
                <div class="mb-3">
                    <label class="form-label">Photo</label>
                    <input class="form-control" type="file" name="image">
                </div>
              

                <button type="submit" class="btn btn-primary btn-block">Update Customer</button>
            </form>

        </div>
    </div>
@endsection