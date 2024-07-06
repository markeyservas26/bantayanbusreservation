<?php
    include('includes/layout-header.php');

    $route_from = isset($_GET['route_from']) && !empty($_GET['route_from']) ? $_GET['route_from'] : "";
    $route_to = isset($_GET['route_to']) && !empty($_GET['route_to']) ? $_GET['route_to'] : "";
    $schedule_date = isset($_GET['schedule_date']) && !empty($_GET['schedule_date']) ? $_GET['schedule_date'] : "";

    if(empty($route_from) || empty($route_to) || empty($schedule_date)){
        header('Location: index.php');
    }else{
        include('controllers/db.php');
        include('controllers/bus.php');
        include('controllers/schedule.php');
        include('controllers/route.php');
        include('controllers/location.php');
        
        include('controllers/driver.php');

        $database = new Database();
        $db = $database->getConnection();

        $new_location = new Location($db);
        $locations = $new_location->getAll();
        $location_from = $new_location->getByLocation($route_from);
        $location_to = $new_location->getByLocation($route_to);

        $new_route = new Route($db);
        $route = $new_route->getByFromTo($location_from["id"], $location_to["id"]);
    }
?>

<main>
    <div style="background-color: #ffc432" class="d-flex align-items-center justify-content-center p-4">
        <?php include("includes/forms/schedule-form.php") ?>
    </div>

    <div class="container mt-3">
        <?php
            if(empty($route["id"])){
                echo '<div class="alert alert-danger" role="alert">
                    No schedule available. Please choose another date or try editing your search details.
                </div>';
            }else{
                $new_schedule = new Schedule($db);
                $schedules = $new_schedule->findSchedule($route["id"], $schedule_date);

                if(count($schedules) == 0){
                    echo '<div class="alert alert-danger" role="alert">
                        No schedule available. Please choose another date or try editing your search details.
                    </div>';
                }else{
                    ?>
                        

                        <!-- <div class="row p-2 bg-white">
                            <div class="col-md-2"><b>Date</b></div>
                            <div class="col-md-2"><b>Bus No.</b></div>
                            <div class="col-md-2"><b>Departure Time</b></div>
                            <div class="col-md-2"><b>Estimated Arrival Time</b></div>
                            <div class="col-md-2"><b>Fare</b></div>
                            <div class= "col-md-2"><b>Status</b></div>
                        <div class="col-md-2">&nbsp;</div>
                        </div> -->

                        <div class="row">
                        <?php
                            foreach ($schedules as &$row) {
                                $status = null;

                                if($row["status"] === 'waiting'){
                                    $status = '<span class="badge badge-primary">WAITING</span>';
                                }else if($row["status"] === 'arrived'){
                                    $status = '<span class="badge badge-success">ARRIVED</span>';
                                }else if($row["status"] === 'cancelled'){
                                    $status = '<span class="badge badge-danger">CANCELLED</span>';
                                }else if($row["status"] === 'in-transit'){
                                    $status = '<span class="badge badge-info">IN-TRANSIT</span>';
                                }

                                $new_bus = new Bus($db);
                                $bus = $new_bus->getById($row["bus_id"]);
        
                                $new_driver = new Driver($db);
                                $driver = $new_driver->getById($row["driver_id"]);

                                ?>
                                <div class="col-md-4" id="<?php echo $row["id"]; ?>">
                            <div class="bg-white shadow-sm">
                                <div class="p-3 bg-primary text-white">
                                    <h4 class="mb-0 text-center">
                                        <?php echo $location_from["location_name"].' &#x2192; '.$location_to["location_name"] ?>
                                    </h4>
                                </div>
                                <div class="p-3">
                                    <p class="d-flex align-items-center justify-content-between mb-0">
                                        <span class="text-muted d-block">Date          :</span>
                                        <strong><?php echo date_format(date_create($row['schedule_date']),'F j, Y') ?></strong>
                                    </p>
                                    <p class="d-flex align-items-center justify-content-between mb-0">
                                        <span class="text-muted d-block">Status:</span>
                                        <strong class="text-uppercase"><?php echo $status ?></strong>
                                    </p>
                                    <p class="d-flex align-items-center justify-content-between mb-0">
                                        <span class="text-muted d-block">Departure Time :</span>
                                        <strong><?php echo date_format(date_create($row['departure']), 'g:i A') ?></strong>
                                    </p>
                                    <p class="d-flex align-items-center justify-content-between mb-0">
                                        <span class="text-muted d-block">Estimated Arrival Time :</span>
                                        <strong><?php echo date_format(date_create($row['arrival']), 'g:i A') ?></strong>
                                    </p>
                                   
                                    <hr>
                                    <p class="d-flex align-items-center justify-content-between mb-0">
                                        <span class="text-muted d-block">Bus Driver :</span>
                                        <strong class="text-uppercase"><?php echo $driver['name'] ?></strong>
                                    </p>
                                    <p class="d-flex align-items-center justify-content-between mb-0">
                                        <span class="text-muted d-block">Bus Number:</span>
                                        <strong class="text-uppercase"><?php echo $bus['bus_num'] ?></strong>
                                    </p>
                                    
                                     <p class="d-flex align-items-center justify-content-between mb-0">
                                        <span class="text-muted d-block">Bus Type :</span>
                                        <strong class="text-uppercase"><?php echo $bus['bus_type'] ?></strong>
                                    </p>
                                  
                            
                
                                    <p class="d-flex align-items-center justify-content-between mb-0">
                                        <span class="text-muted d-block">Fare:</span>
                                        <strong><?php echo $row['fare'] ?></strong>
                                    </p>
                                                                       
                                    

                                    <a href="booked.php?schedule_id=<?php echo $row["id"]; ?>" class="text-uppercase btn btn-sm btn-outline-dark btn-block mt-3">
                                        select
                                    </a>
                                </div>
                            </div>
                        </div>
                                <?php

                                // echo '
                                // <div class="mb-3 bg-white shadow-sm p-3">
                                //     <div class="row" id="heading'.$row["id"].'">
                                //         <div class="col-md-2">'.date_format(date_create($row["schedule_date"]),'F j, Y').'</div>
                                //         <div class="col-md-2">'.$row["bus_id"].'</div>
                                //         <div class="col-md-2">'.date_format(date_create($row["departure"]), 'g:i A').'</div>
                                //         <div class="col-md-2">'.date_format(date_create($row["arrival"]), 'g:i A').'</div>
                                //         <div class="col-md-2">'.$row["fare"].'</div>
                                //         <div class="col-md-2">
                                //             '.$status.'
                                //         </div>
                                //         <div class="col-md-1">
                                //             <a href="booked.php?schedule_id='.$row["id"].'" class="text-uppercase btn btn-sm btn-outline-dark">
                                //                 select
                                //             </a>
                                //         </div>
                                //     </div>
                                // </div>
                                // ';
                            }
                        ?>
                        </div>
                    <?php   
                }
            }
        ?>
    </div>
</main>

<?php include('includes/scripts.php')?>
<?php include('includes/layout-footer.php')?>