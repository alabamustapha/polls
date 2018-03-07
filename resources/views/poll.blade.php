@extends('layouts.app')

@section('styles')
 <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
@endsection
@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-offset-4 col-md-5">
            <div class="thumbnail">
                <img  src="{{ asset('storage/' . $poll->img) }}">
                <!-- <img  src="{{ asset('img/vote.png') }}"> -->
                <div class="caption">
                    <h3>{{ $poll->title }}</h3>
                    <p>{{ $poll->description }}</p>
                    <p>
                    
                    
                    
                    @if(!auth()->user()->has_vote($poll))  
                        <a href="#" class="btn btn-primary btn-block" role="button"
                            onclick="event.preventDefault();
                                        document.getElementById('button-one').submit();">
                            {{ $poll->button_one }}
                        </a>

                        <a href="#" class="btn btn-info btn-block" role="button"
                            onclick="event.preventDefault();
                                        document.getElementById('button-two').submit();">
                            {{ $poll->button_two }}
                        </a>      
                        <form id="button-one" action="{{ route('vote', ['poll' => $poll->slug]) }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            <input type="hidden" name="vote" value="1">
                        </form>
                        
                        <form id="button-two" action="{{ route('vote', ['poll' => $poll->slug]) }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            <input type="hidden" name="vote" value="2">
                        </form>
                    @else
                        <a href="#" class="btn btn-default btn-block" role="button">
                            {{ auth()->user()->opinion($poll) }} 
                        </a>

                    @endif
                    
                    </p>
                </div>
            </div>
            @if(auth()->user()->has_vote($poll))
            <div class="progress">
                <div class="progress-bar progress-bar-success" style="width: {{ $poll->button_one_percentage }}%">
                    <span>{{ $poll->button_one}} {{ $poll->button_one_percentage }}%</span>
                </div>

                <div class="progress-bar progress-bar-warning progress-bar-striped" style="width: {{ $poll->button_two_percentage }}%">
                    <span>{{ $poll->button_two }} {{ $poll->button_two_percentage }}%</span>
                </div>
            </div>
            @endif
        </div>
        
    </div>
</div>
@endsection


@section('scripts')

<script>

    Echo.channel('orders')
        .listen('OrderShipped', (e) => {
            console.log(e.order.name);
    });

@endsection