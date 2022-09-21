@foreach($blogs as $blog)
<h1>{{$blog->user->name}}</h1>

@endforeach

<div>
    {{$blogs->links()}}
</div>