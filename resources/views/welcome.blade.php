@extends ('layouts.main')

@section ('title', 'Home page')

@section ('stylesheets')
  {{ Html::style('css/main.css') }}
@stop

@section('breadcrumb')
  <li>Home</li>
@stop

@section ('content')
  <div class="row">
    <div class="col-md-12">
      <div class="well">
        @if (Auth::check())
          @if (Auth::user()->login_count > 0)
            <h1>Welcome back to the site {{ Auth::user()->first_name }}!</h1>
          @endif
        @else
          <h1>Welcome to the site!</h1>
        @endif

        <p>Thank you for visiting. Please have a look at the latest posts and recipes</p>

        @foreach ($popularpost as $p)
          <a class="btn btn-primary btn-sm" href="{{ route('blog.single', $p->slug) }}" role="button">
            <div class="text text-left">
              <i class="fa fa-star" aria-hidden="true"></i> Most Popular Post
            </div>
          </a>
        @endforeach

        @foreach ($popularrecipe as $r)
          <a class="btn btn-primary btn-sm" href="{{ route('recipes.show', $r->id) }}" role="button">
            <div class="text text-left">
              <i class="fa fa-list-alt" aria-hidden="true"></i> Most Popular Recipe
            </div>
          </a>
        @endforeach

        <br /><br />
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">Select the section you wish to access (more to follow)</div>
        <div class="panel-body">
          @if(checkACL('guest'))
            <div class="col-md-2">
              <a href="{{ route ('profile.show', Auth::user()->id) }}" class="no_decoration">
                <div id="panel-hov" class="panel panel-default">
                  <div class="panel-heading text-center">My Profile</div>
                  <div class="panel-body">
                    <div class="text-center">
                      <i class="fa fa-user fa-3x" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          @endif

          @if(checkACL('author'))
            <div class="col-md-2">
              <a href="{{ route('articles.index') }}" class="no_decoration">
                <div id="panel-hov" class="panel panel-default">
                  <div class="panel-heading text-center">Articles</div>
                  <div class="panel-body">
                    <div class="text-center">
                      <i class="fa fa-list fa-3x" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          @endif

          <div class="col-md-2">
            <a href="{{ route('blog.index','all') }}" class="no_decoration">
              <div id="panel-hov" class="panel panel-default">
                <div class="panel-heading text-center">Blog</div>
                <div class="panel-body">
                  <div class="text-center">
                    <i class="fa fa-book fa-3x" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </a>
          </div>

          <div class="col-md-2">
            <a href="{{ route('shop.index', 'all') }}" class="no_decoration">
              <div id="panel-hov" class="panel panel-default">
                <div class="panel-heading text-center">Shop</div>
                <div class="panel-body">
                  <div class="text-center">
                    <i class="fa fa-wpforms fa-3x" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </a>
          </div>
          
          <div class="col-md-2">
            <a href="{{ route('recipes.index','all') }}" class="no_decoration">
              <div id="panel-hov" class="panel panel-default">
                <div class="panel-heading text-center">Recipes</div>
                <div class="panel-body">
                  <div class="text-center">
                    <i class="fa fa-book fa-3x" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </a>
          </div>
        
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-9">
      <div class="panel panel-primary">
        <div class="panel-heading">Latest Posts</div>
        <div class="panel-body">
          @foreach ($posts as $post)
            <div class="panel panel-default">
              <div class="panel-heading">{{ $post->title }}</div>
              <div class="panel-body">
                <div class="col-md-10">
                  {{ substr(strip_tags($post->body), 0, 300) }} {{ strlen(strip_tags($post->body)) > 300 ? " ..." : "" }}
                </div>
                <div class="col-md-2">
                  <a href="{{ url('blog/'.$post->slug) }}" class="btn btn-primary btn-sm">
                    <div class="text text-left">
                      <i class="fa fa-chevron-right" aria-hidden="true"></i> Read More
                    </div>
                  </a>
                </div>
              </div>
              <div class="panel-footer">
                Created by @include('layouts.author', ['model'=>$post, 'field'=>'user'])
                <div class="pull-right">
                  Published on @include('layouts.dateFormat', ['model'=>$post, 'field'=>'created_at'])
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div> <!-- end of header row -->

    <div class="col-md-3">
      <div class="panel panel-default">
        <div class="panel-heading">Recipes Archives</div>
        <div class="panel-body">
          <ul class="list-group">
            @foreach($recipelinks as $rlink)
              <a href="{{ route('recipes.archive', ['year'=>$rlink->year, 'month'=>$rlink->month]) }}" class="list-group-item">{{ $rlink->month_name }} - {{ $rlink->year }} <span class="badge">{{ $rlink->post_count }}</span></a> 
            @endforeach
          </ul>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="panel panel-default">
        <div class="panel-heading">Blog Archives</div>
        <div class="panel-body">
          <ul class="list-group">
            @foreach($postlinks as $plink)
              <a href="{{ route('blog.archive', ['year'=>$plink->year, 'month'=>$plink->month]) }}" class="list-group-item">{{ $plink->month_name }} - {{ $plink->year }} <span class="badge">{{ $plink->post_count }}</span></a> 
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
@stop

@section ('scripts')
@stop