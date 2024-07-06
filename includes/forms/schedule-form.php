<form class="form-inline" method="GET" action="schedule.php">
    <label class="sr-only" for="route_from">Origin</label>
<div class="form-group mb-2">
  <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-geo-alt" viewBox="0 0 16 16">
                            <path
                                d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                        </svg>
                    </div>
                </div>
     <select class="form-control mb-16 mr-sm-16" id="route_from" name="route_from" value="<?php echo $route_from; ?>" required>
        <option value="" <?php empty($route_from) ? 'selected' : '' ?>>Origin</option>
        <?php
            foreach ($locations as &$row){
                if($route_from == $row["location_name"]){
                    echo '<option value="'.$row["location_name"].'" selected>'.$row["location_name"].'</option>';
                }else{
                    echo '<option value="'.$row["location_name"].'">'.$row["location_name"].'</option>';
                }
            }
        ?>
     </select>
    </div>
</div>
    <h3 class="mb-2 mr-sm-2 text-center">&#x2192;</h3>

<label class="sr-only" for="route_to">Destination</b></label>
<div class="form-group mb-2">
    <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-geo-alt" viewBox="0 0 16 16">
                            <path
                                d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                        </svg>
                    </div>
                </div>
        <select class="form-control mb-16 mr-sm-16" id="route_to" name="route_to" value="<?php echo $route_to; ?>" required>
        <option value="" <?php empty($route_to) ? 'selected' : '' ?>>Destination</option>
        <?php
            foreach ($locations as &$row){
                if($route_to == $row["location_name"]){
                    echo '<option value="'.$row["location_name"].'" selected>'.$row["location_name"].'</option>';
                }else{
                    echo '<option value="'.$row["location_name"].'">'.$row["location_name"].'</option>';
                }
            }
        ?>
        </select>
    </div>
</div>
<h3 class="mb-2 mr-sm-2 text-center"></h3>
<h3 class="mb-2 mr-sm-2 text-center"></h3>
<div class="form-group mb-2">
    <label class="sr-only" for="schedule_date">Date</label>
    <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-calendar" viewBox="0 0 16 16">
                            <path
                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                        </svg>
                    </div>
                </div>
        <input type="date" class="form-control mb-16 mr-sm-16" id="schedule_date" name="schedule_date" value="<?php echo $schedule_date; ?>" required>
    </div>
</div>     
<h3 class="mb-2 mr-sm-2 text-center"></h3>
<h3 class="mb-2 mr-sm-2 text-center"></h3>
            <button type="submit" class="btn btn-dark mb-2 text-uppercase">Find</button>
</form>


<script>
    const schedule_date = document.getElementById("schedule_date");
    schedule_date.min =new Date().toISOString().split("T")[0];
</script>