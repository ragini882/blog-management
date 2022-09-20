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
                        </br></br>
                        <input type="text" class="form-control" id="search" name="search" placeholder="Search">
                    </div>
                    @endcan

                    <div>

                        <div id="table_data">
                            @include('blog_table')
                        </div>


                        <div class="modal fade" id="linkEditorModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="linkEditorModalLabel">Link Editor</h4>
                                    </div>
                                    <form id="modalFormData" name="modalFormData" class="form-horizontal" novalidate="" enctype="multipart/form-data">

                                        <div class="modal-body">
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
                                                    <textarea class="form-control" id="description" name="description" placeholder="Enter Link Description" value=""></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Date</label>
                                                <div class="col-sm-10">
                                                    <input type="date" class="form-control" id="blog_date" name="blog_date" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Image</label>
                                                <div class="col-sm-10">
                                                    <input type="file" id="image" name="image" value="">
                                                </div>
                                                <img id="preview-image-before-upload" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif" alt="preview image" style="max-height: 250px;">
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" id="btn-save" value="add">Save changes
                                            </button>
                                            <input type="hidden" id="blog_id" name="blog_id" value="0">
                                            <input type="hidden" id="user_id" name="user_id" value="{{auth()->user()->id}}">
                                        </div>]
                                    </form>
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