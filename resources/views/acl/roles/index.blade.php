@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Permissions</div>

                <div class="panel-body">
                    <div class="pull-right">
                        <a href="{{ url('/acl/create') }}" class="btn btn-primary btn-xs">Add Role</a>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>name</th>
                                <th>label</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($acl_roles as $role)
                                <tr>
                                    <td></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">It's empty yet!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
