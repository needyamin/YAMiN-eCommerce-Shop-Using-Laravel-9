@section('title') Office Staff Logs @endsection
@section('keywords') Home,About,Contact,Car @endsection
@section('description') Marketing Team Logs @endsection
@include('dashboards.admin.admin.header-footer.header')
@include('dashboards.admin.admin.header-footer.datatablecore')
<!-- main content -->

<h2 style="margin:0 auto;" class="mt-2">Office Staff Price Update Logs</h2>


<main class="container mt-3">

  
	<div class="card p-2"> <span class='text-muted'> <a href="{{ url('/') }}"> <span class="bi bi-border-all"></span> Home</a> / Office Staff Activity Logs</span></div>
	<br>

	@if (session('status'))
  <div class="alert alert-danger" role="alert">
      {{ session('status') }}
  </div>
  @endif



<form method="POST" action="{{ url('admin/arraydelete/MarketingArrayDel') }}">
@csrf
{{ method_field('DELETE') }}

	<table id="indexproduct" style="font-size: medium;" cellspacing="0" width="100%">
	<thead>
     <tr>
	 @if (\Auth::user()->email == 'needyamin@gmail.com') <th></th>@endif
	        <th>SL.</th>
			<th>Product Name</th>
			<th>Update Price</th>
			<th>Old Price</th>
			<th>Phone</th>
			<th>IP</th>
			<th>Date/Time </th>
	</tr>
		</thead>
		
		<tbody>

		@php $i = 1; @endphp
		@foreach ($fetchData as $log)
			<tr>
			@if (\Auth::user()->email == 'needyamin@gmail.com')  <td> <input type="checkbox" name="ids[]" value="{{ $log->id }}"> </td> @endif
				<td>{{ $i++ }} </td>
				<td><a href="{{ url('shop').'/'.$log->slug }}" target="_blank">{{ $log->product_name }}</a></td>
				<td>{{ $log->update_price }}</td>
				<td><span class="text-success">{{ $log->old_price }}</span></td>
				<td style="text-align: center;">0{{ $log->username }}</td>
				<td>{{ $log->ip }}</td>
				<td>{{Carbon\Carbon::parse($log->created_at)->format('d M Y / g:i A')}}</td>

			</tr>
		@endforeach
	
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
</form>
@endif




</div>

<script>
$(document).ready(function() {
$('#indexproduct').DataTable({
dom: 'Bfrtip',
buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
  });
} );
</script>


</main>

@include('dashboards.admin.admin.header-footer.footer')