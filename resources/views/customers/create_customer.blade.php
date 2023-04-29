@extends('layouts.app')

@section('mainpart')
    <div class="card my-4 px-0 container">

        <div class="card-header">
            <h3>Add Customer</h3>
        </div>

        <div class="card-body">

            <form action={{ route('customer.store') }} method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input class="form-control" type="text" name="name">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input class="form-control" type="email" name="email">
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone Numbar</label>
                    <input class="form-control" type="number" name="phone_numbar">
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input class="form-control" type="text" name="address">
                </div>
                <div class="mb-3">
                    <label class="form-label">Photo</label>
                    <input class="form-control" type="file" name="image">
                </div>
              

                <button type="submit" class="btn btn-primary btn-block">Add Customer</button>
            </form>

        </div>
    </div>
@endsection