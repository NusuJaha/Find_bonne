<?php

//update_is_type_status.php

include('database_connectionb.php');

session_start();

$query = "
UPDATE login_detailsb
SET is_type = '".$_POST["is_type"]."' 
WHERE login_details_id = '".$_SESSION["login_details_id"]."'
";

$statement = $connect->prepare($query);

$statement->execute();

?>
