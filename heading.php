<?php

// include("functions.php");
$email = $_SESSION['username'];
$query = "SELECT * from users where email='" . $email . "'";
$uid = getUserid();
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
<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
    <div class="app-header header-shadow">
        <div class="app-header__logo">
            <div class="logo-src"></div><span class="bg-info" style="font-family: 'Freeman', sans-serif; font-optical-sizing: auto;font-weight: 400;font-style: normal;font-size:20px">NUVSHARE</span>
            <div class="header__pane ml-auto">
                <div>
                    <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                        <span class="hamburger-box" style="color:#16aaff">
                            <span class="hamburger-inner" ></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="app-header__mobile-menu">
            <div>
                <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                    <span class="hamburger-box" style="color:#16aaff">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
        <div class="app-header__menu">
            <span>
                <button type="button" class="btn-icon btn-icon-only btn btn-info btn-sm mobile-toggle-header-nav">
                    <span class="btn-icon-wrapper">
                        <i class="fa fa-ellipsis-v fa-w-6"></i>
                    </span>
                </button>
            </span>
        </div>
        <div class="app-header__content">
            <div class="app-header-right">
                <div class="header-btn-lg pr-0">
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="btn-group">
                                    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                        <!-- <img width="42" class="rounded-circle" src="assets/images/avatars/1.jpg" alt=""> -->
                                        <span class="rounded-circle font-size-lg bg-deep-blue p-2"><?php echo strtoupper(substr($name, 0, 1)) ?></span>
                                        <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                    </a>
                                    <div tabindex="-1" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-menu-header">
                                            <div class="dropdown-menu-header-inner bg-info">
                                                <!-- <div class="menu-header-image opacity-2" style="background-image: url('assets/images/dropdown-header/city3.jpg');"></div> -->
                                                <div class="menu-header-content text-left">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <!-- <img width="42" class="rounded-circle" src="assets/images/avatars/1.jpg" alt=""> -->
                                                                <span class="rounded-circle font-size-lg bg-deep-blue p-3"><?php echo strtoupper(substr($name, 0, 1)) ?></span>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading"><?php echo ucfirst($name) ?></div>
                                                            </div>
                                                            <div class="widget-content-right mr-2">
                                                                <a href="logout.php" class="btn-pill btn-shadow btn-shine btn btn-focus">Logout</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="scroll-area-xs" style="height: 300px;">
                                            <div class="scrollbar-container ps">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item-header nav-item">My Account
                                                    </li>
                                                    <li class="nav-item">
                                                        <span class="nav-link">Email
                                                            <div class="ml-auto font-weight-bold"><?php echo $email ?></div>
                                                        </span>
                                                    </li>
                                                    <li class="nav-item">
                                                        <span class="nav-link">Gender
                                                            <div class="ml-auto font-weight-bold"><?php echo ucfirst($sex) ?></div>
                                                        </span>
                                                    </li>
                                                    <li class="nav-item">
                                                        <span class="nav-link">Contact No.
                                                            <div class="ml-auto font-weight-bold"><?php echo $contact ?></div>
                                                        </span>
                                                    </li>
                                                    <li class="nav-item">
                                                        <span class="nav-link">Credits
                                                            <div class="ml-auto font-weight-bold"><?php echo $credits ?></div>
                                                        </span>
                                                    </li>
                                                    <li class="nav-item">
                                                        <span class="nav-link">Badge
                                                            <div class="ml-auto badge badge-success"><?php echo $badge ?></div>
                                                        </span>
                                                    </li>
                                                </ul>
                                                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                                </div>
                                                <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="nav flex-column">
                                            <li class="nav-item-divider mb-0 nav-item"></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content-left  ml-3 header-user-info">
                                <div class="widget-heading"> <?php echo ucfirst($name) ?> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ui-theme-settings">
        <button type="button" id="TooltipDemo" class="btn-open-options btn btn-warning">
            <i class="fa fa-cog fa-w-16 fa-spin fa-2x"></i>
        </button>
    </div>
    <div class="app-main">
        <div class="app-sidebar sidebar-shadow">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-info btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="scrollbar-sidebar">
                <div class="app-sidebar__inner">
                    <ul class="vertical-nav-menu">
                        <li class="app-sidebar__heading" style="color:#16aaff">Menu</li>
                        <li class="<?php echo ($pg == 1) ? "mm-active" : "" ?>">
                            <a href="index2.php">
                                <i class="metismenu-icon fa-solid fa-car"></i>&nbsp;Home
                            </a>
                        </li>
                        <li class="<?php echo ($pg == 2) ? "mm-active" : "" ?>">
                            <a href="shareride2.php">
                                <i class="metismenu-icon fa-solid fa-map-location-dot"></i>&nbsp;Share Your Ride
                            </a>
                        </li>
                        <li class="<?php echo ($pg == 3) ? "mm-active" : "" ?>">
                            <a href="getride2.php">
                                <i class="metismenu-icon fa-solid fa-location-crosshairs"></i>&nbsp;Get Ride
                            </a>
                        </li>
                        <li class="<?php echo ($pg == 4) ? "mm-active" : "" ?>">
                            <a href="notification2.php">
                                <i class="metismenu-icon fa-solid fa-bell"></i>&nbsp;Notifications
                            </a>
                        </li>
                        <li class="<?php echo ($pg == 5) ? "mm-active" : "" ?>">
                            <a href="leaderboard2.php">
                                <i class="metismenu-icon fa-solid fa-users"></i>&nbsp;Leaderboard
                            </a>
                        </li>
                        <li class="<?php echo ($pg == 6) ? "mm-active" : "" ?>">
                            <a href="profile2.php">
                                <i class="metismenu-icon fa-solid fa-user"></i>&nbsp;Profile
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>