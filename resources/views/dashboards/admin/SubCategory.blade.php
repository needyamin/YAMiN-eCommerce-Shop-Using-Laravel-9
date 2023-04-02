@section('title') Sub Category @endsection
@section('keywords') Home,About,Contact,Car @endsection
@section('description') Write some descripton about the webpage @endsection
@include('dashboards.admin.admin.header-footer.header')
@include('dashboards.admin.admin.sidebar')
<!-- main content -->
<main class="container-fluid">


<div class="card p-2"> <span class='text-muted'> <a href="{{ url('admin/dashboard') }}"> <span class="bi bi-border-all"></span> Dashboard</a> / SubCategory</div>
	<br>


@if (session('status'))
  <div class="alert alert-danger" role="alert">
      {{ session('status') }}
  </div>
  @endif
  


 <p> <a href="{{ url('admin-AddSubCategory')}}" class="btn btn-success"> Add SubCategory </a></p>

<div class="col-md-12">
        <div class="card">
            <div class="card-body">

                   <table class="table table-striped table-bordered">
                       <thead>
                        <th>SubCategory Name</th>
                        <th>Category ID</th>
 

                       </thead>
                     @php
                     $Orders=App\Models\subcategory::all();
                     @endphp
                       <tbody>
                           @foreach ($Orders as $item)
                       <tr>

                           <td>{{$item->name}} </td>
                           <td>{{$item->category->name}}</td>
                          
                       </tr>
                           @endforeach
                           
                       </tbody>
                   </table>
            </div>
        </div>
</div>




</main>
@include('dashboards.admin.admin.header-footer.footer')