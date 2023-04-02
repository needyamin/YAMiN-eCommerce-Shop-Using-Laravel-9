@section('title') Delivery Charges @endsection
@section('keywords') Home,About,Contact,Car @endsection
@section('description') Write some descripton about the webpage @endsection
@include('dashboards.admin.admin.header-footer.header')
@include('dashboards.admin.admin.header-footer.datatablecore')
@include('dashboards.admin.admin.sidebar')


@if (\Auth::user()->role == 'admin')
<!-- main content -->
<main class="container-fluid">
<div class="card p-2 mt-4"> <span class='text-muted'> <a href="{{ url('admin/dashboard') }}"> <span class="bi bi-border-all"></span> Dashboard</a> / BLOCK IP</span></div><br>
<div class="container"><hr>
@if (session('status'))<div class="alert alert-danger" role="alert">{{ session('status') }}</div>@endif
</div>


<div class="container">
<p> <a href="#" class="btn btn-success" data-toggle="modal" data-target="#exampleModal"> Add SPAM IP </a></p>



 <table id="indexproduct" class="table table-striped table-bordered" cellspacing="0" width="100%" style="text-align:center;">
            <thead>
                <tr>
                    <th style="text-align:center;">SL.</th>
                    <th style="text-align:center;">Blacklisted IP</th>
                    <th style="text-align:center;">Note</th>
                    <th></th>
                  </tr>
              </thead>

                <tbody>
                    <?php $i=1; ?>
                        @foreach ($ips as $data)
                           <tr>
                                <td>{{ $i++ }}</td>
                                <td style="text-align: center;">{{ $data->ip }} </td>
                                <td style="text-align: center;">{{ $data->note }}</td>
                                <th style="text-align: center;"><a href="{{ url('admin/block_ip/delete')}}/{{ $data->id }}">Delete</a></th>
                           </tr>
                        @endforeach      
                        </tbody>
                    </table>

<script>$(document).ready(function() {$('#indexproduct').DataTable( );} );</script>
</div>
</main>







<style>
.form-group{
  margin-bottom: 0;
}

input,
input::placeholder {
    font: 17px/3 sans-serif;
}
    
    .form-group.floating>label {
    bottom: 34px;
    left: 8px;
    position: relative;
    background-color: white;
    padding: 0px 5px 0px 5px;
    font-size: 1.1em;
    transition: 0.1s;
    pointer-events: none;
    font-weight: 500 !important;
    transform-origin: bottom left;
}

.form-control.floating:focus~label{
    transform: translate(1px,-85%) scale(0.80);
    opacity: .8;
    color: #005ebf;
}

.form-control.floating:valid~label{
    transform-origin: bottom left;
    transform: translate(1px,-85%) scale(0.80);
    opacity: .8;
}
</style>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add SPAM ID</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('admin/block_ip/add') }}" method="POST">
        @csrf
          <div class="form-group floating">
          <input type="text" class="form-control floating" name="ip" id="ip" placeholder="Enter IP" required>
          <label for="ip">IP</label>
          </div>

          <div class="form-group floating">
          <textarea type="text" class="form-control floating" id="Note" name="Note" placeholder="Note" required></textarea>
          <label for="Note"></label>
          </div>


       
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-primary" value="BAN IP">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

@endif
@include('dashboards.admin.admin.header-footer.footer')
