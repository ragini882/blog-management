<div class="container">
    <p>We are happy to help you.</p>
    <span class="time-right">11:00</span>
</div>
@if(isset($messages) && count($messages)>0)
@foreach($messages as $message)
<div class="container darker">
    <p>{{$message->message}}</p>
    <span class="time-left">{{$message->created_at}}</span>
</div>
@endforeach
@endif