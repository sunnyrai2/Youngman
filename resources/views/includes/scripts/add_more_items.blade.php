<script type="text/javascript">
    $(document).ready(function(){
      //var postURL = "<?php echo url('addmore'); ?>";
      var i=1;
      $('#add').click(function(){
           i++;
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="item_code[]" placeholder="Item Code" class="form-control item_code" /></td><td><input type="text" name="item_name[]" placeholder="Item Name" class="form-control item_name" /></td><td><input type="text" name="unit_price[]" placeholder="Unit Price" class="form-control unit_price" /></td><td><input type="text" name="quantity[]" placeholder="quantity" class="form-control Quantity" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
      });

      $(document).on('click', '.btn_remove', function(){
           var button_id = $(this).attr("id");
           $('#row'+button_id+'').remove();
      });

      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      function printErrorMsg (msg) {
         $(".print-error-msg").find("ul").html('');
         $(".print-error-msg").css('display','block');
         $(".print-success-msg").css('display','none');
         $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
         });
      }
    });
</script>
