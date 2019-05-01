var jq = jQuery.noConflict();

function sortList(url_base,ctrl,col,page){
    var url = url_base+'sort';
	jq.ajax({
        data:  {"ctrl": ctrl, "column": col, "page": page},
        url:   url,
        type:  "POST",
        dataType: "html",
        /*beforeSend: function () {
            jq("#table-list tbody").html("Procesando, espere por favor...");
        },*/
        success:  function (response) {
            jq("#table-list tbody").html(response);
        }
    });
}
