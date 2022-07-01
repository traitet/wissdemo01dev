@extends('permissions.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 CRUD Permissions</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('permissions.create') }}"> Create Permission</a>
                <a class="btn btn-success" href="{{ route('index') }}"> Index</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Navigatioin Group Name</th>
            <th>Sequence</th>
            <th>Active</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($permissions as $permission)
        <tr>
            <td>{{ $permission->id }}</td>
            <td>{{ $permission->name }}</td>
            <td>{{ $permission->navigation_name }}</td>
            <td>{{ $permission->sequence }}</td>
            <td>{{ $permission->active() }}</td>
            <td>
                <form action="{{ route('permissions.destroy',$permission->id) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('permissions.show',$permission->id) }}">Show</a>

                    <a class="btn btn-primary" href="{{ route('permissions.edit',$permission->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {{-- {!! $navigationItems->links() !!} --}}

@endsection
