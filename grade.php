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
        mysql_query("delete from marks where mark_id = '" . $_GET['id'] . "'");
        
        $_SESSION['delmsg'] = "Student Grade deleted !!";
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
		



		<div class="content-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1 class="page-head-line">Managed Tests</h1>
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
												<th>Test ID</th>
												<th>Test Name</th>
												<th>Test Grade</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
<?php
    $sql = mysql_query("select * from marks");
    $cnt = 1;
    while ($row = mysql_fetch_array($sql)) {
        ?>


                                        <tr>
												<td><?php echo htmlentities($row['mark_id']);?></td>
												<td><?php echo htmlentities($row['test_name']);?></td>
												<td><?php echo htmlentities($row['grade']);?></td>
												<td> <a
													href=grade.php?id=<?php echo $row['mark_id']?>&del=delete"
													onClick="return confirm('Are you sure you want to delete?')">
														<button class="btn btn-danger">Delete</button>
												</a> </td>
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
