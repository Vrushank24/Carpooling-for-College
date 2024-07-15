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
$userId = getUserid();
//$userId ="1"; 
$con = mysqli_connect("localhost", "root", "", "nuvshare1");
$query = 'SELECT * from notifications WHERE receiver="' . $userId . '" ORDER BY timestamp DESC;';
$result = mysqli_query($con, $query) or die("error!!!");
?>

<?php
$title = "Notifications";
$pg = 4;
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
                <div class="card mb-3">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="header-icon fa-solid fa-comments" style="color: #16aaff;"></i>Notifications
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered dataTable dtr-inline" role="grid" aria-describedby="example_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 255.2px;" aria-sort="ascending" aria-label="Time: activate to sort column descending">Time</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 387.2px;" aria-label="Car Pool Details: activate to sort column ascending">Car Pool Details</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 188.2px;" aria-label="Notification Type: activate to sort column ascending">Notification Type</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 107.2px;" aria-label="Action: activate to sort column ascending">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            while ($row = mysqli_fetch_array($result)) {
                                                $type = $row["type"];
                                                if ($i % 2 == 0) {
                                                    echo "<tr role='row' class='even'>";
                                                } else {
                                                    echo "<tr role='row' class='even'>";
                                                }
                                                echo '<td class="sorting_1 dtr-control">' . $row["timestamp"] . '</td>';
                                                $i += 1;
                                                if ($type == "1") {
                                                    // Request from sender to apporve his car pool request
                                                    $query = 'SELECT * from offers WHERE id="' . $row["cid"] . '";';
                                                    $con = mysqli_connect("localhost", "root", "", "nuvshare1");
                                                    $result1 = mysqli_query($con, $query) or die("error!!");
                                                    $carPoolRow = mysqli_fetch_array($result1);
                                                    echo '<td>' . $carPoolRow["from"] . '=>' . $carPoolRow["to"] . '</td>';
                                                    echo '<td>Approve Request</td>';
                                                    $status = $row["status"];
                                                    $cid = $row["cid"];
                                                    $slno = $row["slno"];
                                                    $sender = $row["sender"];
                                                    if ($status == "Approved") {
                                                        echo '<td><button class="btn" disabled  >Approved</button><td>';
                                                    } else if ($status == "Declined") {

                                                        echo '<td><button class="btn" disabled >Declined</button></td>';
                                                    } else {
                                                        $funcAgrsApp = '"ApproveRequest(' . $slno . ',1)"';
                                                        $funcAgrsDec = '"ApproveRequest(' . $slno . ',0)"';
                                                        echo '<td><button class="mb-2 mr-2 btn btn-info"  onclick=' . $funcAgrsApp . '>Approve</button> 
                                                                <button onclick=' . $funcAgrsDec . 'class="mb-2 mr-2 btn btn-info" >Decline</button></td>';
                                                    }
                                                } else if ($type == "2") {
                                                    $query = 'SELECT * from offers WHERE id="' . $row["cid"] . '";';
                                                    $result1 = mysqli_query($con, $query) or die("error!!");
                                                    $carPoolRow = mysqli_fetch_array($result1);
                                                    $slno = $row["slno"];
                                                    echo '<td>' . $carPoolRow["from"] . '=>' . $carPoolRow["to"] . '</td>';
                                                    $status = $row["status"];
                                                    echo '<td>Feedback</td>';
                                                    if ($status != "") {
                                                        echo '<td>' . $status . '/5<td>';
                                                    } else {
                                            ?>
                                                        <td>

                                                            <div class="btn-group">
                                                                <button id="fartDropDown" class="btn dropdown-toggle" data-toggle="dropdown">Rating <span class="caret"></span></button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a href="#">1</a></li>
                                                                    <li><a href="#">2</a></li>
                                                                    <li><a href="#">3</a></li>
                                                                    <li><a href="#">4</a></li>
                                                                    <li><a href="#">5</a></li>
                                                                </ul>
                                                            </div><!-- /btn-group -->
                                                <?php
                                                        $funcAgrsRate = '"RateRequest(' . $slno . ')"';
                                                        echo '<button class="btn"  onclick=' . $funcAgrsRate . '>Submit</button> ';
                                                        echo '</td>';
                                                    }
                                                } else if ($type == "3") {
                                                    $query = 'SELECT * from offers WHERE id="' . $row["cid"] . '";';
                                                    $con = mysqli_connect("localhost", "root", "", "nuvshare1");
                                                    $result1 = mysqli_query($con, $query) or die("error!!");
                                                    $carPoolRow = mysqli_fetch_array($result1);
                                                    $status = $row["status"];
                                                    $cid = $row["cid"];
                                                    $slno = $row["slno"];
                                                    $sender = $row["sender"];
                                                    echo '<td>' . $carPoolRow["from"] . '=>' . $carPoolRow["to"] . '</td>';
                                                    echo '<td>Request Status</td>';
                                                    if ($status == "Approved") {
                                                        echo '<td>Approved, Enjoy the Ride</td>';
                                                    } else if ($status == "Declined") {
                                                        echo '<td>Declined, :-(</td>';
                                                    } else {
                                                        echo '<script>alert("Uhhh ohhh")</script>';
                                                    }
                                                } else if ($type == "4") {
                                                    $query = 'SELECT * from offers WHERE id="' . $row["cid"] . '";';
                                                    $result1 = mysqli_query($con, $query) or die("error!!");
                                                    $carPoolRow = mysqli_fetch_array($result1);
                                                    $status = $row["status"];
                                                    $cid = $row["cid"];
                                                    $slno = $row["slno"];
                                                    $sender = $row["sender"];
                                                    echo '<td>' . $carPoolRow["from"] . '=>' . $carPoolRow["to"] . '</td>';
                                                    echo '<td>Request Status</td>';
                                                    echo '<td>Still pending with the rider, Please Come again later</td>';
                                                }
                                                echo '</tr>';
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
        </div>
        <div class="app-wrapper-footer">

            <div class="app-drawer-overlay d-none animated fadeIn"></div>
            <script type="text/javascript" src="assets/scripts/main.d810cf0ae7f39f28f336.js"></script>
</body>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
    $(".dropdown-menu li a").click(function() {
        var selText = $(this).text();
        $('#fartDropDown').html(selText);

    });

    function RateRequest(slno) {
        $rating = $('#fartDropDown').html();
        $.post("updateDBNotifications.php", {
                type: "2",
                serialNo: slno,
                rating: $rating
            })
            .done(function(data) {
                //alert("Data Loaded: " + data);
                location.reload();
            }); // alert($rating);

    }

    function ApproveRequest(slno, stat) {
        if (stat == "0") {

            $.post("updateDBNotifications.php", {
                    type: "1",
                    serialNo: slno,
                    stat: "Declined"
                })
                .done(function(data) {
                    //alert("Data Loaded: " + data);
                    location.reload();
                });
        } else if (stat == "1") {
            $.post("updateDBNotifications.php", {
                    type: "1",
                    serialNo: slno,
                    stat: "Approved"
                })
                .done(function(data) {
                    //alert("Data Loaded: " + data);
                    location.reload();
                });
        } else {
            alert("Random error , stat doesnot match");
        }
    }

    $('.dropdown-toggle').dropdown();
</script>

</html>