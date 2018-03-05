@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-8 col-md-offset-2">
           
            <div class="panel panel-default">
                <div class="panel-heading">Site Settings</div>

                <div class="panel-body">
                        <form method="POST" action="{{ route('update_setting') }}" class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <label for="max_vote_power" class="col-md-4 control-label">Maximum vote power</label>
                                <div class="col-sm-4">
                                    <input type="number" id="max_vote_power" class="form-control" name="max_vote_power" value="{{ $setting->max_vote_power }}" required autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user-verification" class="col-md-4 control-label">Verify users after registraion</label>
                                <div class="col-sm-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="new_user_activation" name="new_user_activation" {{ $setting->new_user_activation == 1 ? 'checked' : ''}}>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-4">
                                <button type="submit" class="btn btn-primary register-btn">
                                    Update Setting
                                </button>
                            </div>
                        </div>
                            
                            
                        </form>
                </div>
            </div>
        </div>
        
    </div>
    
</div>
@endsection
