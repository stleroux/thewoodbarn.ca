<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    {!! Form::label("title", "Title:") !!}
    {!! Form::text("title", null, ["class" => "form-control", "autofocus", 'onfocus' => 'this.focus();this.select()']) !!}
    <span class="text-danger">{{ $errors->first('title') }}</span>
</div>

<div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
	{{ Form::label('category_id', 'Category:') }}
    {{-- {{ Form::select('category_id', $categories, null, ['class'=>'form-control']) }} --}}
    {!! Form::select('category_id', array_merge(['' => 'Select a category'] + $categories), null , ['class' => 'form-control']) !!}
    <span class="text-danger">{{ $errors->first('category_id') }}</span>
</div>

<div class="form-group {{ $errors->has('description_eng') ? 'has-error' : '' }}">
    {!! Form::label("description_eng", "Description (En):") !!}
    {!! Form::textarea("description_eng", null, ["class" => "form-control"]) !!}
    <span class="text-danger">{{ $errors->first('description_eng') }}</span>
</div>

<div class="form-group {{ $errors->has('description_fre') ? 'has-error' : '' }}">
    {!! Form::label("description_fre", "Description (Fr):") !!}
    {!! Form::textarea("description_fre", null, ["class" => "form-control"]) !!}
    <span class="text-danger">{{ $errors->first('description_fre') }}</span>
</div>