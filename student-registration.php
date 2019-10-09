<?php
include 'deprecate.php';
session_start();
include ('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    
    if (isset($_POST['submit'])) {
        $studentname = $_POST['studentname'];
        $studentregno = $_POST['studentregno'];
        $password = "Test@123";
        $ret = mysql_query("insert into students(studentName,StudentRegno,password) values('$studentname','$studentregno','$password')");
        if ($ret) {
            $_SESSION['msg'] = "Student Registered Successfully !!";
        } else {
            $_SESSION['msg'] = "Error : Student  not Register";
        }
    }
    
    if (isset($_POST['refat'])) {
        $target_path = "uploads/";
        
        $target_path = $target_path . basename( $_FILES['uploadedfile']['name']);
        
        if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
           // echo "The file ".  basename( $_FILES['uploadedfile']['name'])." has been uploaded";
        } else{
            echo "There was an error uploading the file, please try again!";
        }
        // var_dump($target_path);
        $handle = fopen($target_path, "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $line = str_replace("\n", "", $line);
                $name = explode( ":" , $line );
                $name_st= str_replace("_"," ",$name[1]);
                $password = "Test@123";
                mysql_query("insert into students(studentName,StudentRegno,password) values('$name_st','$name[0]','$password')");
                
            }
            fclose($handle);
        }
    }
    if (isset($_GET['del'])) {
        //var_dump("delete from students where StudentRegno = '" . $_GET['id'] . "'");
        mysql_query("delete from students where StudentRegno = '" . $_GET['id'] . "'");
        
        $_SESSION['delmsg'] = "Student record deleted ffffff!!";
    }
    
    if (isset($_GET['pass'])) {
        $password = "Test@123";
        $newpass = $password;
        mysql_query("update students set password='$newpass' where StudentRegno = '" . $_GET['id'] . "'");
        $_SESSION['delmsg'] = "Password Reset. New Password is Test@123";
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
<title>Admin | Student Registration</title>
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
    
<!-- <form  method="post"> -->
<!-- 							<button type="refat" name="refat" id="refat" -->
<!-- 									class="btn btn-default">Add Student From File</button> -->
<!-- </form> -->



	<div class="content-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1 class="page-head-line">Student Registration</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-heading">Student Registration</div>
						<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


						<div class="panel-body">
							<form name="dept" method="post">
								<div class="form-group">
									<label for="studentname">Student Name </label> <input
										type="text" class="form-control" id="studentname"
										name="studentname" placeholder="Student Name" required />
								</div>

								<div class="form-group">
									<label for="studentregno">Student Reg No </label> <input
										type="text" class="form-control" id="studentregno"
										name="studentregno" onBlur="userAvailability()"
										placeholder="Student Reg no" required /> <span
										id="user-availability-status1" style="font-size: 12px;">
								
								</div>





								<button type="submit" name="submit" id="submit"
									class="btn btn-default">Submit</button>
							</form>
							<p>
							<br>
							<form enctype="multipart/form-data"  method="POST">
<input  type="hidden" name="MAX_FILE_SIZE" value="100000" />
Choose a file to upload: <input name="uploadedfile" type="file" /><br />
<button type="refat" name="refat" id="refat"
									class="btn btn-default">Add Student From File</button>


</form>
						</div>
						
					</div>
				</div>

			</div>

		</div>



		<div class="content-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1 class="page-head-line">Managed Students</h1>
					</div>
				</div>
				<div class="row">

					<font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>
					<div class="col-md-12">
						<!--    Bordered Table  -->
						<div class="panel panel-default">
							<div class="panel-heading">Manage Course</div>
							<!-- /.panel-heading -->
							<div class="panel-body">
								<div class="table-responsive table-bordered">
									<table class="table">
										<thead>
											<tr>
												<th>#</th>
												<th>Reg No</th>
												<th>Student Name</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
<?php
    $sql = mysql_query("select * from students");
    $cnt = 1;
    while ($row = mysql_fetch_array($sql)) {
        ?>


                                        <tr>
												<td><?php echo $cnt;?></td>
												<td><?php echo htmlentities($row['StudentRegno']);?></td>
												<td><?php echo htmlentities($row['studentName']);?></td>
												<td><a
													href="edit-student.php?id=<?php echo $row['StudentRegno']?>">
														<button class="btn btn-primary">
															<i class="fa fa-edit "></i> Edit
														</button>
												</a> <a
													href="student-registration.php?id=<?php echo $row['StudentRegno']?>&del=delete"
													onClick="return confirm('Are you sure you want to delete?')">
														<button class="btn btn-danger">Delete</button>
												</a> <a
													href="student-registration.php?id=<?php echo $row['StudentRegno']?>&pass=update"
													onClick="return confirm('Are you sure you want to reset password?')">
														<button type="submit" name="submit" id="submit"
															class="btn btn-default">Reset Password</button>
												</a></td>
											</tr>
<?php
        $cnt ++;
    }
    ?>

                                        
                                    </tbody>
									</table>
								</div>
							</div>
						</div>
						<!--  End  Bordered Table  -->
					</div>
				</div>





			</div>
		</div>

	</div>
	</div>

	<script src="assets/js/jquery-1.11.1.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'regno='+$("#studentregno").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>


</body>
</html>
<?php } ?>
