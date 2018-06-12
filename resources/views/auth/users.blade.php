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
                        @can ('adicionar_usuarios')
                            <a href="{{ url('/users/create') }}" class="btn btn-primary btn-xs">Add User</a>
                        @endcan
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>name</th>
                                <th>email</th>
                                <th>roles</th>
                                @if(Gate::check('editar_usuarios') || Gate::check('excluir_usuarios'))
                                    <th></th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ str_replace(',', ', ', $Acl::getRoles($user->id, 'name')) }}</td>
                                    @if (Gate::check('editar_usuarios') || Gate::check('excluir_usuarios'))
                                        <td>
                                            @can ('editar_usuarios')
                                                <a href="{{ url('/users/edit/' . $user->id) }}">Editar</a>
                                            @endcan
                                            @can ('excluir_usuarios')
                                                <a href="{{ url('/users/destroy/' . $user->id) }}">Excluir</a>
                                            @endcan
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">It's empty yet!</td>
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
