{{--================================================================================================================================================
== 
================================================================================================================================================--}}
@if($action_name == 'add')
    <div class="row">
        <div class="col-xs-10 col-sm-10 col-md-10">
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                {!! Form::label("title", "Title", ['class'=>'required']) !!}
                {!! Form::text("title", null, ["class" => "form-control", "autofocus"]) !!}
                <span class="text-danger">{{ $errors->first('title') }}</span>
            </div>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2">
            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                {{ Form::label('category_id', 'Category', ['class'=>'required']) }}
                {{ Form::select('category_id', array(''=>'Select a category') + $categories, null, ['class'=>'form-control']) }}
                <span class="text-danger">{{ $errors->first('category_id') }}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group {{ $errors->has('description_eng') ? 'has-error' : '' }}">
                {!! Form::label("description_eng", "Description (En)", ['class'=>'required']) !!}
                {!! Form::textarea("description_eng", null, ["class" => "form-control wysiwyg"]) !!}
                <span class="text-danger">{{ $errors->first('description_eng') }}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group {{ $errors->has('description_fre') ? 'has-error' : '' }}">
                {!! Form::label("description_fre", "Description (Fr)") !!}
                {!! Form::textarea("description_fre", null, ["class" => "form-control wysiwyg"]) !!}
                <span class="text-danger">{{ $errors->first('description_fre') }}</span>
            </div>
        </div>
    </div>
@endif

{{--================================================================================================================================================
== 
================================================================================================================================================--}}
@if($action_name == 'edit')
    <div class="row">
        <div class="col-xs-10 col-sm-10 col-md-10">
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                {!! Form::label("title", "Title", ['class'=>'required']) !!}
                {!! Form::text("title", null, ["class" => "form-control", "autofocus", "onfocus"=>"this.focus();this.select()"]) !!}
                <span class="text-danger">{{ $errors->first('title') }}</span>
            </div>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2">
            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                {{ Form::label('category_id', 'Category', ['class'=>'required']) }}
                {{ Form::select('category_id', array(''=>'Select a category') + $categories, null, ['class'=>'form-control']) }}
                <span class="text-danger">{{ $errors->first('category_id') }}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group {{ $errors->has('description_eng') ? 'has-error' : '' }}">
                {!! Form::label("description_eng", "Description (En)", ['class'=>'required']) !!}
                {!! Form::textarea("description_eng", null, ["class" => "form-control wysiwyg"]) !!}
                <span class="text-danger">{{ $errors->first('description_eng') }}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group {{ $errors->has('description_fre') ? 'has-error' : '' }}">
                {!! Form::label("description_fre", "Description (Fr)") !!}
                {!! Form::textarea("description_fre", null, ["class" => "form-control wysiwyg"]) !!}
                <span class="text-danger">{{ $errors->first('description_fre') }}</span>
            </div>
        </div>
    </div>
@endif

{{--================================================================================================================================================
== 
================================================================================================================================================--}}
@if($action_name == 'show')
    <div class="row">
        <div class="col-xs-10 col-sm-10 col-md-10">
            <div class="form-group">
                {!! Form::label("title", "Title") !!}
                <div class="well well-sm">
                    {!! $article->title !!}
                </div>
            </div>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2">
            {!! Form::label("category", "Category") !!}
            <div class="well well-sm">
                {{ $article->category->name }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                {!! Form::label("description_eng", "Description (En)") !!}
                <div class="well well-sm">
                    {!! $article->description_eng !!}
                </div>
            </div>
        </div>
    </div>

    {{-- Only display this part of there is something to display --}}
    @if($article->description_fre)
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    {!! Form::label("description_fre", "Description (Fr)") !!}
                    <div class="well well-sm">
                        {!! $article->description_fre !!}
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
