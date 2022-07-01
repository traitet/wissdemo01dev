@extends('navigationitems.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 CRUD Navigation Items</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('navigationitems.create') }}"> Create Navigation Item</a>
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
        @foreach ($navigationItems as $navigationItem)
        <tr>
            <td>{{ $navigationItem->id }}</td>
            <td>{{ $navigationItem->name }}</td>
            <td>{{ $navigationItem->navigation_group_name }}</td>
            <td>{{ $navigationItem->sequence }}</td>
            <td>{{ $navigationItem->active() }}</td>
            <td>
                <form action="{{ route('navigationitems.destroy',$navigationItem->id) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('navigationitems.show',$navigationItem->id) }}">Show</a>

                    <a class="btn btn-primary" href="{{ route('navigationitems.edit',$navigationItem->id) }}">Edit</a>

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
