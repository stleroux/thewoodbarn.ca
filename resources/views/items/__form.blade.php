{{--================================================================================================================================================
== 
================================================================================================================================================--}}
@if($action_name == 'add')
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
            {{ Form::label('title', 'Title', ['class'=>'required']) }}
            {!! Form::text('title', null, array('placeholder' => 'Title','class' => 'form-control', 'autofocus')) !!}
            <span class="text-danger">{{ $errors->first('title') }}</span>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
            {{ Form::label('description', 'Description', ['class'=>'required']) }}
            {!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control','style'=>'height:100px')) !!}
            <span class="text-danger">{{ $errors->first('description') }}</span>
        </div>
    </div>
@endif

{{--================================================================================================================================================
== 
================================================================================================================================================--}}
@if($action_name == 'edit')
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
            {{ Form::label('title', 'Title', ['class'=>'required']) }}
            {!! Form::text('title', null, array('placeholder' => 'Title','class' => 'form-control', 'autofocus')) !!}
            <span class="text-danger">{{ $errors->first('title') }}</span>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
            {{ Form::label('description', 'Description', ['class'=>'required']) }}
            {!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control','style'=>'height:100px')) !!}
            <span class="text-danger">{{ $errors->first('description') }}</span>
        </div>
    </div>
@endif

{{--================================================================================================================================================
== 
================================================================================================================================================--}}
@if($action_name == 'show')
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('title', 'Title') }}
            <div class="well well-sm">
                {!! $item->title !!}
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('description', 'Description') }}
            <div class="well well-sm">
                {!! $item->description !!}
            </div>
        </div>
    </div>
@endif


