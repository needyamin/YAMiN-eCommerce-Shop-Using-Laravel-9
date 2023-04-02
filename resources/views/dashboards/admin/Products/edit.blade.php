@section('title') Add Products @endsection
@section('keywords') Home,About,Contact,Car @endsection
@section('description') Write some descripton about the webpage @endsection
@include('dashboards.admin.admin.header-footer.header')
@include('dashboards.admin.admin.header-footer.datatablecore')
@include('dashboards.admin.admin.sidebar')
<!-- main content -->
<main class="container-fluid">


<!-- start from here -->
<link href="{{asset('css/richtext.min.css')}}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.10.1/css/mdb.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- all scripts -->
<!-- end from here -->

@if (session('status'))<div class="alert alert-success" role="alert">{{ session('status') }}</div>@endif
  
<div class="container py-5">
    <p align="left">
        <i class="fas fa-edit"></i> Edit the Product
          </p>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
              <form method="POST" action="{{url('admin/product-update/'.$Products->id)}}" enctype="multipart/form-data">
                  @csrf
                  
                  {{method_field('PUT')}}
               <ul class="nav nav-tabs" id="myTab" role="tablist">
                   <li class="nav-item">
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                      aria-selected="true">Home</a>
                   </li>
                   
                  <li class="nav-item">
                      <a class="nav-link" id="Images-tab" data-toggle="tab" href="#Images" role="tab" aria-controls="Images"
                        aria-selected="false">Images</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" id="SEO-tab" data-toggle="tab" href="#SEO" role="tab" aria-controls="SEO"
                      aria-selected="false">SEO</a>
                  </li>

                  <li class="nav-item">
                      <a class="nav-link" id="Additional_Information-tab" data-toggle="tab" href="#Additional_Information" role="tab" aria-controls="Additional_Information"
                        aria-selected="false">Additional Information</a>
                    </li>
                    
                  <li class="nav-item">
                      <a class="nav-link" id="pstatus-tab" data-toggle="tab" href="#pstatus" role="tab" aria-controls="pstatus"
                        aria-selected="false">Product Status</a>
                   </li>

                </ul>

  <div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

         <div class="row" style="padding: 30px;">
          
             <div class="col-md-6">
                 <div class="form-group">
                   <label>Product Title</label>
            <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{$Products->name}}">
                              </div>
                         </div>
          

             <div class="col-md-6">
                <div class="form-group">
                    <label> Custom URL(Slug)</label>
              <input type="text" class="form-control" name="url" placeholder="Custom URL" value="{{$Products->url}}">
                          </div>
                      </div>

      <div class="col-md-12">
          <div class="form-group">
              <label>Small Description</label>
             <textarea rows="4" class="form-control"  name="small_description" placeholder="Small Description About Product">{{$Products->description}}</textarea>
        </div>
      </div>

          <div class="col-md-6">
                <div class="form-group">
                     <label>SKU</label>
                    <input type="text" name="sku" value="{{$Products->sku}}" maxlength="15" class="form-control">
                    <input type="hidden" name="priority" min="0" class="form-control" value="0">
                 </div>
          </div>

         <div class="col-md-6">
            <div class="form-group">
                 <label> Price</label>
                 <input type="text" name="price" min="0" class="form-control" value="{{$Products->price}}">
             </div>
         </div>


     <div class="col-md-6"   >
          <div class="form-group">
           <label>Discount ( in terms of %)</label>
           <input type="number" name="Discount" min="0" class="form-control" value="{{$Products->discount}}">
      </div>
  </div>
  
     <div class="col-md-6">
      <div class="form-group">
          <label>Rating</label>
         <select class="form-control" name="rating">
            <option value="{{$Products->rating}}">{{$Products->rating}}</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
         </select> 
            </div>
        </div>


    <div class="col-md-6">
        <div class="form-group">
        <label>Category ID</label>
      <select name="category_id" class="form-control" id="category"> 
          <option value="{{$Products->category->id}}">{{$Products->category->name}}</option>
                @php
                $Orders=App\Models\category::all();
                @endphp
                @foreach ($Orders as $item)
           <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
       </select>
       </div>
    </div>



