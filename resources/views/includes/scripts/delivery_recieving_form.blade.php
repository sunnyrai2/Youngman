<script type="text/javascript">
  "use strict";
    $( document ).ready( function () {

      $('#modal-challan').on('show.bs.modal', function(e) {
        var challanId = $(e.relatedTarget).data('challan-id');
        $(e.currentTarget).find('input[name="challanId"]').val(challanId);
        
        var jobOrder =  $(e.relatedTarget).data('job-order');
         $(e.currentTarget).find('input[name="orderId"]').val(jobOrder);
      });

      $.validator.setDefaults({
        submitHandler: function (form) {
            var formData = new FormData( form );
            console.log(formData);
            $.ajax({
                url: "{{ route('add_delivery_recieving') }}",
                type: 'POST',
                data: formData,
                beforeSend: function() {
                 $("#loading").show();
                },
                success: function (data) {
                    console.log(data);
                    location.reload(); 
                },
                error: function(data){
                    console.log(data);
                },
                cache: false,
                contentType: false,
                processData: false
            })
            .complete(function() {
              $("#loading").hide(); // To Hide progress bar
            });
        return false;
      }
    });

      $( "#delivery_recieving" ).validate( {
        rules: {
          challanId: "required",
          orderId: "required",
          transporter: "required",
          recieving_date: "required",
          gr_no: {
            required: true,
            maxlength: 10
          },
          amt: {
            required: true,
            maxlength: 10,
            digits: true
          }
        },
        messages: {
          transporter: "Please enter Transporter Name",
          recieving_date: "Please enter Date of Recieving",
          gr_no: "Please enter GR No",
          amt: "Please enter Amount"
        },
        errorElement: "em",
        errorPlacement: function ( error, element ) {
          error.addClass( "help-block" );
          if ( element.prop( "type" ) === "checkbox" ) 
          {
            error.insertAfter( element.parent( "label" ) );
          }
          else 
          {
            error.insertAfter( element );
          }
        },
        highlight: function ( element, errorClass, validClass )
        {
          $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
        },
        unhighlight: function (element, errorClass, validClass)
        {
          $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
        }
      });
    });
  </script>