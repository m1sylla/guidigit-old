<?php
session_start();
function errorMessage(){
    if(isset($_SESSION["ErrorMessage"])){
       $Output="<div class=\"alert alert-danger\">" ;
       $Output.=htmlentities($_SESSION["ErrorMessage"]);
       $Output.="</div>";
       $_SESSION["ErrorMessage"]=null;
       return $Output;
        
    }
}

function successMessage(){
    if(isset($_SESSION["SuccessMessage"])){
       $Output="<div class=\"alert alert-success\">" ;
       $Output.=htmlentities($_SESSION["SuccessMessage"]);
       $Output.="</div>";
       $_SESSION["SuccessMessage"]=null;
       return $Output;
        
    }
}

?>