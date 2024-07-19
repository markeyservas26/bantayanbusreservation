<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css" />
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/styles.css" />
    
    <title>Bantayan Online Bus Reservation</title>
  </head>
<?php
    include('../controllers/db.php');
    $database = new Database();
    $db = $database->getConnection();

    include('../controllers/book.php');
    $new_book = new Book($db);
    $bookings = $new_book->getAll();

    include('../controllers/location.php');
    $new_location = new Location($db);

    include('../controllers/bus.php');
    $new_bus = new Bus($db);

    include('../controllers/driver.php');
    $new_driver = new Driver($db);

    include('../controllers/passenger.php');
    $new_passenger = new Passenger($db);

    include('../controllers/conductor.php');
    $new_conductor = new Conductor($db);
?>

<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/ceres/admin" style="font-family: 'Times New Roman', serif;"><b>DASHBOARD</b></a></li>
            <li class="breadcrumb-item active" aria-current="page" style="font-family: 'Times New Roman', serif;"><b>BOOKINGS</b></li>
        </ol>
    </nav>

    <ul class="nav nav-tabs" id="myTab" role="tablist" style="background-image: linear-gradient(to left, #BDBBBE 0%, #9D9EA3 100%), radial-gradient(88% 271%, rgba(255, 255, 255, 0.25) 0%, rgba(254, 254, 254, 0.25) 1%, rgba(0, 0, 0, 0.25) 100%), radial-gradient(50% 100%, rgba(255, 255, 255, 0.30) 0%, rgba(0, 0, 0, 0.30) 100%); background-blend-mode: normal, lighten, soft-light;">
        <li class="nav-item">
            <a class="nav-link active" id="Pending-tab" data-toggle="tab" href="#Pending" role="tab" aria-controls="Pending" aria-selected="true" style="color: black;">Pending</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="Confirmed-tab" data-toggle="tab" href="#Confirmed" role="tab" aria-controls="Confirmed" aria-selected="false" style="color: black;">Confirmed</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="Cancelled-tab" data-toggle="tab" href="#Cancelled" role="tab" aria-controls="Cancelled" aria-selected="false" style="color: black;">Cancelled</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active p-3" id="Pending" role="tabpanel" aria-labelledby="Pending-tab">
            <div class="row">
                <?php
                    foreach ($bookings as &$row) {
                        if ($row['payment_status'] == 'pending') {
                            $route_from = $new_location->getById($row['route_from']);
                            $route_to = $new_location->getById($row['route_to']);
                            $bus = $new_bus->getById($row["bus_id"]);
                            $driver = $new_driver->getById($row["driver_id"]);
                            $passenger = $new_passenger->getById($row["passenger_id"]);
                            $conductor = $new_conductor->getById($row["conductor_id"]);
                ?>
                <div class="col-md-4 mb-3">
                    <div class="border bg-light">
                        <div id="<?php echo 'print_'.$row['book_id'] ?>">
                            <div class="bg-primary text-white p-3">
                                <h4 class="mb-0">
                                    <?php echo $route_from["location_name"] . ' &#x2192; ' . $route_to["location_name"] ?>
                                </h4>
                            </div>
                            <div class="p-3">
                                <div class="p-3">
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Booked Date:</span>
                                        <span class="font-weight-bold"><?php echo date_format(date_create($row['book_date']), 'F j, Y') ?></span>
                                    </p>
                                    <hr>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Reference:</span>
                                        <span class="font-weight-bold"><?php echo $row['book_reference'] ?></span>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Bus Name:</span>
                                        <span class="font-weight-bold"><?php echo $bus['bus_num'] ?></span>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Bus Number:</span>
                                        <span class="font-weight-bold"><?php echo $bus['bus_code'] ?></span>
                                    </p>
                                    <p class="d-flex align-items-center justify-content-between mb-0">
                                        <span class="text-muted d-block">Bus Driver:</span>
                                        <strong class="text"><?php echo $driver['name'] ?></strong>
                                    </p>
                                    <p class="d-flex align-items-center justify-content-between mb-0">
                                        <span class="text-muted d-block">Bus Conductor:</span>
                                        <strong class="text"><?php echo $conductor['name'] ?></strong>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Bus Type:</span>
                                        <span class="font-weight-bold"><?php echo $bus['bus_type'] ?></span>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Seat Number:</span>
                                        <span class="font-weight-bold"><?php echo $row['seat_num'] ?></span>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Status:</span>
                                        <span class="font-weight-bold text-uppercase badge badge-success"><?php echo $row['payment_status'] ?></span>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Schedule Date:</span>
                                        <span class="font-weight-bold"><?php echo date_format(date_create($row['schedule_date']), 'F j, Y') ?></span>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Departure Time:</span>
                                        <span class="font-weight-bold"><?php echo date_format(date_create($row["departure"]), 'g:i A') ?></span>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Arrival Time:</span>
                                        <span class="font-weight-bold"><?php echo date_format(date_create($row["arrival"]), 'g:i A') ?></span>
                                    </p>
                                    <p class="d-flex align-items-center justify-content-between mb-0">
                                        <span class="text-muted d-block">Fare:</span>
                                        <strong><?php echo $row['fare'] ?></strong>
                                    </p>
                                </div>
                            </div>
                            <div class="p-3">
                                <button class="confirm-booking btn btn-sm btn-primary" onclick="confirmBook('<?php echo $row['book_id'] ?>', '<?php echo $passenger['email'] ?>')">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
        <div class="tab-pane fade p-3" id="Confirmed" role="tabpanel" aria-labelledby="Confirmed-tab">
            <div class="row">
                <?php
                    foreach ($bookings as &$row) {
                        if ($row['payment_status'] == 'confirmed') {
                            $route_from = $new_location->getById($row['route_from']);
                            $route_to = $new_location->getById($row['route_to']);
                            $bus = $new_bus->getById($row["bus_id"]);
                            $driver = $new_driver->getById($row["driver_id"]);
                            $passenger = $new_passenger->getById($row["passenger_id"]);
                            $conductor = $new_conductor->getById($row["conductor_id"]);
                ?>
                <div class="col-md-4 mb-3">
                    <div class="border bg-light">
                        <div id="<?php echo 'print_'.$row['book_id'] ?>">
                            <div class="bg-primary text-white p-3">
                                <h4 class="mb-0">
                                    <?php echo $route_from["location_name"] . ' &#x2192; ' . $route_to["location_name"] ?>
                                </h4>
                            </div>
                            <div class="p-3">
                                <div class="p-3">
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Booked Date:</span>
                                        <span class="font-weight-bold"><?php echo date_format(date_create($row['book_date']), 'F j, Y') ?></span>
                                    </p>
                                    <hr>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Reference:</span>
                                        <span class="font-weight-bold"><?php echo $row['book_reference'] ?></span>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Bus Name:</span>
                                        <span class="font-weight-bold"><?php echo $bus['bus_num'] ?></span>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Bus Number:</span>
                                        <span class="font-weight-bold"><?php echo $bus['bus_code'] ?></span>
                                    </p>
                                    <p class="d-flex align-items-center justify-content-between mb-0">
                                        <span class="text-muted d-block">Bus Driver:</span>
                                        <strong class="text"><?php echo $driver['name'] ?></strong>
                                    </p>
                                    <p class="d-flex align-items-center justify-content-between mb-0">
                                        <span class="text-muted d-block">Bus Conductor:</span>
                                        <strong class="text"><?php echo $conductor['name'] ?></strong>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Bus Type:</span>
                                        <span class="font-weight-bold"><?php echo $bus['bus_type'] ?></span>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Seat Number:</span>
                                        <span class="font-weight-bold"><?php echo $row['seat_num'] ?></span>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Status:</span>
                                        <span class="font-weight-bold text-uppercase badge badge-success"><?php echo $row['payment_status'] ?></span>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Schedule Date:</span>
                                        <span class="font-weight-bold"><?php echo date_format(date_create($row['schedule_date']), 'F j, Y') ?></span>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Departure Time:</span>
                                        <span class="font-weight-bold"><?php echo date_format(date_create($row["departure"]), 'g:i A') ?></span>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Arrival Time:</span>
                                        <span class="font-weight-bold"><?php echo date_format(date_create($row["arrival"]), 'g:i A') ?></span>
                                    </p>
                                    <p class="d-flex align-items-center justify-content-between mb-0">
                                        <span class="text-muted d-block">Fare:</span>
                                        <strong><?php echo $row['fare'] ?></strong>
                                    </p>
                                </div>
                            </div>
                            <div class="p-3">
                                <button class="confirm-booking btn btn-sm btn-primary" onclick="cancelBook('<?php echo $row['book_id'] ?>', '<?php echo $passenger['email'] ?>')">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
        <div class="tab-pane fade p-3" id="Cancelled" role="tabpanel" aria-labelledby="Cancelled-tab">
            <div class="row">
                <?php
                    foreach ($bookings as &$row) {
                        if ($row['payment_status'] == 'cancelled') {
                            $route_from = $new_location->getById($row['route_from']);
                            $route_to = $new_location->getById($row['route_to']);
                            $bus = $new_bus->getById($row["bus_id"]);
                            $driver = $new_driver->getById($row["driver_id"]);
                            $passenger = $new_passenger->getById($row["passenger_id"]);
                            $conductor = $new_conductor->getById($row["conductor_id"]);
                ?>
                <div class="col-md-4 mb-3">
                    <div class="border bg-light">
                        <div id="<?php echo 'print_'.$row['book_id'] ?>">
                            <div class="bg-primary text-white p-3">
                                <h4 class="mb-0">
                                    <?php echo $route_from["location_name"] . ' &#x2192; ' . $route_to["location_name"] ?>
                                </h4>
                            </div>
                            <div class="p-3">
                                <div class="p-3">
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Booked Date:</span>
                                        <span class="font-weight-bold"><?php echo date_format(date_create($row['book_date']), 'F j, Y') ?></span>
                                    </p>
                                    <hr>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Reference:</span>
                                        <span class="font-weight-bold"><?php echo $row['book_reference'] ?></span>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Bus Name:</span>
                                        <span class="font-weight-bold"><?php echo $bus['bus_num'] ?></span>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Bus Number:</span>
                                        <span class="font-weight-bold"><?php echo $bus['bus_code'] ?></span>
                                    </p>
                                    <p class="d-flex align-items-center justify-content-between mb-0">
                                        <span class="text-muted d-block">Bus Driver:</span>
                                        <strong class="text"><?php echo $driver['name'] ?></strong>
                                    </p>
                                    <p class="d-flex align-items-center justify-content-between mb-0">
                                        <span class="text-muted d-block">Bus Conductor:</span>
                                        <strong class="text"><?php echo $conductor['name'] ?></strong>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Bus Type:</span>
                                        <span class="font-weight-bold"><?php echo $bus['bus_type'] ?></span>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Seat Number:</span>
                                        <span class="font-weight-bold"><?php echo $row['seat_num'] ?></span>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Status:</span>
                                        <span class="font-weight-bold text-uppercase badge badge-success"><?php echo $row['payment_status'] ?></span>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Schedule Date:</span>
                                        <span class="font-weight-bold"><?php echo date_format(date_create($row['schedule_date']), 'F j, Y') ?></span>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Departure Time:</span>
                                        <span class="font-weight-bold"><?php echo date_format(date_create($row["departure"]), 'g:i A') ?></span>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Arrival Time:</span>
                                        <span class="font-weight-bold"><?php echo date_format(date_create($row["arrival"]), 'g:i A') ?></span>
                                    </p>
                                    <p class="d-flex align-items-center justify-content-between mb-0">
                                        <span class="text-muted d-block">Fare:</span>
                                        <strong><?php echo $row['fare'] ?></strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
        <div class="tab-pane fade p-3" id="Pending" role="tabpanel" aria-labelledby="Pending-tab">
            <div class="row">
                <?php
                    foreach ($bookings as &$row) {
                        if ($row['payment_status'] == 'pending') {
                            $route_from = $new_location->getById($row['route_from']);
                            $route_to = $new_location->getById($row['route_to']);
                            $bus = $new_bus->getById($row["bus_id"]);
                            $driver = $new_driver->getById($row["driver_id"]);
                            $passenger = $new_passenger->getById($row["passenger_id"]);
                            $conductor = $new_conductor->getById($row["conductor_id"]);
                ?>
                <div class="col-md-4 mb-3">
                    <div class="border bg-light">
                        <div id="<?php echo 'print_'.$row['book_id'] ?>">
                            <div class="bg-primary text-white p-3">
                                <h4 class="mb-0">
                                    <?php echo $route_from["location_name"] . ' &#x2192; ' . $route_to["location_name"] ?>
                                </h4>
                            </div>
                            <div class="p-3">
                                <div class="p-3">
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Booked Date:</span>
                                        <span class="font-weight-bold"><?php echo date_format(date_create($row['book_date']), 'F j, Y') ?></span>
                                    </p>
                                    <hr>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Reference:</span>
                                        <span class="font-weight-bold"><?php echo $row['book_reference'] ?></span>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Bus Name:</span>
                                        <span class="font-weight-bold"><?php echo $bus['bus_num'] ?></span>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Bus Number:</span>
                                        <span class="font-weight-bold"><?php echo $bus['bus_code'] ?></span>
                                    </p>
                                    <p class="d-flex align-items-center justify-content-between mb-0">
                                        <span class="text-muted d-block">Bus Driver:</span>
                                        <strong class="text"><?php echo $driver['name'] ?></strong>
                                    </p>
                                    <p class="d-flex align-items-center justify-content-between mb-0">
                                        <span class="text-muted d-block">Bus Conductor:</span>
                                        <strong class="text"><?php echo $conductor['name'] ?></strong>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Bus Type:</span>
                                        <span class="font-weight-bold"><?php echo $bus['bus_type'] ?></span>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Seat Number:</span>
                                        <span class="font-weight-bold"><?php echo $row['seat_num'] ?></span>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Status:</span>
                                        <span class="font-weight-bold text-uppercase badge badge-success"><?php echo $row['payment_status'] ?></span>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Schedule Date:</span>
                                        <span class="font-weight-bold"><?php echo date_format(date_create($row['schedule_date']), 'F j, Y') ?></span>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Departure Time:</span>
                                        <span class="font-weight-bold"><?php echo date_format(date_create($row["departure"]), 'g:i A') ?></span>
                                    </p>
                                    <p class="mb-0 d-flex align-items-center justify-content-between">
                                        <span class="text-muted">Arrival Time:</span>
                                        <span class="font-weight-bold"><?php echo date_format(date_create($row["arrival"]), 'g:i A') ?></span>
                                    </p>
                                    <p class="d-flex align-items-center justify-content-between mb-0">
                                        <span class="text-muted d-block">Fare:</span>
                                        <strong><?php echo $row['fare'] ?></strong>
                                    </p>
                                </div>
                            </div>
                            <div class="p-3">
                                <button class="confirm-booking btn btn-sm btn-primary" onclick="cancelBook('<?php echo $row['book_id'] ?>', '<?php echo $passenger['email'] ?>')">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</div>


<script>
    function confirmBook(id, email)
    {
        if(confirm("Are you sure to confirm this booking?")){
            const confirmBooking = document.querySelector('.confirm-booking');
            confirmBooking.disabled = true;
            confirmBooking.textContent = 'loading..'
            $.ajax({
                cache: false,
                data: {
                    type: 2,
                    id,
                    payment_status: 'confirmed',
                    email
                },
                type: "post",
                url: "../controllers/update-booking.php",
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode == 200) {
                        alert("Booking confirmed successfully.");
                        location.reload();
                    } else {
                        alert(dataResult.title);
                    }
                },
            });
        }
    }
</script>