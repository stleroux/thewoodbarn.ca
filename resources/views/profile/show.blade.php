<!--
    Used by logged in user to view their profile
-->

@extends('layouts.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/styles.css') }}
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@stop

@section('breadcrumb')
    <li><a href="/">Home</a></li>
    <li><b>User Profile</b> :: {{ ucwords($user->first_name) }} {{ ucwords($user->last_name) }} ({{ $user->email }})</li>
@stop

{{-- @section('page_top_menu')
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm clearfix">
                <div class="pull-right">
                    @if (Auth::user()->id == $user->id) --}}
                        {{--================================================================================================================--}}
                        {{-- CHANGE PASSWORD BUTON                                                                                          --}}
                        {{--================================================================================================================--}}
                            {{-- <a href="{{ route('profile.changePassword', $user->id) }}" class="btn btn-primary btn-xs">
                                <i class="fa fa-key" aria-hidden="true"></i> Change Password
                            </a> --}}
                        {{--================================================================================================================--}}
                        {{-- END CHANGE PASSWORD BUTTON                                                                                     --}}
                        {{--================================================================================================================--}}

                        {{--================================================================================================================--}}
                        {{-- EDIT PROFILE BUTTON                                                                                            --}}
                        {{--================================================================================================================--}}
                            {{-- <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-info btn-xs">
                                <i class="fa fa-edit" aria-hidden="true"></i> Edit Profile
                            </a> --}}
                        {{--================================================================================================================--}}
                        {{-- END EDIT PROFILE BUTTON                                                                                        --}}
                        {{--================================================================================================================--}}
                    {{-- @endif
                </div>
            </div>
        </div>
    </div>
@stop --}}

