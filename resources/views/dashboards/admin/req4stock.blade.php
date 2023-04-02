@section('title') Request For Stock @endsection
@section('description') Request For Stock on Admin Panel @endsection
@include('dashboards.admin.admin.header-footer.header')
@include('dashboards.admin.admin.header-footer.datatablecore')
@include('dashboards.admin.admin.sidebar')
<!-- main content -->
<main class="container-fluid">

<div class="card p-2 mt-4"> <span class='text-muted'> <a href="{{ url('admin/dashboard') }}"> <span class="bi bi-border-all"></span> Dashboard</a> / Request For Stock </span></div>
<br>
    <div class="container">
        <hr>
            @if (session('status'))
              <div class="alert alert-danger" role="alert">{{ session('status') }}</div>
            @endif
      </div>


<div class="container">
  <table id="indexproduct" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile No.</th>
                        <th>Product Code</th>
                        <th>Quantity</th>
                        <th>Message</th>
                        <th>IP</th>
                        <th></th>
                    </tr>
                </thead>
             <tbody>

                    @foreach ($reqforstock as $costing)
                        <tr>
                            <td>{{ $costing->name }}</td>
                            <td>{{ $costing->email }}</td>
                            <td>{{ $costing->mobile_no }}</td>
                            <td>A-{{ $costing->product_id }}</td>
                            <th>{{ $costing->quantity }}</th>
                            <th>{{ $costing->message }}</th>
                            <th>{{ $costing->ip }}</th>
                            <th><a href="{{ url('admin/deletereqforstock/') }}/{{ $costing->id }}">Delete</a></th>
                        </tr>
                        @endforeach      
                    </tbody>
    
                    </table>

<script> $(document).ready(function() {$('#indexproduct').DataTable( );} );</script>
</div>


</main>
@include('dashboards.admin.admin.header-footer.footer')
