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
        $addque= $_POST['que_desc'];
        $ans1= $_POST['ans1'];
        $ans2= $_POST['ans2'];
        $ans3= $_POST['ans3'];
        $ans4= $_POST['ans4'];
        $anstrue= $_POST['true_ans'];
//         var_dump("update question set que_desc='$addque',ans1='$ans1',ans2='$ans2',ans3='$ans3',ans4='$ans4',true_ans='$anstrue' where que_id='$id'");
        $ret = mysql_query("update question set que_desc='$addque',ans1='$ans1',ans2='$ans2',ans3='$ans3',ans4='$ans4',true_ans='$anstrue' where que_id='$id'");
        if ($ret) {
            $_SESSION['msg'] = "question Updated Successfully !!";
        } else {
            $_SESSION['msg'] = "Error : Course not Updated";
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
					<h1 class="page-head-line">Question</h1>
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
    $sql = mysql_query("select * from question where que_id='$id'");
    $cnt = 1;
    while ($row = mysql_fetch_array($sql)) {
        ?>
<p>
								
								<div class="form-group">
									<label for="que_desc">Question lable ? </label> <input
										type="text" class="form-control" id="que_desc" name="que_desc"
										placeholder="Question lable"
										value="<?php echo htmlentities($row['que_desc']);?>"
										required />
								</div>
								<div class="form-group">
									<label for="ans1">Answer 1 </label> <input type="text"
										class="form-control" id="ans1" name="ans1"
										placeholder="Question lable"
										value="<?php echo htmlentities($row['ans1']);?>"required />
								</div>

								<div class="form-group">
									<label for="ans2">Answer 2 </label> <input type="text"
										class="form-control" id="ans2" name="ans2"
										placeholder="Question lable"
										value="<?php echo htmlentities($row['ans2']);?>"
										required />
								</div>

<div class="form-group">
									<label for="ans3">Answer 3 </label> <input type="text"
										class="form-control" id="ans3" name="ans3"
										placeholder="Question lable"
										value="<?php echo htmlentities($row['ans3']);?>"
										required />
								</div>

<div class="form-group">
									<label for="ans4">Answer 4 </label> <input type="text"
										class="form-control" id="ans4" name="ans4"
										placeholder="Question lable"
										value="<?php echo htmlentities($row['ans4']);?>"
										required />
								</div>

<div class="form-group">
									<label for="true_ans">True Answer </label> <input type="text"
										class="form-control" id="true_ans" name="true_ans"
										placeholder="Question lable"
										value="<?php echo htmlentities($row['true_ans']);?>"
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
