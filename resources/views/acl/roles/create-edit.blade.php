@extends('layouts.app')

@section('content')
<div class="container">
    <form class="form-horizontal" method="POST" action="{{ url('/roles/store') }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Role</div>

                    <div class="panel-body">

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="id_role" type="hidden" name="id_role" value="{{ $roles->id ?? '' }}">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $roles->name ?? '' }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('label') ? ' has-error' : '' }}">
                            <label for="label" class="col-md-4 control-label">Label</label>

                            <div class="col-md-6">
                                <input id="label" type="label" class="form-control" name="label" value="{{ $roles->label ?? '' }}" required>

                                @if ($errors->has('label'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('label') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="{{ url('/roles') }}" class="btn btn-default">Cancel</a>
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Roles Permissions</div>

                    <div class="panel-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            @foreach($tabs as $tab => $tab_text)
                                <li role="presentation" class="{{ ($tab_text->group == '') ? 'active' : '' }}"><a href="#{{ $tab_text->group }}" aria-controls="{{ $tab_text->group }}" role="tab" data-toggle="tab">{{ ucfirst($tab_text->group) }}</a></li>
                            @endforeach
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            @foreach($tabs as $tab => $tab_text)
                                 <div role="tabpanel" class="tab-pane {{ ($tab_text->group == '') ? 'active' : '' }}" id="{{ $tab_text->group }}">
                                    @foreach($Acl::getPermissionsGroup($tab_text->group) as $permissions)
                                        <label>
                                            <input type="checkbox" name="permissions[]" value="{{ $permissions->id }}" {{ isset($roles->id) && $Acl::verifyPermission($roles->id, $permissions->id) ? 'checked=\"checked\"' : '' }}>
                                            {{ $permissions->name }}
                                        </label>
                                        <br>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
