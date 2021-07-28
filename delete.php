<?php
//orig idea overlay modal but cant be bothered;
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){

    }
    else{
    header("location: login.php");
    exit;
    }

// Include config file
$title = "Delete Anime";
$act1 = "active";
$act2=$act3=$act4 = "";
include "./includes/header.php";

    // include the config file that we created before
require_once "./admin/config.php";
if (isset($_GET['id']) && !empty($_GET['id'])) {
// this is called a try/catch statement
try {
    // FIRST: Connect to the database
    $connection = new PDO($dsn, $username, $password, $options);
  $animeid = $_GET['id'];
            $userid = $_SESSION['id'];

    // SECOND: Create the SQL
    $sql1 ="SELECT * FROM anibase where  anibase.animeid = :animeid group by :userid";

    // THIRD: Prepare the SQL
    $statement = $connection->prepare($sql1);

            $statement->bindValue(':animeid', $animeid);
            $statement->bindValue(':userid', $userid);
    $statement->execute();

    // FOURTH: Put it into a $result object that we can access in the page
    $result = $statement->fetchAll();


    if(isset($_POST['yes'])) {

      try {
          // define database connection
          $connection = new PDO($dsn, $username, $password, $options);

          // set id variable
          $animeid = $_GET["id"];

          // Create the SQL
          $sql3 = "DELETE FROM anibase WHERE userid  = :userid AND animeid = :animeid";


          // Prepare the SQL
          $statement3 = $connection->prepare($sql3);
          // bind the id to the PDO
          $statement3->bindValue(':animeid', $animeid);
            $statement3->bindValue(':userid', $userid);
          // execute the statement
          $statement3->execute();
          //this fetchAll gives a false error
          $result3 = $statement3->fetchAll();
        } catch(PDOException $error) {
              // if there is an error, tell us what it is
          // echo $sql3 . "<br>" . $error->getMessage();
        }
  }

  foreach($result as $row) {
  if(isset($_POST['cancel'])) {
header("Location: delete.php?id=".$row['animeid']."");
  }
}

}

 catch(PDOException $error) {
    // if there is an error, tell us what it is
echo $sql1 . "<br>" . $error->getMessage();
}
if (isset($_POST['yes']) && $statement3) {?>
<h3 class='container-fluid bg-success'><p>Anime Successfully Deleted. </br>Results Refreshing...</p></h3>
<script> setTimeout(function() { window.location = "search.php"; }, 1250);</script>

          <div class="container-fluid">
<h2>My Anime Index</h2>
<h3>Deleted <?php foreach($result as $row) { echo $row['animename'];}?>?</h3>
<?php

// header( "location: index.php");
}
        ?>

        <?php foreach($result as $row) { ?>
        <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Anime</th>
                <th>Episodes Watched</th>
                <th>Are You Sure?</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td name="animename" value="<?php echo $row['animename'];?>"><?php echo $row['animename'];?></td>
                <td name="episodes" value="<?php echo $row['episodes'];?>"><?php echo $row['episodes'];?></td>
                <td><a data-toggle="modal"  data-target="#myModal" data-id="<?php echo $row['animeid'];?>" class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-trash"></span>
              </a></td>
              </tr>
            </tbody>
          </table>
        <?php } ?>

        <!-- Modal START -->

        <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Are You Sure?</h4>
          </div>



              <?php foreach($result as $row) {?>
        <form method="post" action="delete.php?id=<?php echo $row['animeid'];?>" class="container">
              <div class="modal-body">
          <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Anime</th>
                  <th>Episodes Watched</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td name="animename" value="<?php echo $row2['animename'];?>"><?php echo $row['animename'];?></td>
                  <td name="episodes" value="<?php echo $row['episodes'];?>"><?php echo $row['episodes'];?></td>
                </tr>
              </tbody>
</table>
</div>
<div class="modal-footer">
<input type="submit" name="yes" value="YES" class="btn-update btn-danger btn btn-default btn-sm">
<input type="submit" name="cancel" value="CANCEL" class="btn-update btn-success btn btn-default btn-sm">
</div>
        </form>
    <?php }?>



</div>
        </div>
        </div>
        <!-- Modal END -->


</div>
</body>
  </html>
  <?php
}else{
    echo "Error: Unknown ID";
}
   ?>
