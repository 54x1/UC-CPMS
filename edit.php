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
$title = "Edit My AniDEX";
$act2 = "active";
include "./includes/header.php";

    // include the config file that we created before
require_once "./admin/config.php";
if (isset($_GET['id']) && !empty($_GET['id'])) {
// this is called a try/catch statement
try {
    // FIRST: Connect to the database
    $connection = new PDO($dsn, $username, $password, $options);
  $id = $_GET['id'];
    // SECOND: Create the SQL
    $sql = "SELECT * FROM users, anibase where  anibase.userid = users.id and anibase.animeid= :id";

    // THIRD: Prepare the SQL
    $statement = $connection->prepare($sql);

            $statement->bindValue(':id', $id);
    $statement->execute();

    // FOURTH: Put it into a $result object that we can access in the page
    $result = $statement->fetchAll();

    if(isset($_POST['submit'])) {
      try {
        $connection = new PDO($dsn, $username, $password, $options);
        $id = $_GET['id'];
        $userid = $_SESSION['id'];
        $episodes = $_POST['episodes'];
        $sql2 = "UPDATE anibase SET episodes = :episodes WHERE anibase.animeid = :id and anibase.userid = :userid";
        $statement = $connection->prepare($sql2);
        $statement->bindValue(":id", $id);
        $statement->bindValue(":userid", $userid);
        $statement->bindValue(":episodes", $episodes);
        $statement->execute();
    }
    catch(PDOException $error) {
      echo $sql2. "<br>" . $error->getMessage();
    }
  }

}

 catch(PDOException $error) {
    // if there is an error, tell us what it is
echo $sql . "<br>" . $error->getMessage();
}
foreach($result as $row) {
  if ($_SESSION['id'] == $row['userid']){
          ?>
          <?php if (isset($_POST['submit']) && $statement) {?>
          <h3><p class='container-fluid bg-success'>Anime Successfully Updated.</br>Results Refreshing...</p></h3>
          <script> setTimeout(function() { window.location = "edit.php?id=<?php echo $row['animeid']?>"; }, 1250);</script>

          <?php

          }?>
          <div class="container-fluid">


<h2>Edit AniDEX</h2>



<form action="edit.php?id=<?php echo $row['animeid'];?>" class="episodes" method="post">

<table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Anime</th>
        <th>Episodes Watched</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td name="animename" value="<?php echo $row['animename'];?>"><?php echo $row['animename'];?></td>
        <td>
          <input required type="number" min="0" id="episodes" name="episodes" value="<?php echo $row['episodes'];?>">
          <input type="submit" name="submit" value="SAVE" class="btn-update btn btn-default btn-sm">
        </td>
        <td>          <a href="delete.php?id=<?php echo $row['animeid'];?>" class="btn btn-default btn-sm">
                  <span class="glyphicon glyphicon-remove"></span>
                </a></td>
      </tr>
    </tbody>
  </table>
<?php }
} ?>
</form>
</div>
</body>
  </html>
  <?php
}else{
    echo "Error: Unknown ID";
}
   ?>
