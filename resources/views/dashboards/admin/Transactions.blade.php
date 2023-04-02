@section('title') All Transactions @endsection
@section('keywords') Home,About,Contact,Car @endsection
@section('description') Write some descripton about the webpage @endsection
@include('dashboards.admin.admin.header-footer.header')
@include('dashboards.admin.admin.sidebar')
<!-- main content -->
<main class="container-fluid">
	

<div class="card p-2"> <span class='text-muted'> <a href="{{ url('admin/dashboard') }}"> <span class="bi bi-border-all"></span> Dashboard</a> / Transactions </div>
	<br>


@if (session('status'))
  <div class="alert alert-danger" role="alert">
      {{ session('status') }}
  </div>
  @endif
  


 <!-- Payments Section Starts Here-->
 <section id="mytransactionsindesktopmode">
    @include('components.admin.mytransactionsindesktopmode')
</section>
 <section id="mytransactionsinmobilemode">
    @include('components.admin.mytransactionsinmobilemode')
  </section>

<!-- Payments Section Ends Here-->



</main>
@include('dashboards.admin.admin.header-footer.footer')