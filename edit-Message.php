<?php
include 'deprecate.php';
session_start();
include ('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    $id = intval($_GET['id']);
    date_default_timezone_set('Asia/Kolkata'); // change according timezone
    $currentTime = date('d-m-Y h:i:s A', time());
    if (isset($_POST['submit'])) {
        $coursecode = $_POST['msg'];
        
        $ret = mysql_query("update posts set msg='$coursecode' where id='$id'");
        if ($ret) {
            $_SESSION['msg'] = "Message Updated Successfully !!";
           // redirect("./Send_message.php");
            header('location:course.php');
        } else {
            $_SESSION['msg'] = "Error : Message not Updated";
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
					<h1 class="page-head-line">Course</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-heading">Course</div>
						<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


						<div class="panel-body">
							<form name="dept" method="post">
<?php
    $sql = mysql_query("select * from posts where id='$id'");
    $cnt = 1;
    while ($row = mysql_fetch_array($sql)) {
        ?>
        update Message
<p>
									<div class="form-group">
									<textarea name="msg" id="msg" rows="10" cols="60" required></textarea>
									
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