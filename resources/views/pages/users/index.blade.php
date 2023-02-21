@extends('layout.app')

@section('title', ' | List users')

@section('content')

    <section class="content-header">
        <h1>
            Users
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Users</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        @include('includes.flash_message')

                        <a href="{{ url('/admin/users/create') }}" class="btn btn-success btn-sm pull-right" title="Add New user">
                            <i class="fa fa-plus" aria-hidden="true"></i> New User
                        </a>

                        <form method="GET" action="{{ url('/admin/users') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0" role="search">
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
                                    <th>#</th>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th> Last Login Time</th>
                                    <th>Position Title</th>
                                    <th>Is Admin</th>
                                    <th>Active / Banned</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($users->count() > 0)
                                @foreach($users as $item)
                                    <tr>

                                        <td>{{ $item->id }}</td>
                                        <td>
                                            {{ Form::checkbox('check_user', 1, false,['class'=>'check_user','data-id' => $item->id ]) }}
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td> {{ $item->last_login_at }}</td>
                                        <td>{{ $item->position_title }}</td>
                                        <td>{!! $item->is_admin == 1? '<i class="fa fa-check"></i>':'<i class="fa fa-times"></i>' !!}</td>
                                        <td>{!! $item->is_active == 1? '<i class="fa fa-check"></i>':'<i class="fa fa-ban"></i>' !!}</td>
                                        <td>@if(isset($item->roles[0]))<a href="{{ url('/admin/roles/'.$item->roles[0]->id.'/edit') }}"> <span class="label label-success">{{ $item->roles[0]->name }}</span> @endif</a></td>
                                        <td>
                                            <a href="{{ url('/admin/users/' . $item->id) }}" title="View user"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> </button></a>
                                            <a href="{{ url('/admin/users/' . $item->id . '/edit') }}" title="Edit user"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                            
                                            <a href="{{ url('/admin/mailbox-create') }}" title="Edit user"><button class="btn btn-primary btn-sm"><i class="fa fa-envelope" aria-hidden="true"></i></button></a>
                                            <a href="{{ url('/admin/users/role/' . $item->id) }}" title="Select role"><button class="btn bg-purple btn-sm"><i class="fa fa-user" aria-hidden="true"></i> Select Role</button></a>

                                            @if($item->is_admin == 0)
                                                <form method="POST" action="{{ url('/admin/users' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete user" onclick="return confirm('Confirm delete?')"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $users->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    @section('scripts')

    <script>
        $(function () {
            //Add text editor
            $("#compose-textarea").wysihtml5();

            $("#item_id").select2({placeholder: "To:"});
        });
    </script>

@endsection
{{--    <script>--}}
{{--        $('.user-all').change(function (e) {--}}
{{--            var value = $('.user-all:checked').val();--}}
{{--            if (value == 1) {--}}
{{--                $('input[name="check_user"]').prop('checked',true);--}}
{{--                $('.send').removeAttr('disabled');--}}
{{--            }else{--}}
{{--                $('input[name="check_user"]').prop('checked',false);--}}
{{--                $('.send').attr('disabled','disabled');--}}
{{--            }--}}
{{--        });--}}

{{--        $("input[name='check_user']").change(function () {--}}
{{--            if ($("input[name='check_user']:checked").length > 0) {--}}
{{--                $('.send').removeAttr('disabled');--}}
{{--            }else{--}}
{{--                $('.send').attr('disabled','disabled');--}}
{{--            }--}}
{{--        });--}}

{{--        $('.send').click(function (e) {--}}
{{--            e.preventDefault();--}}
{{--            var ids = [];--}}

{{--            $.each($('input[name="check_user"]:checked'),function(){--}}
{{--                ids.push($(this).data('id'));--}}
{{--            });--}}

{{--            if (ids != '') {--}}
{{--                $(this).attr("disabled", true);--}}
{{--                $(this).html('<i class="fa fa-spinner fa-spin"></i> Send Mail');--}}
{{--                $.ajax({--}}
{{--                    url: '{{ route('send.mail') }}',--}}
{{--                    type: 'POST',--}}
{{--                    data: {--}}
{{--                        _token:$('meta[name="csrf-token"]').attr('content'),--}}
{{--                        ids:ids--}}
{{--                    },--}}
{{--                    success: function (data) {--}}
{{--                        $('.success-mail').css('display','block');--}}
{{--                        $('.send').attr("disabled", false);--}}
{{--                        $('.send').html('<i class="fa fa-share"></i> Send Mail');--}}
{{--                    }--}}
{{--                });--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
@endsection