@php
$subcategory=App\Models\subcategory::all();
@endphp      
<div class="col-md-6">
<div class="form-group">
<label>SubCategory ID</label>
<select name="subcategory_id" class="form-control" id="subcategory"> 

@if(!$Products->subcategory_id)
<option value='0'>No Subcategory</option>                       
@else
<option value="{{$Products->subcategory->id}}">{{$Products->subcategory->name}}</option>
<option value='0'>No Subcategory</option>
@endif

</select>
</div>
</div>



<!-- subcategory auto select zone -->
@php
$subcategory1=App\Models\subcategory::where('category_id','=','9')->get();
$subcategory2=App\Models\subcategory::where('category_id','=','3')->get();
$subcategory3=App\Models\subcategory::where('category_id','=','19')->get();


@endphp
<script>
  document.getElementById("category").onchange=
  function myFunc() {
var x = document.getElementById("category").value;
var newSelect = document.getElementById("subcategory");

// if selected 14 value
  if (x == "9")
   newSelect.innerHTML="@foreach ($subcategory1 as $item)<option value='{{$item->id}}'>{{$item->name}}</option>@endforeach";

   else if (x == "3")
   newSelect.innerHTML="<option value=''>SELECT ONE</option>@foreach ($subcategory2 as $item)<option value='{{$item->id}}'>{{$item->name}}</option>@endforeach";

   else if (x == "19")
   newSelect.innerHTML="<option value=''>SELECT ONE</option>@foreach ($subcategory3 as $item)<option value='{{$item->id}}'>{{$item->name}}</option>@endforeach";


  //else if(x == "14")
  // newSelect.innerHTML="<option>Orange</option>"; 
 else {
  newSelect.innerHTML="<option value='0'>No Subcategory</option>";
 }
}
 </script>

<!-- subcategory auto select zone -->

         <div class="col-md-6"   >
          <div class="form-group">
              <label>Quantity</label>
                 <input type="number" name="quantity" value="{{$Products->quantity}}" min="0" class="form-control">
            </div>
         </div>


         <div class="col-md-12">
                    <div class="form-group">
                   <button type="submit" class="btn btn-primary">Update</button>
                   </div>
              </div>
             </div>
         </div>
                
                 <div class="tab-pane fade" id="Images" role="tabpanel" aria-labelledby="Images-tab">
                     <div class="row px-5 py-3">
                         
    <div class="col-md-6"   >
      <div class="form-group">
        <label>Cover Image</label>
         <input type="file" name="image1" class="form-control">
           <img src="{{asset('Uploads/Products/'.$Products->image1)}}" width="50px;"  alt="{{$Products->image1}}" onerror="this.src='{{asset('Img/select.png')}}';this.onerror='';"/>
                <br>
     <a href="{{ url('delete_update_images/del1/'.$Products->id)}}"><i class="bi bi-trash"></i></a>
             </div>
         </div>
                          

