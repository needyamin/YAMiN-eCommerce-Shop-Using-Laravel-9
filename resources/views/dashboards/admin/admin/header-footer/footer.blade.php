</div></div></div>

<p style="text-align:right; padding-right:10px;"></p>
<!--<div class="container-fluid mt-3"><p style="text-align:right; padding-right:10px;">
copyright © 2023 Bishuddhotastore | Developed by <a href="https://needyamin.github.io/" target="_blank">Md. Yamin Hossain</a> </p></div>-->

<script>
$(document).ready(()=>{
  
  $('#open-sidebar').click(()=>{
     
      // add class active on #sidebar
      $('#sidebar').addClass('active');
      
      // show sidebar overlay
      $('#sidebar-overlay').removeClass('d-none');
    
   });
  
  
   $('#sidebar-overlay').click(function(){
     
      // add class active on #sidebar
      $('#sidebar').removeClass('active');
      
      // show sidebar overlay
      $(this).addClass('d-none');
    
   });
  
});
</script>

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

