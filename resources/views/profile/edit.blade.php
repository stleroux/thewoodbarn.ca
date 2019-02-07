@section ('stylesheets')
  {{ Html::style('css/main.css') }}
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@stop




{!! Form::model($user, ['route'=>['profile.update', $user->id], 'method' => 'PUT', 'files'=>true]) !!}
{{--   <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active">
          <a href="#editgeneral" aria-controls="editgeneral" role="tab" data-toggle="tab">General Information</a>
      </li>
      <li role="presentation" class="">
          <a href="#editpreferences" aria-controls="editpreferences" role="tab" data-toggle="tab">User Preferences</a>
      </li>
      <li role="presentation" class="">
          <a href="#editimage" aria-controls="editimage" role="tab" data-toggle="tab">Image</a>
      </li>
      <li role="presentation">
          <a href="#changePWD1" aria-controls="changePWD1" role="tab" data-toggle="tab" class="hidden-xs hidden-sm">Change Password</a>
          <a href="#changePWD1" aria-controls="changePWD1" role="tab" data-toggle="tab" class="hidden-md hidden-lg">Change Pwd</a>
      </li>
  </ul>

  <br /> --}}
  <div class="row">
    <div class="col-md-12">
      <div class="well well-sm clearfix">
        <div class="pull-right">
          @if (((Auth::user()->id) == $user->id))
            {{--==================================================================================================================--}}
            {{-- DELETE IMAGE BUTTON --}}
            {{--==================================================================================================================--}}
              @if ($user->image)
                <a href="{{ route('profile.deleteImage', $user->id) }}" class="btn btn-danger btn-xs">Delete Image</a>
              @endif
            {{--==================================================================================================================--}}
            {{-- END DELETE IMAGE BUTTON --}}
            {{--==================================================================================================================--}}

            {{--==================================================================================================================--}}
            {{-- CANCEL BUTTON --}}
            {{--==================================================================================================================--}}
              <a href="{{ route('profile.show', $user->id) }}" class="btn btn-default btn-xs">
                <i class="fa fa-ban" aria-hidden="true"></i> Cancel
              </a>
            {{--==================================================================================================================--}}
            {{-- END CANCEL BUTTON --}}
            {{--==================================================================================================================--}}

            {{--==================================================================================================================--}}
            {{-- RESET FORM BUTTON --}}
            {{--==================================================================================================================--}}
              <button type="reset" class="btn btn-primary btn-xs"><i class="fa fa-repeat"></i> Undo Changes</button>
            {{--==================================================================================================================--}}
            {{-- END RESET FORM BUTTON --}}
            {{--==================================================================================================================--}}

            {{--==================================================================================================================--}}
            {{-- UPDATE PROFILE BUTTON --}}
            {{--==================================================================================================================--}}
              <button type="submit" class="btn btn-info btn-xs"><i class="fa fa-save"></i> Update Profile</button>
            {{--==================================================================================================================--}}
            {{-- END UPDATE PROFILE BUTTON --}}
            {{--==================================================================================================================--}}
          @endif
        </div>
      </div>
    </div>
  </div>

  {{-- <div class="tab-content"> --}}
   
    @if (Auth::user()->id == $user->id) 
      <div role="tabpanel" class="tab-pane fade in active" id="editgeneral">
        <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">Personal Info</div>
                <div class="panel-body">
                  <div class="col-md-3">
                    <div class="panel panel-default">
                      <div class="panel-heading">First Name</div>
                      <div class="panel-body {{ $errors->has('first_name') ? 'has-error' : '' }}">
                        {{ Form::text ('first_name', null, ['class' => 'form-control']) }}
                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="panel panel-default">
                      <div class="panel-heading">Last Name</div>
                      <div class="panel-body {{ $errors->has('last_name') ? 'has-error' : '' }}">
                        {{ Form::text ('last_name', null, ['class' => 'form-control']) }}
                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="panel panel-default">
                      <div class="panel-heading">Email Address</div>
                      <div class="panel-body {{ $errors->has('email') ? 'has-error' : '' }}">
                        {{ Form::text ('email', null, ['class' => 'form-control']) }}
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>

      <div role="tabpanel" class="tab-pane fade in" id="editpreferences">
        <div class="row">
          <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">User Preferences</div>
            <div class="panel-body">
              <div class="col-md-3">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    Style
                    <div class="pull-right">
                      <a href="#" data-toggle="tooltip" title="Choosing a different style will change the whole apperance of the site">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                      </a>
                    </div>
                  </div>
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
                      ), $user->style, array('class'=>'form-control')) }}
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    Display Email
                    <div class="pull-right">
                      <a href="#" data-toggle="tooltip" title="Display your e-mail address to the general public when someone views your profile">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                      </a>
                    </div>
                  </div>
                  <div class="panel-body">
                    {{-- Form::select('show_email', array('0' => 'No', '1' => 'Yes'), null, array('class'=>'form-control')) --}}
                    {{ Form::checkbox('show_email', 1, $user->show_email, ['data-toggle=toggle', 'data-on="Yes"', 'data-off="No"', 'data-onstyle="success"', 'data-offstyle="danger"']) }}
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    Landing Page
                    <div class="pull-right">
                      <a href="#" data-toggle="tooltip" title="The page you will be redirected to when you log in to the site">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                      </a>
                    </div>
                  </div>
                  <div class="panel-body">
                    {{ Form::select('landingPage', array(
                      'blog' => 'Blog',
                      'dashboard' => 'Dashboard',
                      'home' => 'Home (Default)',
                      'profile' => 'Profile',
                      ), $user->landingPage, array('class'=>'form-control')) }}
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    Display Size
                    <div class="pull-right">
                      <a href="#" data-toggle="tooltip" title="Changes the width of the display of the whole site">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                      </a>
                    </div>
                  </div>
                  <div class="panel-body">
                    {{ Form::select('display', array(
                      'normal' => 'Normal',
                      'wide' => 'Wide',
                      ), $user->display, array('class'=>'form-control')) }}
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    Author Format
                    <div class="pull-right">
                      <a href="#" data-toggle="tooltip" title="Changes the way the author's name will be displayed">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                      </a>
                    </div>
                  </div>
                  <div class="panel-body">
                    {{ Form::select('authorFormat', array(
                      '1' => 'Username',
                      '2' => 'Last Name, First Name',
                      '3' => 'First Name Last Name'
                      ), $user->authorFormat, array('class'=>'form-control')) }}
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    Date Format
                    <div class="pull-right">
                      <a href="#" data-toggle="tooltip" title="Changes the way the dates are displayed">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                      </a>
                    </div>
                  </div>
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
                      ), $user->dateFormat, array('class'=>'form-control')) }}
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    Rows Per Page
                    <div class="pull-right">
                      <a href="#" data-toggle="tooltip" title="Changes the number of entries displayed in grids">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                      </a>
                    </div>
                  </div>
                  <div class="panel-body">
                    {{ Form::select('rowsPerPage', array(
                      '5' => '5',
                      '10' => '10',
                      '15' => '15',
                      '20' => '20',
                      '25' => '25',
                      '50' => '50',
                      '100' => '100'
                      ), $user->rowsPerPage, array('class'=>'form-control')) }}
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    Action Buttons
                    <div class="pull-right">
                      <a href="#" data-toggle="tooltip" title="Changes the appearance of some buttons (Edit & Delete only at the moment)">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                      </a>
                    </div>
                  </div>
                  <div class="panel-body">
                    {{ Form::select('actionButtons', array(
                      '1' => 'Icons and Text',
                      '2' => 'Icons only',
                      '3' => 'Text Only',
                      ), $user->actionButtons, array('class'=>'form-control'))
                    }}
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    Alert Fade Time
                    <div class="pull-right">
                      <a href="#" data-toggle="tooltip" title="Changes the length of time the alerts will be displayed">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                      </a>
                    </div>
                  </div>
                  <div class="panel-body">
                    {{ Form::select('alertFadeTime', array(
                      '2000' => '2 seconds',
                      '3000' => '3 seconds',
                      '4000' => '4 seconds',
                      '5000' => '5 seconds',
                      '6000' => '6 seconds',
                      '7000' => '7 seconds',
                      '8000' => '8 seconds',
                      '9000' => '9 seconds',
                      '10000' => '10 seconds',
                      '15000' => '15 seconds',
                      '20000' => '20 seconds',
                      '1000000000' => 'Forever',
                      ), $user->alertFadeTime, array('class'=>'form-control'))
                    }}
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>

      <div role="tabpanel" class="tab-pane fade in" id="editimage">
        <div class="row">
          <div class="col-md-3">
            <div class="panel panel-default">
              <div class="panel-heading">Image</div>
              <div class="panel-body {{ $errors->has('image') ? 'has-error' : '' }}">
                <div class="text text-center">
                @if ($user->image)
                  {{ Html::image("images/profiles/" . $user->image, "",array('height'=>'115','width'=>'115')) }}
                @else
                  <i class="fa fa-5x fa-user" aria-hidden="true"></i>
                @endif
                </div>
                {{ Form::file ('image' , ['class'=>'form-control']) }}
                <span class="text-danger">{{ $errors->first('image') }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif

  {{-- </div> --}}
{!! Form::close() !!}


@section ('scripts')
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@stop 
