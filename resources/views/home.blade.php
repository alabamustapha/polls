@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach($polls as $poll)
        <div class="col-sm-6 col-md-4 col-lg-3 ">
            <div class="thumbnail">
                <img  src="{{ asset('storage/' . $poll->img) }}">
                <!-- <img  src="{{ asset('img/vote.png') }}"> -->
                <div class="caption">
                    <h3>{{ $poll->title }}</h3>
                    <p>{{ $poll->description }}</p>
                    <p><a href="{{ route('view_poll', ['poll' => $poll->slug]) }}" class="btn btn-primary btn-block" role="button">Visit page</a></p>
                </div>
            </div>
            @if(auth()->user()->has_vote($poll))
            <div class="progress">
                <div class="progress-bar progress-bar-success" style="width: {{ $poll->button_one_percentage }}%">
                    <span>{{ $poll->button_one }} {{ $poll->button_one_percentage }}%</span>
                </div>

                <div class="progress-bar progress-bar-warning progress-bar-striped" style="width: {{ $poll->button_two_percentage }}%">
                    <span> {{ $poll->button_two }} {{ $poll->button_two_percentage }}%</span>
                </div>
            </div>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection
