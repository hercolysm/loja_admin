@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>

                <div class="panel-body">
                    <p class="pull-left">Total {{ $users->total() }}</p>
                    <div class="pull-right">
                        <a href="{{ url('/users/create') }}" class="btn btn-primary btn-xs">Add User</a>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>name</th>
                                <th>email</th>
                                <th>role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $Acl::getRole($user->id, 'label') }}</td>
                                    <td>
                                        <a href="{{ url('/users/edit/' . $user->id) }}">Editar</a>
                                        <a href="{{ url('/users/destroy/' . $user->id) }}">Excluir</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">It's empty yet!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <center>{{ $users->links() }}</center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
