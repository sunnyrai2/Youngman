<script>
  "use strict";
   $(document).ready(function() {
     $("#item_name").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "{{ route('search_item') }}",
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
             $.ajax({
              url: "{{route('item_at_godowns') }}",
              data:{
                  term : ui.item.code,
              },
              "success": function(data) {
                console.log(data);
                  
              }
            });
        },

    });
});
</script>