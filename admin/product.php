<!DOCTYPE html>
<?php
include 'conn.php';
session_start();

if (!isset($_SESSION["uid"])) {
    echo "<script> window.location.href = 'index.php';</script>";
}

$id = null;
$state = "";
$inputName = "";
$inputDescription = "";
$inputPrice = "";
$inputKilo = "";
$errorMessage = null;
$target_dir = "../files/";

if (isset($_POST["submit"])) {
    $inputName = $_POST["inputName"];
    $inputDescription = $_POST["inputDescription"];
    $inputPrice = $_POST["inputPrice"];
    $inputKilo = $_POST["inputKilo"];
    $errorMessage = null;

    if (basename($_FILES["file1"]["name"])) {
        $image = basename($_FILES["file1"]["name"]);
        move_uploaded_file($_FILES["file1"]["tmp_name"], $target_dir . $image);
    } else {
        echo "dasdsadasdsad";
        $image = "no-image.png";
    }

    if ($_POST["id"] == null) {
        $sql = "INSERT INTO tbl_product(name,description,price,kilo,image,imageURL)
   			VALUES('" . $inputName . "','" . $inputDescription . "','" . $inputPrice . "','" . $inputKilo . "','" . $image . "','" . $image . "')";
    } else {

        if (basename($_FILES["file1"]["name"])) {
            $sql = "UPDATE tbl_product SET
                  name='" . $inputName . "',
                  description='" . $inputDescription . "',
                  price='" . $inputPrice . "',
                  kilo='" . $inputKilo . "',
                  image='" . $image . "',
                  imageURL='" . $image . "'
                  WHERE id ='" . $_POST["id"] . "'";
        } else {
            $sql = "UPDATE tbl_product SET
   				name='" . $inputName . "',
   				description='" . $inputDescription . "',
   				price='" . $inputPrice . "',
   				kilo='" . $inputKilo . "'
   				WHERE id ='" . $_POST["id"] . "'";
        }
    }
    
    if (mysqli_query($conn, $sql)) {	  
		$id = null;
		$state = "";
		$inputName = "";
		$inputDescription = "";
		$inputPrice = "";
		$inputKilo = "";
		$errorMessage = null;
   } else {
	   $errorMessage = mysqli_error($conn);
   }   

}

