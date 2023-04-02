@section('title') Search Activity @endsection
@section('keywords') Home,About,Contact,Car @endsection
@section('description') Write some descripton about the webpage @endsection
@include('dashboards.admin.admin.header-footer.header')
@include('dashboards.admin.admin.header-footer.datatablecore')
@include('dashboards.admin.admin.sidebar')
<!-- main content -->
<main class="container-fluid">

<div class="card p-2 mt-4"> <span class='text-muted'> <a href="{{ url('admin/dashboard') }}"> <span class="bi bi-border-all"></span> Dashboard</a> / SearchActivity</span></div>
<br>

<div class="container">

<hr>
@if (session('status'))<div class="alert alert-danger" role="alert">{{ session('status') }}</div> @endif
</div>



<form method="POST" action="{{ url('admin/arraydelete/searches') }}">
{{ csrf_field() }}
{{ method_field('DELETE') }}

<table id="indexproduct" style="text-align:center;" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        
						<thead>  
                        <tr style='text-align:left;'>
                        <th> </th>
                        <th>SL.</th>
                            <th>search_q</th>
                            <th>user_id</th>
                            <th>created_at</th>
                            <th>Date/Time</th>
                            <th>ip</th>
                            <th> </th>
                        </tr>
                        </thead>
                    <tbody>

                        @php $i=1; @endphp  
                        @foreach ($fetch as $data)
                         <tr style='text-align:left;'>
                                <td> <input type="checkbox" name="ids[]" value="{{ $data->id }}"> </td>
                                <td>{{ $i++ }}</td>
                                <td style="padding-left:15px;">{{ $data->search_q }}</td>
                                <td>{{ $data->user_id }}</td>
                                <td>{{ $data->created_at->diffForHumans(); }}</td>
                                <td>{{Carbon\Carbon::parse($data->created_at)->format('d M Y / g:i A')}}</td>
                                <td><a href="https://api.db-ip.com/v2/free/{{ $data->ip }}" target="_blank"><span style="color:#212529;">{{ $data->ip }}</span></a></td>
                                <td> <a href="{{ url('admin/search_feed/') }}/{{ $data->id }}">Delete</a></td>
                         </tr>
                        @endforeach      
                        </tbody>
                    </table>
                    

<input type="button" class="btn btn-secondary" onclick='selects()' value="Select All"/>  
<input type="button" class="btn btn-secondary" onclick='deSelect()' value="Deselect All"/>                     

<script>
function selects(){  
 var ele=document.getElementsByName('ids[]');  
 for(var i=0; i<ele.length; i++){  
 if(ele[i].type=='checkbox')  
 ele[i].checked=true;  
} }

function deSelect(){  
 var ele=document.getElementsByName('ids[]');  
  for(var i=0; i<ele.length; i++){  
  if(ele[i].type=='checkbox')  
  ele[i].checked=false;  
 }  
}
             

</script>


<input type="submit" class="btn btn-danger" name="submit" value="Mass Delete">   
</form>



<script>
$(document).ready(function() {
$('#indexproduct').DataTable( {
dom: 'Bfrtip',
buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
  });
} 
);
</script>




</div>
</main>

@include('dashboards.admin.admin.header-footer.footer')
