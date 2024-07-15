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
$title = "Leaderboard";
$pg = 5;
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
                else if (isset($_GET['nerror']))
                    echo ("<div class=\"alert alert-error\">\nPlease enter all the details asked before you can continue!\n</div>");
                ?>
                <div class="card mb-3">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="header-icon fa-solid fa-users-line" style="color: #16aaff;"></i>Leaderboard
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered dataTable dtr-inline" role="grid" aria-describedby="example_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 255.2px;" aria-sort="ascending" aria-label="Username: activate to sort column descending">Username</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 387.2px;" aria-label="Carbon Credits: activate to sort column ascending">Carbon Credits</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "SELECT * from users ORDER BY credits DESC";
                                            $con = mysqli_connect("localhost", "root", "", "nuvshare1");
                                            $result = mysqli_query($con, $query);
                                            $i = 0;
                                            while ($row = mysqli_fetch_array($result)) {
                                                if ($i % 2 == 0) {
                                                    echo '<tr role="row" class="even"><td>' . $row['name'] . '</td><td>' . $row['credits'] . '</td></tr>';
                                                } else {
                                                    echo '<tr role="row" class="odd"><td>' . $row['name'] . '</td><td>' . $row['credits'] . '</td></tr>';
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
        window.location.href = "ride.php?id=" + row;
    });
</script>

</html>