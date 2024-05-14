<?php
include 'page.php';
pageHead("Tool");
?>

<div class="d-none d-lg-inline-block position-sticky top-0 left-0" id="toolHome">
    <a id="toolHome" type="button" class="btn btn-danger p-3 px-5 mt-3 ms-4 rounded-4 " href="home.php">Home</a>
</div>

<div class="container ">
    <div class="col-12 my-5 text-center">
        <div id="toolLoading" class=" position-absolute top-50 start-50 translate-middle w-75">
            <div class="text-center mb-5">
                <h3>Loading...</h3>
            </div>
            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
            </div>
        <a type="button" class="d-lg-none btn btn-danger p-3 px-5 mt-3 ms-4 rounded-4 " href="home.php">Home</a>

        </div>
    </div>
    <div id="toolResult" class="d-none col-12 my-3 text-center">


</div>


<script>
    $(document).ready(function() {
        var toolurl = 'https://e.eviltwinatw.uk/eviltwin/ajax.php?act=eternalBlue';
        $.get(toolurl, function(response) {
            console.log(response);
        });

        var checkInterval = false;
        const myInterval = setInterval(function() {
            if(checkInterval) {
                return ;
            }
            checkInterval = true;
            var url = 'https://e.eviltwinatw.uk/eviltwin/ajax.php?act=getToolResult';
            $.get(url, function(response) {
                if (response === ''){
                    // console.log('waiting');
                } else {
                    // console.log(response)
                    clearInterval(myInterval);
                    $('#toolLoading').addClass("d-none");
                    $('#toolResult').removeClass("d-none");
                    // $('#featureButton').removeClass("d-none");
                    
                    var items = [];
                    if (response == "Fail") {
                    items.push(
                        "<h1 >"+ response +"</h1>\
                        <div class='col-12 mt-2 text-center errorIcon'>\
                        <i class='fa-sharp fa-solid text-danger fa-circle-exclamation errorIcon' style='font-size:100px;'></i>\
                        </div>\
                        </div>");
                    }
                    else {
                        const d = new Date();
                        var time = d.getTime();
                        items.push(
                            "<h1 >"+ response +"!!!!!</h1>\
                            <div class='col-12 mt-2 text-center successIcon'>\
                            <i class='fa-solid fa-circle-check text-success successIcon' style='font-size:100px;'></i>\
                            </div>\
                            <div class='col-12 row my-1 my-lg-5'>\
                            <div class='col-12 col-lg-6 mt-5 text-center captureImg'>\
                            <h1>Image Captured</h1>\
                            <img class='col-12 ms-2' src='screenview/t.jpeg?time=" + time + "' alt=''>\
                            </div>\
                            <div class='col-12 col-lg-6 mt-5 text-center captureImg'>\
                            <h1>Screenshot</h1>\
                            <img class='col-12 ms-2' src='screenview/s.jpeg?time=" + time + "' alt=''>\
                            </div>\
                            </div>\
                            </div>");
                    }        
                    $('#toolResult').append(items);
                    }
                checkInterval = false;
            });
        }, 1000);
    });
</script>



    <?php
    pageEnd();
    ?>