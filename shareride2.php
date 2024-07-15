<!doctype html>
<html lang="en">
<?php
/*
 * The landing page that lists all the problem
 */
require_once('functions.php');
if (!loggedin())
    header("Location: login.php");

connectdb();
?>

<?php
$title = "Share Your Ride";
$pg = 2;
include_once("header2.php")
?>
<!-- <style>
    .fixed-header .app-main {
        padding-top: 0px !important;
    }
</style> -->

<body>
    <?php include_once("heading.php") ?>
    <div class="app-main__outer">
        <div class="app-main__inner">
            <?php
            if (isset($_GET['changed']))
                echo ("<div class=\"alert alert-info\">\nAccount details changed successfully!\n</div>");
            else if (isset($_GET['nerror']))
                echo ("<div class=\"alert alert-error\">\nPlease enter all the details asked before you can continue!\n</div>");
            ?>
            <div class="tabs-animation">
                <?php
                if (isset($_GET['changed']))
                    echo ("<div class=\"alert alert-info\">\nAccount details changed successfully!\n</div>");
                else if (isset($_GET['nerror']))
                    echo ("<div class=\"alert alert-error\">\nPlease enter all the details asked before you can continue!\n</div>");
                ?>
                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                        <div class="mb-3 card">
                            <div class="card-header-tab card-header">
                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                    <i class="header-icon fa-solid fa-bullhorn" style="color:#16aaff"></i>
                                    Share Your Ride
                                </div>
                            </div>
                            <div class="p-0 card-body">
                                <form class="col-md-10 mx-auto" method="post" action="update.php">
                                    <input type="hidden" name="action" value="shareride" />
                                    <div class="form-group">
                                        <div>
                                            <input type="text" class="form-control mt-4 typeahead" data-provide="typeahead" id="From" name="from" placeholder="Source" required>
                                        </div>
                                    </div>
                                    <div class="inputs">
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <input type="text" class="form-control typeahead" data-provide="typeahead" id="To" name="to" placeholder="Destination" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div role="group" class="mb-3 btn-group-lg btn-group">
                                            <button type="button" class="btn-shadow  btn btn-info" id="add">Add Via Routes</button>
                                            <button type="button" class="btn-shadow  btn btn-info" id="remove">Delete Via</button>
                                            <button type="button" class="btn-shadow  btn btn-info" id="reset">Reset Via</button>
                                            <button type="button" class="btn-shadow  btn btn-info" id="CheckOnMap" onclick="RefreshMap()">Refresh Map</button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group uptimepicker">
                                            <input type="datetime-local" class="form-control" placeholder="Start Time of your ride" name="uptime">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <label for="" class="font-weight-bold">Mode of Travel:</label><br>
                                            <div class="custom-radio custom-control custom-control-inline">
                                                <input type="radio" name="vehicle" id="twowheels" class="custom-control-input" value="Two-wheeler">
                                                <label class="custom-control-label" for="twowheels">Two-Wheeler</label>
                                            </div>
                                            <div class="custom-radio custom-control custom-control-inline">
                                                <input type="radio" name="vehicle" id="cars" class="custom-control-input" value="Car">
                                                <label class="custom-control-label" for="cars">Car</label>
                                            </div>
                                            <div class="custom-radio custom-control custom-control-inline">
                                                <input type="radio" name="vehicle" id="taxi" class="custom-control-input" value="Auto">
                                                <label class="custom-control-label" for="taxi">Auto/Taxi</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input placeholder="Approx Duration of Travel" name="time" type="number" class="form-control">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Hrs</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <input type="number" class="form-control" name="number" placeholder="Number of Vacancies" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rs</span>
                                            </div>
                                            <input placeholder="Cost per person" name="cost" type="number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <textarea name="description" style="width: 100%;resize: none;" rows="5" class="form-control" placeholder="Any further details which might help people select your ride"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="mb-2 mr-2 btn-hover-shine btn btn-info btn-wide btn-lg" name="signup" value="Search">Share</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6 h-100">
                        <div class="card-hover-shadow-2x mb-3 card">
                            <div class="card-header-tab card-header">
                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                    <i class="header-icon fa-solid fa-map-location-dot" style="color:#16aaff"></i>
                                    Map
                                </div>
                            </div>

                            <div class="p-0 card-body">
                                <div class="span5" id="map" style="width: 100%; height: 100%">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="app-wrapper-footer">

                <div class="app-drawer-overlay d-none animated fadeIn"></div>
                <script type="text/javascript" src="assets/scripts/main.d810cf0ae7f39f28f336.js"></script>
