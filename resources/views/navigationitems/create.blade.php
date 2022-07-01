
@extends('navigationitems.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add Navigation Items</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('navigationitems.index') }}"> Back</a>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('navigationitems.store') }}" method="POST">
    @csrf

     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Navigation Group ID:</strong>
                <div class="form-group">
                    <select class="form-control" name="navigation_group_id">
                        @foreach($navigationGroups as $key)
                                <option value='{{$key->id}}'>{{$key->name}}</option>
                        @endforeach
                    </select>
                </div>
                {{-- <input type="text" name="nav_group_id" class="form-control" placeholder="Navigation Group ID"> --}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Sequence:</strong>
                <input type="text" name="sequence" class="form-control" placeholder="Sequence">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Active:</strong>
                <select class="form-control" name="active">
                    <option value="1" >Active</option>
                    <option value="0" >Inactive</option>
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>

</form>
@endsection
