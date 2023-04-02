@section('title') Add Shipping Cost @endsection
@section('keywords') Home,About,Contact,Car @endsection
@section('description') Write some descripton about the webpage @endsection
@include('dashboards.admin.admin.header-footer.header')
@include('dashboards.admin.admin.sidebar')

@if (\Auth::user()->role == 'admin')
<!-- main content -->
<main class="container-fluid">
<div class="container">

<div class="card p-2 mt-4"> <span class='text-muted'> <a href="{{ url('admin/dashboard') }}"> <span class="bi bi-border-all"></span> Dashboard</a> / <a href="{{ url('admin/delivery_charges') }}"> Delivery Charges</a> / Edit Delivery Charges</span></div>
<br>


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  

  @if (session('status'))
  <div class="alert alert-success" role="alert">
      {{ session('status') }}
  </div>
  @endif

   
    <!--Grid column-->
    <div class="col-md-12 mb-4">

        <!--Card-->
        <div class="card">

   
        <!--Card content-->
        <div class="card-body">
        <form action="{{ url('admin/delivery_charges/edit_submit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
        <input type="hidden" class="form-control" name="id" value="{{ $delivery_charges_edit->id }}">


                <input type="text" class="form-control" name="city" placeholder="city" value="{{ $delivery_charges_edit->city }}">
                </div>

                <div class="form-group">
                <input type="number" class="form-control" name="cost" placeholder="Shipping Cost" value="{{ $delivery_charges_edit->cost }}">
                </div>

                <div class="form-group">
                <input type="number" class="form-control" name="postcode" placeholder="Post Code" value="{{ $delivery_charges_edit->postcode }}">
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