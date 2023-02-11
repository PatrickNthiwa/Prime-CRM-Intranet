@extends('layout.app')
@section('title', ' | List Files')
@section('content')
    <section class="content-header">
        <h1>
            Files
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Files</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @include('includes.flash_message')
                        @if(user_can("create_file"))
                            <a href="{{ url('/admin/files/create') }}" class="btn btn-success btn-sm pull-right" title="Add New document">
                                <i class="fa fa-plus" aria-hidden="true"></i> Add New
                            </a>
                        @endif
                        <form method="GET" action="{{ url('/admin/files') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    @if(\Auth::user()->is_admin == 1)
                                        <th>#</th>
                                    @endif
                                    <th>Name</th>
                                    <th>File Type</th>
                                        <th>Created by</th>
                                        <th>Download</th>
                                        @if(\Auth::user()->is_admin == 1)
                                            <th>Action</th>
                                        @endif

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($files as $file)
                                    <tr>
                                        @if(\Auth::user()->is_admin == 1)
                                            <td>{{ $file->id }}</td>
                                        @endif
                                        <td>{{ $file->name}}</td>
                                            <td><i class="btn bg-maroon">{{ $file->getType->name }}</i></td>

                                            <td>{{ $file->createdBy->name }}</td>
                                        <td>@if(!empty($file->file)) <a href="{{ url('uploads/files/' . $file->file) }}"> <i class="fa fa-download"></i> {{$file->file}}</a> @endif</td>

{{--                                        @if(\Auth::user()->is_admin == 1)--}}
{{--                                        @endif--}}
                                        <td>
{{--                                            @if(user_can('view_file'))--}}
{{--                                                <a href="{{ url('/admin/files/' . $file->id) }}" title="View file"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>--}}
{{--                                            @endif--}}
                                            @if(user_can('delete_file'))
                                                <form method="POST" action="{{ url('/admin/files' . '/' . $file->id) }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete file" onclick="return confirm('Confirm delete?')"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $files->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
