<?php
$indevfinitedb = false;

if($indevfinitedb == TRUE){
    $server = "localhost";
    $user = "fina_ncial";
    $password = "o5z!dtAeU3y6H@xD";
    $database = "fina_ncialdb";

    $connections = mysqli_connect($server, $user, $password, $database);

    if(!$connections){
        echo "error" .mysqli_connect_errno();
    }
    else{
     echo "This is Indevfinite database";
    }

}
else{
    $server = "localhost";
    $user = "root";
    $password = "";
    $database ="fina_ncialdb";

    $connections = mysqli_connect($server, $user, $password, $database);

    if(!$connections){
        echo "error" .mysqli_connect_errno();
    }
    else{
        echo  "This is backup database";
    }
}
?>