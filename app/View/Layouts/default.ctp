<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'W.O.M.S.');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $cakeDescription ?>:
        <?php echo $this->fetch('title'); ?>
    </title>
    <link href='http://fonts.googleapis.com/css?family=Bitter' rel='stylesheet' type='text/css'/>
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'/>
    <?php
    //fetching dependencies and css
    echo $this->Html->meta('icon');

    echo $this->Html->css('bootstrap.min');
    echo $this->Html->css('navbar');
    echo $this->Html->css('simple-sidebar');
    echo $this->Html->css('style');
    echo $this->Html->css('cake.generic');

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
</head>
<body>
<!-- navbar header -->
<div id="header">
    <nav class="navbar navbar-custom" role="navigation">
        <div id="navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand index-link heading" href="/finalproject2261/tickets"><span
                            class="glyphicon glyphicon-home"
                            aria-hidden="true"></span> Work Order
                        Management System</a>
                </div>
                <div id="userNameWell">
                    <?php if ($loggedIn === true) echo "<span class='glyphicon glyphicon-user'
                                                                              aria-hidden='true'></span> " . $userName; ?>
                </div>
            </div>
        </div>
</div>
<div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <?php if ($loggedIn === true) { ?>
                <!-- Navigation pane -->
                <li>
                    <span class="heading">NAVIGATION</span>
                </li>
                <li>
                    <a href="/finalproject2261/tickets/myTickets"><span class="glyphicon glyphicon-tags"
                                                                        aria-hidden="true"></span> My Tickets</a>
                </li>
                <?php if ($userAuth == 2) { ?>
                    <li>
                        <a href="/finalproject2261/tickets/deptTickets"><span class="glyphicon glyphicon-inbox"
                                                                              aria-hidden="true"></span> Department
                            Tickets</a>
                    </li>
                <?php } ?>
                <?php if ($userAuth == 1) { ?>
                    <li>
                        <a href="/finalproject2261/tickets/"><span class="glyphicon glyphicon-inbox"
                                                                   aria-hidden="true"></span> All Tickets</a>
                    </li>
                    <li>
                        <a href="/finalproject2261/reports"><span class="glyphicon glyphicon-stats"
                                                                  aria-hidden="true"></span> Reports</a>
                    </li>
                <?php }
            } ?>
            <!-- Actions pane -->
            <li>
                <span class="heading">ACTIONS</span>
            </li>
            <?php if ($loggedIn === false) { ?>
                <li>
                    <a href="/finalproject2261/users/add"><span class="glyphicon glyphicon-plus-sign"
                                                                aria-hidden="true"></span> Register</a>
                </li>
                <li>
                    <a href="/finalproject2261/users/login/"><span class="glyphicon glyphicon-log-in"
                                                                   aria-hidden="true"></span> Login</a>
                </li>
            <?php } else if ($loggedIn === true) { ?>
                <li>
                    <a href="/finalproject2261/tickets/add/"><span class="glyphicon glyphicon-share-alt"
                                                                   aria-hidden="true"></span> Submit Ticket</a>
                </li>
                <?php if ($userAuth == 1) { ?>
                    <li>
                        <a href="/finalproject2261/users/"><span class="glyphicon glyphicon-cog"
                                                                 aria-hidden="true"></span> Manage Users</a>
                    </li>
                <?php } ?>
                <li>
                    <a href="/finalproject2261/users/edit/<?php echo $userId; ?>"><span class="glyphicon glyphicon-edit"
                                                                                        aria-hidden="true"></span>
                        Manage My Account</a>
                </li>
                <li>
                    <a href="/finalproject2261/users/logout/"><span class="glyphicon glyphicon-log-out"
                                                                    aria-hidden="true"></span> Logout</a>
                </li>
            <?php } ?>

        </ul>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div id="content">

                        <?php echo $this->Session->flash(); ?>
                        <?php echo $this->fetch('content'); ?>
                    </div>
                </div>
            </div>
        </div>


        <!-- /#page-content-wrapper -->
        <div id="footer">
            <div class="col-xs-5"></div>
            <div class="col-xs-3"><p>The Zone Development &copy2015</p></div>
            <div class="col-xs-5"></div>
        </div>
        <!--<?php echo $this->element('sql_dump'); ?>-->
    </div>
</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>

</html>
