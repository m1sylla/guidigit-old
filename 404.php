<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700' rel='stylesheet' type='text/css'>

    <!----  favicon  --->
    <link rel="shortcut icon" type="image/png" href="assets/images/icons/favicon-192.png">
    <link rel="shortcut icon" sizes="192x192" href="assets/images/icons/favicon-192.png">
    <link rel="apple-touch-icon" href="assets/images/icons/favicon-192.png">

    <title>Page non trouvée | Guidigit.com</title>

  <!-- Bootstrap CSS CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!--<link rel="stylesheet" href="~https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css" media="screen">
  -->
  <!-- Bootstrap CSS local fallback -->

  <!--  custom css  --->
  <link rel="stylesheet" href="assets/css/custom-css.css">

  <script>
    var test = document.createElement("div")
    test.className = "hidden d-none"

    document.head.appendChild(test)
    var cssLoaded = window.getComputedStyle(test).display === "none"
    document.head.removeChild(test)

    if (!cssLoaded) {
        var link = document.createElement("link");

        link.type = "text/css";
        link.rel = "stylesheet";
        link.href = "assets/css/bootstrap.min.css";

        document.head.appendChild(link);
    }
  </script>
</head>

<body>

<?php require_once 'includes/header.php'?>

  <main class="container-fluid d-flex">
     <div class="mx-auto my-5">
     <h3 class="my-5">Page non trouvée | 404</h3>
     </div>
  </main>

  <?php require_once 'includes/footer.php'?>

  <!-- jQuery CDN -->
  <script src="~https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <!-- jQuery local fallback -->
  <script>window.jQuery || document.write('<script src="node_modules/jquery/dist/jquery.min.js"><\/script>')</script>

  <!-- Bootstrap JS CDN -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <!-- Bootstrap JS local fallback -->
  <script>if(typeof($.fn.modal) === 'undefined') {document.write('<script src="assets/js/bootstrap.min.js"><\/script>')}</script>

</body>
</html>