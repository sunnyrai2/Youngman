<script type="text/javascript">
"use strict";
$(document).ready(function(){

      //Variable to hold the current length of table_stock_adjust
      var length = $('#table_stock_adjust').length;
      //Used to allow backspace in isNumeric functions. Backspace is allowed because it will be used while adjusting the price
      var specialKeys = new Array();
      specialKeys.push(8,46); //Backspace

      var godown = $("#godown_id").val();

      //Deletes a row
      $(".delete").on('click', function() {
        $('.case:checkbox:checked').parents("tr").remove();
        $('#check_all').prop("checked", false); 
      });

      //Adds a row
      $(".addmore").on('click', function () {
        addEmptyRow();
      });

      //Function to add an empty row
      function addEmptyRow()
      {
        var html = "<tr id='' class = 'item'> <td><input class='case' type='checkbox'/></td>" +
          "  <td> <input type='text' data-type='productCode' name='itemNo[]' id='itemNo_" + length + "' class='form-control autocomplete_txt search' autocomplete='off' value='' readonly></td>" +
          "<td> <input type='text' data-type='productName' name='itemName[]' id='itemName_" + length + "' class='form-control autocomplete_txt search' autocomplete='off' value=''></td>" +
          "  <td><input type='number' name='price[]' id='price_" + length + "' class='form-control changesNo m_price' autocomplete='off' value=''></td>" +
          "<td><input type='number' name='quantity[]' id='quantity_" + length + "' class='form-control changesNo m_quantity' autocomplete='off' onkeypress='return IsNumeric(event); ondrop='return false;' onpaste='return false;' value='1'></td>" +
         "<td><input type='number' name='quantity_aval[]' id='quantity_aval_" + length + "' class='form-control changesNo quantity' autocomplete='off' onkeypress='return IsNumeric(event); ondrop='return false;' onpaste='return false;' value='' readonly></td>" +
          " <td><input type='number' name='total[]' id='total_" + length + "' class='form-control totalLinePrice' autocomplete='off' onkeypress='return IsNumeric(event);'ondrop='return false;' onpaste='return false;' value='' readonly></td>" + "</tr>";

        $("#table_challan_rental tbody").append(html);

        length++;
      }

      function calculateTotal()
      {
        var subTotal = 0;
        $('.totalLinePrice').each(function () {
          if ($(this).val() != '') subTotal += parseFloat($(this).val());
        });
        $('#subTotal').val(subTotal.toFixed(2));
      }

      //Checks if numeric data is being entered in numeric fields
      function IsNumeric(e) {
          var keyCode = e.which ? e.which : e.keyCode;
          var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
          return ret;
      }

      $(document).on('change keyup blur', '.changesNo', function () {
        var parent_id = $(this).closest('tr').attr('id');
        var qty = $("#table_stock_adjust").find('#' + parent_id).find("td:eq(4)").find('input').val();
        var price = $("#table_stock_adjust").find('#' + parent_id).find("td:eq(3)").find('input').val();
        qty = parseInt(qty);
        price = parseFloat(price).toFixed(2);
        var new_price = qty * price;
        $("#table_stock_adjust").find('#' + parent_id).find("td:eq(6)").find('input').val(new_price);
        calculateTotal();
      });

      //Recalculate total when price is changed
      $(document).on('change keyup blur','.m_price',function(){
        var id_arr = $(this).attr('id');
        var id = id_arr.split("_");
        var quantity = $('#quantity_'+id[1]).val();
        var price = $('#price_'+id[1]).val();
        if( quantity!='' && price !='') $('#total_'+id[1]).val( (parseFloat(price)*parseFloat(quantity)).toFixed(2) );  
        calculateTotal();
      });

      //Recalculate total when quantity is changed
      $(document).on('change keyup blur','.m_quantity',function(){
        var id_arr = $(this).attr('id');
        var id = id_arr.split("_");
        var quantity = $('#quantity_'+id[1]).val();
        var price = $('#price_'+id[1]).val();
        if( quantity!='' && price !='') $('#total_'+id[1]).val( (parseFloat(price)*parseFloat(quantity)).toFixed(2) );  
        calculateTotal();
      });

      //Live search items
      $(document).on('focus','.autocomplete_txt',function(){
          var type = $(this).data('type');
          var autoTypeNo = null;
          
          if(type =='productCode' )autoTypeNo=0;
          if(type =='productName' )autoTypeNo=1;  

          var src = "{{ route('get_requested_item') }}";
          $(this).autocomplete({
            source: function( request, response ) {
              $.ajax({
                url : src,
                dataType: "json",
                data: {
                   keyword: request.term,
                   type: type,
                   godown: godown
                },
                 success: function( data ) {
                  
                   response(data);
                }
              });
            },
            autoFocus: true,
            minLength: 0,
            select: function( event, ui ) {
              
              var id_arr = $(this).attr('id');
              var id = id_arr.split("_");
                
              $('#itemNo_'+id[1]).val(ui.item.id);
              $('#quantity_aval_'+id[1]).val(ui.item.aval_quantity);
              $('#price_'+id[1]).val(ui.item.rental_value);
              $('#total_'+id[1]).val(ui.item.rental_value);
              calculateTotal();
            }
          });
      });
});
</script>
