@if(session()->has('message') && auth()->check())
    <div class="alert alert-info alert-top mb-10" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {!! session()->get('message') !!}
    </div>
@endif