if (isset($_GET["state"])) {
    if ($_GET["state"] == "delete") {
        $sql = "DELETE FROM tbl_product WHERE id ='" . $_GET["id"] . "'";

        if (!mysqli_query($conn, $sql)) {
            $errorMessage = mysqli_error($conn);
        } else {
            echo "<script> window.location.href='product.php#'; </script>";
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
               <a style="color: black; font-weight: bold" class="navbar-brand" href="dashboard.php#">Uma Verde Admin</a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
               <li class="dropdown">
                  <a style="color: black" class="dropdown-toggle" data-toggle="dropdown" href="#">
                  <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-user">
                     <li><a href="index.php"><i class="fa fa-key fa-fw"></i> Change Password</a>
                     </li>
                     <li><a href="index.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                     </li>
                  </ul>
               </li>
            </ul>
            <div class="navbar-default sidebar" role="navigation">
               <div class="sidebar-nav navbar-collapse">
                  <ul class="nav" id="side-menu">
                     <li>
                        <a href="dashboard.php#"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                     </li>
                     <li>
                        <a><i class="fa fa-table fa-fw"></i> References<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                           <li>
                              <a href="user.php#"><i class="fa fa-user fa-fw"></i> Users<span class="fa arrow"></span></a>
                           </li>
                           <li>
                              <a href="#"><i class="fa fa-shopping-bag fa-fw"></i> Products<span class="fa arrow"></span></a>
                           </li>
                           <li>
                              <a href="tour.php#"><i class="fa fa-hotel fa-fw"></i> Tours<span class="fa arrow"></span></a>
                           </li>
                           <li>
                              <a href="training.php#"><i class="fa fa-laptop fa-fw"></i> Trainings<span class="fa arrow"></span></a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a><i class="fa fa-calculator fa-fw"></i> Transactions<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                           <li>
                              <a href="transaction.php#"><i class="fa fa-shopping-bag fa-fw"></i> Product Orders<span
                                 class="fa arrow"></span></a>
                           </li>
                           <li>
                              <a href="transaction.php#"><i class="fa fa-hotel fa-fw"></i> Tour Reservations<span
                                 class="fa arrow"></span></a>
                           </li>
                           <li>
                              <a href="transaction.php#"><i class="fa fa-laptop fa-fw"></i> Training Requests<span
                                 class="fa arrow"></span></a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a><i class="fa fa-bar-chart fa-fw"></i> Reports<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                           <li>
                              <a href="transaction.php#"><i class="fa fa-shopping-bag fa-fw"></i> Product Reports<span
                                 class="fa arrow"></span></a>
                           </li>
                           <li>
                              <a href="transaction.php#"><i class="fa fa-hotel fa-fw"></i> Tour Reports<span class="fa arrow"></span></a>
                           </li>
                           <li>
                              <a href="transaction.php#"><i class="fa fa-laptop fa-fw"></i> Training Reports<span
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
                  <h1 class="page-header">Products Management</h1>
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
                                 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#productModal"
                                    onclick="return window.location.href='product.php#?state=new'">Add New Product</button>
                              </div>
                           </div>
                        </div>
                        <div class="panel-body">
                           <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                              <thead>
                                 <tr>
                                    <th>Updated</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Kilo</th>
                                    <th>Actions</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
$q = mysqli_query($conn, "SELECT * FROM tbl_product");
while ($r = mysqli_fetch_array($q)) {
    echo "<tr><td style=\"vertical-align: middle;\">" . $r['updatedAt'] . "</td>";
    echo "<td style=\"vertical-align: middle;\">" . $r['name'] . "</td>";
    echo "<td style=\"vertical-align: middle;\">" . $r['description'] . "</td>";
    echo "<td style=\"vertical-align: middle;\">" . $r['price'] . "</td>";
    echo "<td style=\"vertical-align: middle;\">" . $r['kilo'] . "</td>";
    echo "<td style=\"text-align: center; width:15%\">";
    ?>
                                 <button type="button" class="btn btn-warning btn-circle btn-s"
                                    onclick="return window.location.href='product.php?state=edit&id=<?php echo $r['id']; ?>'">
                                 <i class="fa fa-edit"></i></button>&nbsp;&nbsp;
                                 <a type="button" class="btn btn-danger btn-circle btn-s"
                                    onclick="return confirm('Are you sure want to delete this?');"
                                    href="product.php?state=delete&id=<?php echo $r['id']; ?>">
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
         <div class="modal fade" id="productModal" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h2 class="modal-title">Product Details</h2>
                  </div>
                  <div class="modal-body">
                     <?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $q = mysqli_query($conn, "SELECT * FROM tbl_product WHERE id='" . $_GET["id"] . "'");
    $r = mysqli_fetch_array($q);
    $inputName = $r["name"];
    $inputDescription = $r["description"];
    $inputPrice = $r["price"];
    $inputKilo = $r["kilo"];
    $image = $r["image"];
}
?>
                     <form action="product.php#" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                           <label for="inputName" class="col-form-label">Name</label>
                           <input type="hidden" name="id" value="<?php echo $id; ?>">
                           <input type="text" class="form-control" name="inputName" value="<?php echo $inputName; ?>" required>
                        </div>
                        <div class="form-group">
                           <label for="inputDescription" class="col-form-label">Description</label>
                           <input type="text" class="form-control" name="inputDescription" value="<?php echo $inputDescription; ?>" required>
                        </div>
                        <div class="form-group">
                           <label for="inputPrice" class="col-form-label">Price</label>
                           <input type="text" class="form-control" name="inputPrice" value="<?php echo $inputPrice; ?>" required>
                        </div>
                        <div class="form-group">
                           <label for="inputKilo" class="col-form-label">Kilo</label>
                           <input type="text" class="form-control" name="inputKilo" value="<?php echo $inputKilo; ?>" required>
                        </div>
                        <div class="form-group">
                           <label for="file1">Image</label>
                           <input type="file" class="form-control-file" name="file1" accept="image/*">
                           <?php
if (isset($image)) {
    echo "<br><label>" . $image . "</label><br>";
    echo "<img src=\"../files/" . $r["image"] . "\" style=\"width:30%; height:30%; object-fit=contain;\">";
}
?>
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

                  $('#productModal').on('show.bs.modal', function (event) {
                      var button = $(event.relatedTarget)
                      var event = button.data('event');
                      $state = event;
                  });
                  <?php
if (isset($_GET["state"])) {
    if ($_GET["state"] == "new" || $_GET["state"] == "edit") {
        echo "$('#productModal').modal('show')";
    }
}
?>
      </script>
   </body>
</html>