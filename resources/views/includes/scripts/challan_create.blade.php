<script type="text/javascript">
"use strict";
$(document).ready(function(){

      //Variable to hold the current length of table_challan_rental
      var length = $('#table_challan_rental').length;
      //Used to allow backspace in isNumeric functions. Backspace is allowed because it will be used while adjusting the price
      var specialKeys = new Array();
      specialKeys.push(8,46); //Backspace

      var godown = $("#godown_name").text();

      //Deletes a row
      $(".delete").on('click', function() {
        $('.case:checkbox:checked').parents("tr").remove();
        $('#check_all').prop("checked", false); 
      });

      //Adds a row
      $(".addmore").on('click', function () {
        //$('#verify').modal('show');
        addEmptyRow();
      });

      function verifyUser(password) {
        if (password.value === "abcd") 
          addEmptyRow();
        else 
          alert("Wrong password");
      }

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

      //Function to add filled row
      function addRow(ID, desc, price, quantity, avail_qty) 
      {
        var ids = $("#table_challan_rental").find('#' + ID).html();
        var totLinePrice = parseFloat(price * quantity).toFixed(2);
        
        if (ids === undefined || ids === null) 
        {
          var html = "<tr id='" + ID + "' class = 'item'> <td><input class='case' type='checkbox'/></td>" +
            "  <td> <input type='text' data-type='productCode' name='itemNo[]' id='itemNo_0' class='form-control autocomplete_txt' autocomplete='off' value='" + ID + "' readonly></td>" +
            "<td> <input type='text' data-type='productName' name='itemName[]' id='itemName_0' class='form-control autocomplete_txt' autocomplete='off' value='" + desc + "'></td>" +
            "  <td><input type='number' name='price[]' id='price_0' class='form-control changesNo' autocomplete='off' onkeypress='return IsNumeric(event);' ondrop='return false;' onpaste='return false;' value='" + price + "'></td>" +
            "<td><input type='number' name='quantity[]' id='quantity_0' class='form-control changesNo' autocomplete='off' onkeypress='return IsNumeric(event); ondrop='return false;' onpaste='return false;' value='" + quantity + "'></td>" +
            "<td><input type='number' class='form-control quantity_aval' autocomplete='off' onkeypress='return IsNumeric(event); ondrop='return false;' onpaste='return false;' value='" + avail_qty + "' readonly></td>" +
            " <td><input type='number' name='total[]' id='total_0' class='form-control totalLinePrice' autocomplete='off' onkeypress='return IsNumeric(event);'ondrop='return false;' onpaste='return false;' value='" + totLinePrice + "' readonly></td>" + "</tr>";

          $("#table_challan_rental tbody").append(html);
        } 
        else 
        {
          var oldQty = $("#table_challan_rental").find('#' + ID).find("td:eq(4)").find('input').val();
          var newQty = parseInt(oldQty) + parseInt(quantity);
          $("#table_challan_rental").find('#' + ID).find("td:eq(4)").find('input').val(newQty);
          var total = newQty * parseFloat(price).toFixed(2);
          $("#table_challan_rental").find('#' + ID).find("td:eq(6)").find('input').val(total);
        }
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
        var qty = $("#table_challan_rental").find('#' + parent_id).find("td:eq(4)").find('input').val();
        var price = $("#table_challan_rental").find('#' + parent_id).find("td:eq(3)").find('input').val();
        qty = parseInt(qty);
        price = parseFloat(price).toFixed(2);
        var new_price = qty * price;
        $("#table_challan_rental").find('#' + parent_id).find("td:eq(6)").find('input').val(new_price);
        calculateTotal();
      });


      $("#required_items").on('click', '.btnSelect', function () {

        var currentRow = $(this).closest("tr");
        var ID = currentRow.attr('id');
        var bundle = currentRow.find("td:eq(2)").text();
        var qty = currentRow.find("td:eq(1)").text();

        qty = parseInt(qty, 10);

        if (qty > 0) 
        {
            currentRow.find("td:eq(1)").text(qty - 1);
            var row_id = $("#fullfilled_items").find('#' + ID).html();
            if (row_id === undefined || row_id === null) 
            {
                var new_row = "<tr id='" + ID + "'><td><input type='text' name='itemCodeBOM[]' value='" + ID + "' readonly></td><td><input type='text' name='itemQtyBOM[]' value='1' readonly></td></tr>";
                $("#fullfilled_items tbody").append(new_row);
            } 
            else 
            {
                var oldQty = $("#fullfilled_items").find('#' + ID).find("td:eq(1)").find('input').val();
                var newQty = parseInt(oldQty) + 1;
                $("#fullfilled_items").find('#' + ID).find("td:eq(1)").find('input').val(newQty);
            }
        } 
        else return;

        if (bundle === "Bundle") 
        {
          var src = "{{ route('expand_bundle') }}";
          $.ajax({
              dataType: "json",
              url: src,
              data: {
                  keyword: ID,
                  location_id: godown
              },
              success: function (data) {
                var obj = data//JSON.parse(data);
                    for (var prop in obj) {
                        addRow(obj[prop].code, obj[prop].name, obj[prop].rental_value, obj[prop].quantity, obj[prop].ok_quantity);
                    }
                    calculateTotal()
                }
            });
        }
        else if(bundle === "Item")
        {
            var avail_qty = '';
            var src = "{{ route('get_aval_item_quantity') }}";
            $.ajax({
                dataType: "json",
                url: src,
                data: {
                    keyword: ID,
                    location_id: godown
                },
                success: function (data) {
                  var obj = data;
                   for (var prop in obj) {
                        addRow(obj[prop].code, obj[prop].name, obj[prop].rental_value, "1", obj[prop].ok_quantity);
                    }
                    calculateTotal()
                }
            });
        }
      });

      //Recalculate total when price is changed
      $(document).on('change keyup blur','.m_price',function(){
        id_arr = $(this).attr('id');
        id = id_arr.split("_");
        quantity = $('#quantity_'+id[1]).val();
        price = $('#price_'+id[1]).val();
        if( quantity!='' && price !='') $('#total_'+id[1]).val( (parseFloat(price)*parseFloat(quantity)).toFixed(2) );  
        calculateTotal();
      });

      //Recalculate total when quantity is changed
      $(document).on('change keyup blur','.m_quantity',function(){
        id_arr = $(this).attr('id');
        id = id_arr.split("_");
        quantity = $('#quantity_'+id[1]).val();
        price = $('#price_'+id[1]).val();
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
              calculateTotal();
            }
          });
        });
});
</script>
