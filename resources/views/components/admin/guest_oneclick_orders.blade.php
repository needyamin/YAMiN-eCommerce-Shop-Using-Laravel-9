@section('title') Category @endsection
@section('keywords') Home,About,Contact,Car @endsection
@section('description') Write some descripton about the webpage @endsection
@include('dashboards.admin.admin.header-footer.header')
@include('dashboards.admin.admin.sidebar')
@include('dashboards.admin.admin.header-footer.datatablecore')
<meta name="csrf-token" content="{{ csrf_token() }}" />


<main class="container-fluid">
@if (session('status'))<div class="alert alert-danger" role="alert">{{ session('status') }}</div>@endif

<div class="container">
<p><a href="{{ url('admin/admin-Orders-edit/get/view') }}" class="btn btn-primary mt-2">Add Order </a></p>

<p><div class="card p-2"> <span class="text-muted"> <a href="http://127.0.0.1:8000/admin/dashboard" style="font-size: 0.9rem;"> <span class="bi bi-border-all"></span> Dashboard</a> / All Orders </span></div></p>



<button type="button" class="btn-sm btn-primary float-right mb-1 ml-1" data-toggle="modal" data-target="#exampleModalExcelCenter">
<i class="bi bi-download"></i> Download Excel
</button>

<button type="button" class="btn-sm btn-primary float-right" data-toggle="modal" data-target="#exampleModalCenter">
<i class="bi bi-filter"></i> Filter
</button>

<br>
<!-- Modal Start Filter-->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Filter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
<form action="{{ url('admin/guest/Orders')}}" method="GET">

  <div class="form-group">
        <label>Start Date</label>
        <input type="date" name="start_date" value="{{Carbon\Carbon::now()->subDays(60)->isoFormat('YYYY-MM-DD')}}" class="form-control" required>
      </div>
   

   
    <div class="form-group">
      <label>End Date</label>
       <input type="date" name="end_date" value="{{Carbon\Carbon::now()->isoFormat('YYYY-MM-DD')}}" class="form-control" required>
      </div>
  

      <div class="form-group">
      <button type="submit" class="btn btn-primary mb-2">Submit</button>
    </div>

  </div>
</form>

      </div>

    </div>
  </div>

<!-- Modal END-->



<!-- Modal Start excel-->
<div class="modal fade" id="exampleModalExcelCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalExcelCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalExcelCenterLongTitle">Excel Export</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
<form action="{{ url('admin/guest/Orders')}}" method="GET">

  <div class="form-group">
        <label>Start Date</label>
        <input type="date" name="start_date_excel" value="{{Carbon\Carbon::now()->subDays(60)->isoFormat('YYYY-MM-DD')}}" class="form-control" required>
      </div>
   

   
    <div class="form-group">
      <label>End Date</label>
       <input type="date" name="end_date_excel" value="{{Carbon\Carbon::now()->isoFormat('YYYY-MM-DD')}}" class="form-control" required>
      </div>
  

      <div class="form-group">
      <button type="submit" class="btn btn-primary mb-2">Submit</button>
    </div>

  </div>
</form>
      </div>
    </div>

</div>
<!-- Modal excel END-->


<div class="table-responsive-sm">
<style>
td{word-break: break-all !important;}select{width:110px;} table,td,tr{font-size: 0.9rem;}.badge{margin-top: 5px;}
</style>

<table id="orderProduct" class="table-striped table-bordered">
<thead>
  <tr>
     <th>Order_Id</th>
      <th> Product_ID</th>
       <th>Customer Name</th>
        <th>Telephone</th>
          <th>Delivery Address</th>
              <th>Created</th>
              <th>Note</th>
              <th></th>
                      </tr>    
                         </thead>
  
                 <tbody>
          
     @foreach ($Orders as $item)
      <tr>
        <td style='text-align:center;'>{{$item->id}}</td>
        <td> {{ $item->product_id }} </td>
          <td id="tdID">{{ $item->name }} </td>
           <td style="text-align:left;">{{ $item->phone }}</td>
            <td>{{ $item->address }}</td>              
             <td width="text-align:center;">{{Carbon\Carbon::parse($item->created_at)->format('jS M Y')}}</td>   
             <td>{{ $item->note }}</td>
             <td><a href="{{ url('admin/guest/Orders/delete/') }}/{{$item->id}}"><i class="bi bi-trash"></i></a></td>

        </tr>
             @endforeach      
                   </tbody>
    
                    </table>
                       </div></div>







<script>
$(document).ready(function() {
$('#orderProduct').DataTable({
  "ordering": false,
  "bStateSave": true,
        "fnStateSave": function (oSettings, oData) {
            localStorage.setItem('offersDataTables', JSON.stringify(oData));
        },
        "fnStateLoad": function (oSettings) {
            return JSON.parse(localStorage.getItem('offersDataTables'));
        }
});

} );
</script>


<!-- datatables keep order and page selection page refresh
  $('#offersTable').dataTable({
        "bStateSave": true,
        "fnStateSave": function (oSettings, oData) {
            localStorage.setItem('offersDataTables', JSON.stringify(oData));
        },
        "fnStateLoad": function (oSettings) {
            return JSON.parse(localStorage.getItem('offersDataTables'));
        }
    });
  -->





</main>
@include('dashboards.admin.admin.header-footer.footer')