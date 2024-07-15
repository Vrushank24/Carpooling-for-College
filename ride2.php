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
$title = "NUVSHARE";
$pg = 1;
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
                                    <i class="header-icon fa-solid fa-search" style="color: #16aaff;"></i>
                                    Ride Information
                                </div>
                            </div>
                            <div class="p-0 card-body">

                                <?php
                                if (isset($_GET['id'])) {
                                    $id = $_GET['id'];
                                    $query = "SELECT * FROM offers WHERE id=" . $id;
                                    $con = mysqli_connect("localhost", "root", "", "nuvshare1");
                                    $result = mysqli_query($con, $query);
                                    if (mysqli_num_rows($result) == 0) {
                                        echo ("<p align='center'>Looks like you have entered an URL you shouldn't have!Please go back to previous page</p>\n");
                                    } else {
                                        $row = mysqli_fetch_array($result);
                                        $uid = $row['uid'];
                                        $from = $row['from'];
                                        $to = $row['to'];
                                        $uptime = $row['uptime'];
                                        $vacancy = $row['people'];
                                        $price = $row['price'];
                                        $ferry = $row['vehicle'];
                                        $desc = $row['description'];
                                        $cid = $row['id'];

                                ?>
                                        <div class="vertical-time-icons vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div>
                                                    <div class="vertical-timeline-element-icon bounce-in">
                                                        <div class="timeline-icon border-primary">
                                                            <i class="header-icon fa-solid fa-user" style="color: #16aaff;"></i>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <h4 class="timeline-title"><a href="<?php echo "profile2.php?id=" . $uid; ?>"><?php print_r(getName($uid)[0]); ?></a></h4>
                                                        <p>Rider Name
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div>
                                                    <div class="vertical-timeline-element-icon bounce-in">
                                                        <div class="timeline-icon border-warning">
                                                            <i class="header-icon fa-solid fa-clock" style="color: #16aaff;"></i>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <h4 class="timeline-title"><?php echo $uptime ?></h4>
                                                        <p>Starting Time of Ride</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div>
                                                    <div class="vertical-timeline-element-icon bounce-in">
                                                        <div class="timeline-icon border-success">
                                                            <i class="header-icon fa-solid fa-location-pin" style="color: #16aaff;"></i>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <h4 class="timeline-title"><?php echo $from; ?></h4>
                                                        <p>Rider's Source
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div>
                                                    <div class="vertical-timeline-element-icon bounce-in">
                                                        <div class="timeline-icon border-primary">
                                                            <i class="header-icon fa-solid fa-map-pin" style="color: #16aaff;"></i>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <h4 class="timeline-title"><?php echo $to; ?></h4>
                                                        <p>Rider's Destination
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div>
                                                    <div class="vertical-timeline-element-icon bounce-in">
                                                        <div class="timeline-icon border-success bg-success">
                                                            <i class="header-icon fa-solid fa-user-group" style="color: #FFD43B;"></i>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <h4 class="timeline-title"><?php echo $vacancy; ?></h4>
                                                        <p>Available vacancy</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div>
                                                    <div class="vertical-timeline-element-icon bounce-in">
                                                        <div class="timeline-icon border-warning bg-warning">
                                                        <i class="header-icon fa-solid fa-indian-rupee-sign" style="color: #16aaff;"></i>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <h4 class="timeline-title">INR <?php echo $price; ?></h4>
                                                        <p>Price per person
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div>
                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                        <div class="timeline-icon bg-danger border-danger">
                                                            <i class="header-icon fa-solid fa-car" style="color: #16aaff;"></i>
                                                        </div>
                                                    </span>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <h4 class="timeline-title"><?php echo $ferry; ?></h4>
                                                        <p>Type of vehicle</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div>
                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                        <div class="timeline-icon border-danger">
                                                            <i class="header-icon fa-solid fa-note-sticky" style="color: #16aaff;"></i>
                                                        </div>
                                                    </span>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <h4 class="timeline-title"><?php echo $desc; ?></h4>
                                                        <p>Brief Description of the car pool</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6 h-100">
                        <div class="card-hover-shadow-2x mb-3 card">
                            <div class="card-header-tab card-header">
                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                    <i class="header-icon fa-solid fa-car" style="color: #16aaff;"></i>
                                    Request for this <?php echo $ferry ?>
                                </div>
                            </div>

                            <div class="p-0 card-body">
                                <form class="col-md-10 mx-auto" method="post" action="addCarShare.php">

                                    <?php
                                        $time = date("Y-m-d H:i:s");
                                        if ($uptime > $time) { ?>
                                        <input type="hidden" id="formfrom" name="from" />
                                        <input type="hidden" id="formto" name="to" />
                                        <input type="hidden" name="uid" value=<?php echo getUserid()[0]; ?> />
                                        <input type="hidden" name="cid" value=<?php echo $cid; ?> />
                                        <div class="dropdown d-inline-block">
                                            <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mt-3 mb-3 mr-2 dropdown-toggle btn btn-info p-2" id="from">From
                                            </button>
                                            <ul class="dropdown-menu from dropdown-menu-hover-info" aria-hidden="true" aria-haspopup="true" aria-expanded="false">
                                                <?php

                                                $q = "SELECT place from route WHERE cid=" . $cid;
                                                $con = mysqli_connect("localhost", "root", "", "nuvshare1");
                                                $re = mysqli_query($con, $q) or dir(mysqli_connect_error());
                                                while ($row = mysqli_fetch_array($re)) {
                                                    echo "<li class='dropdown-item'><a href='#' style='color:black;text-decoration:none;'>" . $row['place'] . "</a></li>";
                                                }

                                                ?>
                                            </ul>
                                        </div>
                                        <div class="dropdown d-inline-block">
                                            <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mt-3 mb-3 mr-2 dropdown-toggle btn btn-info p-2" id="to">To
                                            </button>
                                            <ul class="dropdown-menu to dropdown-menu-hover-info" aria-hidden="true" aria-haspopup="true" aria-expanded="false">
                                                <?php

                                                $q = "SELECT place from route WHERE cid=" . $cid;
                                                $con = mysqli_connect("localhost", "root", "", "nuvshare1");
                                                $re = mysqli_query($con, $q) or dir(mysqli_connect_error());
                                                while ($row = mysqli_fetch_array($re)) {
                                                    echo "<li class='dropdown-item'><a href='#' style='color:black;text-decoration:none;'>" . $row['place'] . "</a></li>";
                                                }

                                                ?>
                                            </ul>
                                        </div>
                                        <div class="form-group">
                                            <div>
                                                Number of Seats to be booked: <select style="width:220px" class="custom-select">
                                                    <?php

                                                    for ($i = 1; $i <= $vacancy; $i++) {
                                                        echo "<option value='.$i.'>" . $i . "</option>";
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div>
                                                <input class="mb-2 mr-2 btn-hover-shine btn btn-info btn-wide" type="submit" name="submit" value="Request" />
                                            </div>
                                        </div>
                                </form>
                    <?php } else {
                                            echo "<h3><small> The carpool has been archived, you can get to know more about this carpool by contacting the rider </small></p>";
                                        }
                                    }
                                } else {
                                    echo ("<p align='center'>Looks like you have entered an URL you shouldn't have!Please go back to previous page</p>\n");
                                } ?>
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
<?php
$p = "SELECT "


?>

<script type="text/javascript">
    //<![CDATA[
    $(".from li a").click(function() {

        $("#from").html($(this).text() + "&nbsp<span class='caret'></span>");
        $("#formfrom").val($(this).text());


    });

    $(".to li a").click(function() {

        $("#to").html($(this).text() + "&nbsp<span class='caret'></span>");
        $("#formto").val($(this).text());


    });

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

        <?php
        if (isset($_GET['id'])) {
            echo "var RouteData=new Array();";
            $q = "SELECT place from route WHERE cid=" . $_GET['id'];
            $con = mysqli_connect("localhost", "root", "", "nuvshare1");
            $re = mysqli_query($con, $q) or dir(mysqli_connect_error());
            while ($row = mysqli_fetch_array($re)) {



                echo 'RouteData.push({location:"' . $row["place"] . '",stopover:true});';
            }

            $w = "SELECT * FROM offers WHERE id=" . $_GET['id'];
            $con = mysqli_connect("localhost", "root", "", "nuvshare1");
            $r = mysqli_query($con, $w);
            $row = mysqli_fetch_array($r);

            $from = $row['from'];
            $to = $row['to'];
            echo "calcRoute('" . $from . "','" . $to . "',RouteData);";
        }

        ?>
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

    $('#add').click(function() {
        var nameName = "dynamic" + i;
        $('<div><input type="text"data-provide="typeahead"   class="field" placeholder="Hop " +"' + i + '" name="' + nameName + '"   value="" /></div>').fadeIn('slow').appendTo('.inputs');

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