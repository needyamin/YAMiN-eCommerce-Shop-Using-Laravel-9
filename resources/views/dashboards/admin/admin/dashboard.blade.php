@section('title') Admin Dashboard @endsection
@section('keywords') Home,About,Contact,Car @endsection
@section('description') Write some descripton about the webpage @endsection
@include('dashboards.admin.admin.header-footer.header')
@include('dashboards.admin.admin.sidebar')
	


<!-- reload dashboard every 30 sec -->
<script>window.setTimeout( function() {window.location.reload();}, 60000);</script>

<!-- main content -->
<main class="container-fluid">


<div class="card p-2 mt-1"> <span class='text-muted'> 
  <a href="{{ url('admin/dashboard') }}"> <span class="bi bi-border-all"></span> Dashboard</a></span>
</div>




@if (\Auth::user()->role == 'admin')  

@if ($stockOUTProductSCount > 0)
<div class="alert-warning p-2 mt-1">
<i class="bi bi-exclamation-diamond"></i> Found<a href="{{ url('admin/products?stockoutproduct') }}"> <strong>{{ $stockOUTProductSCount }}</strong> StockOut Products</a>
</div>
@endif


@if ($zeRoProductSCount > 0)
<div class="alert-warning p-2 mt-1">
<i class="bi bi-exclamation-diamond"></i> Found <a href="{{ url('admin/products?zeropriceproduct') }}"> <strong>{{ $zeRoProductSCount }}</strong> Zero Price Products</a>
</div>
@endif
@endif


<style> 
.col-lg-3, .col-md-6, .col-xs-3 {
  position: relative;
  min-height: 1px;
  padding-right: 15px;
  padding-left: 15px;
}

.col-xs-3 {
  float: left;
  width: 20%;
}

.col-xs-9 {
  width: 75%;
  float: left;
}

.clearfix:after {
  clear: both;
}

.clearfix:before,
.clearfix:after {
  display: table;
  content: " ";
}

.panel {
  margin-bottom: 10px;
  background-color: #fff;
  border: 1px solid transparent;
  border-radius: 4px;
  -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
}

.panel-footer {
  padding: 10px 15px;
  background-color: #f5f5f5;
  border-top: 1px solid #ddd;
  border-bottom-right-radius: 3px;
  border-bottom-left-radius: 3px;
}

.panel-heading {
  height: 100px;
  background-color: turquoise;
  padding: 10px 15px;
  border-bottom: 1px solid transparent;
  border-top-left-radius: 3px;
  border-top-right-radius: 3px;
}

.panel-green {
  border: 1px solid #398439;
}

.panel-green .panel-heading {
  background-color: #398439;
}

.green {
  color: #398439;
}

.blue {
  color: #337ab7;
}

.red {
  color: #ce7f7f;
}

.panel-primary {
  border: 1px solid #337ab7;
}

.panel-primary .panel-heading {
  background-color: #337ab7;
}

.yellow {
  color: #ffcc00;
}

.panel-yellow {
  border: 1px solid #ffcc00;
}

.panel-yellow .panel-heading {
  background-color: #ffcc00;
}

.panel-red {
  border: 1px solid #ce7f7f;
}

.panel-red .panel-heading {
  background-color: #ce7f7f;
}

.huge {
  font-size: 30px;
}

.panel-heading {
  color: #fff;
}

.pull-left {
  float: left !important;
}

.pull-right {
  float: right !important;
}

.text-right {
  text-align: right;
}

.under-number {
  font-size: 20px;
}

@media (min-width: 992px) {
  .col-md-6 {
    float: left;
    width: 50%;
  }
}

@media (min-width: 1200px) {
  .col-lg-3 {
    float: left;
    width: 20%;
  }
}

#piechart_3d{width: 600px; height: 500px; margin:0 auto;}
#PANELIDDX {}

</style>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<script>
$(function () {$('[data-toggle="todaysale"]').tooltip()})
$(function () {$('[data-toggle="neworder"]').tooltip()})
$(function () {$('[data-toggle="newproduct"]').tooltip()})
$(function () {$('[data-toggle="newrequest"]').tooltip()})
$(function () {$('[data-toggle="newusers"]').tooltip()})
</script>

<!-- /.row -->
<div class="row mt-2">


