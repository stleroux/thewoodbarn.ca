@extends ('layouts.main')

@section ('title', '| ')

@section ('stylesheets')
    {{ Html::style('css/styles.css') }}
@stop 

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="{{ route('users.index') }}">Users</a></li>
  <li>Import Users</li>
@stop

@section('menubar')
  <form action="{{ URL::to('users/importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
    @include('layouts.buttons.cancel', ['name'=>'users'])
    @include('layouts.buttons.import', ['name'=>'users'])
@stop

@section('content')
      <div class="panel panel-default">
        <div class='panel-heading'>
          Import Users
        </div>
        <div class="panel-body">
          {!! Form::token() !!}
          <input type="file" name="import_file" class="btn"/>
        </div>
      </div>
    </form>

@stop

@section ('scripts')
  {!! Html::script('js/bootstrap.file-input.js') !!}

  <script type="text/javascript">
    $('input[type=file]').bootstrapFileInput();
    $('.file-inputs').bootstrapFileInput();
  </script>
@stop