{{-- Bootstrap 3 --}}
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>TheWoodBarn.ca - @yield ('title')</title>

  <!-- Bootstrap 3.3.7 -->
  {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> --}}

  {{-- {{ Html::style('css/font-awesome.css') }} --}}
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/dt-1.10.13/r-2.1.0/datatables.min.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/plug-ins/1.10.13/integration/font-awesome/dataTables.fontAwesome.css"/>

  @if (Auth::user())
    {{ Html::style('css/bootstrap/' . Auth::user()->style . '.css') }}
  @else
    {{ Html::style('css/bootstrap/bootstrap.css') }}
  @endif

  {{ Html::style('css/test.css') }}
  {{-- {{ Html::style('css/megamenu.css') }} --}}

  @yield ('stylesheets')

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body style="background-color: #C0C0C0">
  <div class="container-fluid">
    <div class="panel panel-default">
      <div class="panel-heading">TheWoodBarn.ca</div>
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-9 col-md-9">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="panel-title"></div>
              </div>
              <div class="panel-body">
                <br />
                <br />
                <br />
                <br />
              </div>
              <div class="panel-footer"></div>
            </div>
          </div>
          <div class="col-sm-3 col-md-3">
            <div class="panel panel-default">
              <div class="panel-heading">Options</div>
              <div class="panel-body">
                @include('layouts.buttons.button', ['model'=>'test', 'name'=>'Home', 'icon'=>'fa-home'])
                @include('layouts.buttons.index', ['model'=>'recipes', 'name'=>'Recipes', 'param1'=>'all', 'icon'=>'fa-book'])
                @include('layouts.buttons.index', ['model'=>'blog', 'name'=>'Blog', 'icon'=>'fa-th-list'])
                @include('layouts.buttons.index', ['model'=>'shop', 'name'=>'Store', 'param1'=>'all', 'icon'=>'fa-shopping-cart'])
                @include('layouts.buttons.button', ['model'=>'about', 'name'=>'About Us', 'icon'=>'fa-question-circle'])
                @include('layouts.buttons.button', ['model'=>'contact', 'name'=>'Contact Us', 'icon'=>'fa-telegram'])
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading"></div>
              <div class="panel-body"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="panel-footer">Copyright Info</div>
    </div>
  </div>
</body>