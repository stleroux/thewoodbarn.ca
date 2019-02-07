@extends ('layouts.main')

@section ('title', 'Contact')

@section ('stylesheets')
  {{ Html::style('css/main.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li>Contact Us</li>
@stop

@section ('content')
  <form action="{{ url('contact') }}" method="POST">
    {{ csrf_field() }}
    <div class="row">
      <div class="col-md-9">
        <div class="panel panel-default">
          <div class="panel-heading">Contact Us</div>
          <div class="panel-body">
            <!-- Use url() instead of route() when there is no named route -->
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
              <label name="email">Email:</label>
              <input id="email" name="email" class="form-control" autofocus="autofocus" value="{{ old('email') }}">
              <span class="text-danger">{{ $errors->first('email') }}</span>
            </div>
            <div class="form-group {{ $errors->has('subject') ? 'has-error' : '' }}">
              <label name="subject">Subject:</label>
              <input id="subject" name="subject" class="form-control" value="{{ old('subject') }}">
              <span class="text-danger">{{ $errors->first('subject') }}</span>
            </div>
            <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
              <label name="message">Message:</label>
              <textarea id="message" name="message" class="form-control" placeholder="Type your message here">{{ old('message') }}</textarea>
              <span class="text-danger">{{ $errors->first('message') }}</span>
            </div>
            <div class="g-recaptcha" data-sitekey="6LduZyYTAAAAANM_G6pjSZs4O61YJpVDPlLABw11"></div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="panel panel-default">
          <div class="panel-heading">Options</div>
          <div class="panel-body">
            <input type="submit" value="Send Message" class="btn btn-success btn-block">
          </div>
        </div>
      </div>
    </div>
  </form>
@stop

@section ('scripts')
@stop