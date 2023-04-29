@extends('layouts.app')

@section('mainpart')
    <div class="card my-4 px-0 container">

        <div class="card-header">
            <h3>{{ $title }}</h3>
        </div>

        <div class="card-body">

            @if ( !empty($item) )
            <form action={{ route('customer.update', [$item->id]) }} method="post" enctype="multipart/form-data">
                @method('PUT')
            @else
            <form action={{ route('customer.store') }} method="post" enctype="multipart/form-data">
            @endif

                @csrf

                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input class="form-control" type="text" name="name" value="{{ !empty($item) ? $item->name : old('name') }}">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input class="form-control" type="email" name="email" value="{{ !empty($item) ? $item->email : old('email') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone Numbar</label>
                    <input class="form-control" type="number" name="phone" value="{{ !empty($item) ? $item->phone : old('phone') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input class="form-control" type="text" name="address" value="{{ !empty($item) ? $item->address : old('address') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Photo</label>
                    <input class="form-control" type="file" name="image">
                </div>

                @if ( !empty($item) )
                    <button type="submit" class="btn btn-primary btn-block">Update Customer</button>
                @else
                    <button type="submit" class="btn btn-primary btn-block">Add Customer</button>
                @endif

            </form>

        </div>
    </div>
@endsection
