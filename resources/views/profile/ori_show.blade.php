<!--
  Used by logged in user to view their profile
-->

@extends('layouts.frontend.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/main.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><b>User Profile</b> :: {{ ucwords($user->first_name) }} {{ ucwords($user->last_name) }} ({{ $user->email }})</li>
@stop

@section('page_top_menu')
  <div class="row">
    <div class="col-md-12">
      <div class="well well-sm clearfix">
        <div class="pull-right">
        @if (Auth::user()->id == $user->id)
            {{--================================================================================================================--}}
            {{-- CHANGE PASSWORD BUTON                                                                                          --}}
            {{--================================================================================================================--}}
              <a href="{{ route('profile.changePassword', $user->id) }}" class="btn btn-primary btn-xs">
                <i class="fa fa-key" aria-hidden="true"></i> Change Password
              </a>
            {{--================================================================================================================--}}
            {{-- END CHANGE PASSWORD BUTTON                                                                                     --}}
            {{--================================================================================================================--}}

            {{--================================================================================================================--}}
            {{-- EDIT PROFILE BUTTON                                                                                            --}}
            {{--================================================================================================================--}}
              <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-info btn-xs">
                <i class="fa fa-edit" aria-hidden="true"></i> Edit Profile
              </a>
            {{--================================================================================================================--}}
            {{-- END EDIT PROFILE BUTTON                                                                                        --}}
            {{--================================================================================================================--}}
          @endif
        </div>
      </div>
    </div>
  </div>
@stop

@section('content')
  <div class="row">
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
  </div>
@stop

@section ('scripts')
@stop 