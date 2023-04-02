<!-- Orders Section Starts Here-->
<div id="ordersindesktopmode">
    @include('components.admin.ordersindesktopmode')
</div>

<!--<div id="ordersinmobilemode">
      @include('components.admin.ordersinmobilemode')
</div>-->

 <!-- Orders Section Ends Here-->
 @if (session('Order_Status'))
    @include('components.admin.orderstatus')
    <script>
        $(document).ready(function ()
        {
            $('#show_Order_Status_Modal').modal('show');
        });
    </script>
 @endif

  
