@extends ('layouts.main')

@section ('title', '| Change Password')

@section ('stylesheets')
  {{ Html::style('css/main.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="{{ route('profile.show', $user->id) }}">My Profile</a></li>
  <li class="active">Reset Password for {{ $user->first_name}} {{ $user->last_name}}</li>
@stop

@section('menubar')

{!! Form::model($user, ['route'=>['profile.updatePassword', $user->id], 'method' => 'POST']) !!}
  @if (Auth::user()->id == $user->id)
{{--     <div class="row">
      <div class="col-md-12">
        <div class="well well-sm clearfix">
          <div class="pull-right"> --}}
            {{--================================================================================================================--}}
            {{-- CANCEL BUTTON                                                                                                  --}}
            {{--================================================================================================================--}}
              <a href="{{ route('profile.show', $user->id) }}" class="btn btn-default btn-xs">
                <div class="text text-left">
                  @if(Auth::user()->actionButtons == 1)<i class="fa fa-ban" aria-hidden="true"></i> Cancel
                  @elseif(Auth::user()->actionButtons == 2)<i class="fa fa-ban" aria-hidden="true"></i>
                  @elseif(Auth::user()->actionButtons == 3)Cancel
                  @endif
                </div>
              </a>
            {{--================================================================================================================--}}
            {{-- END CANCEL BUTTON                                                                                              --}}
            {{--================================================================================================================--}}

            {{--================================================================================================================--}}
            {{-- CHANGE PASSWORD BUTTON                                                                                         --}}
            {{--================================================================================================================--}}
              {{ Form::submit('Change Password', ['class'=>'btn btn-success btn-xs']) }}
            {{--================================================================================================================--}}
            {{-- END CHANGE PASSWORD BUTTON                                                                                     --}}
            {{--================================================================================================================--}}
          {{-- </div>
        </div>
      </div>
    </div> --}}
  @endif
@stop

@section ('content')
  @if (Auth::user()->id == $user->id)
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            {{ Form::label('password', 'New Password:') }}
            {{ Form::password('password', ['class'=>'form-control', 'autofocus']) }}
            <br />
            {{ Form::label('password_confirmation', 'Confirm New Password:') }}
            {{ Form::password('password_confirmation', ['class'=>'form-control']) }}
          </div>
        </div>
      </div>
    </div>
  @else
    @include('errors.403')
  @endif

{!! Form::close() !!}
@stop

@section ('scripts')
@stop 
