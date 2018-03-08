@extends('layouts.app')

@section('styles')

<link href="{{ asset('css/datatables.min.css') }}">
<link href="{{ asset('css/datatables.bootstrap.min.css') }}">


@endsection

@section('content')

<div class="container">
    <div class="row">
        
        <div class="col-md-10 col-md-offset-1">
           
            <div class="panel panel-default">
                <div class="panel-heading">Vote history</div>

                <div class="panel-body">
                    <table class="table table-striped  table-hover" id="histories">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Poll Title</th>
                                <th>Answer</th>
                                <th>Option choosen</th>
                                <!-- <th>Vote Power</th> -->
                                <!-- <th>Total votes</th> -->
                                <!-- <th>Looses</th> -->
                                <!-- <th>Wins</th> -->
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($votes as $vote)
                        
                            <tr>
                                    
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{ route('view_poll', ['poll' => $vote->poll->slug]) }}">{{ $vote->poll->title }}</a></td>
                                <td>{{ $vote->poll->answer == 1 ? $vote->poll->button_one : $vote->poll->button_two }}</td>
                                <td>{{ $vote->vote == 1 ? $vote->poll->button_one : $vote->poll->button_two }}</td>
                                <!-- <td>{{ $vote->vote_power }}</td> -->
                                @if($vote->poll->status == 1)
                                <!-- <td>{{ 'N/A' }}</td>
                                <td>{{ 'N/A' }}</td>
                                <td>{{ 'N/A' }}</td> -->
                                <td>{{ "N/A" }}</td>
                                @else
                                <!-- <td>{{ $vote->poll->total_score }}</td>
                                <td>{{ $vote->poll->loss_percentage }}%</td>
                                <td>{{ $vote->poll->win_percentage }}%</td> -->
                                <td>{{  $vote->poll->answer == $vote->vote ? "Correct" : "Wrong"}}</td>
                                @endif
                                
                            </tr>
                        
                        @endforeach    
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        
    </div>
    
</div>
    
@endsection

@section('scripts')

    <script src="{{ asset('js/datatables.min.js') }}"></script>

    <script>
    $(document).ready(function() {
     
        $('table#histories').DataTable( {
                pageLength: 50,
        });

    });
 </script>   

@endsection