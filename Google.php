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
    <script src="//maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyBgw1HOqhudtFHccBF1byGThdGxHC-CE8c"></script>
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
            <div class="m-4 m-lg-5">
              <h1 class="display-5 fw-bold">Google Maps</h1>
              <p class="fs-6 text-muted">Please enter your address </p>
              <label for="address" class="visually-hidden">Address</label>
              <div class="row">
                <div class="col-12">
                  <input type="text" class="form-control" name="address"  id="address" placeholder="501, 5th Floor, Deeksha Blossom, 15th Cross,9, Green Garden Layout, Silver Springs Layout, Munnekollal.">
              <i class="fs-6 text-muted">Retrieve and display coordinates (longitude and latitude) for an address</i>
                </div>
              </div>

            </div>
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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- Bootstrap core JS-->
    <script src="//cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script type="text/javascript">
	  function initialize() {
	    var address = (document.getElementById('address'));
	    var autocomplete = new google.maps.places.Autocomplete(address);
	    autocomplete.setTypes(['geocode']);
	    google.maps.event.addListener(autocomplete, 'place_changed', function() {
	        var place = autocomplete.getPlace();
	        if (!place.geometry) {
	            return;
	        }

	    var address = '';
	    if (place.address_components) {
	        address = [
	            (place.address_components[0] && place.address_components[0].short_name || ''),
	            (place.address_components[1] && place.address_components[1].short_name || ''),
	            (place.address_components[2] && place.address_components[2].short_name || '')
	            ].join(' ');
	    }

	    var html = `<div class="col-lg-6 col-xxl-4 mb-5">
	      <div class="card bg-light border-0 h-100">
	        <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
	          <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-map"></i></div>
	          <h2 class="fs-4 fw-bold">Latitude: ` + place.geometry.location.lat() + `, Longitude: ` + place.geometry.location.lng() + `</h2>
	          
	        </div>
	      </div>
	    </div>`;
	    $("div.coordinates-div").append(html);
	   });
	}
	google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </body>
</html>