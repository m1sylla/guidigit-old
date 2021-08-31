<?php require_once("../includes/Wvchy_db_conn.php"); ?>
<?php require_once("../includes/Sessions.php"); ?>

<?php

$ConnectingDB=mysqli_connect($servername, $username, $password, $dbName);

if (!$ConnectingDB) {
    die("Connexion échouée: ".mysqli_connect_error());
}


function Redirect_to($New_Location){
    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/".$New_Location);
    //header("Location:".$New_Location);
	exit;
}

function Login_Attempt($Email,$Password){
    
    $Query="SELECT * FROM admin_guidigit WHERE email=? AND password=?;";
    /*$stmt = mysqli_stmt_init($ConnectingDB);

    if (!mysqli_stmt_prepare($stmt,$Query)) {
        return null;
    }else{
        mysqli_stmt_bind_param($stmt, "ss", $Email, $Password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($admin = mysqli_fetch_assoc($result)) {
            return $admin;
        } else {
            return null;
        }
        
    }*/
    
    $Execute=mysqli_query($ConnectingDB,$Query);
    $admin=mysqli_fetch_assoc($Execute);
    $count = mysqli_num_rows($admin);
    if($count > 0){
	return $admin;
    }else{
	return null;
    }
}

function Login(){
    if(isset($_SESSION["User_Id"])){
	return true;
    }
}

 function Confirm_Login(){
    if(!Login()){
	$_SESSION["ErrorMessage"]="Vous devez être connecté ! ";
	Redirect_to("adm-digit-zky/gui-signin.php");
    }
    
 }

?>