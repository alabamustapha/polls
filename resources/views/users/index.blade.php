@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-12">
           
            <div class="panel panel-default">
                <div class="panel-heading">Registered Users</div>

                <div class="panel-body">
                     <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>S/N</td>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Vote power</td>
                                <td>Total Votes</td>
                                <td>Correct</td>
                                <td>Incorrect</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->vote_power }}</td>
                                    <td>{{ $user->votes()->count() }}</td>
                                    <td>{{ $user->votes_won }}</td>
                                    <td>{{ $user->votes_lose }}</td>
                                    <td>{{ $user->status == 1 ? 'Active' : 'Deactivated' }}</td>
                                    <td>
                                        <a href="{{ route('toggle_user_status', ['user' => $user->id]) }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('toggle-status-form-{{ $user->id }}').submit();">
                                            {{ $user->status == 0 ? 'Activate' : 'Deactivate' }}
                                        </a>

                                        <form id="toggle-status-form-{{ $user->id }}" action="{{ route('toggle_user_status', ['user' => $user->id]) }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </td>
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
