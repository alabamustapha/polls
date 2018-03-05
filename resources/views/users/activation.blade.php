@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-8 col-md-offset-2">
           
            <div class="panel panel-default">
                <div class="panel-heading">Activation Required</div>

                <div class="panel-body">
                        @if (session('verification-message'))    
                            <div class="alert alert-info alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <strong>{!! session('verification-message') !!}</strong> 
                            </div>
                        @endif
                        @if (session('activation-message'))    
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <strong>{!! session('activation-message') !!}</strong> 
                            </div>
                        @endif
                </div>
            </div>
        </div>
        
    </div>
    
</div>
@endsection
