<?php
include 'deprecate.php';
session_start();
include ('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    $id = $_GET['id'];
    if (isset($_POST['submit'])) {
        $coursecode = $_POST['coursecode'];
        $coursename = $_POST['coursename'];
        //var_dump("update students set StudentRegno='$coursecode',studentName='$coursename' where StudentRegno='$id'");
        $ret = mysql_query("update students set StudentRegno='$coursecode',studentName='$coursename' where StudentRegno='$id'");
        if ($ret) {
            $_SESSION['msg'] = "Student Updated Successfully !!";
        } else {
            $_SESSION['msg'] = "Error : Student not Updated";
        }
    }
    ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="description" content="" />
<meta name="author" content="" />
<title>Admin | Course</title>
<link href="assets/css/bootstrap.css" rel="stylesheet" />
<link href="assets/css/font-awesome.css" rel="stylesheet" />
<link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('includes/header.php');?>
    <!-- LOGO HEADER END-->
<?php
    
    if ($_SESSION['alogin'] != "") {
        include ('includes/menubar.php');
    }
    ?>
    <!-- MENU SECTION END-->
	<div class="content-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1 class="page-head-line">Student</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-heading">Students</div>
						<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


						<div class="panel-body">
							<form name="dept" method="post">
<?php

    $sql = mysql_query("select * from students where StudentRegno='$id'");
    $cnt = 1;
    while ($row = mysql_fetch_array($sql)) {
        
        ?>
<p>
									
								<div class="form-group">
									<label for="coursecode">Student Id </label> <input type="text"
										class="form-control" id="coursecode" name="coursecode"
										placeholder="Course Code"
										value="<?php echo htmlentities($row['StudentRegno']);?>"
										required />
								</div>

								<div class="form-group">
									<label for="coursename">Student Name </label> <input type="text"
										class="form-control" id="coursename" name="coursename"
										placeholder="Course Name"
										value="<?php echo htmlentities($row['studentName']);?>"
										required />
								</div>

								

<?php } ?>
 <button type="submit" name="submit" class="btn btn-default">
									<i class=" fa fa-refresh "></i> Update
								</button>
							</form>
						</div>
					</div>
				</div>

			</div>

		</div>





	</div>
	</div>
	<!-- CONTENT-WRAPPER SECTION END-->
	<!-- FOOTER SECTION END-->
	<!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
	<!-- CORE JQUERY SCRIPTS -->
	<script src="assets/js/jquery-1.11.1.js"></script>
	<!-- BOOTSTRAP SCRIPTS  -->
	<script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>