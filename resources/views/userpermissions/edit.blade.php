@extends('userpermissions.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Navigation Items</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('userpermissions.index') }}"> Back</a>
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

    <form action="{{ route('userpermissions.update',$userPermission->id) }}" method="POST">
        @csrf
        @method('PUT')

         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="text" name="email" value="{{ $userPermission->email }}" class="form-control" placeholder="Email">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Permission ID:</strong>
                    <select class="form-control" name="permission_id">
                        <?php
                        foreach($permissions as $key){
                            $selected = '';
                            if($key->id == $userPermission->per_id){ $selected ="selected"; }
                        ?>
                                <option {{ $selected }}  value='{{$key->id}}'>{{$key->name}}</option>
                        <?php
                        }
                        ?>
                    </select>
                    {{-- <input type="text" name="per_id" value="{{ $userPermission->per_id }}" class="form-control" placeholder="Permission ID"> --}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Active:</strong>
                    <select class="form-control" name="active">
                        <option <?php if($userPermission->active == "1") echo "selected"; ?> value="1" >Active</option>
                        <option <?php if($userPermission->active == "0") echo "selected"; ?> value="0" >Inactive</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
