{{--================================================================================================================================================
== Display for both EDIT and ADD
================================================================================================================================================--}}    
@if($action_name == 'add' || $action_name == 'edit')
    {{-- NOTES/INSTRUCTIONS ABOUT PERMISSIONS --}}
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div id="click_advance">
            <a class="btn btn-primary btn-block" role="button" data-toggle="collapse" href="#instructions" aria-expanded="false" aria-controls="instructions">
                <div class="text text-left">
                    Instructions
                    <i class="fa fa-plus-square pull-right" aria-hidden="true"></i>
                </div>
            </a>
        </div>

        <!-- collapse contain -->
        <div class="collapse" id="instructions">
            <div class="well">
                <p>- You need to select at leadt 1 user permission</p>
                <p>- Admin permissions will override user permissions</p>
                <p>- Permissions are allowed centric</p>
                <p>-- Examples : </p>
                <p>--- Admin -> Articles -> Create -> No AND User -> Articles -> Create -> Yes => User will be able to add articles</p>
                <p>--- Admin -> Articles -> Edit All = Allowed AND User -> Articles -> Edit Own = Denied => User will be able to edit <b><u>All</u></b> articles in the system</p>
                <p>&nbsp;</p>
                <p><b><i>Enabling Super Admin will provide the user with God like access to the system. Use with EXTREME CAUTION.</i></b></p>
            </div>
        </div>
        <!-- collapse contain end -->
        <br />
    </div>
@endif

