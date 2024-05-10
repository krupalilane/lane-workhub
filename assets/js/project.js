var configurator;
var prod_id = $('#project_id').val();
window.onload = function () {
    configurator = new kbmax.KBMaxConfigurator({
        elementId: "viewer",
        configuratorId: prod_id,
        showFields: true,
        showHeader: false,
        showConfigHeader: false,
        showMove: true,
        showSubmitButton: false,
    });
    document.getElementById("submitQuote").onclick = function (event) {
        document.getElementById("submitQuote").disabled = true;
        document.getElementById("submitQuote").value = "Submitting...";
        event.preventDefault();
        configurator.getFields(function(o){
            var fieldsJson = JSON.stringify(o);
            document.getElementById("quoteFields").value = fieldsJson;
        });
        configurator.getConfiguredProduct(function(o){
            var json            = JSON.stringify(o);
            var project_name    = $('#project_name').val(); // You need to set this to the value of the input field on the embed page after you've added that.
            var prodidint       = prod_id;
            var qFields         = $('#quoteFields').val();
            var qFields_arr     = $.parseJSON(qFields);
            if (qFields_arr.Length < 10) {
                document.getElementById("submitQuote").disabled = false;
                document.getElementById("submitQuote").value = "Build Project Plans";
                toastr.error('Length must be 10 or more!');
            }else if(qFields_arr.Width < 10){
                document.getElementById("submitQuote").disabled = false;
                document.getElementById("submitQuote").value = "Build Project Plans";
                toastr.error('Width must be 10 or more!');
            }else{
                if (project_name) {
                    $.ajax({
                        url  : add_project_detail_url,
                        type : "POST",
                        dataType: "json",
                        data : { project_name: project_name, prodidint: prodidint, cfgProduct: json, quoteFields: qFields },
                        success:function(data){
                            if(data.status == 'success'){
                                toastr.success(data.message);
                            }else{
                                toastr.error(data.message);
                            }
                            setTimeout(() => {
                                window.location.href = manage_project_url;
                            }, 2000)
                        },
                    });
                }else{
                    document.getElementById("submitQuote").disabled = false;
                    document.getElementById("submitQuote").value = "Build Project Plans";
                    toastr.error('Project Name is required!');
                }
            }
        });
    }
}