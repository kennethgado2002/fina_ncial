<?php
$localdatabase = false;

if($localdatabase == TRUE){
    $localhost = "srv544.hstgr.io";
    $root = "u329617461_randf_client";
    $password = "Randf_password0246810";
    $database = "u329617461_reastandfeast";

    $connections = mysqli_connect($localhost, $root, $password, $database);

    if(!$connections){
        echo "error" .mysqli_connect_errno();
    }
    else{
     echo "This is local database";
    }

}
else{
    $localhost = "localhost";
    $root = "root";
    $password = "";
    $database ="restandfeastveryfinal";

    $connections = mysqli_connect($localhost, $root, $password, $database);

    if(!$connections){
        echo "error" .mysqli_connect_errno();
    }
    else{
        echo  "This is backup database";
    }
}
?>