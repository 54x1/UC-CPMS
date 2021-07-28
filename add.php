<?php

session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){

    }
    else{
    header("location: login.php");
    exit;
    }

// Include config file
$title = "Add Anime";
$act4 = "active";
$act1=$act2=$act3 = "";
include "./includes/header.php";

if (isset($_POST['submit'])) {

    // include the config file that we created before
require_once "./admin/config.php";







// this is called a try/catch statement
try {
    // FIRST: Connect to the database
    $connection = new PDO($dsn, $username, $password, $options);
$animename = $_POST['animename'];



  if(!empty($_FILES["imagelocation"]["name"])){
    //// https://www.w3schools.com/php/php_file_upload.asp
    $target_dir = "uploads/";

    //The name of the file on the client machine.
    $target_file = $target_dir . basename($_FILES["imagelocation"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Use getimagesize to check if image file is an actual image or fake
    // tmp_name is the temporary filename stored on the server.
    $check = getimagesize($_FILES["imagelocation"]["tmp_name"]);
    if($check !== false) {
      // echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      //echo "File is not an image.";
      $upload_err = "File is not an image.";
      $uploadOk = 0;
    }

    // Check if file already exists
    // $count = 0;
    if (file_exists($target_file)) {
        //echo "Sorry, a file with that name already exists.";
      $upload_err = "Sorry, a file with that name already exists.";
      $uploadOk = 0;
      // $count++;
      // $target_file = $target_dir . $count. basename($_FILES["imagelocation"]["name"]);
    }


    // Check file size (limit in bytes)
    if ($_FILES["imagelocation"]["size"] > 500000) {
      //echo "Sorry, your file must be smaller than 500kb";
      $upload_err = "Sorry, your file must be smaller than 500kb.";
      $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $upload_err = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "<h3 class='container-fluid bg-danger'> Sorry, your file was not uploaded.</br> $upload_err</h3>";
      //exit();

      // if everything is ok, try to upload file
    } else if (empty($upload_err)) {
      if ( move_uploaded_file($_FILES["imagelocation"]["tmp_name"], $target_file) ) {
  				echo "<h3 class='container-fluid bg-success'>The file ". basename( $_FILES["imagelocation"]["name"] ). " has been uploaded.</p></h3>";
      } else {
        echo "<h3 class='container-fluid bg-danger'>Sorry, there was an error uploading your file.</p></h3>";

      }
    }
  }
if (empty($upload_err)){
    $imgurl = isset($_POST['imgurl']);
    // THIRD: Turn the array into a SQL statement
    $sql3 = "INSERT INTO anibase (userid, episodes, animename, image, imageup) VALUES (:userid, :episodes, :animename, :image, :imageup)";

    // FOURTH: Now write the SQL to the database
    $statement3 = $connection->prepare($sql3);
    $statement3->bindValue(':userid', $_SESSION['id']);
  $statement3->bindValue(":animename", $animename);
  $statement3->bindValue(':episodes', $_POST['episodes']);
  if(!empty($target_file)){
    $target_file = $target_dir . basename( $_FILES["imagelocation"]["name"] );
    $imgurl = "0";

  }
  if(!empty($imgurl)){
    $imgurl = $_POST['imgurl'];
    $target_file = "0";
  }
  $statement3->bindValue(':image', $imgurl);
      unset($imgurl);
  $statement3->bindValue(':imageup', $target_file);
      unset($target_file);

    $statement3->execute();

}
} catch(PDOException $error) {
    // if there is an error, tell us what it is
echo $sql3 . "<br>" . $error->getMessage();
}


}

if (!empty($_GET['name'])){
  $name = $_GET['name'];
}
else{
  $name = "";
}

?>
<?php if (isset($_POST['submit']) && isset($statement3) && empty($upload_err)) {?>
<h3><p class="container-fluid bg-success" >Anime Successfully Added.</p></h3>
<?php }?>
<div class="container-fluid">

    <h2>Add to Anime Database</h2>

    <form method="post" class="col-xs-6 col-md-3" enctype="multipart/form-data">
      <div class="form-group">

  <label for="animename">Anime Name</label>
  <input required type="text" value="<?php echo $name ?>" name="animename" id="animename" class="form-control">
</div>
      <div class="form-group">
  <label for="episodes">Episodes Watched</label>
  <input required type="number" min="0" name="episodes" id="episodes" class="form-control">

</div>
<div class="form-group upload">
<input type="button"  value="Enable File Upload" class="upload-btn btn">
<input type="button"  value="Enable URL Upload" class="imgurl-btn btn">
</div>
<div class="form-group">
  <label>Select image to upload:</label>
  <div class="form-group">
  <input type="file" disabled  name="imagelocation" id="imagelocation">
  </div>


</div>
<div class="form-group imgurl">
  <label>Enter image URL file type (e.g .jpg, .png):</label>
  <div class="form-group">
  <input type="text" name="imgurl"  disabled class="form-control imgurl" id="imgurl">
  </div>
</div>
  <!-- <label for="synopsis">synopsis</label>
  <input required type="text" name="synopsis" id="synopsis"> -->

  <input class="btn btn-primary" type="submit" name="submit" value="Submit">
  <?php if (isset($_POST['submit']) && isset($statement3) && empty($upload_err)) {?>
  <a href="index.php" class="btn btn-default btn-sm">Go to Anime List</a>

<?php } ?>
  </form>


</div>
  </body>

  </html>
