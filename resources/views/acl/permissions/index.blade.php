@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Permissions</div>

                <div class="panel-body">
                    <p class="pull-left">Total {{ $acl_permissions->total() }}</p>
                    <div class="pull-right">
                        <a href="{{ url('/permissions/create') }}" class="btn btn-primary btn-xs">Add Permission</a>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>name</th>
                                <th>label</th>
                                <th>group</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($acl_permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->label }}</td>
                                    <td>{{ $permission->group }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">It's empty yet!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <center>{{ $acl_permissions->links() }}</center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