<div class="col-lg-3 col-md-6">
        <div class="panel panel-red"> 
            <div class="panel-heading">
                <div class="row"> 
                    <div class="col-xs-3">
                        <i class="fa fa-usd fa-3x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
       
                        <div class='huge'>{{ number_format($ordersamountTODAY,2) }} <b>৳</b></div>
                         <div class="under-number">Today Sales <a data-toggle="todaysale" data-placement="top" title="Today All Sales Amount"><i class="fa fa-question-circle" aria-hidden="true"></i></a></div>




                    </div>
                </div>
            </div>
            <a href="#" data-toggle="modal" data-target="#exampleallamount">
                <div class="panel-footer">
                    <span class="pull-left red">View Details</span>
                    <span class="pull-right red"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>



<!-- Model Start-->
<div class="modal fade" id="exampleallamount" tabindex="-1" role="dialog" aria-labelledby="exampleallamountTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleallamountLongTitle">Sales</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <span></span>


      <table class="table table-striped" style="text-align: center;">
  <thead>
    <tr>
    <th>Today</th>
      <th>Current Month</th>
      <th>Total</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    <td>{{ number_format($ordersamountTODAY,2) }} ৳</td>
      <td>{{ number_format($ordersamount,2) }} ৳</td>
      <td>{{ number_format($allamount,2) }} ৳</td>
    </tr>
  </tbody>
</table>




      </div>
      <div class="modal-footer">
      <a href="{{ url('admin-Orders')}}" type="button" class="btn btn-primary">All Orders</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Model END-->


        </div>
    </div>






    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-newspaper-o fa-3x"></i>
                    </div>
                    <div class="col-xs-9 text-right">         
        <div class='huge'>{{ $todayDate }}</div>
       <div class="under-number">Today Orders <a data-toggle="neworder" data-placement="top" title="Today All Orders"><i class="fa fa-question-circle" aria-hidden="true"></i></a></div>
                    </div>
                </div>
            </div>
            <a href="{{ url('admin-Orders')}}">
                <div class="panel-footer">
                    <span class="pull-left blue">View Details</span>
                    <span class="pull-right blue"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>







    @if (\Auth::user()->role == 'admin')  
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-3x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
 
       <div class='huge'>{{ $products_TODAY }}</div>
       <div class="under-number">New Products <a data-toggle="neworder" data-placement="top" title="Today All Uploaded Product Number"><i class="fa fa-question-circle" aria-hidden="true"></i></a></div>
                    </div>
                </div>
            </div>
            <a href="{{ url('admin/products')}}">
                <div class="panel-footer">
                    <span class="pull-left red">View Details</span>
                    <span class="pull-right red"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
@endif


    <!-- ********************************************************************************************************* -->
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-3x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                     <div class='huge'>{{ $req4stock_TODAY }}</div>
                      <div class="under-number">Stock Request <a data-toggle="newrequest" data-placement="top" title="Today All Request For Stock"><i class="fa fa-question-circle" aria-hidden="true"></i></a></div>
                    </div>
                </div>
            </div>
            <a href="{{ url('admin/request4stock') }}">
                <div class="panel-footer">
                    <span class="pull-left green">View Details</span>
                    <span class="pull-right green"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>    
    </div>



<!-- ********************************************************************************************************* -->


@if (\Auth::user()->role == 'admin')  
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-3x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                
                    <div class='huge'>{{ $userToday }}</div>
                        <div class="under-number">Today Users <a data-toggle="newusers" data-placement="top" title="Today New User Join"><i class="fa fa-question-circle" aria-hidden="true"></i></a></div>
                    </div>
                </div>
            </div>
            <a href="{{ url('admin/admin-all-users') }}">
                <div class="panel-footer">
                    <span class="pull-left primary">View Details</span>
                    <span class="pull-right primary"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

<!-- ********************************************************************************************************* -->

    <div class="col-lg-3 col-md-6">
        <div class="panel" style="background-color: #05919f;">
            <div class="panel-heading" style="background-color: #05919f;">
                  <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-3x"></i>
                          </div>
                              <div class="col-xs-9 text-right">         
                                 <div class='huge'>{{ $category }}</div>
                                    <div class="under-number">All Categories</div>
                                      </div>
                                          </div>
                                              </div>

            <a href="{{ url('admin-Category') }}">
               <div class="panel-footer">
                    <span class="pull-left" style="color: #05919f;">View Details</span>
                    <span class="pull-right" style="color: #05919f;"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>

        </div>
    </div>

@endif