@section('content')

    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#viewProfile" aria-controls="viewProfile" role="tab" data-toggle="tab">My Profile</a>
                </li>
                <li role="presentation">
                    <a href="#editProfile" aria-controls="editProfile" role="tab" data-toggle="tab">Edit Profile</a>
                </li>
{{--                 <li role="presentation" class="">
                    <a href="#account" aria-controls="account" role="tab" data-toggle="tab" class="hidden-xs hidden-sm">Account Information</a>
                    <a href="#account" aria-controls="account" role="tab" data-toggle="tab" class="hidden-md hidden-lg">Acct Info</a>
                </li> --}}
                <li role="presentation" class="">
                    <a href="#viewRecords" aria-controls="viewRecords" role="tab" data-toggle="tab">My Items</a>
                </li>
                <li role="presentation" class="">
                    <a href="#changePWD" aria-controls="changePWD" role="tab" data-toggle="tab">Change Password</a>
                </li>
            </ul>

            <div class="tab-content">
                
                <div role="tabpanel" class="tab-pane fade in active" id="viewProfile">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="general">
                                    
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="panel panel-default" style="margin-top: 0px;">
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

                                                        @if ($user->show_email)
                                                            <tr>
                                                                <th>Email Address</th>
                                                                <td>{{ $user->email }}</td>
                                                            </tr>
                                                        @endif
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="panel panel-default">
                                                <div class="panel-heading">User Preferences</div>
                                                <div class="panel-body">
                                                    <div class="col-xs-6 col-sm-4 col-md-3">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">Style</div>
                                                            <div class="panel-body">{{ ucfirst($user->style) }}</div>
                                                        </div>
                                                    </div>
                      
                                                    <div class="col-xs-3">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">Display Email</div>
                                                            <div class="panel-body">
                                                                @if ($user->show_email)
                                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                                @else
                                                                    <i class="fa fa-ban" aria-hidden="true"></i>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                      
                                                    <div class="col-xs-3">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">Landing Page</div>
                                                            <div class="panel-body">
                                                                {{ $user->landingPage ? ucfirst($user->landingPage) : 'N/A'}}
                                                            </div>
                                                        </div>
                                                    </div>
                      
                                                    <div class="col-md-3">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">Display Size</div>
                                                            <div class="panel-body">{{ ucfirst($user->display) }}</div>
                                                        </div>
                                                    </div>
                      
                                                    <div class="col-md-3">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">Author Format</div>
                                                            <div class="panel-body">
                                                                @if ($user->authorFormat == 1)
                                                                    Username
                                                                @endif
                                                                @if ($user->authorFormat == 2)
                                                                    Last Name, First Name
                                                                @endif
                                                                @if ($user->authorFormat == 3)
                                                                    First Name Last Name
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                      
                                                    <div class="col-md-3">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">Date Format</div>
                                                            <div class="panel-body">
                                                                @if ($user->dateFormat == 1)
                                                                    Jan 01, 2017
                                                                @endif
                                                                @if ($user->dateFormat == 2)
                                                                    Jan 1, 2017
                                                                @endif
                                                                @if ($user->dateFormat == 3)
                                                                    01/01/2017 (M-D-Y)
                                                                @endif
                                                                @if ($user->dateFormat == 4)
                                                                    1/01/2017 (M-D-Y)
                                                                @endif
                                                                @if ($user->dateFormat == 5)
                                                                    01 Jan 2017
                                                                @endif
                                                                @if ($user->dateFormat == 6)
                                                                    1 Jan 2017
                                                                @endif
                                                                @if ($user->dateFormat == 7)
                                                                    01/01/2017 (D-M-Y)
                                                                @endif
                                                                @if ($user->dateFormat == 8)
                                                                    1/01/2017 (D-M-Y)
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">Rows Per Page</div>
                                                            <div class="panel-body">{{ $user->rowsPerPage }}</div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">Action Buttons</div>
                                                            <div class="panel-body">
                                                                @if ($user->actionButtons == 1)
                                                                    Icons and Text
                                                                @endif
                                                                @if ($user->actionButtons == 2)
                                                                    Icons Only
                                                                @endif
                                                                @if ($user->actionButtons == 3)
                                                                    Text Only
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">Alert Fade Time</div>
                                                            <div class="panel-body">
                                                                @if ($user->alertFadeTime == 2000) 2 seconds @endif
                                                                @if ($user->alertFadeTime == 3000) 3 seconds @endif
                                                                @if ($user->alertFadeTime == 4000) 4 seconds @endif
                                                                @if ($user->alertFadeTime == 5000) 5 seconds @endif
                                                                @if ($user->alertFadeTime == 6000) 6 seconds @endif
                                                                @if ($user->alertFadeTime == 7000) 7 seconds @endif
                                                                @if ($user->alertFadeTime == 8000) 8 seconds @endif
                                                                @if ($user->alertFadeTime == 9000) 9 seconds @endif
                                                                @if ($user->alertFadeTime == 10000) 10 seconds @endif
                                                                @if ($user->alertFadeTime == 15000) 15 seconds @endif
                                                                @if ($user->alertFadeTime == 20000) 20 seconds @endif
                                                                @if ($user->alertFadeTime == 1000000000) Forever @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel-footer">
                                                  See the Edit Profile page for more info on what each settings does
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Image</div>
                                                <div class="panel-body text-center">
                                                     @if ($user->image)
                                                        {{ Html::image("images/profiles/" . $user->image, "",array('height'=>'115','width'=>'115')) }}
                                                    @else
                                                        <i class="fa fa-5x fa-user" aria-hidden="true"></i>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Date(s)</div>
                                                <div class="panel-body">
                                                    <table class="" width="100%">
                                                        <tr>
                                                            <th width="50%">Created on</th>
                                                            <td>
                                                                <span class="pull-right">
                                                                    @include('layouts.dateFormat', ['model'=>$user, 'field'=>'created_at'])
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Updated on</th>
                                                            <td align='right'>@include('layouts.dateFormat', ['model'=>$user, 'field'=>'updated_at'])</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Account Type</div>
                                                <div class="panel-body">
                                                    {{ ucfirst($user->role->name) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <div role="tabpanel" class="tab-pane fade in" id="editProfile">
                    @include('profile.edit')
                </div>

{{--                 <div role="tabpanel" class="tab-pane fade in" id="account">
                    <br />
                </div> --}}

                <div role="tabpanel" class="tab-pane fade in" id="viewRecords">
                    <div class="row">
                        <div class="col-md-12">

                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#articles" aria-controls="articles" role="tab" data-toggle="tab">Articles</a>
                                </li>
                                <li role="presentation" class="">
                                    <a href="#items" aria-controls="items" role="tab" data-toggle="tab">Items</a>
                                </li>
                                <li role="presentation" class="">
                                    <a href="#orders" aria-controls="orders" role="tab" data-toggle="tab">Orders</a>
                                </li>
                                <li role="presentation" class="">
                                    <a href="#posts" aria-controls="posts" role="tab" data-toggle="tab">Posts</a>
                                </li>
                                <li role="presentation" class="">
                                    <a href="#recipes" aria-controls="recipes" role="tab" data-toggle="tab">Recipes</a>
                                </li>
                                <li role="presentation" class="">
                                    <a href="#tasks" aria-controls="tasks" role="tab" data-toggle="tab">Tasks</a>
                                </li>
                                <li role="presentation" class="">
                                    <a href="#tweets" aria-controls="tweets" role="tab" data-toggle="tab">Tweets</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="articles">
                                    <br />
                                    @include('profile._articles')
                                </div>

                                <div role="tabpanel" class="tab-pane fade in" id="items">
                                    <br />
                                    @include('profile._items')
                                </div>

                                <div role="tabpanel" class="tab-pane fade in" id="orders">
                                    <br />
                                    @include('profile._orders')
                                </div>

                                <div role="tabpanel" class="tab-pane fade in" id="posts">
                                    <br />
                                    @include('profile._posts')
                                </div>

                                <div role="tabpanel" class="tab-pane fade in" id="recipes">
                                    <br />
                                    @include('profile._recipes')
                                </div>

                                <div role="tabpanel" class="tab-pane fade in" id="tasks">
                                    <br />
                                    @include('profile._tasks')
                                </div>

                                <div role="tabpanel" class="tab-pane fade in" id="tweets">
                                    <br />
                                    @include('profile._tweets')
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                
                <div role="tabpanel" class="tab-pane fade in" id="changePWD">
                    
                    {!! Form::model($user, ['route'=>['profile.updatePassword', $user->id], 'method' => 'POST']) !!}
                        

                        @if (Auth::user()->id == $user->id)
                          <div class="row">
                            <div class="col-xs-10">
                              <div class="panel panel-default">
                                <div class="panel-heading">Change Password</div>
                                <div class="panel-body">
                                  {{ Form::label('password', 'New Password:') }}
                                  {{ Form::password('password', ['class'=>'form-control', 'autofocus']) }}
                                  <br />
                                  {{ Form::label('password_confirmation', 'Confirm New Password:') }}
                                  {{ Form::password('password_confirmation', ['class'=>'form-control']) }}
                                </div>
                                <div class="panel-footer">
                                  Only enter new password if you want to change it.
                                </div>
                              </div>
                            </div>
                          
                            <div class="col-xs-2">
                              <div class="panel panel-default">
                                <div class="panel-heading">&nbsp;</div>
                                <div class="panel-body">
                                  {{--===========================================================================--}}
                                  {{-- CANCEL BUTTON                                                             --}}
                                  {{--===========================================================================--}}
                                  {{-- <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-default btn-xs btn-block">
                                    <div class="text text-left">
                                      @if(Auth::user()->actionButtons == 1)<i class="fa fa-ban" aria-hidden="true"></i> Cancel
                                      @elseif(Auth::user()->actionButtons == 2)<i class="fa fa-ban" aria-hidden="true"></i>
                                      @elseif(Auth::user()->actionButtons == 3)Cancel
                                      @endif
                                    </div>
                                  </a> --}}
                                  {{--===========================================================================--}}
                                  {{-- END CANCEL BUTTON                                                         --}}
                                  {{--===========================================================================--}}

                                  {{--===========================================================================--}}
                                  {{-- CHANGE PASSWORD BUTTON                                                    --}}
                                  {{--===========================================================================--}}
                                  {{ Form::submit('Change Password', ['class'=>'btn btn-success btn-xs btn-block']) }}
                                  {{--===========================================================================--}}
                                  {{-- END CHANGE PASSWORD BUTTON                                                --}}
                                  {{--===========================================================================--}}
                                </div>
                              </div>
                            </div>
                          </div>
                        @else
                            @include('errors.403')
                        @endif

                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-md-12">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">My Profile</a></li>
                <li role="presentation"><a href="#recipes" aria-controls="recipes" role="tab" data-toggle="tab">My Recipes</a></li>
                <li role="presentation"><a href="#articles" aria-controls="articles" role="tab" data-toggle="tab">My Articles</a></li>
                <li role="presentation"><a href="#tasks" aria-controls="tasks" role="tab" data-toggle="tab">My Tasks</a></li>
                <li role="presentation"><a href="#items" aria-controls="items" role="tab" data-toggle="tab">My Items</a></li>
                <li role="presentation"><a href="#posts" aria-controls="posts" role="tab" data-toggle="tab">My Posts</a></li>
                <li role="presentation"><a href="#tweets" aria-controls="tweets" role="tab" data-toggle="tab">My Tweets</a></li>
                <li role="presentation"><a href="#orders" aria-controls="tweets" role="tab" data-toggle="tab">My Orders</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="profile">@include('frontend.profile._profile')</div>
                <div role="tabpanel" class="tab-pane fade" id="recipes">@include('frontend.profile._recipes')</div>
                <div role="tabpanel" class="tab-pane fade" id="articles">@include('frontend.profile._articles')</div>
                <div role="tabpanel" class="tab-pane fade" id="tasks">@include('frontend.profile._tasks')</div>
                <div role="tabpanel" class="tab-pane fade" id="items">@include('frontend.profile._items')</div>
                <div role="tabpanel" class="tab-pane fade" id="posts">@include('frontend.profile._posts')</div>
                <div role="tabpanel" class="tab-pane fade" id="tweets">@include('frontend.profile._tweets')</div>
                <div role="tabpanel" class="tab-pane fade" id="orders">@include('frontend.profile._orders')</div>
            </div>
        </div>
    </div> --}}
@stop

@section ('scripts')
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@stop 