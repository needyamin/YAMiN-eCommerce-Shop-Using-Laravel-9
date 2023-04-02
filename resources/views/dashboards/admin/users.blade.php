@section('title') All Users @endsection
@section('description') All Users From Admin Panel @endsection
@include('dashboards.admin.admin.header-footer.header')
@include('dashboards.admin.admin.header-footer.datatablecore')
@include('dashboards.admin.admin.sidebar')


@if (\Auth::user()->role == 'admin')
<!-- main content -->
<main class="container-fluid">
	
<div align="center" style="padding:10px; border:1px solid grey;">
  <h3  class="black-text" style="font-weight:bold;"><a href="">Admin Dashboard</a></h3>
<p class="white-text" style="font-weight:bold;">

   <button type="button" class="badge badge-pill btn-green disabled px-3 py-2" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Add Users</button>

   <a href="" class="badge badge-pill btn-dark disabled px-3 py-2"><i class="fas fa-users"></i>  All Users</a> 
    <a href="{{url('admin-bin-users')}}" class="badge badge-pill btn-outline-danger px-3 py-2"><i class="fas fa-dumpster"></i> Recycle Bin</a>
    </p>
    
@if (session('status'))<div class="alert alert-danger" role="alert">{{ session('status') }}</div>@endif
@error('mobile_no') <p style="font-size:13px;color:red"> {{ $message }}</p>@enderror 
@error('email') <p style="font-size:13px;color:red"> {{ $message }}</p>@enderror 

</div>
 


<style>
.form-group{
  margin-bottom: 0;
}

input,
input::placeholder {
    font: 17px/3 sans-serif;
}
    
    .form-group.floating>label {
    bottom: 34px;
    left: 8px;
    position: relative;
    background-color: white;
    padding: 0px 5px 0px 5px;
    font-size: 1.1em;
    transition: 0.1s;
    pointer-events: none;
    font-weight: 500 !important;
    transform-origin: bottom left;
}

.form-control.floating:focus~label{
    transform: translate(1px,-85%) scale(0.80);
    opacity: .8;
    color: #005ebf;
}

.form-control.floating:valid~label{
    transform-origin: bottom left;
    transform: translate(1px,-85%) scale(0.80);
    opacity: .8;
}
</style>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('admin/admin-all-users/createUser') }}" method="POST">
        @csrf

         <div class="form-group floating">
          <input type="text" class="form-control floating" name="name" id="name" placeholder="Name">
          <label for="name">Name</label>
          </div>

          <div class="form-group floating">
            <input type="number" class="form-control floating" name="mobile_no" id="number" placeholder="Mobile Number">
            <label for="number">Phone Number</label>
  
          </div>

          <div class="form-group floating">
          <input type="email" class="form-control floating" name="email" id="email" placeholder="example@mailsite.com">
          <label for="email">Email</label>
          </div>

          <div class="form-group floating">
          <input type="password" class="form-control floating" id="password" name="password" placeholder="password">
          <label for="password">Password</label>
          </div>
          
          <div class="form-group floating">
          <select class="form-control floating" id="usergroup" name="usergroup">
            <option value="user">User</option>
            <option value="admin">Admin</option>
          </select>
          <label for="usergroup">UserGroup</label>
          </div>

       
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-primary" value="Create">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>








<div class="container py-2">
    <div class="card">
        <div class="card-body">

    <table id="ALLUserS" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th style="text-align: center;">#Id</th>
                <th>Name</th>
                <th>Mobile No.</th>
                <th>Role</th>
                <th>Status</th>
                <th>Date/Time</th>
                <th>Action</th>
                </tr>
                   </thead>
            </thead>

    <tbody>
        @foreach ($users as $data)
         <tr>
           <td style="text-align: center;"><a href="{{url('admin/role-edit/'.$data->id)}}">{{ $data->id }}</a></td>
           <td>{{ $data->name=='' ? $data->username:$data->name }}</td>
           <td>{{ $data->mobile_no }}</td>
           <td>{{ $data->role }}</td>
           <td>{{ $data->status==1 ? 'Active':'Inactive' }}</td>
           <td>{{Carbon\Carbon::parse($data->created_at)->format('d M Y / g:i A')}}</td>
            <td style="text-align: center;">
        <a href="{{url('admin/role-edit/'.$data->id)}}" class="badge badge-pill btn-primary px-3 py-2"> Edit </a>
        <a href="{{url('admin/delete-user/'.$data->id)}}" class="badge badge-pill btn-danger px-3 py-2">Delete</a>
            </td>
            </tr>
        @endforeach
         </tbody>
            </table>

    <script> $(document).ready(function() {$('#ALLUserS').DataTable({
dom: 'Bfrtip',
buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
  });} );</script>
     </div></div>

</main>
@endif

@include('dashboards.admin.admin.header-footer.footer')