<script type="text/javascript">
  "use strict";
    $( document ).ready( function () {

		$('#extend_modal').on('show.bs.modal', function(e) {
		    var jobOrder =  $(e.relatedTarget).data('job-order');
		    var jobOrderId = $(e.relatedTarget).data('job-order-id');
		    $(e.currentTarget).find('input[name="job_order"]').val(jobOrder);
		    $(e.currentTarget).find('input[name="job_order_id"]').val(jobOrderId);
		});
		    
		$('#pickup_modal').on('show.bs.modal', function(e) {    
		    var jobOrder =  $(e.relatedTarget).data('job-order');
		    var jobOrderId = $(e.relatedTarget).data('job-order-id');
		    $(e.currentTarget).find('input[name="job_order"]').val(jobOrder);
		    $(e.currentTarget).find('input[name="job_order_id"]').val(jobOrderId);
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

    	$.validator.setDefaults({
        submitHandler: function (form) {
            var formData = new FormData( form );
            console.log(formData);
            $.ajax({
                url: "{{ route('initiate_pickup') }}",
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

      $( "#extend_order" ).validate( {
        rules: {
          job_order: "required",
          job_order_id: "required",
          pickup_date: "required",
          fileToUpload: "required",
        },
        messages: {
          job_order: "required",
          job_order_id: "required",
          pickup_date: "required",
          fileToUpload: "required",
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

      $( "#initiate_manual_pickup" ).validate( {
        rules: {
          job_order_id: "required",
          pickup_date: "required",
          warehouse: "required",
        },
        messages: {
          job_order_id: "required",
          pickup_date: "required",
          warehouse: "required",
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

      $( "#initiate_scheduled_pickup" ).validate( {
        rules: {
          job_order: "required",
          job_order_id: "required",
          warehouse: "required",
        },
        messages: {
          job_order: "required",
          job_order_id: "required",
          warehouse: "required",
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