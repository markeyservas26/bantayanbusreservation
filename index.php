<?php 
    include('includes/layout-header.php');
    include('controllers/db.php');
    include('controllers/location.php');

    $route_from = isset($_GET['route_from']) && !empty($_GET['route_from']) ? $_GET['route_from'] : "";
    $route_to = isset($_GET['route_to']) && !empty($_GET['route_to']) ? $_GET['route_to'] : "";
    $schedule_date = isset($_GET['schedule_date']) && !empty($_GET['schedule_date']) ? $_GET['schedule_date'] : "";

    $database = new Database();
    $db = $database->getConnection();

    $new_location = new Location($db);
    $locations = $new_location->getAll();
    $location_from = $new_location->getByLocation($route_from);
    $location_to = $new_location->getByLocation($route_to);
?>

<?php include('includes/scripts.php')?>
<main>
   
    <div class="d-flex align-items-center justify-content-center p-4">
        <?php include("includes/forms/schedule-form.php") ?>
    </div>

  <br>
  <br>
<div id="carouselExampleIndicators" class="carousel slide carousel-fade"   style="color: black data-ride="carousel>
  <ol class="carousel-indicators" >
    <li data-target="#carouselExampleIndicators" style="color: black" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
  </ol>
  <div class="container1" >
  <center>  <img src="assets/images/bg1.png" style='width:1100px; height: 500px;'> 
    <div class="carousel-item active">
      <img src="assets/images/slideshow5.jpg" class="d-block m-auto" style='width:40%; height: 400px;border: 1px solid black;' alt="...">
    </div>
  
    <div class="carousel-item">
      <img src="assets/images/slideshow6.jpg" class="d-block m-auto" style='width:40%; height: 400px;border: 1px solid black;' alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </button>
</center>
</div>
</div>
</div>
</main>

<br>
<br
<?php include('includes/layout-footer.php')?>