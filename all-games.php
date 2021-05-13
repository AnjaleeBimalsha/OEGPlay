<!DOCTYPE html>
<html>
  <head>
    <link rel="styleSheet" href="css/admin-sidebar.css" />
    <link rel="styleSheet" href="css/all-games.css" />
    <?php include 'header.php'; ?>
  </head>

  <body>
    <div class="a-container">
      <?php include 'admin-sidebar.php'; ?>
      <div class="alg-container">
        <h2>Games</h2>
        <div class = "table" >
        <table class = "games-table">
          <tr>
            <th>Game Name</th>
            <th>Grade</th>
            <th>Category</th>
            <th>Subject</th>
            <th>Description</th>
            <th>Access Level</th>
            <th>Added By</th>
            <th>Developer</th>
            <th></th>
            <th></th>
          </tr>
          <?php
              require 'includes/database.inc.php';

              $sql = "SELECT gameID, gameName, gameGrade, gameCategory, gameSubject, gameDescription, gameAccess, adminID, devID FROM Game";
              $result = mysqli_query($conn, $sql);

              if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                  echo '<tr>';
                  echo '<td>'.$row["gameName"].'</td>';
                  echo '<td>'.$row["gameGrade"].'</td>';
                  echo '<td>'.$row["gameCategory"].'</td>';
                  echo '<td>'.$row["gameSubject"].'</td>';
                  echo '<td>'.$row["gameDescription"].'</td>';
                  echo '<td>'.$row["gameAccess"].'</td>';
                  echo '<td>'.$row["adminID"].'</td>';
                  echo '<td>'.$row["devID"].'</td>';
                  echo '<td><a href="modifygame.php?id='.$row['gameID'].'" class="tablebtn">Modify</a></td>';
                  echo '<td><form action="includes/deletegame.inc.php" name="delete-member" method="get">
                        <input type="hidden" name="rowid" value="'.$row['gameID'].'">
                        <button class="tablebtn2" type="submit" onClick="return confirm(\'Are you sure?. this operation cannot be undone!\')">Delete</button>
                        </form></td>';
                  echo '</tr>';
                }
              }
              else {
                echo '<tr>';
                echo '<td colspan="10">O Games Found!</td>';
                echo '</tr>';
              }
          ?>
        </table>
        </div>
      </div>
    </div>
  </body>
  <?php include('./footer.php'); ?>
  <div class= "output">
        <?php
          if (isset($_GET["error"])) {
            if ($_GET["error"] == "none") {
              echo "<script type='text/javascript'>alert('Game successfully deleted from the database');</script>";
            }
            if ($_GET["error"] == "gmnone") {
              echo "<script type='text/javascript'>alert('Game successfully Modified');</script>";
            }
            if ($_GET["error"] == "20") {
              echo "<script type='text/javascript'>alert('You can not upload a game file of this type!. only js,html are allowd');</script>";
            }
            if ($_GET["error"] == "21") {
              echo "<script type='text/javascript'>alert('There was an error uplaoding game file!');</script>";
            }
            if ($_GET["error"] == "22") {
              echo "<script type='text/javascript'>alert('Game file is too big!');</script>";
            }
            if ($_GET["error"] == "23") {
              echo "<script type='text/javascript'>alert('You can not upload a thumbnail of this type!. only jpg,jpeg and png are allowd');</script>";
            }
            if ($_GET["error"] == "24") {
              echo "<script type='text/javascript'>alert('here was an error uplaoding thumbnail!');</script>";
            }
            if ($_GET["error"] == "25") {
              echo "<script type='text/javascript'>alert('Thumbnail is too big!');</script>";
            }
          }
          ?>
  </div>
</html>
