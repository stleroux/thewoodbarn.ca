@extends('layouts.admin.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/admin.css') }}
  {{ Html::style('css/select2.min.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="/admin">Control Panel</a></li>
  <li><a href="{{ route('admin.posts.index') }}">Posts</a></li>
  <li>Add Post</li>
@stop

@section('page_top_menu')
{!! Form::open(['route' => 'admin.posts.store']) !!}
  <div class="row">
    <div class="col-md-12">
      <div class="well well-sm clearfix">
        <div class="pull-right">
          {{--================================================================================================================================--}}
          {{-- CANCEL BUTTON                                                                                                                  --}}
          {{--================================================================================================================================--}}
          <a href="{{ route('admin.posts.index') }}" class="btn btn-default btn-xs">
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
          {{-- SAVE BUTTON                                                                                                                    --}}
          {{--================================================================================================================================--}}
          {{ Form::button('<i class="fa fa-save"></i> Save Post', array('type' => 'submit', 'class' => 'btn btn-success btn-xs')) }}
          {{--================================================================================================================================--}}
          {{-- END SAVE BUTTON                                                                                                                --}}
          {{--================================================================================================================================--}}
        </div>
      </div>
    </div>
  </div>
@stop

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">Add Post</div>
        <div class="panel-body">
          @include('layouts.common.displayErrorsWarning')
          <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
            {{ Form::label ('title', 'Title', ['class'=>'required'])}}
            {{ Form::text ('title', null, array('class' => 'form-control', 'autofocus'=>'autofocus')) }}
            <span class="text-danger">{{ $errors->first('title') }}</span>
          </div>

          <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
            {{ Form::label ('slug', 'Slug', ['class'=>'required']) }}
            {{ Form::text ('slug', null, array('class' => 'form-control')) }}
            <span class="text-danger">{{ $errors->first('slug') }}</span>
          </div>


          <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
            {{ Form::label('category_id', 'Category', ['class'=>'required']) }}
            {{ Form::select('category_id', array(''=>'Select a category') + $categories, null, ['class'=>'form-control']) }}
            <span class="text-danger">{{ $errors->first('category_id') }}</span>
          </div>

          <div class="form-group {{ $errors->has('tag_id') ? 'has-error' : '' }}">
            {{ Form::label('tag_id', 'Tag') }}
            <select class="form-control select2-multi" name="tags[]" multiple="multiple">
              @foreach ($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
              @endforeach
            </select>
            <span class="text-danger">{{ $errors->first('tag_id') }}</span>
          </div>

          <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
            {{ Form::label ('body', 'Body', ['class'=>'required']) }}
            {{ Form::textarea ('body', null, array('class' => 'form-control wysiwyg')) }}
            <span class="text-danger">{{ $errors->first('body') }}</span>
          </div>
        </div>
        <div class="panel-footer">
          <div>Fields with <i class="fa fa-star" style="color:#ff0000" aria-hidden="true"></i> are required</div>
        </div>
      </div>
    </div>
  </div>
@stop

@section ('scripts')
	{!! Html::script('js/select2.min.js') !!}

	<script type="text/javascript">
		$('.select2-multi').select2();
	</script>
@stop