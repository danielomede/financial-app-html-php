<!doctype html>
<html lang="en">
<head>
        <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Transfer  | Gatehouse Bank</title>
    <link rel="stylesheet" href="assets/css/styleae52.css?v=5">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="description" content="Finapp HTML Mobile Template">
    <meta name="keywords" content="bootstrap, mobile template, mobile, html, wallet, banking, finance" />
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png" sizes="32x32">
    <link rel="shortcut icon" href="assets/img/favicon.png">
    
    <style>
        
        
#myBar {
  width: 50%;
  height: 30px;
  background-color: #4CAF50;
}
</style>
</head>

<body>

    <!-- loader -->
     <!-- loader -->
    
    <!-- * loader -->
    <!-- * loader -->

    <!-- App Header -->
    <div class="appHeader no-border transparent position-absolute">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle"></div>
        <div class="right">
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section mt-2 text-center">
            <h1>  TAX CODE</h1>
            
        </div>
        <div class="section mb-5 p-2">

            <form action="transfers.php" method="post">
                <div class="card">
                    <div class="card-body pb-1">
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="email1">TAX CODE</label>
                                <input type="text" class="form-control" id="cot" placeholder="Enter Your Tax code" name="tax">
                                <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-button-group  transparent">
                    <input type="submit" class="btn btn-primary btn-block btn-lg" value="send" name="tax-submit">
                </div>

            </form>
        </div>

    </div>
    <!-- * App Capsule -->



   <script>
var i = 0;
function move() {
  if (i == 0) {
    i = 1;
    var elem = document.getElementById("myBar");
    var width = 1;
    var id = setInterval(frame, 10);
    function frame() {
      if (width >= 50) {
        clearInterval(id);
        i = 0;
        
      } else {
        width++;
        elem.style.width = width + "%";
      }
    }
  }
}
</script>



</body>



</html>