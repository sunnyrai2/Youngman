<script>
   $(document).ready(function() {
          //Live search items
      $(document).on('focus','.autocomplete_txt',function(){
          var type = $(this).data('type');
          var autoTypeNo = null;
          
          if(type =='productCode' )autoTypeNo=0;
          if(type =='productName' )autoTypeNo=1;  

          var src = "{{ route('search_item') }}";
          $(this).autocomplete({
            source: function( request, response ) {
              $.ajax({
                url : src,
                dataType: "json",
                data: {
                   term: request.term,
                   type: type,
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
                
              $('#itemNo_'+id[1]).val(ui.item.code);
              $('#quantity_' + id[1]).val(1);
              $('#price_' + id[1]).val(0);
              $('#total_' + id[1]).val(1 * 0);
              calculateTotal();
            }
          });
        });

      //total price calculation 
function calculateTotal() {
   /* subTotal = 0;
    total = 0;
    subTotalFreight = 0;
    $('.totalLinePrice').each(function() {
        if ($(this).val() != '') subTotal += parseFloat($(this).val());
    });
    $('#subTotal').val(subTotal.toFixed(2));
    freight = parseFloat($('#freight').val());

    if (typeof(freight) != "undefined") {
        subTotalFreight = subTotal + freight;
        $('#sub_total_freight').val(subTotalFreight.toFixed(2));
        taxRate = 0.18;


        console.log((subTotalFreight * taxRate).toFixed(2));

        $('#tax').val((subTotalFreight * taxRate).toFixed(2));

        total = subTotalFreight + (subTotalFreight * taxRate);

        $('#totalAftertax').val(total.toFixed(2));
    } else {
        
    }
*/
}
});
</script>
