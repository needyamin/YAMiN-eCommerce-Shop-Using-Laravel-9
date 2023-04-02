@extends('layouts.admin')
@section('title') Edit User Role @endsection
@section('keywords') Home,About,Contact,Car @endsection
@section('description') Write some descripton about the webpage @endsection
@section('content')


@if (\Auth::user()->role == 'admin')


<div align="center" style="background:#1CD5E8;padding:20px;">
  <h3  class="black-text" style="font-weight:bold;"><a href="{{url('admin-dash')}}">Admin Dashboard</a></h3>
  <a href="{{url('admin/admin-all-users')}}" class="btn btn-outline-dark" style="color:white">Back</a> 
@if (session('status'))
  <div class="alert alert-danger" role="alert">
      {{ session('status') }}
  </div>
  @endif
 
</div>



<div class="container py-2">
   <p align="left">
    <i class="fas fa-edit"></i> Edit User Role
   </p>
     
    <!--Grid column-->
    <div class="col-md-12 mb-4">

        <!--Card-->
        <div class="card">

        <!--Card content-->
        <div class="card-body">
            <h3>Current Role:{{$userroles->role}}</h3>
        <form action="{{ url('admin/role-update/'.$userroles->id) }}" method="POST">
            {{  csrf_field()  }}

                <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="User Name" value="{{ $userroles->name }}">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="mobile_no" readonly value="{{ $userroles->mobile_no }}">
                    </div>

                        <div class="form-group">
                            <label>User Role</label>
                            <select class="form-control" name="role">
                                @if ($userroles->role == "admin")
                                <option value="admin">{{ $userroles->role }}</option>
                                @endif
                                <option value="user">User</option>
                                 <option value="marketing">Marketing Agent</option>
                                <option value="moderator">Moderator (Order Agent)</option>
                                <option value="admin">Admin</option>
                            </select>
                            </div>


                            <div class="form-group">
                            <label>Reset Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Reset Password For This User" autocomplete="off">
                            </div>


                            <div class="form-group">
                            <label>User Suspend/Active</label>
                            <select class="form-control" name="status">
                                <option disabled>Select--status</option>
                                <option value="0">Suspend</option>
                                <option value="1">Active</option>
                                <option value="2">Delete</option>
                            </select>
                            </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                         </div>

            </form>


        </div>

    </div>
    <!--/.Card-->

</div>
<!--Grid column-->

</div>
<hr>

@endsection


@endif