{{--================================================================================================================================================
== 
================================================================================================================================================--}}
@if($action_name == 'add')
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            {{ Form::label('name', 'Internal Name', ($action_name != "show" ? ['class'=>'required'] : "")) }}
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control', 'autofocus', ($action_name == 'show'?'readonly':''))) !!}
            <span class="text-danger">{{ $errors->first('name') }}</span>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group {{ $errors->has('display_name') ? 'has-error' : '' }}">
            {{ Form::label('display_name', 'Display Name', ($action_name != "show" ? ['class'=>'required'] : "")) }}
            {!! Form::text('display_name', null, array('placeholder' => 'Display Name','class' => 'form-control', ($action_name == 'show'?'readonly':''))) !!}
            <span class="text-danger">{{ $errors->first('display_name') }}</span>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
            {{ Form::label('description', 'Description', ($action_name != "show" ? ['class'=>'required'] : "")) }}
            {!! Form::textarea('description', null, array('rows'=>'2', 'placeholder' => 'Description','class' => 'form-control', ($action_name == 'show'?'readonly':''))) !!}
            <span class="text-danger">{{ $errors->first('description') }}</span>
        </div>
    </div>

    {{-- USER PERMISSIONS --}}
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">Select front-end (user) permissions for this role</div>
            </div>
            <div class="panel-body">
                <span class="text-danger"><b>{{ $errors->first('permission') }}</b></span>
                
                <?php $tmpHead = ''; ?>

                <div class="panel panel-info panel-borderless">
                    @foreach($permission as $value)
                        <?php $split = explode("_", $value->name); ?>

                        @if($tmpHead != $split[0])
                            <?php $tmpHead = $split[0]; ?>
                            <div class="panel-heading"><b>{!! ucfirst($tmpHead) !!}</b></div>
                        @endif

                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <td width="10%">{{ Form::checkbox('permission[]', $value->id, false, ['data-toggle=toggle', 'data-on="Allowed"', 'data-off="Denied"', 'data-onstyle="success"', 'data-offstyle="danger"', 'data-size="mini"']) }}</td>
                                    <td width="30%">{{ str_replace($tmpHead, '', $value->display_name) }}</td>
                                    <td>{{ $value->description }}</td>
                                </tr>
                            </tbody>
                        </table>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- ADMIN PERMISSIONS --}}
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">Select back-end (admin) permissions for this role</div>
            </div>
            <div>
                <div class="panel-body">
                    <span class="text-danger"><b>{{ $errors->first('permissionAdmin') }}</b></span>
                    
                    <?php $tmpHead = ''; ?>

                    <div class="panel panel-warning panel-borderless">
                        @foreach($permissionAdmin as $value)
                            <?php $split = explode("_", $value->name); ?>

                            @if($tmpHead != $split[0])
                                <?php $tmpHead = $split[0]; ?>
                                <div class="panel-heading"><b>{!! ucfirst($tmpHead) !!}</b></div>
                            @endif

                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td width="10%">{{ Form::checkbox('permission[]', $value->id, false, ['data-toggle=toggle', 'data-on="Allowed"', 'data-off="Denied"', 'data-onstyle="success"', 'data-offstyle="danger"', 'data-size="mini"']) }}</td>
                                        <td width="30%">{{ str_replace($tmpHead, '', $value->display_name) }}</td>
                                        <td>{{ $value->description }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

{{--================================================================================================================================================
== 
================================================================================================================================================--}}
@if($action_name == 'edit')
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            {{ Form::label('name', 'Internal Name', ($action_name != "show" ? ['class'=>'required'] : "")) }}
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control', 'autofocus', ($action_name == 'show'?'readonly':''))) !!}
            <span class="text-danger">{{ $errors->first('name') }}</span>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group {{ $errors->has('display_name') ? 'has-error' : '' }}">
            {{ Form::label('display_name', 'Display Name', ($action_name != "show" ? ['class'=>'required'] : "")) }}
            {!! Form::text('display_name', null, array('placeholder' => 'Display Name','class' => 'form-control', ($action_name == 'show'?'readonly':''))) !!}
            <span class="text-danger">{{ $errors->first('display_name') }}</span>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
            {{ Form::label('description', 'Description', ($action_name != "show" ? ['class'=>'required'] : "")) }}
            {!! Form::textarea('description', null, array('rows'=>'2', 'placeholder' => 'Description','class' => 'form-control', ($action_name == 'show'?'readonly':''))) !!}
            <span class="text-danger">{{ $errors->first('description') }}</span>
        </div>
    </div>

    {{-- USER PERMISSIONS --}}
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">Select front-end (user) permissions for this role</div>
            </div>
            <div class="panel-body">
                <span class="text-danger"><b>{{ $errors->first('permission') }}</b></span>
                
                <?php $tmpHead = ''; ?>

                <div class="panel panel-info panel-borderless">
                    @foreach($permission as $value)
                        <?php $split = explode("_", $value->name); ?>

                        @if($tmpHead != $split[0])
                            <?php $tmpHead = $split[0]; ?>
                            <div class="panel-heading"><b>{!! ucfirst($tmpHead) !!}</b></div>
                        @endif

                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <td width="10%">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['data-toggle=toggle', 'data-on="Allowed"', 'data-off="Denied"', 'data-onstyle="success"', 'data-offstyle="danger"', 'data-size="mini"']) }}</td>
                                    <td width="30%">{{ str_replace($tmpHead, '', $value->display_name) }}</td>
                                    <td>{{ $value->description }}</td>
                                </tr>
                            </tbody>
                        </table>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- ADMIN PERMISSIONS --}}
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">Select back-end (admin) permissions for this role</div>
            </div>
            <div>
                <div class="panel-body">
                    <span class="text-danger"><b>{{ $errors->first('permissionAdmin') }}</b></span>
                    
                    <?php $tmpHead = ''; ?>

                    <div class="panel panel-warning panel-borderless">
                        @foreach($permissionAdmin as $value)
                            <?php $split = explode("_", $value->name); ?>

                            @if($tmpHead != $split[0])
                                <?php $tmpHead = $split[0]; ?>
                                <div class="panel-heading"><b>{!! ucfirst($tmpHead) !!}</b></div>
                            @endif

                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td width="10%">{{ Form::checkbox('permissionAdmin[]', $value->id, in_array($value->id, $rolePermissionsAdmin) ? true : false, ['data-toggle=toggle', 'data-on="Allowed"', 'data-off="Denied"', 'data-onstyle="success"', 'data-offstyle="danger"', 'data-size="mini"']) }}</td>
                                        <td width="30%">{{ str_replace($tmpHead, '', $value->display_name) }}</td>
                                        <td>{{ $value->description }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

{{--================================================================================================================================================
== 
================================================================================================================================================--}}
@if($action_name == 'show')
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('name', 'Internal Name') }}
            <div class="well well-sm">
                {!! $role->name !!}
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('display_name', 'Display Name') }}
            <div class="well well-sm">
                {!! $role->display_name !!}
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('description', 'Description') }}
            <div class="well well-sm">
                {!! $role->description !!}
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">Permissions:</div>
            <div class="panel-body">
                @if(!empty($rolePermissions))
                    @php $tmpHead = ''; @endphp
                    @foreach($rolePermissions as $value)
                        @php $split = explode("_", $value->name); @endphp
                        @if($tmpHead != $split[0])
                            @php $tmpHead = $split[0]; @endphp
                            <p>
                            <strong><div class="text text-danger">{!! ucfirst($tmpHead) !!}</div></strong></p>
                        @endif

                        <i class="fa fa-minus" aria-hidden="true"></i> {{ str_replace($tmpHead, '', $value->display_name) }}
                        &nbsp;&nbsp;
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">Admin Permissions:</div>
            <div class="panel-body">
                @if(!empty($rolePermissionsAdmin))
                    @php $tmpHead = ''; @endphp
                    @foreach($rolePermissionsAdmin as $value)
                        @php $split = explode("_", $value->name); @endphp
                        @if($tmpHead != $split[0])
                            @php $tmpHead = $split[0]; @endphp
                            <p>
                            <strong><div class="text text-danger">{!! ucfirst($tmpHead) !!}</div></strong></p>
                        @endif

                        <i class="fa fa-minus" aria-hidden="true"></i> {{ str_replace($tmpHead, '', $value->display_name) }}
                        &nbsp;&nbsp;
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endif
