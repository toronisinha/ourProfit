
@extends('layouts.app')

@section('mainpart')
    <div class="card my-4 px-0 container">

        <div class="card-header d-flex justify-content-between">
            <h3 class="position-relative">All Loan List</h3>
            <button class="btn btn-info "><a class="text-light text-decoration-none" href={{ route('createLoan') }}>Add Loan</a></button>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr class="text-center">
                        <th>SL</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Parcentage</th>
                        <th>Profit</th>
                        <th>Total</th>
                        <th>Per Day</th>
                        <th>Total Due</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Phone Numbar</th>
                        <th>Loan date</th>                       
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loans as $key => $loanList)
                      @php 
                      $perDay = $loanList->profit/$loanList->time;

                      $created = new \Carbon\Carbon($loanList->date_from);
                      $now = \Carbon\Carbon::now();
                      $daysInterval = $created->diff($now)->days;

                      @endphp
                        <tr class="text-center">
                            <td>{{ ++$key }}</td>
                            <td>{{ $loanList->customer->name }}</td>
                            <td>{{ $loanList->amount }}</td>
                            <td>{{ $loanList->parcentage }}%</td>
                            <td>{{ $loanList->profit }}</td>
                            <td>{{ $loanList->total }}</td>
                            <td>{{ number_format($perDay, 2) }} /day</td>
                            <td>{{ $daysInterval>0 ? $perDay/$daysInterval : 0 }}</td>
                            <td>{{ $loanList->time }} Days</td>
                            <td>
                                @if ($loanList->status == 1)
                                    <span class="badge bg-success">Paid</span>
                                @elseif($loanList->profit == 0 && $loanList->total != 0)
                                    <span class="badge bg-info">profit paid</span>
                                @else  
                                   <span class="badge bg-warning">Unpaid</span> 
                                @endif    
                            </td>
                            <td>{{ $loanList->phone_numbar }}</td>
                            <td>{{ $loanList->date_from }}</td>
                            <td class="d-flex ">
                                <a href={{ route( 'loanUpdate', [$loanList->id] ) }} class="btn btn-primary btn-sm">Edit</a>
                                <a href={{ route( 'loanDelete', [$loanList->id] ) }} class="btn btn-danger btn-sm ">Delete</a>
                                <a href="" id={{ $loanList->id }} data-toggle="modal" data-target="#exampleModalLong" class="btn btn-info btn-sm">Details</a>
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
