<!DOCTYPE html>
<html lang="en">
<?php
require_once 'inc/inc.php';
require_once 'inc/checksession.php';
if(!isset($_GET['id'])){
  exit;
}

$_SESSION['previous-location'] = $_SERVER['REQUEST_URI'];
$status = '';
if (isset($_GET['status'])) {
  $status = $_GET['status'];
}
$user = new User($_GET['id'], 'id');
?>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.min.css">
    <title>Edit user</title>
  </head>

  <body>
    <div class="container-fluid">
      <div class="row">
        <!-- NAVIGATION -->
        <div class="col-sm-2 bg-light" id="navbar">
          <nav class="nav flex-column">
            <a class="nav-link navitem selected" href="#">Add User</a>
            <a class="nav-link navitem" href="bannedusers.php">Banned Users</a>
            <a class="nav-link navitem" href="userlist.php">User List</a>
            <a class="nav-link navitem" href="#" data-toggle="modal" data-target="#logoutmodal">Logout</a>
            <p class="version-disclaimer"><small>WebPanel v<?php echo Config::get('webpanel_version'); ?> by 1234filip</small></p>
          </nav>
        </div>
        <div class="col-sm-10" id="content">
          <form action="edituserdata.php" method="post">
          <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $user->getUsername(); ?>">
            </div>
            <div class="form-group">
              <label for="hwid">HWID</label>
              <input type="text" class="form-control" name="hwid" id="hwid" placeholder="HWID" value="<?php echo $user->getHWID(); ?>">
            </div>
            <div class="form-group">
              <label for="hwid">Type</label>
              <input type="text" class="form-control" name="type" id="type" placeholder="Type" value="<?php echo $user->getType(); ?>">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="text" class="form-control" name="password" id="password" placeholder="Password">
            </div>
            <div class="alert alert-primary mt-2">
              If you want to change the password of the user, type in the new password above. If you don't want to change it leave the field empty.
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
          <!-- STATUS MESSAGES -->
          <?php
            if ($status == 'edituser-success') {
              echo '<div class="alert alert-success mt-2" role="alert">Successfully edited the user!</div>';
            } 
            if ($status == 'edituser-error') {
              echo '<div class="alert alert-danger mt-2" role="alert">Unknown error!</div>';
            }
          ?>
          <!-- LOGOUT MODAL -->
          <div class="modal fade" id="logoutmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ban User</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Do you really want to logout?
                </div>
                <div class="modal-footer">
                  <form action="logout.php" method="post">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <input class="btn btn-danger" type="submit" value="Logout">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="js/plugins-dist.js"></script>
  </body>

</html>