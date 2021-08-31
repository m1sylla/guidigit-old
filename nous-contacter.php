<?php
  session_start();
  require_once("includes/Wvchy_db_conn.php"); 

  // processing contact form
if (isset($_POST['submit'])) {
  $ConnectingDB=mysqli_connect($servername, $username, $password, $dbName);
  if (!$ConnectingDB) {
      die("Connexion échouée: ".mysqli_connect_error());
  }

  $first_name = mysqli_real_escape_string($ConnectingDB, $_POST['first_name']);
  $last_name = mysqli_real_escape_string($ConnectingDB, $_POST['last_name']);
  $enterprise_name = mysqli_real_escape_string($ConnectingDB, $_POST['enterprise_name']);
  $email = mysqli_real_escape_string($ConnectingDB, $_POST['email']);
  $phone = mysqli_real_escape_string($ConnectingDB, $_POST['phone']);
  $budget = mysqli_real_escape_string($ConnectingDB, $_POST['budget']);
  $message = mysqli_real_escape_string($ConnectingDB, $_POST['message']);
  $call_me = mysqli_real_escape_string($ConnectingDB, $_POST['call_me']);

  if (empty($first_name) || empty($last_name) || empty($enterprise_name) || empty($phone)) {
      
     $_SESSION["ErrorContact"]="<div class=\"alert alert-danger\">Il y a des champs non remplis!</div>";
      header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/nous-contacter.php");
      exit;
  }else{

    if(!preg_match("/^[0-9\s]{9,12}$/", $phone)) {
      $_SESSION["ErrorContact"]="<div class=\"alert alert-danger\">Numéro invalide!</div>";
      header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/nous-contacter.php");
      exit;
    }

    date_default_timezone_set("UTC");
    $sent_at=date("Y-m-d H:i:s",time());

      $query = "INSERT INTO contact_guidigit (first_name,last_name,enterprise_name,email,phone,budget,message,sent_at,call_me) 
                  VALUES ('$first_name','$last_name','$enterprise_name','$email','$phone','$budget','$message','$sent_at','$call_me');";
      $insert = mysqli_query($ConnectingDB, $query);

      if ($insert) {
          $_SESSION["SuccessContact"]="<div class=\"alert alert-success\">Message bien envoyé! Nous vous répondrons bientôt!</div>" ;
          header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/nous-contacter.php");
          exit;
      }else{
          $_SESSION["ErrorContact"]="<div class=\"alert alert-danger\">Insertion échouée!</div>";
          header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/nous-contacter.php");
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

  <meta name="keywords" content="Médias Sociaux, Marketing social, Marketing digital, Marketing en Guinée">
  <meta name="description" content="Gestion et Campagne Médias Sociaux en Guinée. Faites votre sur marketing sur Facebook, Twitter, Instagram, LinkedIn avec GuiDigit">



    <!--- Twitter meta -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@guidigit" />
    <meta name="twitter:creator" content="@guidigit" />

    <meta property="og:type"        content="website" />
    <meta property="og:title"       content="Marketing social en Guinée, Marketing sur Facebook, Twitter, Instagram, LinkedIn - Guidigit" />
    <meta property="og:description" content="Gestion et la Campagne Médias Sociaux en Guinée - Gestion de vos pages sur Facebook, Twitter, Instagram, LinkedIn. Création et publication des contenus" />
    <meta property="og:image"       content="assets/images/guidigit-og.png" />

    <!----  favicon  --->
    <link rel="shortcut icon" type="image/png" href="assets/images/icons/favicon-192.png">
    <link rel="shortcut icon" sizes="192x192" href="assets/images/icons/favicon-192.png">
    <link rel="apple-touch-icon" href="assets/images/icons/favicon-192.png">

    <title>Marketing sur les réseaux sociaux Guinée | Guidigit.com</title>

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


    //chexhbox
    $(function(){
      $(':checkbox').on('change', function() {
        if (this.checked == true)
            $(this).val("1"); 
        else
            $(this).val("0");
      });
    });
  </script>
</head>

<body>

<?php require_once 'includes/header.php'?>

  <main class="container-fluid">
      <!--<div class="row">
      <div class="col contact-us-img">
        <img src="/assets/images/guidigit-contact-us.png" style="visibility: hidden;" alt="">
        <h2 class="text-center">
            Nous contacter
        </h2>
      </div>
      </div>-->

  <div class="container">

    <div class="row mt-5">
      <div class="col mt-3 text-center">
        <h2 class="title-color py-3" >
          Faisons du bon Travail Ensemble!
        </h2>
        <span class="px-5" style="border-top:solid 3px #24009c;"></span>
      </div>
    </div>

    <div class="row">
      <div class="col mt-5">
        Nous aimerions entendre de vous et discuter de comment augmenter
        l'influence de votre Entreprise, votre Marque ou Votre Organisation
        sur les plateformes des Médias Sociaux (Facebook, Instagram, Twitter,
        LinkedIn, Pinterest). Appelez nous au <strong>+224 629 37 35 30</strong>
        ou remplissez le formulaire ci-dessous.
      </div>
    </div>

    <!--   contact form   -->
    <div class="row my-5">
      <div class="col-12">
          <?php 
          if (isset($_SESSION["ErrorContact"])) {
            echo $_SESSION["ErrorContact"];
            $_SESSION["ErrorContact"]=null;
           } 
           if (isset($_SESSION["SuccessContact"])) {
            echo $_SESSION["SuccessContact"];
            $_SESSION["SuccessContact"]=null;
          } 
          ?>
      </div>
      <div class="col-12">
        <form class="mt-3" action="<?=$_SERVER['PHP_SELF']?>" method="post">
          <div class="form-group row">
            <div class="col-md-6 mb-3 mb-md-0">
              <input type="text" class="form-control form-control-lg" name="first_name" placeholder="Prénom">
            </div>
            <div class="col-md-6">
              <input type="text" class="form-control form-control-lg" name="last_name" placeholder="Nom">
            </div>
          </div>

          <div class="form-group">
            <input type="text" class="form-control form-control-lg" name="enterprise_name" placeholder="Entreprise, Marque ou Organisation">
          </div>

          <div class="form-group">
            <input type="email" class="form-control form-control-lg" name="email" placeholder="Email" aria-describedby="email">
            <small id="email" class="form-text text-muted">
              Cet email ne sera utilisé que pour vous contacter.
            </small>
          </div>

          <div class="form-group">
            <input type="text" class="form-control form-control-lg" name="phone" placeholder="Téléphone" aria-describedby="phone">
            <small id="phone" class="form-text text-muted">
              Ce numéro ne sera utilisé que pour vous contacter.
            </small>
          </div>

          <div class="form-group">
            <select class="form-control form-control-lg" name="budget">
              <option value="Inconnu">Budget mensuel marketing</option>
              <option value="Inconnu">Inconnu</option>
              <option value="Moins de 1 000 000 GNF/mois">Moins de 1 000 000 GNF/mois</option>
              <option value="1 000 000 - 3 000 000 GNF/mois">1 000 000 - 3 000 000 GNF/mois</option>
              <option value="3 000 000 - 5 000 000 GNF/mois">3 000 000 - 5 000 000 GNF/mois</option>
              <option value="5 000 000 - 10 000 000 GNF/mois">5 000 000 - 10 000 000 GNF/mois</option>
              <option value="10 000 000 - Plus GNF/mois">10 000 000 - Plus GNF/mois</option>
            </select>
          </div>

          <div class="form-group">
            <textarea class="form-control form-control-lg" rows="5" name="message" placeholder="Message"></textarea>
          </div>

          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="callMe" name="call_me" value="1" checked>
            <label class="form-check-label" for="callMe">Vous pouvez m'appeler au téléphone</label>
          </div>

          <button class="btn btn-lg btn-primary py-3 px-5" type="submit" name="submit">Envoyer</button>

        </form>
      </div>
    </div>
    <!--  end contact form   -->

    <!--   How we can help   -->

    <!--  end How we can help   -->

    <!--   FAQ   -->

    <!--   end FAQ   -->

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
