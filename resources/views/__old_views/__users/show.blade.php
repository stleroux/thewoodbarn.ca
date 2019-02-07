@extends ('layouts.main')

@section ('title', '| Show User')

@section ('stylesheets')
    {{ Html::style('css/admin.css') }}
@stop

@section('content')
    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="{{ route('users.index') }}">Users</a></li>
        <li class="active">{{ $user->first_name }} {{ $user->last_name }}</li>
    </ol>

    <div class="row">
        <div class="col-md-9">

       		<div class="panel panel-default">
                <div class="panel-heading"><b>User Permissions</b> :: {{ $user->first_name }} {{ $user->last_name }} ({{ $user->email }})</div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">Personal Info</div>
                            <div class="panel-body">
                                <table>
                                    <tr>
                                        <th width='120px'>First Name</th>
                                        <td>{{ $user->first_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Last Name</th>
                                        <td>{{ $user->last_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email Address</th>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        	</div>

            
        </div>
    	<!-- Sidebar -->
    	<div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">Options</div>
                <div class="panel-body">
                    <div>
                        <a href="{{ route('users.index') }}" class="btn btn-default btn-block">All Users</a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-block btn-primary">Edit User</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End row -->


    <div class="row">
    	<div class="col-md-9">
        	<div class="panel panel-default">
                <div class="panel-heading">Account Information</div>
        		<div class="panel-body">
                    <div class="col-md-4">
                        @include ('users/panels/creation_info')
                    </div>
                    <div class="col-md-3">
                        @include ('users/panels/role_info')
                    </div>

                    <div class="col-md-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">Active</div>
                            <div class="panel-body">
                                @if ($user->active)
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                @else
                                    <i class="fa fa-ban" aria-hidden="true"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">Show Email</div>
                            <div class="panel-body">
                                @if ($user->show_email)
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                @else
                                    <i class="fa fa-ban" aria-hidden="true"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section ('scripts')
@stop
