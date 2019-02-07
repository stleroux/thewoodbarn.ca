@extends('layouts.admin.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/admin.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="/admin">Control Panel</a></li>
  <li><a href="{{ route('admin.categories.index') }}">Categories</a></li>
  <li>Add Category</li>
@stop

@section('page_top_menu')
{!! Form::open(['route' => 'admin.categories.store']) !!}
  <div class="row">
    <div class="col-md-12">
      <div class="well well-sm clearfix">
        <div class="pull-right">
          {{--================================================================================================================================--}}
          {{-- CANCEL BUTTON                                                                                                                  --}}
          {{--================================================================================================================================--}}
          <a href="{{ route('admin.categories.index') }}" class="btn btn-default btn-xs">
            <div class="text text-left">
              @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}}<i class="fa fa-ban" aria-hidden="true"></i> Cancel
              @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}}<i class="fa fa-ban" aria-hidden="true"></i>
              @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}}Cancel
              @endif
            </div>
          </a>
          {{--================================================================================================================================--}}
          {{-- END CANCEL BUTTON                                                                                                              --}}
          {{--================================================================================================================================--}}

          {{--================================================================================================================================--}}
          {{-- UPDATE BUTTON                                                                                                                  --}}
          {{--================================================================================================================================--}}
          {{ Form::button('<i class="fa fa-save"></i> Save Category', array('type' => 'submit', 'class' => 'btn btn-success btn-xs')) }}
          {{--================================================================================================================================--}}
          {{-- END UPDATE BUTTON                                                                                                              --}}
          {{--================================================================================================================================--}}
        </div>
      </div>
    </div>
  </div>
@stop

@section('content')
  {!! Form::open(['route' => 'admin.categories.store']) !!}
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">Add Category</div>
          <div class="panel-body">
            @include('layouts.common.displayErrorsWarning')
            <div class="row">
              <div class="col-xs-12 col-sm-6">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                  {{ Form::label('name', 'Name', ['class'=>'required']) }}
                  {{ Form::text('name', null, ['class' => 'form-control', 'autofocus']) }}
                  <span class="text-danger">{{ $errors->first('name') }}</span>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-xs-12 col-sm-6">
                <div class="form-group {{ $errors->has('module_id') ? 'has-error' : '' }}">
                  {{ Form::label('module_id', 'Module', ['class'=>'required']) }}
                  {{ Form::select('module_id', array(''=>'Select a module') + $modules, null, ['class'=>'form-control']) }}
                  <span class="text-danger">{{ $errors->first('module_id') }} </span>
                </div>
              </div>
            </div>
          </div>
          <div class="panel-footer">
            <div>Fields with <i class="fa fa-star" style="color:#ff0000" aria-hidden="true"></i> are required</div>
          </div>
        </div>
      </div>
    </div>
  {!! Form::close() !!} 
@stop

@section ('scripts')
@stop