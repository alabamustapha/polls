@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="container">
        <div class="col-md-4">
           
            <div class="panel panel-default">
                <div class="panel-heading">Total Registered Users</div>

                <div class="panel-body">
                    <h2 class="text-info text-center">{{ $total_users }}<h2>

                </div>
            </div>
        </div>
        <div class="col-md-4">
           
            <div class="panel panel-default">
                <div class="panel-heading">Total Polls</div>

                <div class="panel-body">
                    <h2 class="text-info text-center">{{ $total_polls }}<h2>

                </div>
            </div>
        </div>
        <div class="col-md-4">
           
            <div class="panel panel-default">
                <div class="panel-heading">Total Votes</div>

                <div class="panel-body">
                    <h2 class="text-info text-center">{{ $total_votes }}<h2>
                </div>
            </div>
        </div>
     </div>   
    </div>
    
@endsection

