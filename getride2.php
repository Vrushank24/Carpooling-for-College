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
$title = "Get Ride";
$pg = 3;
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
                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                        <div class="mb-3 card">
                            <div class="card-header-tab card-header">
                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                    <i class="header-icon fa-solid fa-search" style="color: #16aaff;"></i>
                                    Search for a Ride
                                </div>
                            </div>
                            <div class="p-0 card-body">
                                <form class="col-md-10 mx-auto" method="post" action="getride2.php">
                                    <?php if (isset($_POST['action'])) { ?>
                                        <input type="hidden" name="action" value="search" />
                                        <div class="form-group">
                                            <div>
                                                <input type="text" class="form-control mt-4" value="<?php echo $_POST['from'] ?>" data-provide="typeahead" id="src" name="from" placeholder="Source" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div>
                                                <input type="text" class="form-control" value="<?php echo $_POST['to'] ?>" data-provide="typeahead" id="dest" name="to" placeholder="Destination" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="font-weight-bold">Time Range for hoping in your ride: </label>
                                            <div>
                                                <input type="datetime-local" class="form-control" value="<?php echo $_POST['uptime'] ?>" placeholder="Start Time" name="uptime">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div>
                                                <input type="datetime-local" class="form-control" value="<?php echo $_POST['downtime'] ?>" placeholder="End Time" name="downtime">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div>
                                                <div class="custom-checkbox custom-control custom-control-inline">
                                                    <input type="checkbox" id="twowheels" class="custom-control-input" value="Two-wheeler" name="taxi">
                                                    <label class="custom-control-label" for="twowheels">Two-Wheeler</label>
                                                </div>
                                                <div class="custom-checkbox custom-control custom-control-inline">
                                                    <input type="checkbox" id="cars" class="custom-control-input" value="Car" name="car">
                                                    <label class="custom-control-label" for="cars">Car</label>
                                                </div>
                                                <div class="custom-checkbox custom-control custom-control-inline">
                                                    <input type="checkbox" id="taxi" class="custom-control-input" value="Auto" name="auto">
                                                    <label class="custom-control-label" for="taxi">Auto/Taxi</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="mb-2 mr-2 btn-hover-shine btn btn-info btn-wide btn-lg" name="signup" value="Search">Search</button>
                                        </div>
                                </form>
                            <?php } else { ?>
                                <form class="col-md-10 mx-auto" method="post" action="getride2.php">
                                    <?php if (isset($_POST['action'])) ?>
                                    <input type="hidden" name="action" value="search" />
                                    <div class="form-group">
                                        <div>
                                            <input type="text" class="form-control mt-4" data-provide="typeahead" id="src" name="from" placeholder="Source" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <input type="text" class="form-control" data-provide="typeahead" id="dest" name="to" placeholder="Destination" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="font-weight-bold">Time Range for hoping in your ride: </label>
                                        <div>
                                            <input type="datetime-local" class="form-control" placeholder="Start Time" name="uptime">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <input type="datetime-local" class="form-control" placeholder="End Time" name="downtime">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <div class="custom-checkbox custom-control custom-control-inline">
                                                <input type="checkbox" id="twowheels" class="custom-control-input" value="Two-wheeler" name="taxi">
                                                <label class="custom-control-label" for="twowheels">Two-Wheeler</label>
                                            </div>
                                            <div class="custom-checkbox custom-control custom-control-inline">
                                                <input type="checkbox" id="cars" class="custom-control-input" value="Car" name="car">
                                                <label class="custom-control-label" for="cars">Car</label>
                                            </div>
                                            <div class="custom-checkbox custom-control custom-control-inline">
                                                <input type="checkbox" id="taxi" class="custom-control-input" value="Auto" name="auto">
                                                <label class="custom-control-label" for="taxi">Auto/Taxi</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="mb-2 mr-2 btn-hover-shine btn btn-info btn-wide btn-lg" name="signup" value="Search">Search</button>
                                    </div>
                                </form>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6 h-100">
                        <div class="card-hover-shadow-2x mb-3 card">
                            <div class="card-header-tab card-header">
                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                <i class="header-icon fa-solid fa-car" style="color: #16aaff;"></i>
                                    Search Result
                                </div>
                            </div>

                            <div class="p-0 card-body">
                                <table class="mb-0 table table-hover" id="upcomingList">
                                    <thead>
                                        <tr>
                                            <th>Vehicle Type</th>
                                            <th>Vehicle Type</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Starting Time</th>
                                            <th>Connection Type</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($_POST['action'])) {
                                            $from = $_POST['from'];
                                            $to = $_POST['to'];
                                            $uptime = $_POST['uptime'];
                                            $downtime = $_POST['downtime'];
                                            $taxi = 0;
                                            $car = 0;
                                            $auto = 0;
                                            if (isset($_POST['taxi'])) $taxi = 1;
                                            if (isset($_POST['car'])) $car = 1;
                                            if (isset($_POST['auto'])) $auto = 1;

                                            $query = "SELECT r1.cid from route r1 INNER JOIN route r2 ON r1.place='" . $from . "' AND r2.place='" . $to . "' AND r1.serialno < r2.serialno AND r1.cid=r2.cid";
                                            $host = "localhost";
                                            $user = "root";
                                            $password = "";
                                            $database = "nuvshare1";
                                            $con = mysqli_connect($host, $user, $password, $database);
                                            $result = mysqli_query($con, $query) or die(mysqli_connect_error());

                                            if (mysqli_num_rows($result) == 0) {
                                                echo ("<p align='center'>No Upcoming car pools match your request :( </p>\n");
                                            } else {
                                                $query = "SELECT r1.cid from route r1 INNER JOIN route r2 ON r1.place='" . $from . "' AND r2.place='" . $to . "' AND r1.serialno < r2.serialno AND r1.cid=r2.cid";
                                                $result = mysqli_query($con, $query) or die(mysqli_connect_error());

                                                while ($row = mysqli_fetch_array($result)) {
                                                    $query2 = "SELECT `id`,`vehicle`,`from`,`to`,`uptime` from offers WHERE id='" . $row['cid'] . "' AND `uptime` >='" . $_POST['uptime'] . "' AND `uptime` <='" . $_POST['downtime'] . "'";
                                                    $res = mysqli_query($con, $query2) or die(mysqli_connect_error());
                                                    if (mysqli_num_rows($res) == 0) {
                                                    } else {
                                                        $result2 = mysqli_fetch_array($res);

                                                        echo "<tr><td>" . $result2['id'] . "</td><td>" . $result2['vehicle'] . "</td><td>" . $result2['from'] . "</td><td>" . $result2['to'] . "</td><td>" . $result2['uptime'] . "</td>";
                                                        if ($from == $result2['from'] && $to == $result2['to']) {
                                                            echo "<td>Direct</td></tr>";
                                                        } else {
                                                            echo "<td>Via</td></tr>";
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
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
<script type="text/javascript">
    $('#uptimepicker').datetimepicker({
        format: 'yyyy-MM-dd hh:mm:ss',
    });
    $('#downtimepicker').datetimepicker({
        format: 'yyyy-MM-dd hh:mm:ss',
    });


    $('td:nth-child(1),th:nth-child(1)').hide();
    $('#upcominglist').find('tr').click(function() {
        var row = $(this).find('td:first').text();
        window.location.href = "ride.php?id=" + row;
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
echo "</script>" ?>

</html>