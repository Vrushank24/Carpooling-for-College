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
$title = "Profile";
$pg = 6;
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
                <?php if (isset($_GET['id'])) {
                    $query = "SELECT * from users where uid=" . $_GET['id'];
                    $uid = $_GET['id'];
                } else {
                    $email = $_SESSION['username'];
                    $query = "SELECT * from users where email='" . $email . "'";
                    $uid = getUserid();
                }
                $con = mysqli_connect("localhost", "root", "", "nuvshare1");
                $res = mysqli_query($con, $query);
                $fetch = mysqli_fetch_array($res);
                $name = $fetch['name'];
                $email = $fetch['email'];
                $gender = $fetch['gender'];
                $contact = $fetch['contactno'];
                $desc = $fetch['description'];
                $credits = $fetch['credits'];
                $badge = "Newbie in town";
                $rank = "SELECT * from users ORDER BY credits DESC";
                $resul = mysqli_query($con, $rank);
                $num = mysqli_num_rows($resul);
                $top = $num / 3;
                $middle = $top * 2;
                $i = 1;
                while ($row = mysqli_fetch_array($resul)) {
                    if ($row['uid'] == $uid) {
                        if ($i <= $top) {
                            $badge = "Trusted Car Pooler";
                        } else if ($i <= $middle) {
                            $badge = "Budding Car Pooler";
                        } else {
                            $badge = "Newbie in town";
                        }
                    }
                    $i++;
                }
                if ($gender == "M") $sex = "Male";
                else $sex = "Female";
                ?>
                <div class="col-md-12 col-lg-6 col-xl-12">
                    <div class="card-shadow-primary card-border mb-3 card">
                        <div class="dropdown-menu-header">
                            <div class="dropdown-menu-header-inner bg-dark">
                                <div class="menu-header-content">
                                    <div class="avatar-icon-wrapper mb-3 avatar-icon-xl">
                                        <div class="mt-2 mb-2">
                                            <span class="rounded-circle font-size-lg bg-deep-blue p-4"><?php echo strtoupper(substr($name, 0, 1)) ?></span>
                                        </div>
                                    </div>
                                    <div>
                                        <h5 class="menu-header-title"><?php echo $name; ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3">
                            <div class="position-relative form-group">
                                <label for="exampleEmail" class="display-6">Email</label>
                                <input name="email" id="exampleEmail" disabled value="<?php echo $email; ?>" placeholder="with a placeholder" type="email" class="form-control w-50">
                            </div>
                            <div class="position-relative form-group">
                                <label for="exampleEmail" class="display-6">Gender</label>
                                <input name="email" id="exampleEmail" disabled value="<?php echo $sex; ?>" placeholder="with a placeholder" type="email" class="form-control w-50">
                            </div>
                            <div class="position-relative form-group">
                                <label for="exampleEmail" class="display-6">Contact</label>
                                <input name="email" id="exampleEmail" disabled value="<?php echo $contact; ?>" placeholder="with a placeholder" type="email" class="form-control w-50">
                            </div>
                            <div class="position-relative form-group">
                                <label for="exampleEmail" class="display-6">Description</label>
                                <input name="email" id="exampleEmail" disabled value="<?php echo $desc; ?>" placeholder="with a placeholder" type="email" class="form-control w-50">
                            </div>
                            <div class="position-relative form-group">
                                <label for="exampleEmail" class="display-6">Carbon Credits</label>
                                <input name="email" id="exampleEmail" disabled value="<?php echo $credits; ?>" placeholder="with a placeholder" type="email" class="form-control w-50">
                            </div>
                            <div class="position-relative form-group">
                                <label for="exampleEmail" class="display-6">Badge</label>
                                <input name="email" id="exampleEmail" disabled value="<?php echo $badge; ?>" placeholder="with a placeholder" type="email" class="form-control w-50">
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