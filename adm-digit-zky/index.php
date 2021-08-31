<?php
  session_start();
  if(!isset($_SESSION["User_Id"])){
    $_SESSION["ErrorMessage"]="Vous devez être connecté ! ";
    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/adm-digit-zky/gui-signin.php");
    exit;
  }


  require_once("../includes/Wvchy_db_conn.php"); 

  $ConnectingDB=mysqli_connect($servername, $username, $password, $dbName);
  if (!$ConnectingDB) {
      //die("Connexion échouée: ".mysqli_connect_error());
  }

  $query = "SELECT * FROM contact_guidigit;";//WHERE seen= 0
  $results = mysqli_query($ConnectingDB, $query);

  $sql="UPDATE contact_guidigit SET seen=1 WHERE seen=0;"; 
  mysqli_query($ConnectingDB, $sql);

?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700' rel='stylesheet' type='text/css'>

    <title>Admin</title>

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
        link.href = "../assets/css/bootstrap.min.css";

        document.head.appendChild(link);
    }
  </script>
</head>

<body>
 
    <div class="container-fluid text-white bg-dark py-3 position-relative">
        <h3 class="text-sm-center">GuiDigit</h3>
        <form class="form-inline position-absolute" action="logout.php" method="post"
        style="right:0.8em; top:50%; -ms-transform:translateY(-50%); transform:translateY(-50%);">
          <button type="submit" name="submit" class="btn text-white">Déconnexion</button>
        </form>
    </div>

    <main class="container-fluid">
        <div class="container py-5">

            <?php 

            if (mysqli_num_rows($results) > 0) { 
              while ($row=mysqli_fetch_assoc($results)) { ?>

                <div class="row mb-3 bg-light shadow-sm rounded">
                   <div class="col-12 pt-2">
                     <span class="text-muted"><?php echo  $row['sent_at']; ?></span>
                       <span class="text-muted">&nbsp;&nbsp;&nbsp;
                       <?php if ($row['seen'] == 1) { echo "Vu"; } ?></span> <br>
                     <strong>Envoyé Par : </strong> &nbsp; <span><?php echo  $row['first_name']." ".$row['last_name']; ?></span>
                     &nbsp;&nbsp; | &nbsp;&nbsp; <strong>Entreprise : </strong><span><?php echo $row['enterprise_name']; ?></span>
                     &nbsp;&nbsp; | &nbsp;&nbsp; <span><?php echo $row['phone']; ?></span> &nbsp;&nbsp; | &nbsp;&nbsp; 
                     <span><?php echo $row['email']; ?></span> &nbsp;&nbsp; | &nbsp;&nbsp;
                    <strong>M'appeler ? </strong> <span><?php if ($row['call_me']) {
                       echo "Oui";
                     } else {
                      echo "Non";
                     }
                       ?></span>
                   </div>
                   <div class="col-12 pb-2">
                     <p>
                     <?php echo $row['message']; ?> 
                     </p>
                   </div>
                </div>
                
            <?php } }else{ ?>
                <div class="row my-1 bg-light">
                <div class="col py-4 h3 text-center">
                   Aucun nouveau message
                </div>
                </div>
            <?php } ?>

            
        </div>
    </main>

  <!-- jQuery CDN -->
  <script src="~https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <!-- jQuery local fallback -->
  <script>window.jQuery || document.write('<script src="../node_modules/jquery/dist/jquery.min.js"><\/script>')</script>

  <!-- Bootstrap JS CDN -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <!-- Bootstrap JS local fallback -->
  <script>if(typeof($.fn.modal) === 'undefined') {document.write('<script src="../assets/js/bootstrap.min.js"><\/script>')}</script>

</body>
</html>