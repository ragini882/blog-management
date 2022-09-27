<!-- <div class="container">
    <p>We are happy to help you.</p>
    <span class="time-right">11:00</span>
</div> -->
@if(isset($messages) && count($messages)>0)
@foreach($messages as $message)
@if($message->msg_type == 0)
<div class="container darker">
    <p>{{$message->message}}</p>
    <span class="time-left">{{$message->user_name}} {{$message->created_at}}</span>
</div>
@else
<div class="container">
    <p>{{$message->message}}</p>
    <span class="time-right">{{$message->user_name}} {{$message->created_at}}</span>
</div>
@endif
@endforeach
@endif