
@extends('layouts.app')

@section('mainpart')
    <div class="card my-4 px-0 container">

        <div class="card-header d-flex justify-content-between">
            <h3 class="position-relative">All Loan List</h3>
            <form action={{ route('loan.index') }} method="get">
                <input type="text" name="amount" placeholder="Search Amount">
                <input type="submit"  value="Search">
            </form>
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
                        <th>Total Due</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_due_sum = 0 ;
                    @endphp
                    @foreach ($loans as $key => $loan)
                   
                      @php 
                     
                      $created = new \Carbon\Carbon($loan->date_from);
                      $now = \Carbon\Carbon::now();
                      $daysInterval = $created->diff($now)->days;
                    //   $total_due = ( ($loan->day_profit * $daysInterval) + $loan->amount ) - $loan->paid_amount;
                      $total_due = ( $loan->total_profit + $loan->amount ) - $loan->paid_amount;
                      $total_due_sum = $total_due_sum + $total_due;
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
                            <td>
                                @if ($loan->status==2)
                                 <span class="badge bg-info">Close</span>
                                @else
                                {{ $daysInterval>0 ? $loan->day_profit * $daysInterval : 0 }}
                                @endif
                            </td>
                            <td>{{ $loan->paid_amount>0 ? $loan->paid_amount : 0 }}</td>
                            <td>{{ $total_due }}</td>
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
                                {{-- <a data-id="{{ $loan->id }}" class="btn btn-info btn-sm modalUpdatePickupBtn">Close</a> --}}
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="text-center">
                        <th colspan="2">Total amount</th>
                        <th>{{ $loans != null? $loans->sum('amount') : 0 }}</th>
                        <th colspan="5"></th>
                        <th>total paid</th>
                        <th>{{ $loans != null? $loans->sum('paid_amount') : 0 }}</th>
                        <th>{{ $total_due_sum }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

 
  
@endsection
 @section('pagejs')


 @endsection