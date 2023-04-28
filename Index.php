<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Coordinates - Retrieve and display coordinates (longitude and latitude) for an address, using Google Maps and OpenStreetMap (OSM)</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />

     </head>
  <body>
    <!-- Responsive navbar-->
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container px-lg-5">
        <a class="navbar-brand" href="">Coordinates</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" href="index.php">OpenStreetMap (OSM)</a></li>
            <li class="nav-item"><a class="nav-link" href="google.php">Google Maps</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header-->
    <header class="py-5">
      <div class="container px-lg-5">
        <div class="p-4 p-lg-5 bg-light rounded-3 text-center">
          <form class=" mt-2">
            <div class="m-4 m-lg-5">
              <h1 class="display-5 fw-bold">OpenStreetMap (OSM)</h1>
              <p class="fs-6 text-muted">Please enter your address </p>
              <label for="address" class="visually-hidden">Address</label>
              <div class="row">
                <div class="col-12">
                  <input type="text" class="form-control" name="address"  id="address" placeholder="501, 5th Floor, Deeksha Blossom, 15th Cross,9, Green Garden Layout, Silver Springs Layout, Munnekollal.">
              <i class="fs-6 text-muted">Retrieve and display coordinates (longitude and latitude) for an address</i>
                </div>
                </div>
              <button class="btn btn-primary btn-md mt-4 get-coordinates-btn" type="submit" >Get Coordinates
                
              </button>
            </div>
          </form>
        </div>
      </div>
    </header>
    <!-- Page Content-->
    <section class="pt-4">
      <div class="container px-lg-5">
        <!-- Page Features-->
        <div class="row gx-lg-5 coordinates-div">
         
        </div>
      </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
      <div class="container"><p class="m-0 text-center text-white">Copyright &copy; coordinates.com <?php echo date('Y'); ?></p></div>
    </footer>
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>

    
    <script type="text/javascript">

   $(document).ready(function() {
    $("form").submit(function(event) {
        event.preventDefault();
        var formData = {
            address: $("input[name='address']").val(),
            api: 'openstreetmap',
        };
        $('.get-coordinates-btn').prop("disabled", true);
        $('.get-coordinates-btn').html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`);
        
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
                $('.get-coordinates-btn').prop("disabled", false);
                $('.get-coordinates-btn').html(`Get Coordinates`);
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
                $('.get-coordinates-btn').prop("disabled", false);
                $('.get-coordinates-btn').html(`Get Coordinates`);
            });
        
    });
});

    </script>
  </body>
</html>