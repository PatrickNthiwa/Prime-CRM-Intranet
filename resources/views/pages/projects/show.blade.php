@extends('layout.app')
@section('title', ' | Show Project')
@section('content')
    <section class="content-header">
        <h1>
          Project {{ $project->id }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ url('/admin/projects') }}">Projects</a></li>
            <li class="active">Show</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('/admin/projects') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        @if(user_can('edit_document'))
                            <a href="{{ url('/admin/projects/' . $project->id . '/edit') }}" title="Edit document"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                        @endif
                        @if(user_can('delete_document'))
                            <form method="POST" action="{{ url('admin/projects' . '/' . $project->id) }}" accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete document" onclick="return confirm('Confirm delete?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                            </form>
                        @endif
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                @if(\Auth::user()->is_admin == 1)
                                    <tr>
                                        <th>S.no</th><td>{{ $project->id }}</td>
                                    </tr>
                                @endif
                                <tr><th> Client Name </th><td> {{ $project->name }} </td></tr>
                                <!-- <tr><th> File </th><td> @if(!empty($document->file)) <a href="{{ url('uploads/documents/' . $document->file) }}"> <i class="fa fa-download"></i> {{$document->file}}</a> @endif </td></tr> -->
                                <tr><th> Project Status </th><td> {{ $project->getStatus->name}} </td></tr>
                                <tr><th> Project Type </th><td>{!! $project->type == 1?" Water Drilling":"Building Construction" !!}</td></tr>
                                <tr><th>Project Amount</th><td>{{ $project->amount }}</td></tr>
                                @if(\Auth::user()->is_admin == 1)
                                    <tr><th> Created by </th><td>{{ $project->createdBy->name }}</td></tr>
                                    
                                @endif
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
