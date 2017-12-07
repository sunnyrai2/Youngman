<script>
  "use strict";
   $(document).ready(function() {
     $("#job_order").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "{{ route('search_jobs') }}",
                dataType: "json",
                data: {
                    term : request.term
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        select: function( event, ui ) {
             getItemsAtJob(ui.item.id);
        },

    });

     $("#customer_name").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "{{ route('search_customer') }}",
                dataType: "json",
                data: {
                    term : request.term
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        select: function( event, ui ) {
           //fetch job orders for this customer
           $.ajax({
              url: "{{route('get_orders_of_customer') }}",
              data:{
                  term : ui.item.id,
              },
              "success": function(data) {
                
                //populate a select input with job orders of the customer 
                for(var i in data)
                {
                     var job_order = data[i].job_order;
                     var jobSelect = document.getElementById('job_order_select');
                      jobSelect.options[jobSelect.options.length] = new Option(job_order, job_order);
                }
              }
            });
        },

    });

     function getItemsAtJob(job_id){
      $.ajax({
              url: "{{route('get_items_at_job') }}",
              data:{
                  term : job_id,
              },
              "success": function(data) {
                  //Add content to table
                  for(var i in data)
                {
                     var item_code = data[i].item_code;
                     var ok_quantity = data[i].ok_quantity
                     var damaged_quantity = data[i].damaged_quantity
                     var missing_quantity  = data[i].missing_quantity
                     
                     var html = "<tr><td> "+item_code +" </td> <td> "+ok_quantity +" </td> <td> "+damaged_quantity +" </td> <td> "+missing_quantity +" </td> </tr>";

                     $("#table_items tbody").append(html);
                }
              }
            });
     }



});
</script>