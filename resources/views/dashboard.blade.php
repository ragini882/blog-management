@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    <meta name="csrf-token" content="{{ csrf_token() }}">

                    <h1>Blog Manegment System</h1>
                    @can('blog-create')
                    <div class="card card-block">
                        <button id="btn-add" name="btn-add" class="btn btn-primary btn-xs">Add New Link</button>
                    </div>
                    @endcan

                    <div>
                        <table class="table table-inverse">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Blog Name</th>
                                    <th>Description</th>
                                    <th>Edit or Delete</th>
                                </tr>
                            </thead>
                            <tbody id="blogs-list" name="blogs-list">
                                @foreach ($blogs as $blog)
                                <tr id="blog{{$blog->id}}">
                                    <td>{{$blog->id}}</td>
                                    <td>{{$blog->blog_name}}</td>
                                    <td>{{$blog->description}}</td>
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

                        <div class="modal fade" id="linkEditorModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="linkEditorModalLabel">Link Editor</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form id="modalFormData" name="modalFormData" class="form-horizontal" novalidate="">
                                            @csrf
                                            <div class="form-group">
                                                <label for="inputLink" class="col-sm-2 control-label">Blog</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="blog_name" name="blog_name" placeholder="Enter Blog name" value="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Description</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="description" name="description" placeholder="Enter Link Description" value="">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn-save" value="add">Save changes
                                        </button>
                                        <input type="hidden" id="blog_id" name="blog_id" value="0">
                                        <input type="hidden" id="user_id" name="user_id" value="{{auth()->user()->id}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    You are Logged In
                </div>
            </div>
        </div>
    </div>
</div>
@endsection