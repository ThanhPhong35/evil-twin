<?php
include 'page.php';
pageHead("Device Info");
?>

<div class="container">
    <div id="loadingInfo" class=" position-absolute top-50 start-50 translate-middle d-flex justify-content-center flex-column ">
        <div class=" align-self-center spinner-border ml-2" role="status">
        </div>
        <div>
            <p class="my-3 fs-4">Loading Device Info...</p>
        </div>
    </div>

    <div id="infoIcon" class="col-12 mt-3 text-center successIcon">

    </div>

    <div id="deviceInfo" class="d-none">
        
    </div>
    <div class="col-12 d-flex justify-content-center mb-5 text-center" id ="exploitBtn">
    </div>
</div>

<script>
    <?php
        $hostname = $_GET["hostname"];
        $mac = $_GET["mac"];
        $ip = $_GET["ip"];
    ?>

    var hostname = "<?php echo $hostname; ?>";
    var ip = "<?php echo $ip; ?>";
    var mac = "<?php echo $mac; ?>";

    $(document).ready(function() {

        var ajaxurl = "https://e.eviltwinatw.uk/eviltwin/ajax.php?act=deviceInfo&hostname=" + hostname + "&ip=" + ip + "&mac=" + mac;
        $.get(ajaxurl, function(response) {
            console.log(response);
            $('#loadingInfo').addClass("d-none");
            $('#infoIcon').append("<i class='fa-solid fa-circle-check text-success successIcon' style='font-size:100px;'></i>");
            $('#infoIcon').append("<h1 class='fw-bold'>SUCCESSFUL!!!!!</h1>");
            $('#deviceInfo').removeClass("d-none");

            var itemStart = [];
            var port = [];
            var itemEnd = [];
            var arr = JSON.parse(response);
            // console.log(arr.port[1]);
            itemStart.push("<div class='row mt-5 deviceDetail'>\
                                <h1 class='fw-bold'>Device Info</h1>\
                                <div class=''>\
                                   <h4 class='fw-bold'>Name: \
                                   <span id='name' class='ms-3 fs-5 fw-normal '>" + arr.name + "</span>\
                                   </h4>\
                                   <h4 class='fw-bold'>OS: \
                                   <span id='OS' class='ms-3 fs-5 fw-normal '>" + arr.OS + "</span>\
                                   </h4>\
                                   <h4 class='fw-bold'>Device IP: \
                                   <span class='ms-3 fs-5 fw-normal '>" + ip + "</span>\
                                   </h4>\
                                   <h4 class='fw-bold'>Device MAC: \
                                   <span class='ms-3 fs-5 fw-normal text-uppercase'>" + mac + "</span>\
                                   </h4>\
                                   <h4 class='fw-bold'>Manufacture: \
                                   <span class='ms-3 fs-5 fw-normal '>" + hostname + "</span>\
                                   </h4>\
                                </div>\
                            </div>");
            itemEnd.push("<div class='row mt-5'>\
                          <h1 class='fw-bold'>Port and Vuln</h1>\
                          <div class='' id='portInfo'>\
                          <pre class='fs-6'>" + arr.vulnResult + "</pre>\
                          </div>\
                          </div>\
                          <div id='loadingVuln' class=''>\
                          <div class=' align-self-center spinner-border ml-2' role='status'>\
                          </div>\
                          <div>\
                          <p class='my-3 fs-4'>Loading Vuln... </p>\
                          </div>\
                          </div>");

            $("#deviceInfo").append(itemStart);
            $("#deviceInfo").append(itemEnd);

            const myInterval = setInterval(function() {
            var url = 'https://e.eviltwinatw.uk/eviltwin/ajax.php?act=getVuln';
            $.get(url, function(response) {
                    //if (response !== '' && response.indexOf('smb-vuln-ms17-010') !== -1){
                        console.log('Test: ' + response);
                        $('#portInfo').empty();
                        $('#loadingVuln').addClass('d-none');

                        
                        var items = [];
                        var arrPort = JSON.parse(response);
                        items.push("<pre class='fs-6'>" + arrPort.portVuln + "</pre>")
                        
                        $('#portInfo').append(items);
                        $("#exploitBtn").append("<a type='button' class='col-5 col-lg-2 btn btn-primary p-3 pe-3 rounded-4' href='tool.php'>Exploit</a>");
                        
                        clearInterval(myInterval);

                    //}
                });
            }, 1000);
        });

        var url= "https://e.eviltwinatw.uk/eviltwin/ajax.php?act=deviceVuln&ip=" + ip;
        $.get(url, function(response) {
            console.log(response);
        });

        
    });

</script>

<?php
pageEnd();
?>