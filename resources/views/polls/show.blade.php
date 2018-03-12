@extends('layouts.app')

@section('styles')

<link href="{{ asset('css/morris/morris-0.4.3.min.css') }}" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

@endsection

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-offset-1 col-md-5">
            <div class="thumbnail">
                <img  src="{{ asset('storage/' . $poll->img) }}">
                <!-- <img  src="{{ asset('img/vote.png') }}"> -->
                <div class="caption">
                    <h3>{{ $poll->title }}</h3>
                    <p>{{ $poll->description }}</p>
                    <p>
                    
                    </p>
                </div>
            </div>
            
            <div class="progress">
                <div id="button_one_progress" class="progress-bar progress-bar-success" style="width: {{ $poll->button_one_percentage }}%">
                    <span>{{ $poll->button_one_percentage }}%</span>
                </div>

                <div id="button_two_progress" class="progress-bar progress-bar-warning progress-bar-striped" style="width: {{ $poll->button_two_percentage }}%">
                    <span>{{ $poll->button_two_percentage }}%</span>
                </div>
            </div>
            
        </div>
        <div class="col-md-5">

                <div class="row">
                    <div class="col-md-12">
                        <div id="morris-donut-chart" ></div>
                    </div>
                </div>

        </div>
        
    </div>
</div>
@endsection

@section('scripts')

<script src="{{ asset('js/morris/raphael-2.1.0.min.js') }}"></script>
<script src="{{ asset('js/morris/morris.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>

$(function() {

toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
  
var button_one = {!! json_encode($poll->button_one) !!};
var button_two = {!! json_encode($poll->button_two) !!};
var pollId = {!! json_encode($poll->id) !!};
var pollSlug = {!! json_encode($poll->slug) !!};
var votes_count = {!! json_encode($poll->votes()->count()) !!};

    
morris = Morris.Donut({
    element: 'morris-donut-chart',
    data: [
            { label: button_one, value: {!! json_encode($poll->button_one_percentage) !!} },
            { label: button_two, value: {!! json_encode($poll->button_two_percentage) !!} } 
        ],
    resize: true,
    colors: ['#3097d1', '#31708f'],
});



setInterval(function(){ 
    
    
    axios.get('/admin/polls/' + pollSlug + '/stats')
    .then(function (response) {
        
        if(response.data.votes_count > votes_count){
        
        $("div.progress > div#button_one_progress").attr("style", "width: " + response.data.button_one_percentage + "%;");
        $("div.progress > div#button_one_progress > span").html(response.data.button_one + " " + response.data.button_one_percentage + "%;");
        $("div.progress > div#button_two_progress").attr("style", "width: " + response.data.button_two_percentage + "%;");
        $("div.progress > div#button_two_progress > span").html(response.data.button_two + " " + response.data.button_two_percentage + "%;");
        
        morris.setData([
            {label: response.data.button_one, value: response.data.button_one_percentage},
            {label: response.data.button_two, value: response.data.button_two_percentage}
        ]);
        
        toastr.info("New votes");   
        votes_count = response.data.votes_count;
        }

    })
    .catch(function (error) {
        console.log(error);
    });


}, 


3000);


// Echo.channel(channel)
//     .listen('UserVoteForPoll', (e) => {


//         $("div.progress > div#button_one_progress").attr("style", "width: " + e.button_one_percentage + "%;");
//         $("div.progress > div#button_one_progress > span").html(e.button_one + " " + e.button_one_percentage + "%;");
//         $("div.progress > div#button_two_progress").attr("style", "width: " + e.button_two_percentage + "%;");
//         $("div.progress > div#button_two_progress > span").html(e.button_two + " " + e.button_two_percentage + "%;");
        
//         morris.setData([
//             {label: e.button_one, value: e.button_one_percentage},
//             {label: e.button_two, value: e.button_two_percentage}
//         ]);
        
//         toastr.info(e.username + " Voted for " + e.opinion);            

//     });


});



</script>

@endsection