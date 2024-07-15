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
                if (isset($_GET['share']))
                    echo ("<div class=\"alert alert-info\">\nYour Ride was succesfully added! You can edit it from your profile\n</div>");
                else if (isset($_GET['success']))
                    echo ("<div class=\"alert alert-success\">\nYour request has been sent to  the Rider for approval, You may expect a call soon!.\n</div>");

                else if (isset($_GET['nerror']))
                    echo ("<div class=\"alert alert-error\">\nPlease enter all the details asked before you can continue!\n</div>");
                ?>
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
                                        <label for="" class="font-weight-bold">Vehicle Type</label>
                                        <div>
                                            <div class="custom-checkbox custom-control custom-control-inline">
                                                <input type="checkbox" id="twowheels" class="custom-control-input" value="Two-wheeler">
                                                <label class="custom-control-label" for="twowheels">Two-Wheeler</label>
                                            </div>
                                            <div class="custom-checkbox custom-control custom-control-inline">
                                                <input type="checkbox" id="cars" class="custom-control-input" value="Car">
                                                <label class="custom-control-label" for="cars">Car</label>
                                            </div>
                                            <div class="custom-checkbox custom-control custom-control-inline">
                                                <input type="checkbox" id="taxi" class="custom-control-input" value="Auto">
                                                <label class="custom-control-label" for="taxi">Auto/Taxi</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="mb-2 mr-2 btn-hover-shine btn btn-info btn-wide btn-lg" name="signup" value="Search">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6 h-100">
                        <div class="card-hover-shadow-2x mb-3 card">
                            <div class="card-header-tab card-header">
                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                    <i class="header-icon fa-solid fa-car" style="color: #16aaff;"></i>
                                    Latest Car Pools
                                </div>
                            </div>

                            <div class="p-0 card-body">
                                <table class="mb-0 table table-hover" id="upcomingList">
                                    <thead>
                                        <tr>
                                            <th>Vehicle Type</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Starting Time</th>
                                            <th>Connection Type</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $today = date("Y-m-d H:i:s");
                                        $query = "SELECT `id`, `from` , `to` , `uptime` , `vehicle` from offers where uptime > '" . $today . "'";
                                        $con = mysqli_connect("localhost", "root", "", "nuvshare1");
                                        $result = mysqli_query($con, $query);
                                        if (mysqli_num_rows($result) == 0) {
                                            echo ("<p align='center'>No Upcoming car pools are scheduled currently :( </p>\n");
                                        } else {
                                            while ($row = mysqli_fetch_array($result)) {
                                                echo "<tr><td>" . $row['id'] . "</td><td>" . $row['vehicle'] . "</td><td>" . $row['from'] . "</td><td>" . $row['to'] . "</td><td>" . $row['uptime'] . "</td></tr>";
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
<script>
    $('td:nth-child(1),th:nth-child(1)').hide();
    $('#upcomingList').find('tr').click(function() {
        var row = $(this).find('td:first').text();
        window.location.href = "ride2.php?id=" + row;
    });
</script>

</html>