<script>
   $(document).ready(function() {
    src = "{{ route('search_item') }}";
     $("#search_item").autocomplete({
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
        minLength: 3,

    });
});
</script>
