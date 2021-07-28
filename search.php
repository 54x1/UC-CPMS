<?php
//thinking of cross user searching and adding. originally just search your own database/implement mal api
// database data redundancy in database
// duplicacy of data management from adding and removing titles
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
//<- login if start ->
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    // Include config file
    $title = "Search AniDEX";
    $act2 = "active";
    $act1 = $act3 = $act4 = "";
                                      global $added, $ref;
    include "./includes/header.php";
    // include the config file that we created before
    require_once "./admin/config.php";



    //search database
    //<- submit if search start ->
    // if (isset($_POST['submit'])) {
        // this is called a try/catch statement
        try {
            // FIRST: Connect to the database
            $connection = new PDO($dsn, $username, $password, $options);
            $userid = $_SESSION['id'];
            // SECOND: Create the SQL
            //working ish
//             $sql = "SELECT * FROM anibase WHERE anibase.animename like :search and userid= :id
// union SELECT * from anibase where anibase.animename like :search group by animename order by animename";

$sql = "SELECT Distinct a.animeid, a.userid,a.animename, a.episodes, a.image, a.imageup
FROM anibase as a
LEFT JOIN users
ON a.animename like :search and userid=:id left join anibase as b on a.animename like :search group by animename";
            // THIRD: Prepare the SQL
            $statement = $connection->prepare($sql);
            $statement->bindValue(':id', $userid);
            $statement->bindValue(':search', "%%");
            $statement->execute();
            // FOURTH: Put it into a $result object that we can access in the page
            $result = $statement->fetchAll();


            //<- add/removeing start ->
            if (isset($_GET['addid']) && !empty($_GET['addid'])) {
                try {
                  //<-select anime row from other user start ->
                    $connection = new PDO($dsn, $username, $password, $options);
                    $id = $_GET['addid'];
                    // echo $id;
                    $sql3 = "SELECT * FROM anibase where animeid = :id";
                    $statement3 = $connection->prepare($sql3);
                    $statement3->bindValue(':id', $id);
                    $statement3->execute();
                    $result3 = $statement3->fetchAll();
          //<-select anime row from other user end ->
                    if ($statement3->rowCount() > 0) {
                            foreach ($result3 as $row3) {
                              //<-add anime name from other user start ->
                                $animename = $row3['animename'];
                                if(!empty($row3['imageup'])){
                                $imageup = $row3['imageup'];
                                  $image = "0";

                                }
                                if(!empty($row3['image'])){
                                  $image = $row3['image'];
                                  $imageup = "0";
                                }


                                $episodes = "0";
                                $userid = $_SESSION['id'];
                                $sql4 = "INSERT INTO anibase (userid, animename, episodes, image, imageup) VALUES (:userid, :animename, :episodes, :image, :imageup)";
                                $statement4 = $connection->prepare($sql4);
                                $statement4->bindValue(":userid", $userid);
                                $statement4->bindValue(":animename", $animename);
                                $statement4->bindValue(":episodes", $episodes);
                                $statement4->bindValue(":image", $image);
                                $statement4->bindValue(":imageup", $imageup);
                                $statement4->execute();

                                $added = "<div class='container-fluid bg-success'><h3>$animename Successfully Added to List.</p></div>";
                                $ref = "<div class='container-fluid bg-success'><p>Results Refresh...</p></div>";

                                echo $added;
                                echo $ref;
                                ?>

                                <script> setTimeout(function() { window.location = "search.php"; }, 1000);</script>
                                <?php
                                    //<-add anime name from other user end ->
                            }
                    }
                }
                catch(PDOException $error) {
                    echo $sql4 . "<br>" . $error->getMessage();
                }
            } else {
                // echo "Unknow ID";
            }
            if (isset($_GET['removeid']) && !empty($_GET['removeid'])) {
              $connection = new PDO($dsn, $username, $password, $options);
                  $id = $_GET["removeid"];
              $sql7 = "SELECT * FROM anibase where animeid = :id";
              $statement7 = $connection->prepare($sql7);
              $statement7->bindValue(':id', $id);
              $statement7->execute();
              $result7 = $statement7->fetchAll();
                try {
                    // define database connection
                    $connection = new PDO($dsn, $username, $password, $options);
                    // set id variable
                    foreach ($result7 as $row7) {
                      $animename = $row7['animename'];
                    }


                    // Create the SQL
                    $sql2 = "DELETE FROM anibase WHERE animeid = :id";
                    // Prepare the SQL
                    $statement2 = $connection->prepare($sql2);
                    // bind the id to the PDO
                    $statement2->bindValue(':id', $id);
                    // execute the statement
                    $statement2->execute();
                    // $result2 = $statement2->fetchAll();
                    //error control of invalid variable
                    if (empty($animename)){
                      $animename = "";
                    }
                    echo "<div class='container-fluid bg-success'><h3>$animename Successfully Removed from List.</p></div>";
                    echo "<div class='container-fluid bg-success'><p>Results Refreshing...</p></div>";
                    ?>

                    <script> setTimeout(function() { window.location = "search.php"; }, 1000);</script>
                    <?php
                    }
                catch(PDOException $error) {
                    // if there is an error, tell us what it is
                    echo $sql2 . "<br>" . $error->getMessage();
                }
            }
            //<- add/removeing start ->



?>
<div class="container-fluid">

    <h2>AniDEX Anime Database</h2>

    <div class="search_query"  method="post">
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
        <th>Add/Remove</th>
      </tr>
    </thead>
    <tbody class="search_table">
      <?php  foreach ($result as $row){ ?>



     <tr>

    <td>
      <div class="row">


      <div class="col-sm-6 center-block col-md-6 col-lg-6 col-sm-push-3">
             <?php

               echo "<b>". $row['animename'] . "</b>";
               ?>
             </div>
                 </div>
               <div class="col-sm-6 col-sm-offset-6 col-md-offset-7  col-lg-offset-8  col-md-4 col-lg-2 col-sm-pull-3">

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
        </div>
    </td>
   <td>

      <?php
// echo $row2;
        if ($row['episodes'] && $userid == $row['userid']){
       echo $row['episodes'];
     }
     else{
       echo "0";
     }
      // break;

 //}
  // }
  ?>
   </td>
        <td>
        <?php if ($statement->rowCount() > 0 && $userid == $row['userid']) {?>
          <a href="search.php?removeid=<?php echo $row['animeid'];?>" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-remove"></span></a>
        <?php } else {?>
          <a href="search.php?addid=<?php echo $row['animeid'];?>" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus"></span></a>
        <?php  } ?>
     </td>
     </tr>
    <?php
  // }
// break;
}
//   break;
// }


?>

   </tbody>
  </table>

<?php
              ///<-check if anime is in database end->
              //needed more time to implement add feature if not found
              //true to see feature
               if (false) {

?>
   <div class="container-fluid sResult">
  <h2>Results for: "<span class="getid"></span>"</h2>
  <div class="results">
      <form class="addform" method="get">
        <span class="container">"<span class="getid"></span>" does not appear to have been added to the database would you like to add "<span class="getid"></span>"
        <a href="add.php?name=<?php echo $getid?>" class="btn btn-default btn-sm">
      <span type="submit" name="submit" class="glyphicon glyphicon-plus"></span>
    </a>
    </span>
    </form>
  </div>

  </div>
</div>
<?php
                // var_dump($result);

           }
         }

        catch(PDOException $error) {
            // if there is an error, tell us what it is
            echo $sql . "<br>" . $error->getMessage();
        }
?>
</div>
</body>
  </html>
  <?php
   //} //<- submit search end ->



}
//<- login if end ->
else {
    header("location: login.php");
    exit;
}
?>
