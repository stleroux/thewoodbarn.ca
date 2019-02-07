{{--================================================================================================================================================
== 
================================================================================================================================================--}}
@if($action_name == 'add')
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-md-10">
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                {{ Form::label('title', 'Title', ['class'=>'required']) }}
                {!! Form::text('title', null, array('placeholder' => 'Title','class'=>'form-control', 'autofocus')) !!}
                <span class="text-danger">{{ $errors->first('title') }}</span>
            </div>
        </div>

        <div class="col-xs-12 col-sm-2 col-md-2">
            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                {{ Form::label('category_id', 'Category', ['class'=>'required']) }}
                {{ Form::select('category_id', array(''=>'Select a category') + $categories, null, ['class'=>'form-control']) }}
                <span class="text-danger">{{ $errors->first('category_id') }}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-10 col-md-10">
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                {{ Form::label('description', 'Description', ['class'=>'required']) }}
                {!! Form::textarea('description', null, array('placeholder' => 'Description','class'=>'form-control','style'=>'height:100px')) !!}
                <span class="text-danger">{{ $errors->first('description') }}</span>
            </div>
        </div>

        <div class="col-xs-12 col-sm-2 col-md-2">
            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                {{ Form::label('price', 'Price', ['class'=>'required']) }}
                {!! Form::text('price', null, array('placeholder' => 'Price','class'=>'form-control')) !!}
                <span class="text-danger">{{ $errors->first('price') }}</span>
            </div>
        </div>
    </div>
@endif

{{--================================================================================================================================================
== 
================================================================================================================================================--}}
@if($action_name == 'edit')
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-md-10">
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                {{ Form::label('title', 'Title', ['class'=>'required']) }}
                {!! Form::text('title', null, array('placeholder' => 'Title','class'=>'form-control', 'autofocus', "onfocus"=>"this.focus();this.select()")) !!}
                <span class="text-danger">{{ $errors->first('title') }}</span>
            </div>
        </div>

        <div class="col-xs-12 col-sm-2 col-md-2">
            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                {{ Form::label('category_id', 'Category', ['class'=>'required']) }}
                {{ Form::select('category_id', array(''=>'Select a category') + $categories, null, ['class'=>'form-control']) }}
                <span class="text-danger">{{ $errors->first('category_id') }}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-10 col-md-10">
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                {{ Form::label('description', 'Description', ['class'=>'required']) }}
                {!! Form::textarea('description', null, array('placeholder' => 'Description','class'=>'form-control','style'=>'height:100px')) !!}
                <span class="text-danger">{{ $errors->first('description') }}</span>
            </div>
        </div>

        <div class="col-xs-12 col-sm-2 col-md-2">
            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                {{ Form::label('price', 'Price', ['class'=>'required']) }}
                {!! Form::text('price', null, array('placeholder' => 'Price','class'=>'form-control')) !!}
                <span class="text-danger">{{ $errors->first('price') }}</span>
            </div>
        </div>
    </div>
@endif

{{--================================================================================================================================================
== 
================================================================================================================================================--}}
@if($action_name == 'show')
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-md-10">
            <div class="form-group">
                {{ Form::label('title', 'Title') }}
                <div class="well well-sm">
                    {!! $product->title !!}
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-2 col-md-2">
            {!! Form::label("category", "Category") !!}
            <div class="well well-sm">
                {!! $product->category->name !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-10 col-md-10">
            <div class="form-group">
                {{ Form::label('description', 'Description') }}
                <div class="well well-sm">
                    {!! $product->description !!}
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-2 col-md-2">
            <div class="form-group">
                {{ Form::label('price', 'Price') }}
                <div class="well well-sm">
                    {!! $product->price !!}
                </div>
            </div>
        </div>
    </div>
@endif
