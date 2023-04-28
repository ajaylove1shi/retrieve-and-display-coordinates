/**
 * [description]
 * @param  {Object} ) {              $("form").submit(function(event) {       var formData [description]
 * @return {[type]}   [description]
 */
$(document).ready(function() {
   $("form").submit(function(event) {
       var formData = {
           address: $("input[name='address']").val(),
           api: $("input[name='api']").val(),
       };
       // $('.get-coordinates-btn').prop("disabled", true);
       // $('.get-coordinates-btn').html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`);
       $.ajax({
           type: "POST",
           url: "Coordinate.php",
           data: formData,
           dataType: "json",
           encode: true,
       }).done(function(data) {
           $("div.coordinates-div").html('');
           $('.error-message').remove();
           var results = data.results;
           if (results != null) {
               for (var i = 0; i < results.length; i++) {
                   var lat = results[i].lat;
                   var lon = results[i].lon;
                   var display_name = results[i].display_name;
                   var html = `<div class="col-lg-6 col-xxl-4 mb-5">
            <div class="card bg-light border-0 h-100">
              <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-map"></i></div>
                <h2 class="fs-4 fw-bold">Latitude: ` + lat + `, Longitude: ` + lon + `</h2>
                <p class="mb-0 text-muted">` + display_name + `</p>
              </div>
            </div>
          </div>`;
                   $("div.coordinates-div").append(html);
               }
           } else {
               $("form ").append('<span class="text-danger error-message">No data found.</span>');
           }
           // $('.get-coordinates-btn').prop("disabled", false);
           // $('.get-coordinates-btn').html(`Get Coordinates`);
       }).fail(function(jqXHR, textStatus) {
           if (jqXHR.responseJSON.status == "failed") {
               var errors = jqXHR.responseJSON.errors;
               for (var i = 0; i < errors.length; i++) {
                   if (errors[i] != true) {
                       $('.error-message').remove();
                       $("form ").append('<span class="text-danger error-message">' + errors[i] + '</span>');
                   }
               }
           } else {
               $('.error-message').remove();
               $("form ").append('<span class="text-danger error-message">' + jqXHR.responseJSON.message + '</span>');
           }
           // $('.get-coordinates-btn').prop("disabled", false);
           // $('.get-coordinates-btn').html(`Get Coordinates`);
       });
       event.preventDefault();
   });
});