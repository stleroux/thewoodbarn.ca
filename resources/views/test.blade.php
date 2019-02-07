<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Sticky Footer Navbar Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap/bootstrap.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/sticky-footer-navbar.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="/css/font-awesome.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">TheWoodBarn.ca</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <!-- Begin page content -->
    <div class="container">

      <div class="row">
        <div class="col-xs-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              @include('layouts.buttons.button', ['model'=>'test', 'name'=>'Home', 'icon'=>'fa-home', 'loc'=>'top'])
              @include('layouts.buttons.index', ['model'=>'recipes', 'name'=>'Recipes', 'param1'=>'all', 'icon'=>'fa-book', 'loc'=>'top'])
              @include('layouts.buttons.index', ['model'=>'blog', 'name'=>'Blog', 'icon'=>'fa-th-list', 'loc'=>'top'])
              @include('layouts.buttons.index', ['model'=>'shop', 'name'=>'Store', 'param1'=>'all', 'icon'=>'fa-shopping-cart', 'loc'=>'top'])
              @include('layouts.buttons.button', ['model'=>'about', 'name'=>'About Us', 'icon'=>'fa-question-circle', 'loc'=>'top'])
              @include('layouts.buttons.button', ['model'=>'contact', 'name'=>'Contact Us', 'icon'=>'fa-telegram', 'loc'=>'top'])
            </div>
          </div>
        </div>
      </div>


      <div class="row">
        <div class="col-xs-9">
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
        <div class="col-xs-3">
          <div class="panel panel-default">
            <div class="panel-heading">Options</div>
            <div class="panel-body">
              @include('layouts.buttons.button', ['model'=>'test', 'name'=>'Home', 'icon'=>'fa-home', 'loc'=>'side'])
              @include('layouts.buttons.index', ['model'=>'recipes', 'name'=>'Recipes', 'param1'=>'all', 'icon'=>'fa-book', 'loc'=>'side'])
              @include('layouts.buttons.index', ['model'=>'blog', 'name'=>'Blog', 'icon'=>'fa-th-list', 'loc'=>'side'])
              @include('layouts.buttons.index', ['model'=>'shop', 'name'=>'Store', 'param1'=>'all', 'icon'=>'fa-shopping-cart', 'loc'=>'side'])
              @include('layouts.buttons.button', ['model'=>'about', 'name'=>'About Us', 'icon'=>'fa-question-circle', 'loc'=>'side'])
              @include('layouts.buttons.button', ['model'=>'contact', 'name'=>'Contact Us', 'icon'=>'fa-telegram', 'loc'=>'side'])
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading"></div>
            <div class="panel-body"></div>
          </div>
        </div>
      </div>
    </div>





    





    <footer class="footer">
      <div class="container">
        <p class="text-muted">Place sticky footer content here.</p>
      </div>
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
