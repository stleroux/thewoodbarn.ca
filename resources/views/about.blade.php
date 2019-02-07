@extends ('layouts.main')

@section ('title', 'About')

@section ('stylesheets')
	{{ Html::style('css/main.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li>About Us</li>
@stop

@section ('content')
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-primary">
        <div class="panel-heading">About US</div>
        <div class="panel-body">
          Just some text about us
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="panel panel-info">
        <div class="panel-heading">About Stephane</div>
        <div class="panel-body">
          Just some text about me
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="panel panel-warning">
        <div class="panel-heading">About Stacie</div>
        <div class="panel-body">
          Just some text about her
        </div>
      </div>
    </div>
  </div>
@stop

@section ('scripts')
@stop