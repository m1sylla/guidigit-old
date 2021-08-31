<?php require_once("../includes/Sessions.php"); ?>
<?php require_once("../includes/Wvchy_db_conn.php"); ?>

<?php
if(isset($_POST["submit"])){
  $ConnectingDB=mysqli_connect($servername, $username, $password, $dbName);
  if (!$ConnectingDB) {
    die("Connexion échouée: ".mysqli_connect_error());
  }

  $email = mysqli_real_escape_string($ConnectingDB, $_POST["email"]);
  $password = mysqli_real_escape_string($ConnectingDB, $_POST["password"]);

  if(empty($email) || empty($password)){
	  $_SESSION["ErrorMessage"]="Tous les champs doivent être remplis!";
    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/adm-digit-zky/gui-signin.php");

  }else{
    $sql = "SELECT * FROM admin_guidigit WHERE email= '$email' AND password = '$password';";
    $result = mysqli_query($ConnectingDB, $sql);
    $row = mysqli_fetch_assoc($result); 
    $count = mysqli_num_rows($result);
    if($count > 0){
      $_SESSION["User_Id"] = $row['id']; 
      $_SESSION["Name"] = $row['name']; 
      $_SESSION["SuccessMessage"] = "Bienvenue!  {$_SESSION["name"]} ";
    
      header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/adm-digit-zky/index.php");
      exit;
    }else{
      $_SESSION["ErrorMessage"] = "Erreur de connexion";
      header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/adm-digit-zky/gui-signin.php");
      exit;
    }

  }	
}	

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

<body class="bg-light">

<div class="row">
	<div class="col-12 col-sm-8 col-md-6 col-lg-4 mx-auto">
		<br><br>
    <?php echo errorMessage(); ?>
	<div>
<div>

<div class="row">
<div class="col-auto mx-auto my-5">

<form class="form-signin my-5" action="<?=$_SERVER['PHP_SELF']?>" method="post">
  <h1 class="h3 mb-3 font-weight-normal px-5">Se connecter</h1>
  
  <input type="email" class="form-control mb-4" name="email" placeholder="Email address" required autofocus>
  
  <input type="password" class="form-control mb-4" name="password" placeholder="Password" required>
  
  <input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Se connecter">
</form>


</div>
</div>
 

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