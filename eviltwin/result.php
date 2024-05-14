<?php
include 'page.php';
pageHead("Result");
?>


<?php
$password = $_GET["password"];
$ssid = $_GET["ssid"];
?>/
<div class="col-12 mt-3 text-center successIcon">
    <i class="fa-solid fa-circle-check text-success successIcon" style="font-size:100px;"></i>
</div>
<div class="col-12 my-5 text-center">
    <h1>Successful!!!</h1>
    <h3>SSID:
        <?php
        echo $ssid; 
        ?>
    </h3>
    <h3>Password:
        <?php
        echo $password; 
        ?>
    </h3>
</div>
<div class="col-12 position-absolute bottom-0 start-0">
    <div class="col-12 d-flex justify-content-center mb-2 mb-lg-5 text-center">
        <a  type="button" class="col-5 col-lg-2 btn btn-success p-3 pe-3 rounded-4"  href='connect.php?ssid=<?php echo $ssid ?>&password=<?php echo $password ?>' >Connect to target's wifi</a>
    </div>
    <div class="col-12 d-flex justify-content-center mb-2 mb-lg-5 text-center">
        <a type="button" class="col-5 col-lg-2 btn btn-danger p-3 pe-3 rounded-4" href="home.php">Home</a>
    </div>
</div>

<?php
pageEnd();
?>