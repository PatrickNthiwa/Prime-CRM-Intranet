
@extends('layout.app')
@section('title', ' | Show document')
@section('content')
    <section class="content-header">
        <h1>
            File #{{ $file->id }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ url('/admin/files') }}">Files</a></li>
            <li class="active">Show</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('/admin/files') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        @if(user_can('edit_file'))
                            <a href="{{ url('/admin/files/' . $file->id . '/edit') }}" title="Edit File"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        @endif
                        @if(user_can('file_file'))
                            <form method="POST" action="{{ url('admin/files' . '/' . $file->id) }}" accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete file" onclick="return confirm('Confirm delete?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                            </form>
                        @endif
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                @if(\Auth::user()->is_admin == 1)
                                    <tr>
                                        <th>ID</th><td>{{ $file->id }}</td>
                                    </tr>
                                @endif
                                <tr><th> Name </th><td> {{ $file->name }} </td></tr>
                                <tr><th> File </th><td> @if(!empty($file->file)) <a href="{{ url('uploads/files/' . $file->file) }}"> <i class="fa fa-download"></i> {{$file->file}}</a> @endif </td></tr>
                                <tr><th> File Type </th><td> <i class="btn bg-maroon">{{ $file->name }}</i> </td></tr>
                                <tr><th> Created at </th><td>{{ $file->created_at }}</td></tr>
                                <tr><th> Modified at </th><td>{{ $file->updated_at }}</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
