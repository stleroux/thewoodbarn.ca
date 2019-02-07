{{--================================================================================================================================================
== 
================================================================================================================================================--}}
@if($action_name == 'add')
{{--     <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                {!! Form::label("title", "Title", ['class'=>'required']) !!}
                {!! Form::text("title", null, ["class" => "form-control", "autofocus"]) !!}
                <span class="text-danger">{{ $errors->first('title') }}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-8">
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                {{ Form::label('description', 'Description', ['class'=>'required']) }}
                {!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control','style'=>'height:100px')) !!}
                <span class="text-danger">{{ $errors->first('description') }}</span>
            </div>
        </div>
    </div> --}}


<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div>
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#_instructions_" aria-controls="_instructions_" role="tab" data-toggle="tab">Instructions</a></li>
				<li role="presentation"><a href="#_title_" aria-controls="_title_" role="tab" data-toggle="tab">Title</a></li>
				<li role="presentation"><a href="#_description_" aria-controls="_description_" role="tab" data-toggle="tab">Description</a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="_instructions_">
					<div class="panel panel-default">
						<div class="panel-body">
							Related instructions would go here
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="_title_">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
								{!! Form::label("title", "Title", ['class'=>'required']) !!}
								{!! Form::text("title", null, ["class" => "form-control", "autofocus"]) !!}
								<span class="text-danger">{{ $errors->first('title') }}</span>
							</div>
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="_description_">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
								{{ Form::label('description', 'Description', ['class'=>'required']) }}
								{!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control','style'=>'height:100px')) !!}
								<span class="text-danger">{{ $errors->first('description') }}</span>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>


@endif

{{--================================================================================================================================================
== 
================================================================================================================================================--}}
@if($action_name == 'edit')
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                {!! Form::label("title", "Title", ['class'=>'required']) !!}
                {!! Form::text("title", null, ["class" => "form-control", "autofocus", "onfocus" => "this.focus();this.select()"]) !!}
                <span class="text-danger">{{ $errors->first('title') }}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-8">
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                {{ Form::label('description', 'Description', ['class'=>'required']) }}
                {!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control','style'=>'height:100px')) !!}
                <span class="text-danger">{{ $errors->first('description') }}</span>
            </div>
        </div>
    </div>
@endif

{{--================================================================================================================================================
== 
================================================================================================================================================--}}
@if($action_name == 'show')
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="form-group">
                {!! Form::label("title", "Title") !!}
                <div class="well well-sm">
                    {!! $item->title !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-8">
            <div class="form-group">
                {{ Form::label('description', 'Description') }}
                <div class="well well-sm">
                    {!! $item->description !!}
                </div>
            </div>
        </div>
    </div>
@endif
