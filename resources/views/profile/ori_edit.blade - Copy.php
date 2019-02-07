@extends ('layouts.main')

@section ('title', 'Template')

@section ('content')

<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li class="active">Edit Profile</li>
</ol>

{!! Form::model($user, ['route'=>['profile.update', $user->id], 'method' => 'PUT', 'files'=>true]) !!}
<div class="row">
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">My Profile</div>
                    <div class="panel-body">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">First Name</div>
                                <div class="panel-body">
                                    {{ Form::text ('first_name', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">Last Name</div>
                                <div class="panel-body">
                                    {{ Form::text ('last_name', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="panel panel-default">
                                <div class="panel-heading">Email Address</div>
                                <div class="panel-body">
                                    {{ Form::text ('email', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="panel panel-default">
                                <div class="panel-heading">Display Email</div>
                                <div class="panel-body">
                                    {{ Form::select('show_email', array('0' => 'No', '1' => 'Yes'), null, array('class'=>'form-control')) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="panel panel-default">
                                <div class="panel-heading">Style</div>
                                <div class="panel-body">
                                    {{ Form::select('style', array('bootstrap' => 'Bootstrap', 'cerulean' => 'Cerulean'), null, array('class'=>'form-control')) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="panel panel-default">
                                <div class="panel-heading">Information</div>
                                <div class="panel-body">
                                    <div class="col-md-6">
                                        <div><b>Created On</b></div>
                                        <div>{{ date('M j, Y', strtotime($user->created_at)) }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div><b>Last Updated On</b></div>
                                        <div>{{ date('M j, Y', strtotime($user->updated_at)) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">Roles</div>
                                <div class="panel-body">
                                    <div class="col-md-3">
                                        @foreach ($user->roles as $role)
                                            <div> {{ $role->name }} </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Image</div>
                    <div class="panel-body text-center">
                        @if ($user->image)
                            {{ Html::image("images/profiles/" . $user->image, "",array('height'=>'115','width'=>'115')) }}
                        @else
                            <i class="fa fa-5x fa-user" aria-hidden="true"></i>
                        @endif
                        <br /><br />
                        {{ Form::file ('image' , ['class'=>'form-control']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">Options</div>
            <div class="panel-body">
                <div class="col-md-12">
                    {{ Form::submit('Update Profile', ['class' => 'btn btn-success btn-block']) }}

                    @if ($user->image)
                        <a href="{{ route('profile.delete_image', $user->id) }}" class="btn btn-danger btn-block">Delete Image</a>
                    @endif
                    
                    <a href="{{ route('profile.show', $user->id) }}" class="btn btn-default btn-block">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}

@stop