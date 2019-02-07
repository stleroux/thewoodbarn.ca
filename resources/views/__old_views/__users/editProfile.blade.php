@extends('layouts.main')
 
@section('content')

{!! Form::model($profile, ['method' => 'PATCH', 'route' => ['users.updateProfile', $profile->user_id]]) !!}

	<div class="row">
	    <div class="col-lg-12 margin-tb">
	        <div class="pull-left">
	            <h2>Edit User Profile</h2>
	        </div>
	        <div class="pull-right">
                {{ Form::submit('Update User Profile', ['class' => 'btn btn-success btn-sm btn-block']) }}
	            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
	        </div>
	    </div>
	</div>
	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<strong>Whoops!</strong> There were some problems with your input.<br><br>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	
	<div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">User Preferences</div>
                                    <div class="panel-body">
                                        <div class="col-md-3">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Style</div>
                                                <div class="panel-body">
                                                    {{ Form::select('style', array(
                                                        'bootstrap' => 'Bootstrap',
                                                        'cerulean' => 'Cerulean',
                                                        'cosmo' => 'Cosmo',
                                                        'cyborg'=>'Cyborg',
                                                        'darkly'=>'Darkly',
                                                        'flatly'=>'Flatly',
                                                        'journal'=>'Journal',
                                                        'lumen'=>'Lumen',
                                                        'paper'=>'Paper',
                                                        'readable'=>'Readable',
                                                        'sandstone'=>'Sandstone',
                                                        'simplex'=>'Simplex',
                                                        'slate'=>'Slate (default)',
                                                        'spacelab'=>'SpaceLab',
                                                        'superhero'=>'SuperHero',
                                                        'united'=>'United',
                                                        'yeti'=>'Yeti',
                                                        ), $profile->style, array('class'=>'form-control')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Display Email</div>
                                                <div class="panel-body">
                                                    {{-- Form::select('show_email', array('0' => 'No', '1' => 'Yes'), null, array('class'=>'form-control')) --}}
                                                    {{ Form::checkbox('show_email', 1, $profile->show_email, ['data-toggle=toggle', 'data-on="Yes"', 'data-off="No"', 'data-onstyle="success"', 'data-offstyle="danger"']) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Landing Page</div>
                                                <div class="panel-body">
                                                    {{ Form::select('landingPage', array(
                                                        'blog' => 'Blog',
                                                        'dashboard' => 'Dashboard',
                                                        'home' => 'Home (Default)',
                                                        'profile' => 'Profile',
                                                        ), $profile->landingPage, array('class'=>'form-control')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Display Size</div>
                                                <div class="panel-body">
                                                    {{ Form::select('display', array(
                                                        'normal' => 'Normal',
                                                        'wide' => 'Wide',
                                                        ), $profile->display, array('class'=>'form-control')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Author Format</div>
                                                <div class="panel-body">
                                                    {{ Form::select('authorFormat', array(
                                                        '1' => 'Username',
                                                        '2' => 'Last Name, First Name',
                                                        '3' => 'First Name Last Name'
                                                        ), $profile->authorFormat, array('class'=>'form-control')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Date Format</div>
                                                <div class="panel-body">
                                                    {{ Form::select('dateFormat', array(
                                                        '1' => 'Jan 01, 2017',
                                                        '2' => 'Jan 1, 2017',
                                                        '3' => '01/01/2017 (M-D-Y)',
                                                        '4' => '1/01/2017 (M-D-Y)',
                                                        '5' => '01 Jan 2017',
                                                        '6' => '1 Jan 2017',
                                                        '7' => '01/01/2017 (D-M-Y)',
                                                        '8' => '1/01/2017 (D-M-Y)',
                                                        ), $profile->dateFormat, array('class'=>'form-control')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Rows Per Page</div>
                                                <div class="panel-body">
                                                    {{ Form::select('rowsPerPage', array(
                                                        '5' => '5',
                                                        '10' => '10',
                                                        '15' => '15',
                                                        '20' => '20',
                                                        '25' => '25',
                                                        '50' => '50',
                                                        '100' => '100'
                                                        ), $profile->rowsPerPage, array('class'=>'form-control')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Action Buttons</div>
                                                <div class="panel-body">
                                                    {{ Form::select('actionButtons', array(
                                                        '1' => 'Icons and Text',
                                                        '2' => 'Icons only',
                                                        '3' => 'Text Only',
                                                        ), $profile->actionButtons, array('class'=>'form-control')) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
	</div>
{!! Form::close() !!}
@endsection