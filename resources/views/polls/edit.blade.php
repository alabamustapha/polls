@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Create new Poll</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('update_poll', ['slug' => $poll->slug]) }}" enctype="multipart/form-data">
                                {{ method_field('PUT') }}
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label for="title" class="col-md-4 control-label">Title</label>

                                    <div class="col-md-6">
                                        <input id="title" type="text" class="form-control" name="title" value="{{ $poll->title }}" required autofocus>

                                        @if ($errors->has('title'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('img') ? ' has-error' : '' }}">
                                    <label for="img" class="col-md-4 control-label">Image</label>

                                    <div class="col-md-6">
                                        <input id="img" type="file" class="form-control" name="img" value="{{ old('img') }}">

                                        @if ($errors->has('img'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('img') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label for="description" class="col-md-4 control-label">Description</label>

                                    <div class="col-md-6">
                                        <textarea id="description" class="form-control" name="description">{{ $poll->description }}</textarea>

                                        @if ($errors->has('description'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('button_one') ? ' has-error' : '' }}">
                                    <label for="button_one" class="col-md-4 control-label">Button one text</label>

                                    <div class="col-md-6">
                                        <input id="button_one" type="text" class="form-control" name="button_one" value="{{ $poll->button_one }}" required>

                                        @if ($errors->has('button_one'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('button_one') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('button_two') ? ' has-error' : '' }}">
                                    <label for="button_two" class="col-md-4 control-label">Button two text</label>

                                    <div class="col-md-6">
                                        <input id="button_two" type="text" class="form-control" name="button_two" value="{{ $poll->button_two }}" required>

                                        @if ($errors->has('button_two'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('button_two') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                                    <label for="answer" class="col-md-4 control-label">Correct option</label>

                                    <div class="col-md-6">
                                        <select name="answer" id="answer" class="form-control">
                                            <option value="">---select answer----</option>
                                            <option value="1" {{ $poll->answer == 1 ? 'selected' : ''}}>Button one</option>
                                            <option value="2" {{ $poll->answer == 2 ? 'selected' : ''}}>Button two</option>
                                        </select>
                                        

                                        @if ($errors->has('answer'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('answer') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                

                                <!-- <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="status" value="1" {{ $poll->status ? 'checked' : '' }}> Allow voting
                                            </label>
                                        </div>
                                    </div>
                                </div> -->
                                
                                
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Update
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