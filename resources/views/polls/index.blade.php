@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('create_poll') }}" class="btn btn-primary btn-block">Create Poll</a>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            
            
           
            <div class="panel panel-default">
                <div class="panel-heading">Polls</div>

                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Options</th>
                                <th>Votes</th>
                                <th>Percentages</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($polls as $poll)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{ route('poll_page', ['poll' => $poll->slug]) }}">{{ $poll->title }}</a></td>
                                <td>{{ $poll->description }}</td>
                                <td>{{ $poll->status == 1 ? "Voting On" : "Voting Close" }}</td>
                                <td>{{ $poll->button_one }}/{{ $poll->button_two }}</td>
                                <td>{{ $poll->votes()->count() }}</td>
                                <td>{{ $poll->button_one_percentage }}/{{ $poll->button_two_percentage }}</td>
                                <td>
                                        <a href="{{ route('toggle_poll_status', ['poll' => $poll->slug]) }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('toggle-poll-status-form-{{ $poll->slug }}').submit();">
                                            {{ $poll->status == 0 ? 'Turn on' : 'Turn off' }}
                                        </a>/

                                        <form id="toggle-poll-status-form-{{ $poll->slug }}" action="{{ route('toggle_poll_status', ['poll' => $poll->slug]) }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                        </form>

                                    <a href="{{ route('edit_poll', ['poll' => $poll->slug]) }}">Edit</a>/
                                        
                                        <a href="{{ route('delete_poll', ['poll' => $poll->slug]) }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('delete-poll-form-{{ $poll->slug }}').submit();">
                                            Delete         
                                        </a>

                                        <form id="delete-poll-form-{{ $poll->slug }}" action="{{ route('delete_poll', ['poll' => $poll->slug]) }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $polls->links() }}
                </div>
            </div>
        </div>
        
    </div>
    
</div>
    

@endsection