@if(isset($blogs) && count($blogs) > 0)
@foreach($blogs as $blog)
<img src="{{$blog->image}}" alt="Nature" style="height: 200px; width: 800px;">
<div class="w3-container">
    <h3><b>{{$blog->blog_name}}</b></h3>
    <h5><span class="w3-opacity">{{date('M d, Y', strtotime($blog->blog_date))}}</span></h5>
</div>

<div class="w3-container">
    <p>{!! $blog->description !!}</p>
    <div class="w3-row">
        <div class="w3-col m8 s12">
            <p><button class="w3-button w3-padding-large w3-white w3-border"><b>READ MORE »</b></button></p>

        </div>

        <div class="w3-col m4 w3-hide-small">
            <p><span class="w3-padding-large w3-right"><b>Written By  </b> <span class="w3-tag">{{$blog->user->name}}</span></span></p>
        </div>

    </div>
</div>
<!-- //////// -->
<div class="w3-container">
    <div class="w3-row" style="margin-bottom: 10px">
        <h4>Display Comments</h4>
        @include('commentsDisplay', ['comments' => $blog->comments, 'blog_id' => $blog->id])
        <hr />
        <h4>Add comment</h4>
        <form method="POST" action="{{ route('commentstore') }}">
            @csrf
            <div class="form-group">
                <textarea class="form-control" name="body"></textarea>
                <input type="hidden" name="blog_id" value="{{ $blog->id }}" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Add Comment" />
            </div>
        </form>
    </div>
</div>
@endforeach
@else
<div class="alert alert-warning">
    <strong>Sorry!</strong> No Blogs Found.
</div>
@endif