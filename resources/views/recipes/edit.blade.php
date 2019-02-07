@extends ('layouts.main')

@section ('title', 'Edit Recipe')

@section ('stylesheets')
  {{ Html::style('css/recipes.css') }}
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="{{ route('recipes.index','all') }}">Recipes</a></li>
  <li class="active">Update Recipe</li>
@stop

@section('menubar')
  {!! Form::model($recipe, ['route'=>['recipes.update', $recipe->id], 'method' => 'PUT', 'files' => true]) !!}
    <a href="{{ route('recipes.deleteImage', $recipe->id) }}" class="btn btn-xs btn-danger">
      <div class="text text-left">
        <i class="fa fa-trash-o" aria-hidden="true"></i> Delete Image
      </div>
    </a>
    @include('layouts.buttons.cancel', ['name'=>'recipes', 'param1'=>'all'])
    @include('layouts.buttons.update', ['name'=>'recipes'])
@stop

@section ('content')
  @include('layouts.partials.section_top', ['name'=>'Edit Recipe', 'icon'=>'fa-book'])
    <div class="panel-body">
      <div class="row">
        <div class="col-md-8">
          <div class="panel panel-default">
            <div class="panel-heading required">Name</div>
            <div class="panel-body">
              <div class="{{ $errors->has('title') ? 'has-error' : '' }}" >
                {{ Form::text ('title', null, array('class' => 'form-control', 'autofocus'=>'autofocus')) }}
                <span class="text-danger">{{ $errors->first('title') }}</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading required">Category</div>
            <div class="panel-body">
              <div class="{{ $errors->has('category_id') ? 'has-error' : '' }}" >
                {{ Form::select('category_id', array(''=>'Select a category') + $categories, null, ['class'=>'form-control']) }}
                <span class="text-danger">{{ $errors->first('category_id') }}</span>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-md-8">
          <div class="panel panel-default">
            <div class="panel-heading required">Ingredients <small>(One per line)</small></div>
            {{-- <div class="panel-body"> --}}
              <div class="{{ $errors->has('ingredients') ? 'has-error' : '' }}" >
                {{ Form::textarea ('ingredients', null, array('class' => 'form-control simple', 'rows'=>'8')) }}
                <span class="text-danger">{{ $errors->first('ingredients') }}</span>
              </div>
            {{-- </div> --}}
          </div>
          <div class="panel panel-default">
            <div class="panel-heading required">Methodology <small>(One per line)</small></div>
            {{-- <div class="panel-body"> --}}
              <div class="{{ $errors->has('methodology') ? 'has-error' : '' }}" >
                {{ Form::textarea ('methodology', null, array('class' => 'form-control simple', 'rows'=>'8')) }}
                <span class="text-danger">{{ $errors->first('methodology') }}</span>
              </div>
            {{-- </div> --}}
          </div>
        </div>

        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading">Image</div>
            <div class="panel-body text-center">
                @if ($recipe->image)
                      {{ Html::image("images/recipes/" . $recipe->image, "", array('height'=>'150','width'=>'150')) }}
                  @else
                      <i class="fa fa-5x fa-ban" aria-hidden="true"></i>
                  @endif
                <br /><br />
                {{ Form::file('image', ['class'=>'form-control']) }}
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading">Source</div>
            <div class="panel-body">
              {{ Form::text ('source', null, array('class' => 'form-control')) }}
            </div>
          </div>
        </div>

        <div class="col-md-2">
          <div class="panel panel-default">
            <div class="panel-heading required">Servings</div>
            <div class="panel-body">
              <div class="{{ $errors->has('servings') ? 'has-error' : '' }}" >
                {{ Form::number ('servings', null, array('class' => 'form-control')) }}
                <span class="text-danger">{{ $errors->first('servings') }}</span>
              </div>
            </div>
          </div>
        </div>
          
        <div class="col-md-2">
          <div class="panel panel-default">
            <div class="panel-heading required">Prep Time</div>
            <div class="panel-body">
              <div class="{{ $errors->has('prep_time') ? 'has-error' : '' }}" >
                {{ Form::number ('prep_time', null, array('class' => 'form-control', 'placeholder'=>'minutes')) }}
                <span class="text-danger">{{ $errors->first('prep_time') }}</span>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-2">
          <div class="panel panel-default">
            <div class="panel-heading required">Cook Time</div>
            <div class="panel-body">
              <div class="{{ $errors->has('cook_time') ? 'has-error' : '' }}" >
                {{ Form::number ('cook_time', null, array('class' => 'form-control', 'placeholder'=>'minutes')) }}
                <span class="text-danger">{{ $errors->first('cook_time') }}</span>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-2">
          <div class="panel panel-default">
            <div class="panel-heading">Make Private</div>
            <div class="panel-body text-center">
              {{ Form::select('personal', array('0' => 'No', '1' => 'Yes'), 0, ['class'=>'form-control']) }}
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">Public Notes</div>
            {{-- <div class="panel-body"> --}}
              {{ Form::textarea ('public_notes', null, array('class' => 'form-control simple', 'rows'=>'2')) }}
            {{-- </div> --}}
          </div>
        </div>
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">Author's Personal Notes <small>(not shown to public)</small></div>
            {{-- <div class="panel-body"> --}}
              {{ Form::textarea ('author_notes', null, array('class' => 'form-control simple', 'rows'=>'2')) }}
            {{-- </div> --}}
          </div>
        </div>
        <div class="col-xs-12">
          <div class="panel panel-default">
            <div class="panel-heading">Information</div>
            <div class="panel-body">
              <div class="col-xs-4">
              Created By : @include('layouts.author', ['model'=>$recipe , 'field'=>'user']) <br />
              Created On : @include('layouts.dateFormat', ['model'=>$recipe, 'field'=>'created_at'])
              </div>

              <div class="col-xs-4">
              @if ($recipe->modified_by_id)
                Modified By : @include('layouts.author', ['model'=>$recipe , 'field'=>'modified_by']) <br />
                Modified On : @include('layouts.dateFormat', ['model'=>$recipe, 'field'=>'updated_at'])
              @endif
              </div>

              <div class="col-xs-4">
              @if ($recipe->last_viewed_by_id)
                Last Viewed By : @include('layouts.author', ['model'=>$recipe , 'field'=>'last_viewed_by']) <br />
                Last Viewed On : @include('layouts.dateFormat', ['model'=>$recipe, 'field'=>'last_viewed_on'])
              </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('layouts.create_edit_panel_footer')
  @include('layouts.partials.section_close')
  {!! Form::close() !!}
@stop

@section ('scripts')
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@stop