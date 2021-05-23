<link rel="styleSheet" href="css/sidebar.css" />
<link rel="styleSheet" href="css/modify-member.css" />
<?php 
      $title = 'Modify Games';
      include 'header.php'; 
      include_once ('./includes/admin-config.inc.php');
?>

<div class="a-container">
      <?php include 'admin-sidebar.php'; ?>
      <div class="ag-container">
        <h2>- Modify Member -</h2>

        <?php 
          require 'includes/database.inc.php';

          $mid = $_GET['id'];

          echo '<form action="includes/modifymember.inc.php?id='.$mid.'" method="post" name="modify-member" enctype="multipart/form-data" >';

          $sql = "SELECT M.memberID, M.username, M.firstName, M.lastName, M.TID, ME.email, MM.m_plan, MM.m_status, MM.renewal_date
                  FROM Member AS M
                  JOIN Member_email AS ME ON ME.memberID = M.memberID
                  JOIN Membership AS MM ON MM.memberID = M.memberID
                  WHERE M.memberID = $mid;";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);

          $uName = $row["username"];
          $fName = $row["firstName"];
          $lName = $row["lastName"];
          $TID = $row["TID"];
          $mEmail = $row["email"];
          $mPlan = $row["m_plan"];
          $mStatus = $row["m_status"];
          $rDate = $row["renewal_date"];
          }
          else{
              // Error MSG
          }
          
          echo '<div class="form-item">
                <label for="fname">First Name:</label>
                <input type="text" name="fname" id="fname" value = "'.$fName.'" required/>
                </div>';
          echo '<div class="form-item">
                <label for="lname">Last Name:</label>
                <input type="text" name="lname" id="lname" value = "'.$lName.'" required/>
                </div>';
          echo '<div class="form-item">
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" value = "'.$mEmail.'" required/>
                </div>';
          if($TID == 1) {
                echo '<div class="form-item">';
                echo '<label for="m-types">Membership Type:</label>';
                echo '<select name="m-type" id="m-types" required>';
                echo '<option disabled selected value> -- Select Membership Type -- </option>';
                echo '<option selected value="1">Premium</option>
                     <option value="2">Free</option>';
                echo '</select>';
                echo '</div>';

                echo '<div class="form-item">';
                echo '<label for="plans">Plan:</label>';
                echo '<select name="plan" id="plans" required>';
                echo '<option disabled selected value> -- Select plan -- </option>';
                if ($mPlan == 'Annual') { 
                  echo '<option selected value="Annual">Annual</option>
                        <option value="Monthly">Monthly</option>';
                }
                else {
                  echo '<option value="Annual">Annual</option>
                        <option selected value="Monthly">Monthly</option>';
                }
                echo '</select>';
                echo '</div>';

                echo '<div class="form-item">
                      <label for="name">Renewal Date:</label>
                      <input type="text" name="rdate" id="rdate" value = "'.$rDate.'" required/>
                      </div>';

                echo '<div class="form-item">';
                echo '<label for="m_status">Status:</label>';
                echo '<select name="status" id="m_status" required>';
                echo '<option disabled selected value> -- Select Status -- </option>';
                if ($mStatus == 'Active') { 
                  echo '<option selected value="Active">Active</option>
                        <option value="Expired">Expired</option>';
                }
                else {
                  echo '<option value="Active">Active</option>
                        <option selected value="Expired">Expired</option>';
                }
                echo '</select>';
                echo '</div>';
          }
          else if( $TID == 2) {
                echo '<div class="form-item">';
                echo '<label for="m-types">Membership Type:</label>';
                echo '<select name="m-type" id="m-types" required>';
                echo '<option disabled selected value> -- Select Membership Type -- </option>';
                echo '<option  value="1">Premium</option>
                     <option selected value="2">Free</option>';
                echo '</select>';
                echo '</div>';

                echo '<div class="form-item">';
                echo '<label for="plans">Plan:</label>';
                echo '<select name="plan" id="plans" required>';
                echo '<option disabled selected value> -- Select plan -- </option>';
                echo '<option selected value="Annual">Annual</option>
                      <option value="Monthly">Monthly</option>';
                echo '</select>';
                echo '</div>';

                echo '<div class="form-item">
                      <label for="name">Renewal Date:</label>
                      <input type="text" name="rdate" id="rdate" value = "'.$rDate.'" required/>
                      </div>';

                echo '<div class="form-item">';
                echo '<label for="m_status">Status:</label>';
                echo '<select name="status" id="m_status" required>';
                echo '<option disabled selected value> -- Select Status -- </option>';
                echo '<option selected value="Active">Active</option>
                      <option value="Expired">Expired</option>';
                echo '</select>';
                echo '</div>';
          }

          ?>

          <div class="ag-buttons">
            <button class="addgame-btn" name = "submit" type= "submit" onclick="return confirm('Please confirm!')">Save</button>
          </div>
        </form>
      </div>
    </div>


<?php include('./footer.php'); ?>