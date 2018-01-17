@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Roles</div>

                <div class="panel-body">
                    <p class="pull-left">Total {{ $acl_roles->total() }}</p>
                    <div class="pull-right">
                        <a href="{{ url('/roles/create') }}" class="btn btn-primary btn-xs">Add Role</a>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>name</th>
                                <th colspan="2">label</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($acl_roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->label }}</td>
                                    <td>
                                        <a href="{{ url('/roles/edit/' . $role->id) }}">Editar</a>
                                        <a href="{{ url('/roles/destroy/' . $role->id) }}">Excluir</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">It's empty yet!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <center>{{ $acl_roles->links() }}</center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
