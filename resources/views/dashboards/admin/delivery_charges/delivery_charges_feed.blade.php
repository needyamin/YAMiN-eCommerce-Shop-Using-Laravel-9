@section('title') Delivery Charges @endsection
@section('keywords') Home,About,Contact,Car @endsection
@section('description') Write some descripton about the webpage @endsection
@include('dashboards.admin.admin.header-footer.header')
@include('dashboards.admin.admin.header-footer.datatablecore')
@include('dashboards.admin.admin.sidebar')

@if (\Auth::user()->role == 'admin')
<!-- main content -->
<main class="container-fluid">
<div class="card p-2 mt-4"> <span class='text-muted'> <a href="{{ url('admin/dashboard') }}"> <span class="bi bi-border-all"></span> Dashboard</a> / Delivery Charges</span></div>
<br>

<div class="container">

<hr>

@if (session('status'))
  <div class="alert alert-danger" role="alert">
      {{ session('status') }}
  </div>
@endif
  
</div>


<div class="container">


<p> <a href="{{ url('admin/delivery_charges/add')}}" class="btn btn-success"> Add Cost </a></p>


 <table id="indexproduct" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Transport cost</th>
                            <th>Postcode</th>
                            <th></th>
                        </tr>
                        </thead>

                    <tbody>
    
                        @foreach ($charges as $costing)
                         <tr>
                                <td><a href="{{ url('admin/delivery_charges/') }}/{{ $costing->id }}">{{ $costing->city }}</a></td>
                                <td style="text-align: center;">{{ number_format($costing->cost,2) }} <span style="font-size: 20px;">৳</span></td>
                                <td style="text-align: center;">{{ $costing->postcode }}</td>
                                <th style="text-align: center;"><a href="{{ url('admin/delivery_charges/del') }}/{{ $costing->id }}">Delete</a></th>
                         </tr>
                        @endforeach      
                     
               

                        </tbody>
    
                    </table>

                    <script>
$(document).ready(function() {
    $('#indexproduct').DataTable( );
} );

</script>

</div>
</main>

@endif

@include('dashboards.admin.admin.header-footer.footer')
