@extends('layout.app')
@section('title', ' | List Projects')
@section('content')
    <section class="content-header">
        <h1>
        Projects
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Projects</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @include('includes.flash_message')
                        @if(user_can("create_project"))
                            <a href="{{ url('/admin/projects/create') }}" class="btn btn-success btn-sm pull-right" title="Add New document">
                                <i class="fa fa-plus" aria-hidden="true"></i> Add New
                            </a>
                        @endif
                        <form method="GET" action="{{ url('/admin/projects') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0" role="search">
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
                                   
                                        <th>S.no</th>
                                    
                                    <th> Client Name</th>
                                    <th>Project Type</th>
                                    <th>Project Description</th>
                                    
                                
                                    <th>Project Amount</th>
                                    <th>Project Cost</th>
                                    <th>Project Location</th>
                                    <th>Status</th>
                                    <!-- <th>Project Images</th> -->
                                    
                                        <!-- <th>Created by</th> -->
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($projects as $project)
                                    <tr>
                                    
                                            <td>{{ $project->id }}</td>
                                        
                                        <td>{{ $project->name }}</td>
                                        <td>{!! $project->type == 1?" Water Drilling":"Building Construction" !!}</td>
                                        <td>{{ $project->description}}</td>
                                        
                                        <!-- <td>@if(!empty($file->file)) <a href="{{ url('uploads/files/' . $file->file) }}"> <i class="fa fa-download"></i> {{$file->file}}</a> @endif</td> -->
                                           
                                            <td>{{ $project->amount }}</td>
                                            <td>{{$project->cost}}</td>
                                            <td>{{$project->location}}</td>
                                            <td><i class="btn btn-info">{{ $project->getStatus->name}}</i></td>
                                            <!-- <td>{{$project->image}}</td> -->
<!-- {{--                                        @if(\Auth::user()->is_admin == 1)--}} -->
                                            <!-- <td>{{ $project->createdBy->name }}</td> -->
<!-- {{--                                        @endif--}} -->
                                        <td>
                                            @if(user_can('view_project'))
                                                <a href="{{ url('/admin/projects/' . $project->id) }}" title="View Project"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                            @endif
                                            @if(user_can('edit_project'))
                                                <a href="{{ url('/admin/projects/' . $project->id . '/edit') }}" title="Edit project"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                            @endif
                                            @if(user_can('delete_project'))
                                                <form method="POST" action="{{ url('/admin/projects' . '/' . $project->id) }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete project" onclick="return confirm('Confirm delete?')"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $projects->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection