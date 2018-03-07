@extends('layouts.app')

@section('styles')

<link href="{{ asset('css/datatables.min.css') }}">
<link href="{{ asset('css/datatables.bootstrap.min.css') }}">


@endsection

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-12">
           
            <div class="panel panel-default">
                <div class="panel-heading">Registered Users</div>

                <div class="panel-body">
                     <table class="table table-striped" id="users">
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

                     <div class="row">
                        <div class="col-md-12 text-center">
                            {{ $users->links() }}
                        </div>
                    </div>
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
     
        $('table#users').DataTable( {
                pageLength: 50,
        });

    });
 </script>   

@endsection