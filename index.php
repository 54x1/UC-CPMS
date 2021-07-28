<?php
//Get Heroku ClearDB connection information
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;
// Connect to DB
try{
    $pdo_connection = new PDO($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}

// $conn = mysqli_connect();
echo $pdo_connection;
?>
<?php
echo 'php app';
?>
