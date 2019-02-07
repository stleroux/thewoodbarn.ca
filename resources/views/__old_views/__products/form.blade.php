<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
        {{ Form::label('title', 'Title:') }}
        {!! Form::text('title', null, array('placeholder' => 'Title','class' => 'form-control', 'autofocus')) !!}
        <span class="text-danger">{{ $errors->first('title') }}</span>
    </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
        {{ Form::label('description', 'Description:') }}
        {!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control','style'=>'height:100px')) !!}
        <span class="text-danger">{{ $errors->first('description') }}</span>
    </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
        {{ Form::label('price', 'Price:') }}
        {!! Form::text('price', null, array('placeholder' => 'Price','class' => 'form-control')) !!}
        <span class="text-danger">{{ $errors->first('price') }}</span>
    </div>
</div>