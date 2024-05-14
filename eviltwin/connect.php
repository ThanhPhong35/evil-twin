<?php
include 'page.php';
pageHead("Connect");
?>


<div id="connecting" class=" position-absolute top-50 start-50 translate-middle d-flex justify-content-center flex-column ">
    <div class=" align-self-center spinner-border ml-2" role="status">
    </div>
    <div>
        <p class="my-3 fs-4">Connecting...</p>
    </div>
</div>
<div class="container d-none" id="connectResult">
    <?php
    $ssid = $_GET["ssid"];
    $password = $_GET["password"];
    ?>
    <div id="connectIcon" class="col-12 mt-3 text-center successIcon">

    </div>
    <div class="col-12 my-5 text-center">
        <h1 id="connectTitle">
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
         <!-- <div class="col-12 d-flex justify-content-center mb-2 mb-lg-5 text-center">
            <a type="button" class="col-8 col-lg-2 btn btn-success p-3 pe-3 rounded-4" href="https://etssh.eviltwinatw.uk/" id="connectSSH">Connect SSH</a>
        </div> -->
        <div class="col-12 d-flex justify-content-center mb-2 mb-lg-5 text-center">
            <a type="button" class="col-8 col-lg-2 btn btn-success p-3 pe-3 rounded-4" href="scanDevice.php" id="toolAttack">Scan Target Devices</a>
        </div>
        <div class="col-12 d-flex justify-content-center mb-2 mb-lg-5 text-center">
            <a type="button" class="col-8 col-lg-2 btn btn-danger p-3 pe-3 rounded-4" href="home.php">Home</a>
        </div>
    </div>
</div>

<script>
    var password = "<?php echo $password; ?>";
    var ssid = "<?php echo $ssid; ?>";
    
    $(document).ready(function() {
        var ajaxurl = 'https://e.eviltwinatw.uk/eviltwin/ajax.php?act=connectWifi&ssid=' + ssid + '&password=' + password;
        $.get(ajaxurl, function(response) {
            // console.log(response);
            $('#connecting').addClass("d-none");
            $('#connectResult').removeClass("d-none");

            if (response == "Connected") {
                $('#connectIcon').append("<i class='fa-solid fa-circle-check text-success successIcon' style='font-size:100px;'></i>");
                $('#connectTitle').append(response);
            }
            else {
                $('#connectIcon').append("<i class='fa-sharp fa-solid text-danger fa-circle-exclamation errorIcon' style='font-size:100px;'></i>");
                $('#connectTitle').append(response);
                $('#toolAttack').addClass("d-none")   
            }
        });
    });

</script>

<?php
pageEnd();
?>