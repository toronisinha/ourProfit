
@extends('layouts.app')

@section('mainpart')
    <div class="card my-4 px-0 container">

        <div class="card-header d-flex justify-content-between">
            <h3 class="position-relative">All Loan List</h3>
            <button class="btn btn-info "><a class="text-light text-decoration-none" href={{ route('loan.create') }}>Add Loan</a></button>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr class="text-center">
                        <th>SL</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th title="Percentage">%</th>
                        <th title="Per Day Profit">PD Profit</th>
                        <th title="Package Total Profit">Pac T. Profit</th>
                        <th title="Total Days">T days</th>
                        <th>LoanDate</th>
                        <th>Grand T Profit</th>
                        <th>Grand T Paid</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loans as $key => $loan)
                    
                      @php 
                     
                      $created = new \Carbon\Carbon($loan->date_from);
                      $now = \Carbon\Carbon::now();
                      $daysInterval = $created->diff($now)->days;
                      @endphp
                        <tr class="text-center">
                            <td>{{ ++$key }}</td>
                            <td>{{ $loan->customer->name }}</td>
                            <td>{{ $loan->amount }}</td>
                            <td>{{ $loan->percentage }}%</td>
                            <td>{{ $loan->day_profit }}</td>
                            <td>{{ $loan->total_profit }}</td>
                            <td>{{ $daysInterval }} days</td>
                            <td>{{ $created->format('d-M-Y') }}</td>
                            <td>{{ $daysInterval>0 ? $loan->day_profit * $daysInterval : 0 }}</td>
                            <td>{{ $loan->paid_amount>0 ? $loan->paid_amount : 0 }}</td>
                            <td>
                                @if ($loan->status == 1)
                                    <span class="badge bg-primary">Active</span>
                                @elseif ($loan->status==2)
                                   <span class="badge bg-success">Complete</span>
                                @endif    
                            </td>
                            <td class="d-flex ">
                                <a href={{ route( 'loan.edit', [$loan->id] ) }} class="btn btn-primary btn-sm">Edit</a>
                                <a onclick="return confirm('Are you sure to delete?')" href={{ route( 'loan.destroy', [$loan->id] ) }} class="btn btn-danger btn-sm ">Delete</a>
                                {{--<a href="" id={{ $loan->id }} data-toggle="modal" data-target="#exampleModalLong" class="btn btn-info btn-sm">Details</a>--}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



    <!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
          <button type="button" onclick="window.print()" class="btn btn-primary print">Print</button>
        </div>
      </div>
    </div>
  </div>
@endsection
