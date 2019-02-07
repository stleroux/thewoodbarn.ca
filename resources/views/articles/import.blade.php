@extends ('layouts.main')

@section ('title', '| ')

@section ('stylesheets')
  {{ Html::style('css/admin.css') }}
@stop 

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="{{ route('articles.index') }}">Articles</a></li>
  <li>Import Articles</li>
@stop

@section('menubar')
  <form action="{{ URL::to('articles/importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
    @include('layouts.buttons.cancel', ['name'=>'articles'])
    @include('layouts.buttons.import', ['name'=>'articles'])
@stop

@section('content')
    <div class="panel panel-default">
      <div class='panel-heading panel-relative'>Import Articles</div>
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