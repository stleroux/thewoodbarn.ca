<div class="panel panel-default">
    <div class="panel-heading">Image</div>
    <div class="panel-body text-center">
         @if ($user->image)
            {{ Html::image("images/profiles/" . $user->image, "",array('height'=>'115','width'=>'115')) }}
        @else
            <i class="fa fa-5x fa-user" aria-hidden="true"></i>
        @endif
        <br /><br />
        {{ Form::file ('image' , ['class'=>'form-control']) }}
    </div>
</div>