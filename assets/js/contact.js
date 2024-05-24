var Contact = function () {
    return {
        //main function to initiate the module
        init: function () {
			var map;
			$(document).ready(function(){
			  map = new GMaps({
				div: '#gmapbg',
				lat: 40.2148665,
				lng: -76.9436953
			  });
			   var marker = map.addMarker({
		            lat: 40.2148665,
					lng: -76.9436953,
		            title: 'Loop, Inc.',
		            infoWindow: {
		                content: "<b>Lane Enterprises, Inc.</b> 3905 Hartzdale Drive Suite 514<br>Camp Hill, PA 17011"
		            }
		        });

			   marker.infoWindow.open(map, marker);
			});
        }
    };

}();

jQuery(document).ready(function() {    
   Contact.init(); 
});
$('#contact_form').validate({
    rules: {
        name: {
            required: true
        },
        email: {
            required: true,
            email: true,
        },
        company_name: {
            required: true
        },
        message: {
            required: true
        }
    },
    messages: {
        name: {
            required: "Name is required!"
        },
        email: {
            required: "Email is required!",
            email: "Enter valid email!"
        },
        company_name: {
            required: "Company name is required!"
        },
        message: {
            required: "Message is required!"
        }
    },
    submitHandler: function(form) {
        form.submit();
    }
});