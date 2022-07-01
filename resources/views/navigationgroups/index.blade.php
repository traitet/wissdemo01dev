@extends('navigationgroups.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 CRUD Navigation Groups</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('navigationgroups.create') }}"> Create Navigation Group</a>
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
            <th>Sequence</th>
            <th>Active</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($navigationGroups as $navigationGroup)
        <tr>
            <td>{{ $navigationGroup->id }}</td>
            <td>{{ $navigationGroup->name }}</td>
            <td>{{ $navigationGroup->sequence }}</td>
            <td>{{ $navigationGroup->active() }}</td>
            <td>
                <form action="{{ route('navigationgroups.destroy',$navigationGroup->id) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('navigationgroups.show',$navigationGroup->id) }}">Show</a>

                    <a class="btn btn-primary" href="{{ route('navigationgroups.edit',$navigationGroup->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {!! $navigationGroups->links() !!}

@endsection
