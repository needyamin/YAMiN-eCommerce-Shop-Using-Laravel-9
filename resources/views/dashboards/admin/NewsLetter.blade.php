@section('title') Category @endsection
@section('keywords') Home,About,Contact,Car @endsection
@section('description') Write some descripton about the webpage @endsection
@include('dashboards.admin.admin.header-footer.header')
@include('dashboards.admin.admin.header-footer.datatablecore')
@include('dashboards.admin.admin.sidebar')
<!-- main content -->
<main class="container-fluid">

@if (session('status'))
  <div class="alert alert-danger" role="alert">
      {{ session('status') }}
  </div>
  @endif
  
        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-bordered" id="newsletter">
                    <thead>
                       <th>SR.</th>
                        <th>Name</th>
                        <th>Email Address</th>
                        <th>Date/Time</th>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp 
                        @foreach ($NewsLetter as $item)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{Carbon\Carbon::parse($item->created_at)->format('d M Y / g:i A')}}</td>
                    </tr>
                        @endforeach

                    </tbody>

                </table>



                <script>
$(document).ready(function() {
    $('#newsletter').DataTable( {
dom: 'Bfrtip',
buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
  });
} 
);
</script>


            </div>
        </div>



        </main>
@include('dashboards.admin.admin.header-footer.footer')