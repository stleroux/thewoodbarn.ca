@extends('layouts.admin.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/admin.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="/admin">Control Panel</a></li>
  <li><a href="{{ route('admin.articles.index') }}">Articles</a></li>
  <li>Add Article</li>
@stop

@section('page_top_menu')
{!! Form::open(['route' => 'admin.articles.store']) !!}
  <div class="row">
    <div class="col-md-12">
      <div class="well well-sm clearfix">
        <div class="pull-right">
          {{--================================================================================================================================--}}
          {{-- CANCEL BUTTON                                                                                                                  --}}
          {{--================================================================================================================================--}}
          <a href="{{ route('admin.items.index') }}" class="btn btn-default btn-xs">
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
          {{ Form::button('<i class="fa fa-save"></i> Save Item', array('type' => 'submit', 'class' => 'btn btn-success btn-xs')) }}
          {{--================================================================================================================================--}}
          {{-- END SAVE BUTTON                                                                                                                --}}
          {{--================================================================================================================================--}}
        </div>
      </div>
    </div>
  </div>
@stop

@section('content')
  <div class="col-md-10">
    {!! Form::open(['route' => 'admin.items.store']) !!}
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
                  <div class="panel-footer">
                    <div>Fields with <i class="fa fa-star" style="color:#ff0000" aria-hidden="true"></i> are required</div>
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
                  <div class="panel-footer">
                    <div>Fields with <i class="fa fa-star" style="color:#ff0000" aria-hidden="true"></i> are required</div>
                  </div>
                </div>
              </div>
              <div role="tabpanel" class="tab-pane" id="_description_">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                      {{ Form::label('description', 'Description', ['class'=>'required']) }}
                      {!! Form::textarea('description', null, ['placeholder' => 'Description','class' => 'form-control','style'=>'height:100px']) !!}
                      <span class="text-danger">{{ $errors->first('description') }}</span>
                    </div>
                  </div>
                  <div class="panel-footer">
                    <div>Fields with <i class="fa fa-star" style="color:#ff0000" aria-hidden="true"></i> are required</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    {!! Form::close() !!} 
  </div>
@stop

@section ('scripts')
@stop