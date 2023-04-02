@section('title') Products Feed @endsection
@section('keywords') Home,About,Contact,Car @endsection
@section('description') Welcome to the Admin Panel of Bishuddhotabd @endsection
@include('dashboards.admin.admin.header-footer.header')
@include('dashboards.admin.admin.header-footer.datatablecore')
@include('dashboards.admin.admin.sidebar')



<style> #SEARCHIDADMIN{display:none;}</style>

<!-- main content -->
<main class="container-fluid">

<div class="card p-2"> <span class='text-muted'> <a href="{{ url('admin/dashboard') }}"> <span class="bi bi-border-all"></span> Dashboard</a> / Products</span></div>

<br>

<div class="container-fluid">

<!-- main search bar start -->
<div class="row" id="search">
<div class="col-8">
<form action="{{url('admin/products')}}" method="GET">
	<div class="form-group">
			<input class="form-control" type="text" name="q" value="{{ request()->q }}" placeholder="Search All Products By Product Name, Price, Item Codes" style="background:#f2ffdf;"/>
			   </div>
</div>
			
    <div class="col-4">
            <div class="form-group">
				<button type="submit" class="btn btn-block btn-success">Search</button>
			      </div>
	        </div>
			</form>
  </div>
<!-- main search bar end -->

<hr>


<button type="button" class="btn-sm btn-primary float-right mb-1 ml-1" data-toggle="modal" data-target="#exampleModalExcelCenter">
<i class="bi bi-download"></i> Download Excel
</button>

<button type="button" class="btn-sm btn-primary float-right mb-1 ml-1" data-toggle="modal" data-target="#exampleModalCenter">
<i class="bi bi-filter"></i> Search Filter
</button>

<a href="{{ url('admin/products?draft') }}" class="btn-sm btn-info float-left mb-1 ml-1">
<i class="bi bi-file-earmark-lock"></i> Draft Post </a >


<br>

<!-- Modal Start Main Filter-->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Search Filter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      
<div class="modal-body">
<form action="{{ url('admin/products')}}" method="GET">
  <div class="form-group">
        <label>Start Date</label>
        <input type="date" name="start_date_products" value="{{Carbon\Carbon::now()->subDays(60)->isoFormat('YYYY-MM-DD')}}" class="form-control" required>
      </div>
   

   
    <div class="form-group">
      <label>End Date</label>
       <input type="date" name="end_date_products" value="{{Carbon\Carbon::now()->isoFormat('YYYY-MM-DD')}}" class="form-control" required>
      </div>
  

      <div class="form-group">
      <button type="submit" class="btn btn-primary mb-2">Search</button>
    </div>

  </div>

</form>

      </div>
    </div>
  </div>
<!-- Modal END Main Filter-->


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
<form action="{{ url('admin/products')}}" method="GET">

  <div class="form-group">
        <label>Start Date</label>
        <input type="date" name="start_date_excel" value="{{Carbon\Carbon::now()->subDays(60)->isoFormat('YYYY-MM-DD')}}" class="form-control" required>
      </div>
   

    <div class="form-group">
      <label>End Date</label>
       <input type="date" name="end_date_excel" value="{{Carbon\Carbon::now()->isoFormat('YYYY-MM-DD')}}" class="form-control" required>
      </div>
  

      <div class="form-group">
      <button type="submit" class="btn btn-primary mb-2">Export</button>
    </div>

  </div>
</form>
      </div>
    </div>

</div>
<!-- Modal excel END-->

@if (session('status'))
  <div class="alert alert-danger" role="alert">
      {{ session('status') }}
  </div>
  @endif
</div>

<div class="container">

 <table id="indexproduct" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
          <th>SL.</th>
           <th>Name</th>
            <th>Category</th>
             <th>Images</th>
              <th>Price</th>
                <th>Show/Hide</th>
                <th>Item Code</th>
                  <th>Action</th>
                  <th style="text-align:center;"><i class="bi bi-binoculars"></i></th>
                  </tr>
                     </thead>

        <tbody>
               @php
               $i = 1;
               @endphp
              @foreach ($Products as $item)
                <tr>
                  <td>#{{$i++}}</td>
                  <td style="font-weight:bold;"> <a href="{{url('admin/product-edit/'.$item->id)}}">{{$item->name}}</a></td>
                     <td>{{$item->category->name}}</td>
       <td>
         <img src="{{asset('Uploads/Products/'.$item->image1)}}" width="30px;" onerror="this.src='{{asset('Img/no_image.jpg')}}';this.onerror='';"/>
         <img src="{{asset('Uploads/Products/'.$item->image2)}}" width="30px;" onerror="this.src='{{asset('Img/no_image.jpg')}}';this.onerror='';"/>
         <img src="{{asset('Uploads/Products/'.$item->image3)}}" width="30px;" onerror="this.src='{{asset('Img/no_image.jpg')}}';this.onerror='';"/>
         <img src="{{asset('Uploads/Products/'.$item->image4)}}" width="30px;" onerror="this.src='{{asset('Img/no_image.jpg')}}';this.onerror='';"/>
         </td>
                  
      <td style='text-align:center;' id='load{{$item->id}}'> 
            

     <form action="{{ url('updateprice') }}" id="paymentUpdate{{$item->id}}" method="POST">
     @csrf
       <p> <input type="number" value="{{$item->price}}" name="price" id="price{{$item->id}}" style="width: 75%; background: #fdfcc2;" min="0"> TK </p>
          <input type="hidden" name="id" id="priceid{{$item->id}}" value="{{$item->id}}">
      <p>
            <button type="submit"><i class="bi bi-check-lg" title="Update Price"></i></button>
            <a onclick="window.location.reload();"><i class="bi bi-arrow-clockwise" title="Reload This Page"></i></a>
       </p>
      </form> 


<script type="text/javascript">
$('#paymentUpdate{{$item->id}}').on('submit',function(e){
    e.preventDefault();
    let price = $('#price{{$item->id}}').val();
    let id = $('#priceid{{$item->id}}').val();
    var div;
    
    $.ajax({
      url: "{{ url('updateprice') }}",
      type:"POST",
      data:{
        "_token": "{{ csrf_token() }}",
        price:price,
        id:id,
      },
      success:function(response){
        $('#load{{$item->id}}').html(div);
        alertify.success('Product Price Updated, Product ID: {{$item->id}}'); 
      },
      error: function(response) {
        alertify.error('Error, Product Price Not Updated, Product ID: {{$item->id}}'); 
      },
      });
    });
  </script>



            </td>

             <td style='text-align:center;'>
                 <p>    @php
                    if( $item->status==1)
                    {echo 'Published <i class="bi bi-check"></i>';}
                        else
                    { echo 'Draft <i class="bi bi-incognito"></i>';} 
                    @endphp </p>

 <p class='text-muted'> Qty: {{ $item->quantity }}  </p>

                         </td>

                         <td> A-{{$item->id}} </td>

               <td style="text-align:center;">
                  <a href="{{url('admin-product-delete/'.$item->id)}}" class="badge btn-lg badge-pill btn-danger p-2">Delete</a>
                    </td>

                 <td style="text-align:center;">
            <a href="{{url('shop/'.$item->url)}}" class="badge btn-lg badge-pill btn-primary p-2" target="_blank">View Post</a>
            </td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>

<script>
$(document).ready(function() {$('#indexproduct').DataTable( {
dom: 'Bfrtip',
buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
"aaSorting": [],
language: {search: "_INPUT_",searchPlaceholder: "Quick Search.. tables"}
     });
});
</script>


</div>


</main>
@include('dashboards.admin.admin.header-footer.footer')
