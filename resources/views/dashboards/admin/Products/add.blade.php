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

@if (session('status'))
<div class="alert alert-success" role="alert">
   {{ session('status') }}
   <a href="{{ url('shop').'/'.session('product_url') }}" target="_blank"> {{ session('product_name') }}</a>
    </div>
@endif
  

<div class="container-fluid">
     <p align="left">
        <i class="fas fa-plus"></i> Add New Product
      </p>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
              <form method="POST" action="{{url('admin-store-product')}}" enctype="multipart/form-data">
                  @csrf
              
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
                   <label> Product Title</label>
                     <input type="text" class="form-control" id="textString" name="name" onClick="string_to_slug()" placeholder="Enter Name" required>
                    </div>
                </div>
                          

               <div class="col-md-6">
                 <div class="form-group">
                  <label> Custom URL(Slug)</label>
                     <input type="text" class="form-control" id="textSlug" name="url" placeholder="Custom URL">
                          @error('url')<span class="text-danger">{{$message}}</span>@enderror
                      </div>
                  </div>


<script>
  document.getElementById("textString").addEventListener("input", function () {
  let theSlug = string_to_slug(this.value);
  document.getElementById("textSlug").value = theSlug;
});

function string_to_slug(str) {
  str = str.replace(/^\s+|\s+$/g, ""); 
  str = str.toLowerCase();
  var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
  var to = "aaaaeeeeiiiioooouuuunc------";
  for (var i = 0, l = from.length; i < l; i++) {
    str = str.replace(new RegExp(from.charAt(i), "g"), to.charAt(i));
  }
  str = str
    .replace(/[^a-z0-9 -]/g, "") 
    .replace(/\s+/g, "-") 
    .replace(/-+/g, "-"); 
  return str;
}
</script>



          <div class="col-md-12">
               <div class="form-group">
                     <label>Small Description</label>
                     <textarea rows="4" class="form-control"  name="small_description"   placeholder="Small Description About Product" required></textarea>
                </div>
             </div>


        <div class="col-md-6"   >
            <div class="form-group">
                <label>SKU</label>
                <input type="hidden" name="priority" value="0"  class="form-control">
                <input type="text" name="sku" placeholder="SKU" maxlength="15" class="form-control">
            </div>
        </div>


      <div class="col-md-6"   >
          <div class="form-group">
              <label> Price</label>
              <input type="number" name="price" value="0" min="0" class="form-control" required>
          </div>
       </div>
                          
       
       <div class="col-md-6">
         <div class="form-group">
          <label>Product Discount ( in terms of %)</label>
          <input type="number" name="Discount" min="0" class="form-control">
         </div>
      </div>
  
      <div class="col-md-6">
        <div class="form-group">
             <label>Product Rating</label>
             <select class="form-control" name="rating" required>
                 
                  <option value="">Select</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5" selected>5</option>
              </select> 
            </div>

