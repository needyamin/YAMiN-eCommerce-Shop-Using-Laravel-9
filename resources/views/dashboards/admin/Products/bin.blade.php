
@section('title') Dustbin @endsection
@section('keywords') Home,About,Contact,Car @endsection
@section('description') Write some descripton about the webpage @endsection
@include('dashboards.admin.admin.header-footer.header')
@include('dashboards.admin.admin.header-footer.datatablecore')
@include('dashboards.admin.admin.sidebar')
<!-- main content -->


<main class="container-fluid">

<!-- start from here -->
<link href="{{asset('css/richtext.min.css')}}" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.10.1/css/mdb.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- all scripts -->
          
<!-- end from here -->





@if (session('status'))
  <div class="alert alert-danger" role="alert">
      {{ session('status') }}
  </div>
  @endif
  

 

<div class="container py-5">
    <p align="left">
        <i class="fas fa-dumpster"></i> Recently deleted Products
   </p>
    <div cla
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
        
<table class="table table-striped table-bordered" id="dustbin">

    <thead>
        <th>Name</th>
        <th>Description</th>
        <th>Images</th>
        <th>Price</th>
        <th>Show/Hide</th>
        <th>Action</th>
    </thead>
        
    
     <tbody>
          @foreach ($Products as $item)
        <tr>
            <td>{{$item->name}}</td>
            <td>{{$item->description}}</td>
                         
            <td>
             <img src="{{asset('Uploads/Products/'.$item->image1)}}" width="30px;"  alt="{{$item->image1}}" onerror="this.src='{{asset('Img/no_image.jpg')}}';this.onerror='';"/>
             <img src="{{asset('Uploads/Products/'.$item->image2)}}" width="30px;"  alt="{{$item->image2}}" onerror="this.src='{{asset('Img/no_image.jpg')}}';this.onerror='';"/>
             <img src="{{asset('Uploads/Products/'.$item->image3)}}" width="30px;"  alt="{{$item->image3}}" onerror="this.src='{{asset('Img/no_image.jpg')}}';this.onerror='';"/>
             <img src="{{asset('Uploads/Products/'.$item->image4)}}" width="30px;"  alt="{{$item->image4}}" onerror="this.src='{{asset('Img/no_image.jpg')}}';this.onerror='';"/>
            </td>

    <td>{{$item->price}}</td>

     <td> 
        <?php if( $item->status==1){
              echo '<p class="badge badge-pill btn-success"><i class="fas fa-check "></i></p>';}
           else{echo '<p class="badge badge-pill btn-danger"><i class="fas fa-times"></i></p>';}?>
     </td>
              
        <td align="center">
             <a href="{{url('admin-product-restore/'.$item->id)}}" class="badge badge-pill btn-warning px-3 py-2">Restore</a><br><br>
             <a href="{{url('admin-product-delete-confirm/'.$item->id)}}" class="badge badge-pill btn-danger px-3 py-2">Delete Permanently</a>
        </td>
       </tr>

        @endforeach
                </tbody>

                </table>


<script>
$(document).ready(function() {
    $('#dustbin').DataTable();
} 
);
</script>



                
            </div>
        </div>
</div>
</div>
<hr>

</main>
<script src="{{asset('js/jquery.richtext.js')}}"> </script> 
<script src="{{asset('js/jquery.richtext.min.js')}}"> </script> 
@include('dashboards.admin.admin.header-footer.footer')

