<script>
   $(document).ready(function() {
    src = "{{ route('search_customer') }}";
     $("#customer_name").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: src,
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
            $("#customer_id").val(ui.item.id);
            $('#billing_address_line').val(ui.item.billing_address_line);
            $('#billing_address_city').val(ui.item.billing_address_city);
            $('#billing_address_pincode').val(ui.item.billing_address_pincode);

            //TODO delete before production
            $('#delivery_address_line').val(ui.item.billing_address_line);
            $('#delivery_address_city').val(ui.item.billing_address_city);
            $('#delivery_address_pincode').val(ui.item.billing_address_pincode);
        },
        minLength: 3,

    });
});
</script>
