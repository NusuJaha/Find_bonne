<?php

//update_last_activity.php

include('database_connectionb.php');

session_start();

$query = "
UPDATE login_detailsb 
SET last_activity = now() 
WHERE login_details_id = '".$_SESSION["login_details_id"]."'
";

$statement = $connect->prepare($query);

$statement->execute();

?>
