@extends('layouts.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/styles.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li>Tags</li>
@stop

@section('menubar')
  @include('layouts.dropdowns.import', ['name'=>'tags'])
  @include('layouts.buttons.dashboard')
  {{-- @include('layouts.actions.add', ['name'=>'tags']) --}}
@stop

@section('content')
  <div class="row">
    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-tags" aria-hidden="true"></i> Tags</div>
        <div class="panel-body">
          <table id="datatable" class="table table-hover table-striped table-condensed">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Posts</th>
                <th data-orderable="false"></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($tags as $tag)
                <tr>
                  <th>{{ $tag->id }}</th>
                  <td>{{ $tag->name }}</td>
                  <td>{{ $tag->posts()->count() }}</td>
                  <td class="text-right">
                    @include('layouts.buttons.edit', ['model'=>$tag, 'name'=>'tags', 'id'=>$tag->id])
                    @include('layouts.buttons.delete', ['model'=>$tag, 'name'=>'tags', 'id'=>$tag->id])
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="panel panel-default">
        <div class="panel-heading">New Tag</div>
        <div class="panel-body">
          {{-- @ability('admin','tags_create') --}}
            {!! Form::open(['route' => 'tags.store', 'method'=> 'POST']) !!}
              <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                {{ Form::label('name', 'Name', ['class'=>'required']) }}
                {{ Form::text('name', null, ['class' => 'form-control input-sm', 'autofocus'=>'autofocus']) }}
                <span class="text-danger">{{ $errors->first('name') }}</span>
              </div>
              {{ Form::button('<div class="text text-left"><i class="fa fa-save" aria-hidden="true"></i> Save</div>', array('type' => 'submit', 'class' => 'btn btn-success btn-xs btn-block')) }}
            {!! Form::close() !!}
          {{-- @endability --}}
        </div>
        <div class="panel-footer">
          <div>Fields with <i class="fa fa-star" style="color:#ff0000" aria-hidden="true"></i> are required</div>
        </div>
      </div>
    </div>

  </div>

@stop