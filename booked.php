<?php
include('includes/layout-header.php');

$schedule_id = isset($_GET['schedule_id']) && !empty($_GET['schedule_id']) ? $_GET['schedule_id'] : "";
$book_id = isset($_GET['book_id']) && !empty($_GET['book_id']) ? $_GET['book_id'] : "";

if (empty($schedule_id)) {
    header('Location: index.php');
} else {
    include('controllers/db.php');
    include('controllers/schedule.php');

    $database = new Database();
    $db = $database->getConnection();

    $new_schedule = new Schedule($db);
    $schedule = $new_schedule->getById($schedule_id);
    $fare = $schedule['fare'];

    if (empty($schedule["id"])) {
        header('Location: index.php');
    } else {
        include('controllers/route.php');
        include('controllers/location.php');
        include('controllers/book.php');
        include('controllers/bus.php');
        include('controllers/vessel.php');
        include('controllers/driver.php');
        include('controllers/conductor.php'); // Include the conductor controller
        
        $new_route = new Route($db);
        $route = $new_route->getById($schedule["route_id"]);

        $new_bus = new Bus($db);
        $bus = $new_bus->getById($schedule["bus_id"]);

        $new_driver = new Driver($db);
        $driver = $new_driver->getById($schedule["driver_id"]);

        $new_conductor = new Conductor($db); // Instantiate the conductor class
        $conductor = $new_conductor->getById($schedule["conductor_id"]); // Fetch the conductor information

        $new_location = new Location($db);
        $location_from = $new_location->getById($route["route_from"]);
        $location_to = $new_location->getById($route["route_to"]);

        $book_details = [];
        if (!empty($book_id)) {
            $new_book = new Book($db);
            $book_details = $new_book->getById($book_id);
        }
    }
}
?>

<main class="mt-5">
    <div class="container">
        <div class="bg-white shadow-sm w-100 m-auto" style="max-width: 500px">
            <div class="p-3 bg-primary">
                <h4 class="mb-0 text-center">
                    <?php echo $location_from["location_name"].' &#x2192; '.$location_to["location_name"] ?>
                </h4>
            </div>
            <div class="p-3" style="background-image: linear-gradient(109.6deg, rgba(254,253,205,1) 11.2%, rgba(163,230,255,1) 91.1%);">
                <form action="payment.php" method="post">
                    <input type="hidden" name="schedule_id" value="<?php echo $schedule_id ?>">
                    <?php if (!empty($book_id)) { ?>
                        <input type="hidden" name="book_id" value="<?php echo $book_id ?>">
                    <?php } ?>
                    <div class="form-group mb-3">
                        <label for="route">Route</label>
                        <input type="text" id="route" name="route" class="form-control" value="<?php echo $location_from["location_name"].' &#x2192; '.$location_to["location_name"] ?>" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="bus">Bus</label>
                        <input type="text" id="bus" name="bus" class="form-control" value="<?php echo $bus["bus_num"].' - '.$bus["bus_code"] ?>" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="bus_type">Bus Type</label>
                        <input type="text" id="bus_type" name="bus_type" class="form-control" value="<?php echo $bus["bus_type"] ?>" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="driver">Bus Driver</label>
                        <input type="text" id="driver" name="driver" class="form-control" value="<?php echo $driver["name"] ?>" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="conductor">Bus Conductor</label>
                        <input type="text" id="conductor" name="conductor" class="form-control" value="<?php echo $conductor["name"] ?>" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="seat_num">Seat Number</label>
                        <input type="number" id="seat_num" name="seat_num" class="form-control" value="<?php echo isset($book_details['seat_num']) ? $book_details['seat_num'] : '' ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="fare">Fare</label>
                        <input type="text" id="fare" name="fare" class="form-control" value="<?php echo $fare ?>" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="passenger_name">Passenger Name</label>
                        <input type="text" id="passenger_name" name="passenger_name" class="form-control" value="<?php echo isset($book_details['passenger_name']) ? $book_details['passenger_name'] : '' ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="schedule_date">Schedule Date</label>
                        <input type="text" id="schedule_date" name="schedule_date" class="form-control" value="<?php echo date_format(date_create($schedule['schedule_date']), 'F j, Y') ?>" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="departure">Departure Time</label>
                        <input type="text" id="departure" name="departure" class="form-control" value="<?php echo date_format(date_create($schedule["departure"]), 'g:i A') ?>" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="arrival">Arrival Time</label>
                        <input type="text" id="arrival" name="arrival" class="form-control" value="<?php echo date_format(date_create($schedule["arrival"]), 'g:i A') ?>" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Proceed to Payment</button>
                </form>
            </div>
        </div>
    </div>
</main>
