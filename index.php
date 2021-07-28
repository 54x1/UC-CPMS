<?php
//changed index from search to view my list
// has a prob with displaying all from database including other users
//in future combine search and view list or combine myanimelist api
// too fixated on this crud web app i could have just submit the basics of what the assignment required


session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){

    }
    else{
    header("location: login.php");
    exit;
    }

// Include config file
$title = "My AniDEX";
$act1 = "active";
$act2=$act3=$act4 = "";
include "./includes/header.php";

    // include the config file that we created before
require_once "./admin/config.php";

    // this is called a try/catch statement
	try {
        // FIRST: Connect to the database
        $connection = new PDO($dsn, $username, $password, $options);
    $userid = $_SESSION['id'];
        // SECOND: Create the SQL
        $sql = "SELECT * FROM anibase, users where anibase.userid = users.id and users.id= :id order by animename";


        // THIRD: Prepare the SQL
        $statement = $connection->prepare($sql);
          $statement->bindValue(':id', $userid);
        $statement->execute();

        // FOURTH: Put it into a $result object that we can access in the page
        $result = $statement->fetchAll();
	} catch(PDOException $error) {
        // if there is an error, tell us what it is
		echo $sql . "<br>" . $error->getMessage();
	}

  try {
        // FIRST: Connect to the database
        $connection = new PDO($dsn, $username, $password, $options);
    $userid = $_SESSION['id'];
        // SECOND: Create the SQL
        $sql = "SELECT * FROM users where id = :id";

        // THIRD: Prepare the SQL
        $statement = $connection->prepare($sql);
          $statement->bindValue(':id', $userid);
        $statement->execute();

        // FOURTH: Put it into a $result object that we can access in the page
        $result1 = $statement->fetchAll();
	} catch(PDOException $error) {
        // if there is an error, tell us what it is
		echo $sql . "<br>" . $error->getMessage();
	}

?>


          <div class="container-fluid">
<?php foreach ($result1 as $row) {?>
<h2 class="text-center">Welcome to AniDEX: <?php echo $row['username'];?></h2>

<?php
}

if (!empty($result)){
?>
<h2>Search My AniDEX</h2>
<div class="search_query">
        <input type="text" id="search_query" placeholder="Search for an Anime.." name="search">
        <button type="submit" name="submit">
          <i class="fa fa-search">
          </i>
        </button>
        </div>
  <table class="table">
    <thead>
      <tr>
        <th>Anime</th>
        <th>Episodes Watched</th>
        <th>Edit</th>
        <th>Remove From My List</th>
      </tr>
    </thead>
    <tbody class="search_table">
      <?php foreach($result as $row) {?>

      <tr>

        <td>  <div class="row">
          <div class="col-sm-6 center-block col-md-6 col-lg-6 col-sm-push-3">
                 <?php

                   echo "<b>". $row['animename'] . "</b>";
                   ?>
                     </div>
                   <div class="col-sm-6 col-sm-offset-6 col-md-offset-7 col-lg-offset-7  col-md-4 col-lg-4 col-sm-pull-3">

                      <?php
                  switch(TRUE)
                      {
                        case (!empty($row['image']) && $row['imageup'] == 0):
                        echo "<img class='img-fluid img-thumbnail thumbnail' src='" . $row["image"] . "' alt='" . $row['animename'] . "'>";
                        break;
                        case (!empty($row["imageup"]) && $row['image'] == 0):
                          echo "<img class='img-fluid img-thumbnail thumbnail' src='" . $row["imageup"] . "' alt='" . $row['animename'] . "'>";
                        break;
                        case (empty($row['image']) || $row['image'] == 0):
                        echo "<p class='small'>No image available.</p>";
                        break;
                        case (empty($row['imageup']) || $row['imageup'] == 0):
                        echo "<p class='small'>No image available.</p>";
                        break;
                        default: echo "<p class='small'>No image available.</p>";
                      }

            ?>
            </div>
            </div></td>
        <td><?php echo $row['episodes'];?></td>
        <td>
          <a href="edit.php?id=<?php echo $row['animeid'];?>" class="btn btn-default btn-sm">
          <span class="glyphicon glyphicon-edit"></span>
        </a>
      </td>
        <td>
          <a href="delete.php?id=<?php echo $row['animeid'];?>" class="btn btn-default btn-sm">
          <span class="glyphicon glyphicon-remove"></span>
        </a>
      </td>
      </tr>
    <?php } ?>
  </tbody>
  </table>
</div>
<?php } else{
  ?>
<div class="container">
  <a href="add.php">
  <button class="btn btn-primary btn-start btn-sm">Click here to add your first Anime!</button>
</a>
<a href="search.php">
  <button class="btn btn-primary btn-start btn-sm">Click here to search your first Anime!</button>
</div>
</a>
  <?php
}?>
</body>
  </html>
