{{--================================================================================================================================================
== 
================================================================================================================================================--}}
@if($action_name == 'add')
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
@endif

{{--================================================================================================================================================
== 
================================================================================================================================================--}}
@if($action_name == 'edit')
	<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
		{{ Form::label ('title', 'Title', ['class'=>'required']) }}
		{{ Form::text ('title', null, array('class' => 'form-control', 'autofocus'=>'autofocus', "onfocus" => "this.focus();this.select()")) }}
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
		{{ Form::select('tags[]', $tags, null, ['class'=>'form-control select2-multi', 'multiple'=>'multiple']) }}
		<span class="text-danger">{{ $errors->first('tag_id') }}</span>
	</div>

	<div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
		{{ Form::label ('image', 'Upload image') }}
		{{ Form::file('image', ['class'=>'form-control']) }}
		<span class="text-danger">{{ $errors->first('image') }}</span>
	</div>

	<div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
		{{ Form::label ('body', 'Body', ['class'=>'required']) }}
		{{ Form::textarea ('body', null, array('class' => 'form-control wysiwyg')) }}
		<span class="text-danger">{{ $errors->first('body') }}</span>
	</div>
@endif

{{--================================================================================================================================================
== 
================================================================================================================================================--}}
@if($action_name == 'show')
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
        {!! Form::label("category", "Category") !!}
        <div class="well well-sm">
            {{ $post->category->name }}
        </div>
    </div>

	<div class="form-group">
		{{ Form::label('tag_id', 'Tag') }}
		<div class="well well-sm">
			@foreach ($post->tags as $tag)
				<span class="label label-default">{{ $tag->name }}</span>
			@endforeach
		</div>
	</div>

	<div class="form-group">
		{{ Form::label ('body', 'Body') }}
		<div class="well well-sm">
			{!! $post->body !!}
		</div>
	</div>
@endif
