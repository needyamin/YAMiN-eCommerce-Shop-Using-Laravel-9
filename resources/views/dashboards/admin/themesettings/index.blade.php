@section('title') Theme Settings @endsection
@section('keywords') Home,About,Contact,Car @endsection
@section('description') Write some descripton about the webpage @endsection
@include('dashboards.admin.admin.header-footer.header')
@include('dashboards.admin.admin.sidebar')


@if (\Auth::user()->role == 'admin')
<!-- main content -->
<main class="container-fluid">
	
  @if (session('status'))
  <div class="alert alert-success" role="alert">
      {{ session('status') }}
  </div>
  @endif
  


<div class="container">

<div class="card p-2"> <span class='text-muted'> <a href="{{ url('admin/dashboard') }}"> <span class="bi bi-border-all"></span> Dashboard</a> / <a href="{{ url('admin-Category') }}">Theme</a></span></div>
	<br>

   
    <!--Grid column-->
    <div class="col-md-12 mb-4">

        <!--Card-->
        <div class="card">

        <!--Card content-->
        <div class="card-body">
        <form action="{{ url('admin/themesettings/post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
                <div class="form-group">
                <label>Website Name</label>
                    <input type="text" class="form-control" id="textSlug" name="website_name" value="{{ $theme_settings->website_name }}" placeholder="Website Name">
                 </div>

                 <div class="form-group">
                 <label>Website Description</label>
                    <input type="text" class="form-control" name="website_description" value="{{ $theme_settings->website_description }}" placeholder="Website Description">
                 </div>


                 <div class="form-group">
                 <label>Header Add Meta Tags</label>
                    <textarea type="text" class="form-control" name="head_meta_tags" placeholder="Header Meta Tags">{{ $theme_settings->header_meta_code }}</textarea>
                 </div>


                 <div class="form-group">
                 <label>Website logo</label>
                    <input type="file" class="form-control" id="textSlug" name="logo">
                    <img src="{{ url('Uploads/Website_Logo')}}/{{ $theme_settings->logo }}" width="100px">
                 </div>


            @php $settings=App\Models\theme_settings::first(); @endphp
             <div class="form-group">
                <label>Pick Color</label>
                <input type="color" value="{{ $settings->theme_color }}" name="color" class="form-control" style="height: 100px; width:100px;">
                <input type="text" value="{{ $settings->theme_color }}" style="width:100px;">
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
@endif

@include('dashboards.admin.admin.header-footer.footer')