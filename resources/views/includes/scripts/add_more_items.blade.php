<script type="text/javascript">
    $(document).ready(function(){
      var i=1;
      $('#add').click(function(){
           i++;
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input id="itemNo_'+i+'" type="text" name="item_code[]" data-type="productCode" placeholder="Item Code" class="form-control autocomplete_txt search item_code" /></td><td><input id="itemName_'+i+'" type="text" name="item_name[]" data-type="productName" placeholder="Item Name" class="form-control item_name  autocomplete_txt" /></td><td><input id="price_'+i+'" type="text" name="unit_price[]" placeholder="Unit Price" class="form-control unit_price" /></td><td><input id="quantity_'+i+'" type="text" name="quantity[]" placeholder="quantity" class="form-control Quantity" /></td><td><input id="total_'+i+'" type="text" name="total[]" placeholder="Total" class="form-control total" readonly /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
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
