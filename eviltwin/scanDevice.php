<?php
include 'page.php';
pageHead("Scan Device");
?>

<div class="d-none d-lg-inline-block position-sticky top-0 left-0" id="scanHome">
    <a type="button" class="btn btn-danger p-3 px-5 mt-3 ms-4 rounded-4 " href="home.php">Home</a>
</div>

<!-- <div class="d-inline-block d-lg-none d-md-none position-sticky top-0 left-0">
        <a type="button" class="w-0 btn btn-danger p-2 px-2 mt-2 ms-2 ms-lg-4 rounded-circle mobileHomeBtn " href="home.php" value="select">
        <i class="fa-solid fa-house fa-xl"></i>
        </a>
    </div> -->

<div class="container position-relative px-2222" id="scanDeviceContainer">

<div id="loadingWifi" class="d-none col-12 position-absolute top-50 start-50 translate-middle
    d-flex justify-content-center flex-column text-center">
        <div class=" align-self-center spinner-border ml-2" role="status">
        </div>
        <div class="col-12">
            <p class="my-3 fs-4">Device Scanning...</p>
        </div>
    </div>

    <div id="deviceList" class="btn-group-vertical col-12 lg-col-10 float-left" role="group" aria-label="Basic radio toggle button group">
    </div>


    <div class="d-flex justify-content-evenly" id="scanDevice">
        <!-- <button class="btn btn-danger mt-4 mb-3 rounded-4" type="submit" id="getWifiList">Get Wifi List</button> -->
        <button class="btn btn-danger mt-4 mb-3 p-3 px-5 rounded-4" type="submit">Scan Device</button>
    </div>

    
</div>

<script>
    $(document).ready(function() {

        var getUrl = 'https://e.eviltwinatw.uk/eviltwin/ajax.php?act=getdevicelist';
        $.get(getUrl, function(response) {

            $('#deviceList').removeClass("d-none");

            $('#getDeviceList').removeClass('position-absolute top-50 start-0 translate-middle')

            var items = [];
            var arr = JSON.parse(response);

            for (var i = 0; i < arr.length; i++) {
                var index = i + 1;
                items.push("<div class='col-12' >\
                            <input type='radio' class='btn-check btnradio' name='btnradio' id='btnradio" + i + "' autocomplete='off' checked>\
                            <label class='btn btn-outline-success mt-5 col-12' for='btnradio" + i + "'>\
                                    <div class='row mt-1 mb-2 lh-l'>\
                                        <div class='col-12 col-lg-2 lg-text-left'>\
                                            <i class='fa-solid fa-mobile fa-beat fa-2xl mt-4 mt-lg-5 ms-lg-5'></i>\
                                        </div>\
                                        <div class='col-10 col-lg-7 ms-4 col-sm-12 mt-4 text-left'>\
                                            <h5 class='my-1 fw-bold'>NAME: " + arr[i].hostname + " </h5>\
                                            <p class='my-1'>DEVICE IP: " + arr[i].ip + " </p>\
                                            <p class='my-1'>DEVICE MAC: " + arr[i].mac + " </p>\
                                        </div>\
                                        <div class='col-12 col-lg-2' id='attackBtn" + i + "'>\
                                        <a class='btn btn-danger mt-4 mb-3 p-3 px-5 rounded-4' role='button' href='deviceInfo.php?hostname=" + arr[i].hostname +"&ip="+arr[i].ip+"&mac="+arr[i].mac+"'>View</a>\
                                        </div>\
                                    </div>\
                                </label>\
                            </div>");
            }

            $('#deviceList').append(items);
        });

        var scanUrl = 'https://e.eviltwinatw.uk/eviltwin/ajax.php?act=scandevice';
        $("#scanDevice").click(function() {
            $('#deviceList').empty();


            $('#scanDevice').addClass('d-none');

            $('#loadingDevice').removeClass('d-none');
            $.get(scanUrl, function(response) {


                $('#loadingDevice').addClass('d-none');

                $('#scanDevice').removeClass('d-none');

                // $('#attackBtn').removeClass("d-none");

                $('#deviceList').removeClass("d-none");

                var items = [];
                var arr = JSON.parse(response);

                for (var i = 0; i < arr.length; i++) {
                    var index = i + 1;
                    items.push("<div class='col-12' >\
                                <input type='radio' class='btn-check btnradio' name='btnradio' id='btnradio" + i + "' autocomplete='off' checked>\
                                <label class='btn btn-outline-success mt-5 col-12' for='btnradio" + i + "'>\
                                    <div class='row mt-1 mb-2 lh-l'>\
                                        <div class='col-12 col-lg-2 lg-text-left'>\
                                            <i class='fa-solid fa-mobile fa-beat fa-2xl mt-4 mt-lg-5 ms-lg-5'></i>\
                                        </div>\
                                        <div class='col-12 col-lg-7 ms-4 col-sm-12 mt-4 text-left'>\
                                            <h5 class='my-1 fw-bold'>NAME: " + arr[i].hostname + " </h5>\
                                            <p class='my-1'>DEVICE IP: " + arr[i].ip + " </p>\
                                            <p class='my-1'>DEVICE MAC: " + arr[i].mac + " </p>\
                                        </div>\
                                        <div class='col-12 col-lg-2' id='attackBtn" + i + "'>\
                                        <a class='btn btn-danger mt-4 mb-3 p-3 px-5 rounded-4' role='button' href='deviceInfo.php?hostname=" + arr[i].hostname +"&ip="+ arr[i].ip +"&mac="+ arr[i].mac +"'>View</a>\
                                        </div>\
                                    </div>\
                                </label>\
                            </div>");
                }

                var id = $('#deviceList').append(items);
                console.log(id);

            });
        });


    });
</script>

<?php
pageEnd();
?>