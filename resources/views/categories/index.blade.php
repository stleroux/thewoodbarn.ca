@extends('layouts.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/styles.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li>Categories</li>
@stop

@section('menubar')
  @include('layouts.dropdowns.import', ['name'=>'categories'])
  @include('layouts.buttons.dashboard')
  @include('layouts.buttons.add', ['name'=>'categories'])
@stop

@section('content')
  @include('layouts.partials.section_top', ['name'=>'Categories', 'icon'=>'fa-building'])
        <div class="panel-body">
          <table id="datatable" class="table table-hover table-condensed">
            <thead>
              <tr>
                <th>Name</th>
                <th>Module</th>
                <th data-orderable="false"></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($categories as $category)
                <tr>
                  <td>{{ $category->name }}</td>
                  <td>{{ $category->module->name }}</td>
                  <td class="text-right">
                    @include('layouts.buttons.edit', ['model'=>$category, 'name'=>'categories', 'id'=>$category->id])
                    @include('layouts.buttons.delete', ['model'=>$category, 'name'=>'categories', 'id'=>$category->id])
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@stop
