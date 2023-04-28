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
        <a class="navbar-brand" href="">Coordinates - Retrieve and display coordinates (longitude and latitude) for an address.</a>
      </div>
    </nav>
    <!-- Header-->
    <header class="py-5">
      <div class="container px-lg-5">
        <div class="p-4 p-lg-5 bg-light rounded-3 text-center">
          <form class=" mt-2">
            <div class="m-4 m-lg-5">
              <h1 class="display-5 fw-bold">Please enter your address</h1>
              <p class="fs-6 text-muted">Retrieve and display coordinates (longitude and latitude) for an address, using Google Maps and OpenStreetMap (OSM)</p>
              <label for="address" class="visually-hidden">Address</label>
              <div class="row">
                <div class="col-12">
                  <input type="text" class="form-control" name="address"  id="address" placeholder="501, 5th Floor, Deeksha Blossom, 15th Cross,9, Green Garden Layout, Silver Springs Layout, Munnekollal.">
                </div>
                <div class="col-12 mt-3">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="api" id="openstreetmap" checked value="openstreetmap">
                    <label class="form-check-label" for="inlineRadio2">OpenStreetMap (OSM)</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="api" id="google" value="google">
                    <label class="form-check-label" for="inlineRadio1">Google Maps</label>
                  </div>
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

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
    
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
        /*********************************************************************/
        /* var address contain your autocomplete address *********************/
        /* place.geometry.location.lat() && place.geometry.location.lat() ****/
        /* will be used for current address latitude and longitude************/
        /*********************************************************************/
        
        console.log(place.geometry.location.lat());
        console.log(place.geometry.location.lng());
        });
  }

   google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </body>
</html>