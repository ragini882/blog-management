<table class="table table-inverse">
    <thead>
        <tr>
            <th>ID</th>
            <th>Blog Name</th>
            <th>Description</th>
            <th>Date</th>
            <th>image</th>
            <th>Edit or Delete</th>
        </tr>
    </thead>
    <tbody id="blogs-list" name="blogs-list">
        @foreach ($blogs as $blog)
        <tr id="blog{{$blog->id}}">
            <td>{{$blog->id}}</td>
            <td>{{$blog->blog_name}}</td>
            <td>{{$blog->description}}</td>
            <td>{{$blog->blog_date}}</td>
            <td><img src="{{$blog->image}}" /></td>
            <td>
                @can('blog-edit')
                <button class="btn btn-info open-modal" value="{{$blog->id}}">Edit
                </button>
                @endcan
                @can('blog-delete')
                <button class="btn btn-danger delete-blog" value="{{$blog->id}}">Delete
                </button>
                @endcan
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
<div id="pagination">
    {{ $blogs->links() }}
</div>