@if (session('errorProductaddRating'))<div class="alert alert-danger" role="alert">{{ session('errorProductaddRating') }}</div>@endif

         </div>


    <div class="col-md-6">
        <div class="form-group">
          <label>Category ID</label>
          <select name="category_id" class="form-control" id="category" required> 
      <option value="" disabled selected>SELECT ONE</option>
                @php
                $Orders=App\Models\category::all();
                @endphp
                @foreach ($Orders as $item)
     <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
         </select>
      </div>

      @if (session('errorProductaddcategory'))<div class="alert alert-danger" role="alert">{{ session('errorProductaddcategory') }}</div>@endif

    </div>



  <div class="col-md-6">
    <div class="form-group">
      <label>SubCategory ID</label>
    <select name="subcategory_id" class="form-control" id="subcategory"></select>
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
   newSelect.innerHTML="<option value=''>SELECT ONE</option>@foreach ($subcategory1 as $item)<option value='{{$item->id}}'>{{$item->name}}</option>@endforeach";

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

                    <div class="col-md-6">
                              <div class="form-group">
                                  <label>quantity</label>
                                  <input type="number" name="quantity" min="0" value="200" class="form-control" required>
                              </div>
                       </div>



    <div class="col-md-12">
       <div class="form-group">
         <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>

            
            </div>
        </div>
                

        <div class="tab-pane fade" id="Images" role="tabpanel" aria-labelledby="Images-tab">
            
     <div class="row px-5 py-3">
       <div class="col-md-6">
         <div class="form-group">
          <label>Product Cover Image</label>
        <input type="file" onchange="document.getElementById('priview').src = window.URL.createObjectURL(this.files[0])" name="image1" class="form-control">
        <img id="priview" width="100" height="100"/>
        </div>
     </div>

                    
        <div class="col-md-6">
            <div class="form-group">
               <label>Product Image I</label>
                <input type="file" onchange="document.getElementById('priview2').src = window.URL.createObjectURL(this.files['0'])" name="image2" class="form-control">
                <img id="priview2" width="100" height="100"/>
            </div>
        </div>
                  
        
            <div class="col-md-6">
                <div class="form-group">
                <label>Product Image II</label>
                <input type="file" onchange="document.getElementById('priview3').src = window.URL.createObjectURL(this.files['0'])" name="image3" class="form-control">
                <img id="priview3" width="100" height="100" />
              </div>
            </div>


        <div class="col-md-6">
            <div class="form-group">
              <label>Product Image III</label>
                <input type="file" onchange="document.getElementById('priview4').src = window.URL.createObjectURL(this.files['0'])" name="image4" class="form-control">
                <img id="priview4" width="100" height="100" onerror="this.src='{{asset('Img/select.png')}}';this.onerror='';"/>
            </div>
          </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Product Image IV</label>
            <input type="file" onchange="document.getElementById('priview5').src = window.URL.createObjectURL(this.files['0'])" name="image5" class="form-control">
            <img id="priview5" width="100" height="100" onerror="this.src='{{asset('Img/select.png')}}';this.onerror='';"/>
         </div>
      </div>

   <div class="col-md-6">
        <div class="form-group">
            <label>Product Image V</label>
            <input type="file" onchange="document.getElementById('priview6').src = window.URL.createObjectURL(this.files['0'])" name="image6" class="form-control">
            <img id="priview6" width="100" height="100" onerror="this.src='{{asset('Img/select.png')}}';this.onerror='';"/>
       </div>
     </div>

            <div class="col-md-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        
            
      </div>
  </div>

        <div class="tab-pane fade" id="SEO" role="tabpanel" aria-labelledby="SEO-tab">
            <div class="row" style="padding:30px;">
               <div class="col-md-12">
                 <div class="form-group">
                   <label>Meta Title</label>
                    <textarea rows="4" class="form-control"  name="meta_title" placeholder="Meta Title"></textarea>
               </div>
           </div>
                      
     <div class="col-md-12">
         <div class="form-group">
         <label>Meta Description</label>
         <textarea rows="4" class="form-control"  name="meta_description" placeholder="Meta Description"></textarea>
          </div>
      </div>

     <div class="col-md-12">
        <div class="form-group">
          <label>Meta Keywords</label>
           <textarea rows="4" class="form-control"  name="meta_keyword" placeholder="Meta Keywords"></textarea>
        </div>
      </div>

    <div class="col-md-12">
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>


             </div>
          </div>


              <div class="tab-pane fade" id="pstatus" role="tabpanel" aria-labelledby="pstatus-tab">
                <div class="row" style="padding:30px;">


        <div class="col-md-6">
            <div class="form-group">
             <input type="hidden" class="form-control" name="delivery_charges" value="0" placeholder="Delivery Charges ">
            </div>
         </div>
                             
                          
     <div class="col-md-12">
        <div class="form-group">
            <label>Published</label>
                <input type="checkbox" name="status">
              </div>
        <p>Note: If you check mark then, the product will be displayed to the public</p>
     </div>
                              
         <div class="col-md-12">
             <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
             </div>
         </div>

       
        </div>
     </div>

    
     <div class="tab-pane fade" id="Additional_Information" role="tabpanel" aria-labelledby="Additional_Information-tab">
       <div class="row" style="padding:30px;">
         <p>The following content will be displated in the product page</p>









         <script type="text/javascript">
    $(document).on('change','#category',function(){
    var categoryID = $(this).val();    
    if(categoryID){
        $.ajax({
           type:"GET",
           url:"{{url('create')}}?category_id="+categoryID,
           dataType:'json',
           success:function(res){               
            if(res){
                console.log(res);
                // forloop through subcategory and append 
            }else{
               $("#subcategory").empty();
            }
           }
        });
    }else{
        $("#subcategory").empty();

    }      
   });
</script>







        <div class="page-wrapper box-content">
          <textarea class="content" name="additional_info"></textarea>
        </div>
                            
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
                    
    <script>
        $(document).ready(function() {
        $('.content').richText();});
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
