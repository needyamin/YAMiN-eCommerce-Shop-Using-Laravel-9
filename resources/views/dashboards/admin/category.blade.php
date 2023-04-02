@section('title') Category @endsection
@section('keywords') Home,About,Contact,Car @endsection
@section('description') Write some descripton about the webpage @endsection
@include('dashboards.admin.admin.header-footer.header')
@include('dashboards.admin.admin.sidebar')


@if (\Auth::user()->role == 'admin')

<!-- main content -->
<main class="container-fluid">
	
@if (session('status'))
  <div class="alert alert-danger" role="alert">
      {{ session('status') }}
  </div>
  @endif
  
   
  <div class="card p-2"> <span class='text-muted'> <a href="{{ url('admin/dashboard') }}"> <span class="bi bi-border-all"></span> Dashboard</a> / Category</span></div>
	<br>


<p><a href="{{ url('admin-AddCategory')}}" class="btn btn-success"> Add Category </a></p>

                   <table class="table table-striped table-bordered" style="text-align: center;">
                       <thead>
                       <th>Short List</th>
                        <th>Category Name</th>
                           <th>Category Slug</th>
                           <th>Category Image</th>
                           <!--<th> </th>-->

                       </thead>
                     @php
                     $Orders=App\Models\category::all();
                     @endphp
                       <tbody>
                        
                           @foreach ($Orders as $item)
                       <tr>
                           <td>#{{$item->short_list}}</td>
                           <td style="text-align: left; padding-left:30px;"><a href="{{ url('admin/category-edit/') }}/{{$item->id}}">{{$item->name}}</a></td>
                           <td style="text-align: left; padding-left:30px;">{{$item->slug}}</td>
                           <td><img src="Uploads/Category/{{$item->image}}" width="30px"></td>
                           <!--<td><a href="{{ url('admin/deletecategory') }}/{{$item->id}}">Delete</a></td>-->
                       </tr>
                           @endforeach

                       </tbody>

                   </table>

</main>

@endif
@include('dashboards.admin.admin.header-footer.footer')