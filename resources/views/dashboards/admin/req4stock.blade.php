@section('title') Request For Stock @endsection
@section('description') Request For Stock on Admin Panel @endsection
@include('dashboards.admin.admin.header-footer.header')
@include('dashboards.admin.admin.header-footer.datatablecore')
@include('dashboards.admin.admin.sidebar')
<!-- main content -->
<main class="container-fluid">

<div class="card p-2 mt-4"> <span class='text-muted'> <a href="{{ url('admin/dashboard') }}"> <span class="bi bi-border-all"></span> Dashboard</a> / Request For Stock </span></div>
<br>
    <div class="container">
        <hr>
            @if (session('status'))
              <div class="alert alert-danger" role="alert">{{ session('status') }}</div>
            @endif
      </div>


<div class="container">
  <table id="indexproduct" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th style="text-align: center;"> SL. </th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Product Code</th>
                        <th>Quantity?</th>
                        <th>IP</th>
                        <th>Date/Time</th>
                        <th></th>
                    </tr>
                </thead>
             <tbody>


                    @php $i=1; @endphp
                    @foreach ($reqforstock as $costing)

                    @php 
                    $Products=App\Models\Products::where('id','=',$costing->product_id)->first();
                    $me = $Products->url;
                    @endphp

                        <tr>
                            <td style="text-align: center;"> {{ $i++ }} </td>
                            <td>{{ $costing->name }}</td>
                            <td>{{ $costing->email }}</td>
                            <td>{{ $costing->mobile_no }}</td>
                            <td><a href="{{ url('shop').'/'.$me }}" target="_blank">A-{{ $costing->product_id }}</a></td>
                            <td>{{ $costing->message }}</td>
                            <td>{{ $costing->ip }}</td>
                            <td width="150px;">{{Carbon\Carbon::parse($costing->created_at)->format('d M Y / g:i A')}}</td>
                            <td><a href="{{ url('admin/deletereqforstock/') }}/{{ $costing->id }}">Delete</a></td>
                        </tr>
                        @endforeach      
                    </tbody>
    
                    </table>

<script> $(document).ready(function() {$('#indexproduct').DataTable( );} );</script>
</div>


</main>
@include('dashboards.admin.admin.header-footer.footer')
