@extends ('layouts.main')

@section ('title', '| Create Tweet')

@section ('stylesheets')
    {{ Html::style('css/styles.css') }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">

            <form action="#">
                <div class="form-group">
                    <label for="nome">ID</label>
                    <p class="form-control-static">{{$tweet->id}}</p>
                </div>
                <div class="form-group">
                     <label for="title">TITLE</label>
                     <p class="form-control-static">{{$tweet->title}}</p>
                </div>
                    <div class="form-group">
                     <label for="body">BODY</label>
                     <p class="form-control-static">{{$tweet->body}}</p>
                </div>
            </form>

            <a class="btn btn-link" href="{{ route('tweets.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>

        </div>
    </div>
@stop

@section ('scripts')
@stop