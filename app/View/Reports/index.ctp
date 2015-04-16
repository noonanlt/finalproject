<!-- Project Title: Work Order Management System

Author: Logan Noonan, Michael Fesser, Andrew Reid, Roger Myers

Date:  02/17/2015

Purpose: Reports view.

Last Revision: 02/17/2015

Dependencies: Controller.ReportsController.php, Model.Report.php, Controller.TicketsController.php, Model.Ticket.php

-->
<div class="tickets view">
    <h2><?php echo __('Reports'); ?></h2>
    <?php

    $resolvedCounter = 0;
    $pendingCounter = 0;
    $computerServiceCounter = 0;
    $FacilitiesCounter = 0;
    $StudentServicesCounter = 0;

    foreach ($tickets as $ticket) {
        if ($ticket['Report']['ticket_status_code'] == 0) {
            $resolvedCounter++;
        } else {
            $pendingCounter++;
        }

        if ($ticket['Report']['department_id'] == 1) {
            $computerServiceCounter++;
        } else if ($ticket['Report']['department_id'] == 2) {
            $FacilitiesCounter++;
        } else {
            $StudentServicesCounter++;
        }
    }
    ?>
    <hr>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
        google.load("visualization", "1", {packages: ["corechart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {

            var jsResolved = <?php echo $resolvedCounter; ?>;
            var jsPending = <?php echo $pendingCounter; ?>;

            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Resolved', jsResolved],
                ['Pending', jsPending]
            ]);

            var options = {
                title: 'Tickets Resolved',
                is3D: true
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }
    </script>

    <script type="text/javascript">
        google.load("visualization", "1", {packages: ["corechart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {

            var jsCompCounter = <?php echo $computerServiceCounter; ?>;
            var jsFacCounter = <?php echo $FacilitiesCounter; ?>;
            var jsStudCounter = <?php echo $StudentServicesCounter; ?>;

            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Computer Services', jsCompCounter],
                ['Facilities', jsFacCounter],
                ['Student Services', jsStudCounter]
            ]);

            var options = {
                title: 'Tickets Per Department',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart2_3d'));
            chart.draw(data, options);
        }
    </script>


    <div id="piechart_3d" style="width: 100%; height: auto;"></div>
    <hr>
    <div id="piechart2_3d" style="width: 100%; height: auto;"></div>

</div>
