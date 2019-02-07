{{--================================================================================================================================================
== 
================================================================================================================================================--}}
@if($action_name == 'add')
	<div class="row">
		<div class="col-xs-8 col-sm-8 col-md-8">
			<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
				{{ Form::label ('title', 'Title', ['class'=>'required']) }}
				{{ Form::text ('title', null, array('class' => 'form-control', 'autofocus'=>'autofocus')) }}
				<span class="text-danger">{{ $errors->first('title') }}</span>
			</div>
		</div>
		<div class="col-xs-4 col-sm-4 col-md-4">
			<div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
				{{ Form::label('category_id', 'Category', ['class'=>'required']) }}
				{{-- {{ Form::select('category_id', $categories, null, ['class'=>'form-control']) }} --}}
				{{ Form::select('category_id', array('' => 'Select a category') + $categories, null , ['class' => 'form-control']) }}
				<span class="text-danger">{{ $errors->first('category_id') }}</span>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-8 col-sm-8 col-md-8">
			<div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
				{{ Form::label ('slug', 'Slug', ['class'=>'required']) }}
				{{ Form::text ('slug', null, array('class' => 'form-control')) }}
				<span class="text-danger">{{ $errors->first('slug') }}</span>
			</div>
		</div>
		<div class="col-xs-4 col-sm-4 col-md-4">
			<div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
				{{ Form::label ('image', 'Upload image') }}
				{{ Form::file('image', ['class'=>'form-control']) }}
				<span class="text-danger">{{ $errors->first('image') }}</span>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
				{{ Form::label ('body', 'Body', ['class'=>'required']) }}
				{{ Form::textarea ('body', null, array('class' => 'form-control wysiwyg')) }}
				<span class="text-danger">{{ $errors->first('body') }}</span>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group {{ $errors->has('tag') ? 'has-error' : '' }}">
				{{ Form::label('tag_id', 'Tag(s)') }}
				<select class="form-control select2-multi" name="tags[]" multiple="multiple">
					@foreach ($tags as $tag)
						<option value="{{ $tag->id }}">{{ $tag->name }}</option>
					@endforeach
				</select>
				<span class="text-danger">{{ $errors->first('tag') }}</span>
			</div>
		</div>
	</div>
@endif

{{--================================================================================================================================================
== 
================================================================================================================================================--}}
@if($action_name == 'edit')
	<div class="row">
		<div class="col-xs-8 col-sm-8 col-md-8">
			<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
				{{ Form::label ('title', 'Title', ['class'=>'required']) }}
				{{ Form::text ('title', null, array('class' => 'form-control', 'autofocus'=>'autofocus')) }}
				<span class="text-danger">{{ $errors->first('title') }}</span>
			</div>
		</div>
		<div class="col-xs-4 col-sm-4 col-md-4">
			<div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
				{{ Form::label('category_id', 'Category', ['class'=>'required']) }}
				{{ Form::select('category_id', $categories, null, ['class'=>'form-control']) }}
				<span class="text-danger">{{ $errors->first('category_id') }}</span>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-8 col-sm-8 col-md-8">
			<div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
				{{ Form::label ('slug', 'Slug', ['class'=>'required']) }}
				{{ Form::text ('slug', null, array('class' => 'form-control')) }}
				<span class="text-danger">{{ $errors->first('slug') }}</span>
			</div>
		</div>
		<div class="col-xs-4 col-sm-4 col-md-4">
			<div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
				{{ Form::label ('image', 'Upload image') }}
				{{ Form::file('image', ['class'=>'form-control']) }}
				<span class="text-danger">{{ $errors->first('image') }}</span>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
				{{ Form::label ('body', 'Body', ['class'=>'required']) }}
				{{ Form::textarea ('body', null, array('class' => 'form-control wysiwyg')) }}
				<span class="text-danger">{{ $errors->first('body') }}</span>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group {{ $errors->has('tag') ? 'has-error' : '' }}">
				{{ Form::label('tag_id', 'Tag(s)') }}
				{{ Form::select('tags[]', $tags, null, ['class'=>'form-control select2-multi', 'multiple'=>'multiple']) }}
				<span class="text-danger">{{ $errors->first('tag') }}</span>
			</div>
		</div>
	</div>
@endif

{{--================================================================================================================================================
== 
================================================================================================================================================--}}
@if($action_name == 'show')
	<div class="row">
		<div class="col-xs-8 col-sm-8 col-md-8">
			<div class="form-group">
				{{ Form::label ('title', 'Title') }}
				<div class="well well-sm">
					{!! $post->title !!}
				</div>
			</div>
		
			<div class="form-group">
				{{ Form::label ('slug', 'Slug') }}
				<div class="well well-sm">
					{!! $post->slug !!}
				</div>
			</div>
		
			<div class="form-group">
				{{ Form::label('category_id', 'Category') }}
				<div class="well well-sm">
					{!! $post->category->name !!}
				</div>
			</div>
		</div>

		<div class="col-xs-4 col-sm-4 col-md-4">
			<div class="form-group">
				{{ Form::label ('image', 'Image') }}
				<div class="well well-sm text-center">
					{{-- Open larger image in modal window  --}}
					@if ($post->image)
						<a href="{{ route('posts.viewImage', $post->id) }}" data-toggle="modal" data-target=".viewImage-modal-lg">{{ Html::image("images/posts/" . $post->image, "",array('height'=>'175','width'=>'175')) }}</a>
					@else
						<i class="fa fa-5x fa-ban" aria-hidden="true"></i>
					@endif
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group">
				{{ Form::label ('body', 'Body') }}
				<div class="well well-sm">
					{!! $post->body !!}
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group">
				{{ Form::label('tag_id', 'Tag(s)') }}
				<div class="well well-sm">
					@if (count($post->tags) > 0)
						@foreach($post->tags as $v)
							<label class="label label-primary">{{ $v->name }}</a></label>
						@endforeach
					@else
						NA
					@endif
				</div>
			</div>
		</div>
	</div>
@include('frontend.posts.viewImage')
@include('includes.common.confirmDeleteImageModal')
@endif


