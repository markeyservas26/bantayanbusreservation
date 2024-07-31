<?php
    include('includes/layout-header.php');

    $schedule_id = isset($_GET['schedule_id']) && !empty($_GET['schedule_id']) ? $_GET['schedule_id'] : "";
    if(empty($schedule_id)){
        header('Location: index.php');
    }else{
        include('controllers/db.php');
        include('controllers/schedule.php');

        $database = new Database();
        $db = $database->getConnection();

        $new_schedule = new Schedule($db);
        $schedule = $new_schedule->getById($schedule_id);
        $fare = $schedule['fare'];

        if(empty($schedule["id"])){
            header('Location: index.php');
        }else{
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
            <div class="p-3">
                <!-- Schedule details -->
                <p class="d-flex align-items-center justify-content-between mb-0">
                    <span class="text-muted d-block">Date:</span>
                    <strong><?php echo date_format(date_create($schedule['schedule_date']),'F j, Y') ?></strong>
                </p>
                <p class="d-flex align-items-center justify-content-between mb-0">
                    <span class="text-muted d-block">Status:</span>
                    <strong class="text-uppercase"><?php echo $schedule['status'] ?></strong>
                </p>
                <p class="d-flex align-items-center justify-content-between mb-0">
                    <span class="text-muted d-block">Departure Time:</span>
                    <strong><?php echo date_format(date_create($schedule['departure']), 'g:i A') ?></strong>
                </p>
                <p class="d-flex align-items-center justify-content-between mb-0">
                    <span class="text-muted d-block">Arrival Time:</span>
                    <strong><?php echo date_format(date_create($schedule['arrival']), 'g:i A') ?></strong>
                </p>
                <hr>
                <p class="d-flex align-items-center justify-content-between mb-0">
                    <span class="text-muted d-block">Bus Driver:</span>
                    <strong class="text"><?php echo $driver['name'] ?></strong>
                </p>
                <p class="d-flex align-items-center justify-content-between mb-0">
                    <span class="text-muted d-block">Bus Conductor:</span>
                    <strong class="text"><?php echo $conductor['name'] ?></strong> <!-- Display conductor name -->
                </p>
                <p class="d-flex align-items-center justify-content-between mb-0">
                    <span class="text-muted d-block">Bus Name:</span>
                    <strong class="text"><?php echo $bus['bus_num'] ?></strong>
                </p>

                <p class="d-flex align-items-center justify-content-between mb-0">
                    <span class="text-muted d-block">Bus Number:</span>
                    <strong class="text"><?php echo $bus['bus_code'] ?></strong>
                </p>

                <p class="d-flex align-items-center justify-content-between mb-0">
                    <span class="text-muted d-block">Bus Type:</span>
                    <strong class="text"><?php echo $bus['bus_type'] ?></strong>
                </p>
                <p class="d-flex align-items-center justify-content-between mb-0">
                    <span class="text-muted d-block">Fare:</span>
                    <strong><?php echo $schedule['fare'] ?></strong>
                </p>
                
                <hr>
                
                <!-- Discount selection and file upload -->
                <div class="form-group">
                    <label for="discountType">Discount:</label>
                    <select id="discountType" class="form-control">
                        <option value="">None</option>
                        <option value="student">Student</option>
                        <option value="pwd">Person with Disability (PWD)</option>
                        <option value="senior">Senior Citizen</option>
                    </select>
                </div>
                <div class="form-group" id="uploadIdSection" style="display: none;">
                    <label for="uploadId">Upload ID:</label>
                    <input type="file" id="uploadId" class="form-control">
                </div>
                
                <hr />

                <div>
                    <div class="my-3">
                        <p class="mb-0">Legend</p>
                        <div class="d-flex">
                            <div class="d-flex align-items-center mr-2">
                                <span style="height: 16px; width: 16px; background-color: #007bff; opacity: .65;" class="d-inline-block mr-2"></span>
                                <span>Reserved</span>
                            </div>
                            <div class="d-flex align-items-center mr-2">
                                <span style="height: 16px; width: 16px;" class="bg-dark d-inline-block mr-2"></span>
                                <span>Selected</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <span style="height: 16px; width: 16px; border: 2px solid black" class="d-inline-block mr-2"></span>
                                <span>Available</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-dark text-white text-center">Front</div>
                    <div class="py-0">
                        <table class="table table-borderless">
                            <tbody>
                                <?php
                                    $seat_row_num = 0;
                                    for ($i = 1; $i <= 10; $i++) {
                                        echo '<tr>';
                                        for ($x = 1; $x <= 5; $x++) {
                                            if($x == 3){
                                                echo '<td>&nbsp;</td>';
                                            }else{
                                                $seat_row_num++;
                                                $new_book = new Book($db);
                                                $book = $new_book->checkSeat($schedule["id"], $seat_row_num);

                                                if(empty($book["id"])){
                                                    echo '<td><button data-seat="'.$seat_row_num.'" class="btn-seat btn btn-sm btn-outline-dark" style="background-image: url("assets/img/seat.png");">
                                                            <span class="seat-number">'.$seat_row_num.'</span></button></td>';
                                                }else{
                                                    echo '<td><button class="btn btn-sm btn-primary" disabled style="background-image: url("assets/img/seat.png");">
                                                            <span class="seat-number">'.$seat_row_num.'</span></button></td>';
                                                }
                                            }
                                        }
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="bg-dark text-white text-center">Back</div>
                </div>
                <hr />
                <h2>Total: <span id='total'>0</span></h2>
                        
                <hr />
                <div class="text-right">
                    <a href="index.php" class="btn btn-outline-dark">Cancel</a>
                    <button id="booked" class="btn btn-dark">Book</button>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include('includes/scripts.php')?>

<style>
    /* Seat button styles */
    .btn-seat {
        background-size: cover; /* Ensure the icon covers the button */
        background-repeat: no-repeat; /* Prevent the background from repeating */
        background-position: center; /* Center the background image */
        position: relative; /* Required to position the seat number */
        padding: 20px 0; /* Adjust padding as needed */
    }

    /* Seat number styles */
    .seat-number {
        position: absolute; /* Absolute positioning for the number */
        top: 50%; /* Center the number vertically */
        left: 50%; /* Center the number horizontally */
        transform: translate(-50%, -50%); /* Adjust for centering */
        color: white; /* Text color */
        font-weight: bold; /* Make the text bold */
        font-size: 14px; /* Adjust font size as needed */
    }
</style>

<script>
    const from = '<?php echo $location_from["location_name"] ?>';
    const to = '<?php echo $location_to["location_name"] ?>';
    const routeName = `${from.slice(0, 3)}-${to.slice(0, 3)}`;

    const isVerified = '<?php echo isset($_SESSION["isVerified"]) && !empty($_SESSION["isVerified"]) ? $_SESSION["isVerified"] : false ?>';
    const schedule_id = '<?php echo isset($_GET['schedule_id']) && !empty($_GET['schedule_id']) ? $_GET['schedule_id'] : false ;?>';
    const passenger_id = '<?php echo isset($_SESSION["userId"]) && !empty($_SESSION["userId"]) ? $_SESSION["userId"] : false ;?>';
    const passenger_email = '<?php echo isset($_SESSION["userEmail"]) && !empty($_SESSION["userEmail"]) ? $_SESSION["userEmail"] : false ;?>';
    const fare = '<?php echo $fare ;?>';
    let totalFare = 0;
    let seats = [];
    let discount = 0;
    const status = '<?php echo $schedule['status'] ?>';

    $("#discountType").change(function() {
        const discountType = $(this).val();
        if (discountType) {
            discount = 0.20;
            $("#uploadIdSection").show();
        } else {
            discount = 0;
            $("#uploadIdSection").hide();
        }
        handleTotal();
    });

    $(".btn-seat").click(function() {
        const seat_num = $(this).attr("data-seat");
        if (!seats.includes(seat_num)) {
            seats.push(seat_num);
            $(this).addClass("btn-dark").removeClass("btn-outline-dark");
        } else {
            seats = seats.filter(el => el !== seat_num);
            $(this).removeClass("btn-dark").addClass("btn-outline-dark");
        }
        handleTotal();
    });

    $("#booked").click(async function() {
        if (seats.length === 0) {
            alert('Please select seat number.');
            return;
        }

        if (!passenger_id) {
            alert('Unable to create booking. Please sign in your account.');
            return;
        }

        if (!isVerified) {
            alert('Unable to create booking. Please verify your account.');
            return;
        }

        if (status === 'waiting') {
            let promises = [];
            for (let i = 0; i < seats.length; i++) {
                const seat = seats[i];

                let formData = new FormData();
                formData.append('type', 1);
                formData.append('schedule_id', schedule_id);
                formData.append('passenger_id', passenger_id);
                formData.append('total', totalFare);
                formData.append('seat_num', seat);
                formData.append('routeName', routeName);
                formData.append('passenger_email', passenger_email);
                formData.append('discount_type', $("#discountType").val());
                formData.append('upload_id', $("#uploadId")[0].files[0]);

                promises.push(
                    fetch('controllers/create-booking.php', {
                        method: 'POST',
                        body: formData,
                    })
                );
            }
            try {
                const values = await Promise.all(promises);
                console.log('values', values);
                alert("New booking added successfully!");
                window.location.href = 'account.php';
            } catch (error) {
                alert("Error on booking.");
                location.reload();
            }
        } else {
            alert('Oops! Unable to book this schedule.');
            return;
        }
    });

    function handleTotal() {
        totalFare = seats.length * +fare * (1 - discount);
        $("#total").text(totalFare.toFixed(2));
    }
</script>

<?php include('includes/layout-footer.php')?>
