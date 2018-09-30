<!DOCTYPE html>
<?php
	include 'conn.php';
	session_start();
	
	// if (!isset($_SESSION["uid"])) {
	//     echo "<script> window.location.href = 'index.php';</script>";
	// } else {
	// }
	$id = null;
    $state = "";
    $oldUsername = "";
	$inputUsername = "";
	$inputFullname = "";
	$inputContactNo = "";
	$errorMessage = null;
	
	if (isset($_POST["submit"])) {

	    $inputFullname = $_POST["inputFullname"];
	    $inputContactNo = $_POST["inputContactNo"];
        $errorMessage = null;

        if($_POST["id"] == null){

            $inputUsername = $_POST["inputUsername"];
            $password = md5("123456");
    
            $sql = "INSERT INTO tbl_user(username,password,fullname,contactNo)
            VALUES('" . $inputUsername . "','" . $password . "','" . $inputFullname . "','" . $inputContactNo . "')";        

        }else{
            
            if ($_POST["inputUsername"] == $_POST["oldUsername"]) {

                $sql = "UPDATE tbl_user SET
                fullname='" . $inputFullname . "',
                contactNo='" . $inputContactNo . "'
                WHERE id ='" . $_POST["id"] . "'";
    
            } else {
                
                $inputUsername = $_POST["inputUsername"];
                $sql = "UPDATE tbl_user SET
                username='" . $inputUsername . "',
                fullname='" . $inputFullname . "',
                contactNo='" . $inputContactNo . "'
                WHERE id ='" . $_POST["id"] . "'";
    
            }
    
        }

        if (mysqli_query($conn, $sql)) {
            $id = "";
            $state = "";
            $oldUsername = "";
            $inputUsername = "";
            $inputFullname = "";
            $inputContactNo = "";
        } else {
            $errorMessage = mysqli_error($conn);
        }   
    }
    
    if(isset($_GET["state"])){
        if ($_GET["state"] == "delete") {
            $sql = "DELETE FROM tbl_user WHERE id ='" . $_GET["id"] . "'";

            if (!mysqli_query($conn, $sql)) {
                $errorMessage = mysqli_error($conn);
            }else{
                echo "<script> window.location.href='user.php#'; </script>";
            }
        }
    }
	
	?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Uma Verde Econature Park</title>
		<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
		<link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
		<link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
		<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
		<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div id="wrapper">
			<!-- Navigation -->
			<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: green">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a style="color: black; font-weight: bold" class="navbar-brand" href="index.html">Uma Verde Admin</a>
				</div>
				<ul class="nav navbar-top-links navbar-right">
					<li class="dropdown">
						<a style="color: black" class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
						</a>
						<ul class="dropdown-menu dropdown-user">
							<li><a href="login.html"><i class="fa fa-key fa-fw"></i> Change Password</a>
							</li>
							<li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
							</li>
						</ul>
					</li>
				</ul>
				<div class="navbar-default sidebar" role="navigation">
					<div class="sidebar-nav navbar-collapse">
						<ul class="nav" id="side-menu">
							<li>
								<a href="dashboard.html"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
							</li>
							<li>
								<a href="#"><i class="fa fa-table fa-fw"></i> References<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="#"><i class="fa fa-user fa-fw"></i> Users<span class="fa arrow"></span></a>
									</li>
									<li>
										<a href="product.php"><i class="fa fa-shopping-bag fa-fw"></i> Products<span class="fa arrow"></span></a>
									</li>
									<li>
										<a href="tour.php"><i class="fa fa-hotel fa-fw"></i> Tours<span class="fa arrow"></span></a>
									</li>
									<li>
										<a href="training.php"><i class="fa fa-laptop fa-fw"></i> Trainings<span class="fa arrow"></span></a>
									</li>
								</ul>
							</li>
							<li>
								<a href="transaction.php"><i class="fa fa-calculator fa-fw"></i> Transactions<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="transaction.php"><i class="fa fa-shopping-bag fa-fw"></i> Product Orders<span
											class="fa arrow"></span></a>
									</li>
									<li>
										<a href="transaction.php"><i class="fa fa-hotel fa-fw"></i> Tour Reservations<span
											class="fa arrow"></span></a>
									</li>
									<li>
										<a href="transaction.php"><i class="fa fa-laptop fa-fw"></i> Training Requests<span
											class="fa arrow"></span></a>
									</li>
								</ul>
							</li>
							<li>
								<a href="#transaction.php"><i class="fa fa-bar-chart fa-fw"></i> Reports<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="transaction.php"><i class="fa fa-shopping-bag fa-fw"></i> Product Reports<span
											class="fa arrow"></span></a>
									</li>
									<li>
										<a href="transaction.php"><i class="fa fa-hotel fa-fw"></i> Tour Reports<span class="fa arrow"></span></a>
									</li>
									<li>
										<a href="transaction.php"><i class="fa fa-laptop fa-fw"></i> Training Reports<span
											class="fa arrow"></span></a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</nav>
			<!-- Page Content -->
			<div id="page-wrapper">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Tours Management</h1>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<div class="row">
										<div class="col-lg-6" style="text-align: left; padding-top: 1vh">
											<span style="color: red">
											<?php if ($errorMessage !== null) {echo $errorMessage;}?>
											</span>
										</div>
										<div class="col-lg-6"  style="text-align: right">
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#userModal"
												onclick="return window.location.href='user.php?state=new'">Add New User</button>
										</div>
									</div>
								</div>
								<div class="panel-body">
									<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
										<thead>
											<tr>
												<th>Created</th>
												<th>Username</th>
												<th>Fullname</th>
												<th>ContactNo</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$q = mysqli_query($conn, "SELECT * FROM tbl_user");
												while ($r = mysqli_fetch_array($q)) {
                                                    echo "<tr><td style=\"vertical-align: middle;\">" . $r['createdAt'] . "</td>";
												    echo "<td style=\"vertical-align: middle;\">" . $r['username'] . "</td>";
												    echo "<td style=\"vertical-align: middle;\">" . $r['fullname'] . "</td>";
												    echo "<td style=\"vertical-align: middle;\">" . $r['contactNo'] . "</td>";
												    echo "<td style=\"text-align: center; width:15%\">";
												    ?>
											<button type="button" class="btn btn-warning btn-circle btn-s"
												onclick="return window.location.href='user.php?state=edit&id=<?php echo $r['id']; ?>'">
                                            <i class="fa fa-edit"></i></button>&nbsp;&nbsp;
                                            <a type="button" class="btn btn-danger btn-circle btn-s"
												onclick="return confirm('Are you sure want to delete this?');"								
												href="user.php?state=delete&id=<?php echo $r['id']; ?>">
											<i class="fa fa-trash"></i></a>
											<?php }?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal -->
			<div class="modal fade" id="userModal" role="dialog" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">User Details</h2>
						</div>
						<div class="modal-body">
							<?php
								if (isset($_GET["id"])) {
                                    $id = $_GET["id"];
								    $q = mysqli_query($conn, "SELECT * FROM tbl_user WHERE id='" . $_GET["id"] . "'");
                                    $r = mysqli_fetch_array($q);
                                    $oldUsername = $r["username"];
								    $inputUsername = $r["username"];
								    $inputFullname = $r["fullname"];
                                    $inputContactNo = $r["contactNo"];
                                }
								?>
							<form action="user.php#" method="post">
								<div class="form-group">
                                    <label for="inputUsername" class="col-form-label">Username</label>
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <input type="hidden" name="oldUsername" value="<?php echo $oldUsername; ?>">
									<input type="text" class="form-control" name="inputUsername" value="<?php echo $inputUsername; ?>" required>
								</div>
								<div class="form-group">
									<label for="inputFullname" class="col-form-label">Fullname</label>
									<input type="text" class="form-control" name="inputFullname" value="<?php echo $inputFullname; ?>" required>
								</div>
								<div class="form-group">
									<label for="inputContactNo" class="col-form-label">Contact Number</label>
									<input type="text" class="form-control" name="inputContactNo" value="<?php echo $inputContactNo; ?>" required>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
									<button type="submit" name="submit" class="btn btn-primary">Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Important Links -->
		<script src="../vendor/jquery/jquery.min.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="../vendor/metisMenu/metisMenu.min.js"></script>
		<script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
		<script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
		<script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>
		<script src="../dist/js/sb-admin-2.js"></script>
		<script>
			$(document).ready(function () {
			    $('#dataTables-example').DataTable({
			        responsive: true
			    });
            });

            $('#userModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var event = button.data('event');
                $state = event;
            });

            <?php
            if (isset($_GET["state"])) {
                if ($_GET["state"] == "new" || $_GET["state"] == "edit") {
                    echo "$('#userModal').modal('show')";
                }
            }
            ?>
		</script>
	</body>
</html>