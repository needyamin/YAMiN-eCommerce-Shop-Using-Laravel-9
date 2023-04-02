@section('title') Category @endsection
@section('keywords') Home,About,Contact,Car @endsection
@section('description') Write some descripton about the webpage @endsection
@include('dashboards.admin.admin.header-footer.header')
@include('dashboards.admin.admin.sidebar')
<!-- main content -->
<main class="container">



  @if (session('status'))
  <div class="alert alert-danger" role="alert">
      {{ session('status') }}
  </div>
  @endif
  

  <div class="card p-2"> <span class='text-muted'> <a href="{{ url('admin/dashboard') }}"> <span class="bi bi-border-all"></span> Dashboard</a> / <a href="{{ url('admin-AddSubCategory') }}">SubCategory</a> / Add SubCategory</span></div>
	<br>

 

<div class="container py-2">
   
    <!--Grid column-->
    <div class="col-md-12 mb-4">

        <!--Card-->
        <div class="card">

        <!--Card content-->
        <div class="card-body">
        <form action="{{ url('admin/updateSubCategory') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
                <input type="text" class="form-control" name="name" id="textString" onClick="string_to_slug()" placeholder="SubCategory Name">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="textSlug" name="slug" placeholder="select slug">
                 </div>


                 <div class="form-group">
                    <input type="text" class="form-control" name="keywords" placeholder="keywords">
                 </div>

                 <div class="form-group">
                    <textarea class="form-control" name="description" placeholder="description"></textarea>
                 </div>


<script>
document.getElementById("textString").addEventListener("input", function () {
  let theSlug = string_to_slug(this.value);
  document.getElementById("textSlug").value = theSlug;
});

function string_to_slug(str) {
  str = str.replace(/^\s+|\s+$/g, ""); // trim
  str = str.toLowerCase();
  // remove accents, swap ñ for n, etc
  var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
  var to = "aaaaeeeeiiiioooouuuunc------";
  for (var i = 0, l = from.length; i < l; i++) {
    str = str.replace(new RegExp(from.charAt(i), "g"), to.charAt(i));
  }
  str = str
    .replace(/[^a-z0-9 -]/g, "") // remove invalid chars
    .replace(/\s+/g, "-") // collapse whitespace and replace by -
    .replace(/-+/g, "-"); // collapse dashes
  return str;
}
</script>




 <div class="form-group">
  <label>Category ID</label>
    <select name="category_id" min="0" class="form-control"> 
       <option>SELECT ONE</option>
       @php
       $Orders=App\Models\category::all();
       @endphp
       @foreach ($Orders as $item)
       <option value="{{$item->id}}">{{$item->name}}</option>
       @endforeach
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


</main>
@include('dashboards.admin.admin.header-footer.footer')