@if (\Auth::user()->role == 'admin')  
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                  <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-search fa-3x"></i>
                          </div>
                              <div class="col-xs-9 text-right">         
                                 <div class='huge'>{{ $search_feed }}</div>
                                    <div class="under-number">Monthly Searches</div>
                                      </div>
                                          </div>
                                              </div>

            <a href="{{ url('admin/search_feed') }}">
               <div class="panel-footer">
                    <span class="pull-left green">View Details</span>
                    <span class="pull-right green"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>

        </div>
    </div>
@endif







    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-newspaper-o fa-3x"></i>
                    </div>
                    <div class="col-xs-9 text-right">         
        <div class='huge'>{{ $newsletter }}</div>
       <div class="under-number">Monthly Newsletter</div>
                    </div>
                </div>
            </div>
            <a href="{{ url('admin-news-letter')}}">
                <div class="panel-footer">
                    <span class="pull-left blue">View Details</span>
                    <span class="pull-right blue"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>




</div>
<!-- /.row -->
           
<div class="container"> 
  <div class="row"> 
    <div class="col-lg-6 card d-none d-lg-block" style="margin:0 auto;padding:5px;">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],

          ['Last Month Order', {{ $lastMonthR }}],
          ['This Month Order', {{ $ordersid }}]
        ]);

        var options = {
          title: 'Order Monthly Statistics',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
  <div id="piechart_3d"></div>
  
  </div>
</span>


  <div class="col-lg-6 card" style="margin:0 auto; padding:5px;"> 
 
  <div class="card mt-0" id="PANELIDDX">
  <div class="card-header" style="color:white;background:#337ab7;">
  This Month ({{Carbon\Carbon::now()->format('F')}}) Statistics
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><i class="bi bi-arrow-right-circle"></i>  This Month <strong>{{ $ordersid }} Orders</strong> ( <span class="text-muted">last month <strong>{{ $lastMonthR }} Orders</strong></span> ) </li>

    <li class="list-group-item"><i class="bi bi-arrow-right-circle"></i> Sales <strong>{{ number_format($ordersamount,2) }}  TK</strong> ( <span class="text-muted"> last month <strong>{{ number_format($lastMonthordersamount,2) }} TK</strong></span> )</li>

    <li class="list-group-item"><i class="bi bi-arrow-right-circle"></i> New Join <strong>{{ $user }} Users</strong> ( <span class="text-muted"> last month <strong>{{ $LastMOnthuserT }} Users</strong></span> )</li>

    <li class="list-group-item"><i class="bi bi-arrow-right-circle"></i> Product Added <strong>{{ $products_current_month }} Items</strong> ( <span class="text-muted"> last month <strong>{{ $products_LastMonth }} Items</strong></span> )</li>
    
    <li class="list-group-item"><i class="bi bi-arrow-right-circle"></i>  Request For Stock <strong>{{ $req4stock }} Request</strong> ( <span class="text-muted"> last month <strong>{{ $req4stock_LastMonth }} Request</strong></span> ) </li>

  </ul>
  </div>





  <div class="card mt-1" id="PANELIDDX">
  <div class="card-header" style="color:white;background:#05919f;">
  Total Site Statistics
  </div>
  <ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center">
  <span style="text-align:left;"><i class="bi bi-arrow-right-circle"></i>  Total Sales </span>
    <span class=""><strong>{{ number_format($Tamount,2) }} TK</strong></span>
  </li>

  <li class="list-group-item d-flex justify-content-between align-items-center">
  <span style="text-align:left;"><i class="bi bi-arrow-right-circle"></i>  Total Products </span>
    <span class=""><strong>{{ $TPost }}</strong></span>
  </li>

  <li class="list-group-item d-flex justify-content-between align-items-center">
  <span style="text-align:left;"><i class="bi bi-arrow-right-circle"></i>  Total Users </span>
    <span class=""><strong>{{ $Tuser }}</strong></span>
  </li>
</ul>

</div>



  </div>

    </div> </div>






		
		
        <!--<div class="jumbotron jumbotron-fluid rounded bg-white border-0 shadow-sm border-left px-4">
  <div class="container">
    <h1 class="display-4 mb-2 text-primary">Simple</h1>
    <p class="lead text-muted">Simple Admin Dashboard with Bootstrap.</p>
  </div>
</div>-->
</main>


@include('dashboards.admin.admin.header-footer.footer')
