@section('title') logActivity @endsection
@section('keywords') Home,About,Contact,Car @endsection
@section('description') Write some descripton about the webpage @endsection
@include('dashboards.admin.admin.header-footer.header')
@include('dashboards.admin.admin.header-footer.datatablecore')
@include('dashboards.admin.admin.sidebar')
<!-- main content -->
<main class="container-fluid">
	

<main class="container">
@if (session('status'))
  <div class="alert alert-danger" role="alert">
      {{ session('status') }}
  </div>
  @endif
  
	<div class="card p-2"> <span class='text-muted'> <a href="{{ url('admin/dashboard') }}"> <span class="bi bi-border-all"></span> Dashboard</a> / Log Activity Lists</span></div>
	<br>

<form method="POST" action="{{ url('admin/arraydelete/logActivityX') }}">
@csrf
{{ method_field('DELETE') }}


	<table id="indexproduct" class="table-responsive" style="font-size: medium;" cellspacing="0" width="100%">
	<thead>
     <tr>
		    <th></th>
	        <th>SL.</th>
			<th>Action time</th>
			<th>Date/Time</th>
			<th>Subject</th>
			<th>User Id</th>
			<th>Method</th>
			<th>Ip</th>
			<th>User Agent</th>
		</tr>
		</thead>
		<tbody>

		@php 
		$logfound=App\Models\LogActivity::latest()->get();
		$i = 1;
		@endphp

        @if (!$logfound)
		No Data
		@else

		@foreach ($logfound as $log)
			<tr>
			    <td> <input type="checkbox" name="ids[]" value="{{ $log->id }}"> </td>
				<td>{{ $i++ }} </td>
				<td>{{ $log->updated_at->diffForHumans() }}</td>
				<td>{{Carbon\Carbon::parse($log->created_at)->format('d M Y / g:i A')}}</td>
				<td>{{ $log->subject }} <span class="text-success">{{ $log->url }}</span></td>
				<td>0{{ $log->user_id }}</td>
				<td><label class="label label-info">{{ $log->method }}</label></td>
				<td class="text-warning">{{ $log->ip }}</td>
				<td class="text-danger">{{ substr($log->agent,0,10) }}...</td>
			</tr>

			@endforeach
			@endif
			</tbody>


	</table>


@if (\Auth::user()->email == 'needyamin@gmail.com')
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
@endif
</form>




<script>
$(document).ready(function() {
$('#indexproduct').DataTable({
  });
} );
</script>

	</div> </div>

</main>
@include('dashboards.admin.admin.header-footer.footer')