</body>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/datetimepicker.js"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
    $('#uptimepicker').datetimepicker({
        format: 'yyyy-MM-dd hh:mm:ss',
    });
    $('#downtimepicker').datetimepicker({
        format: 'yyyy-MM-dd hh:mm:ss',
    });
</script>
<?php
$query = "SELECT city_name from cities";
$con = mysqli_connect("localhost", "root", "", "nuvshare1");
$result = mysqli_query($con, $query);
echo "<script>var city = new Array();";
while ($row = mysqli_fetch_array($result)) {
    //echo '<option value="' . $row["city_name"]. '"> ' . $row["city_name"].'</option>';
    echo 'city.push("' . $row["city_name"] . '");';
}
echo '$(".typeahead").typeahead({source : city})';
echo "</script>"

?>
<script type="text/javascript">
    //<![CDATA[

    var customIcons = {
        restaurant: {
            icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png',
            shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
        },
        bar: {
            icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png',
            shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
        }
    };

    var dummy = "hello";
    var directionDisplay;
    var directionsService = new google.maps.DirectionsService();

    function load() {
        var map = new google.maps.Map(document.getElementById("map"), {
            center: new google.maps.LatLng(23.6145, 72.3418),
            zoom: 6,
            mapTypeId: 'roadmap'
        });
        directionsDisplay = new google.maps.DirectionsRenderer();
        directionsDisplay.setMap(map);
        var infoWindow = new google.maps.InfoWindow;
    }

    function calcRoute(start, end, waypts) {
        var request = {
            origin: start,
            destination: end,
            waypoints: waypts,
            optimizeWaypoints: true,
            travelMode: google.maps.DirectionsTravelMode.DRIVING
        };
        directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
            }
        });
    }

    function bindInfoWindow(marker, map, infoWindow, html) {
        google.maps.event.addListener(marker, 'click', function() {
            infoWindow.setContent(html);
            infoWindow.open(map, marker);
        });
    }

    function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
            if (request.readyState == 4) {
                request.onreadystatechange = doNothing;
                callback(request, request.status);
            }
        };

        request.open('GET', url, true);
        request.send(null);
    }

    function doNothing() {}

    i = $('.inputs').size();
    // <input type="text" class="form-control" data-provide="typeahead" id="dest" name="to" placeholder="Destination" required>
    $('#add').click(function() {
        var nameName = "dynamic" + i;
        $('<div><input type="text" data-provide="typeahead" class="form-control mb-3 field" placeholder="Hop " +"' + i + '" name="' + nameName + '"   value="" /></div>').fadeIn('slow').appendTo('.inputs');

        $(".field").typeahead({
            source: city
        });
        i++;
        var fields = Number($("#total").val()) + Number(1);
        $("#total").val(fields);


    });

    $('#remove').click(function() {
        if (i > 1) {
            $('.field:last').remove();
            var fields = Number($("#total").val()) - Number(1);
            i--;
        }
    });

    $('#reset').click(function() {
        while (i >= 1) {
            $('.field:last').remove();
            var fields = Number($("#total").val()) - Number(1);
            i--;
        }
    });


    function RefreshMap() {
        waypts = [];
        var start = $('#From').val();
        var end = $('#To').val();
        divs = $('.inputs');
        //alert(start);
        $('.field').each(function() {
            waypts.push({
                location: this.value,
                stopover: true
            });


        });

        calcRoute(start, end, waypts);

    }
</script>

</html>