<div class="col-md-6"   >
  <div class="form-group">
            <label>Product Image I</label>
            <input type="file" name="image2" class="form-control">

     <img src="{{asset('Uploads/Products/'.$Products->image2)}}" width="50px;"  alt="{{$Products->image2}}" onerror="this.src='{{asset('Img/select.png')}}';this.onerror='';"/>
     <br>
     @if ($Products->image2)
     <a href="{{ url('delete_update_images/del2/'.$Products->id )}}"><i class="bi bi-trash"></i></a>
    @endif
              </div>
             </div>

                          <div class="col-md-6"   >
                              <div class="form-group">
                                  <label>Product Image II</label>
                                  <input type="file" name="image3" class="form-control">
               <img src="{{asset('Uploads/Products/'.$Products->image3)}}" width="50px;"  alt="{{$Products->image3}}" onerror="this.src='{{asset('Img/select.png')}}';this.onerror='';" />

               <br>
               @if ($Products->image3)
               <a href="{{ url('delete_update_images/del3/'.$Products->id )}}"><i class="bi bi-trash"></i></a>
               @endif
     
                              </div>
                          </div>
                         
                          <div class="col-md-6"   >
                              <div class="form-group">
                                  <label>Product Image III</label>
                                  <input type="file" name="image4" class="form-control">    
                <img src="{{asset('Uploads/Products/'.$Products->image4)}}" width="50px;" alt="{{$Products->image4}}" onerror="this.src='{{asset('Img/select.png')}}';this.onerror='';"/>

                <br>
                @if ($Products->image4)
                <a href="{{ url('delete_update_images/del4/'.$Products->id )}}"><i class="bi bi-trash"></i></a>
                @endif
                              </div>
                          </div>


                          <div class="col-md-6"   >
                              <div class="form-group">
                                  <label>Product Image IV</label>
                                  <input type="file" name="image5" class="form-control">
                 <img src="{{asset('Uploads/Products/'.$Products->image5)}}" width="50px;" alt="{{$Products->image5}}" onerror="this.src='{{asset('Img/select.png')}}';this.onerror='';"/>

                 <br>
                 @if ($Products->image5)
                 <a href="{{ url('delete_update_images/del5/'.$Products->id )}}"><i class="bi bi-trash"></i></a>
                 @endif
                              </div>
                          </div>


                          <div class="col-md-6"   >
                              <div class="form-group">
                                  <label>Product Image V</label>
                                  <input type="file" name="image6" class="form-control">     
                  <img src="{{asset('Uploads/Products/'.$Products->image6)}}" width="50px;"  alt="{{$Products->image6}}" onerror="this.src='{{asset('Img/select.png')}}';this.onerror='';"/>

            <br>
            @if ($Products->image6)
            <a href="{{ url('delete_update_images/del6/'.$Products->id )}}"><i class="bi bi-trash"></i></a>
            @endif
                              </div>
                          </div>


                          <div class="col-md-12">
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                     </div>

                 </div>

                 <div class="tab-pane fade" id="SEO" role="tabpanel" aria-labelledby="SEO-tab">
                      <div class="row" style="padding:30px;">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label>Meta Title</label>
                              <textarea rows="4" class="form-control"  name="meta_title" placeholder="Meta Title">{{$Products->title}}</textarea>
                          </div>
                      </div>
                      <div class="col-md-12">
                          <div class="form-group">

                              <label>Meta Description</label>
                              <textarea rows="4" class="form-control"  name="meta_description" placeholder="Meta Description">{{$Products->meta_description}}</textarea>
                          </div>
                      </div>
                      <div class="col-md-12">
                          <div class="form-group">

                              <label>Meta Keywords</label>
                              <textarea rows="4" class="form-control"  name="meta_keyword" placeholder="Meta Keywords">{{$Products->keywords}}  </textarea>
                          </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>

                      </div>
                  </div>
                   <div class="tab-pane fade" id="pstatus" role="tabpanel" aria-labelledby="pstatus-tab">

                      <div class="row" style="padding:30px;">

                         
                               <!--<div class="col-md-6">
                              <div class="form-group">
                                  <label> Delivery Charges</label>
                                  <input type="hidden" class="form-control" name="delivery_charges"  required min="1" placeholder="Delivery Charges " value="{{$Products->delivery_charges}}">
                              </div>
                          </div>-->
                            
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label>Shop/Hide</label>
                                      @if($Products->status==1)
                                         <input type="checkbox"  name="status"  checked>
                                      @else
                                         <input type="checkbox"  name="status" >
                                      @endif
                                     
                                  </div>
                                  <p>
                                      Note: If you check mark then, the product will be displayed to the public
                                  </p>
                              </div>
                            
                              <div class="col-md-12">
                                <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                      </div>
                  </div>
                    <div class="tab-pane fade" id="Additional_Information" role="tabpanel" aria-labelledby="Additional_Information-tab">
                        <div class="row" style="padding:30px;">
                            <p>The following content will be displated in the product page</p>
                             <div class="page-wrapper box-content">

                                <textarea class="content" name="additional_info">{{$Products->additional_info}}</textarea>
                    
                            </div>
                            <div class="col-md-12">
                             <button type="submit" class="btn btn-primary">Update</button>
                             </div>
                    
                            <script>
                            $(document).ready(function() {
                                $('.content').richText();
                            });
                            </script>
                        </div>
                    </div>
                     


                </div>

                </form>

              </div>
        </div>
    </div>
</div>
<hr>




</main>
<script src="{{asset('js/jquery.richtext.js')}}"> </script> 
<script src="{{asset('js/jquery.richtext.min.js')}}"> </script> 
@include('dashboards.admin.admin.header-footer.footer')
