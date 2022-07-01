@extends('permissions.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Navigation Items</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('permissions.index') }}"> Back</a>
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

    <form action="{{ route('permissions.update',$permission->id) }}" method="POST">
        @csrf
        @method('PUT')

         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $permission->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Navigation Item ID:</strong>
                    <select class="form-control" name="navigation_item_id">
                        <?php
                        foreach($navigationItems as $key){
                            $selected = '';
                            if($key->id == $permission->navigation_item_id){ $selected ="selected"; }
                        ?>
                                <option {{ $selected }}  value='{{$key->id}}'>{{$key->name}}</option>
                        <?php
                        }
                        ?>
                    </select>
                    {{-- <input type="text" name="nav_item_id" value="{{ $permission->nav_item_id }}" class="form-control" placeholder="Navigation Group ID"> --}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Sequence:</strong>
                    <input type="text" name="sequence" value="{{ $permission->sequence }}" class="form-control" placeholder="Sequence">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Active:</strong>
                    <select class="form-control" name="active">
                        <option <?php if($permission->active == "1") echo "selected"; ?> value="1" >Active</option>
                        <option <?php if($permission->active == "0") echo "selected"; ?> value="0" >Inactive</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
