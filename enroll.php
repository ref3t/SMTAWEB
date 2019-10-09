<?php
include 'deprecate.php';
session_start();
include ('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    
    if (isset($_POST['submit'])) {
        $course = $_POST['course'];
        $stuid = $_POST['stuid'];
        // var_dump("insert into courseenrolls(course,studentid) values('$course','$stuid')");
        $ret = mysql_query("insert into courseenrolls(course,studentid) values('$course','$stuid')");
        if ($ret) {
            $_SESSION['msg'] = "Enroll Successfully !!";
        } else {
            $_SESSION['msg'] = "Error : Not Enroll";
        }
    }
    
    if (isset($_POST['refat'])) {
        $target_path = "uploads/";
        
        $target_path = $target_path . basename($_FILES['uploadedfile']['name']);
        
        if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
            // echo "The file ". basename( $_FILES['uploadedfile']['name'])." has been uploaded";
        } else {
            echo "There was an error uploading the file, please try again!";
        }
        var_dump($target_path);
        $handle = fopen($target_path, "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $line = str_replace("\n", "", $line);
                $name = explode(":", $line);
                $name_st = str_replace("_", " ", $name[1]);
                $course_id = $_POST['course2'];
                $ret = mysql_query("insert into courseenrolls(course,studentid) values('$course_id','$name[0]')");
                // var_dump($line." ".$_POST['course2']);
                // mysql_query("insert into students(studentName,StudentRegno,password) values('$name_st','$name[0]','$password')");
            }
            fclose($handle);
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
<title>Course Enroll</title>
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
					<h1 class="page-head-line">Course Enroll</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-heading">Course Enroll</div>
						<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


						<div class="panel-body">
							<form name="dept" method="post" enctype="multipart/form-data">


								<div class="form-group">
									<label for="studentname">Student Name </label> <select
										class="form-control" name="stuid" id="stuid"
										required="required">
										<option value="">Select Student</option>  
										
   <?php
    $sql = mysql_query("select * from students");
    while ($row = mysql_fetch_array($sql)) {
        ?>
<option value="<?php echo htmlentities($row['StudentRegno']);?>"><?php echo htmlentities($row['studentName']);?></option>
<?php } ?>

    </select>
								</div> 



 <?php } ?>





<div class="form-group">
									<label for="Course">Course </label> <select
										class="form-control" name="course" id="course"
										onBlur="courseAvailability()" required="required">
										<option value="">Select Course</option>   
   <?php
$sql = mysql_query("select * from course");
while ($row = mysql_fetch_array($sql)) {
    ?>
<option value="<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['courseName']);?></option>
<?php } ?>
    </select> <span id="course-availability-status1"
										style="font-size: 12px;">
								
								</div>



								<button type="submit" name="submit" id="submit"
									class="btn btn-default">Enroll</button>
							</form>
						</div>
					</div>
				</div>

			</div>

		</div>








		<div class="container">
			<div class="col-md-12">
				<h1 class="page-head-line">Course Enroll from File</h1>
			</div>

			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-heading">Course Enroll</div>
						<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


						<div class="panel-body">
							<form name="dept" method="POST" enctype="multipart/form-data">







								<div class="form-group">
									<label for="Course">Course </label> <select
										class="form-control" name="course2" id="course2"
										onBlur="courseAvailability()" required="required">
										<option value="">Select Course</option>   
   <?php
$sql = mysql_query("select * from course");
while ($row = mysql_fetch_array($sql)) {
    ?>
<option value="<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['courseName']);?></option>
<?php } ?>
    </select> <span id="course-availability-status1"
										style="font-size: 12px;">
								
								</div>

								<form enctype="multipart/form-data" method="POST">
									<input type="hidden" name="MAX_FILE_SIZE" value="100000"
										required="required" /> Choose a file to upload: <input
										name="uploadedfile" type="file" required="required" /><br />

									<button type="refat" name="refat" id="refat"
										class="btn btn-default">Enroll Student From File</button>

								</form>



							</form>
						</div>
					</div>
				</div>

			</div>

		</div>


		<font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>
		<div class="col-md-12">
			<!--    Bordered Table  -->
			<div class="panel panel-default">
				<div class="panel-heading">Search Course with students</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="table-responsive table-bordered">
					<input class="col-md-12" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Course" title="Type in a name">
						<table class="table" id="myTable">
							<thead>
								<tr>
									<th>#</th>
									<th>Course Name</th>
									<th>Course Code</th>
									<th>Student ID</th>
									<th>Student Name</th>
								</tr>
							</thead>
							<tbody>
<?php
$sql = mysql_query("select * from courseenrolls");
$cnt = 1;
while ($row = mysql_fetch_array($sql)) {
    ?>


                                        <tr>
									<td><?php
    
echo $cnt;
    $sql2 = mysql_query("select * from course where id='$row[course]'");
    
    while ($row2 = mysql_fetch_array($sql2)) {
        ?></td>
									<td><?php
        // var_dump($row2);
        
        echo htmlentities($row2['courseName']);
        ?></td>
									<td><?php
        // var_dump($row2);
        
        echo htmlentities($row2['courseCode']);
    }
    ?></td>
									<td><?php
    
$sql2 = mysql_query("select * from students where StudentRegno='$row[studentid]'");
    
    while ($row2 = mysql_fetch_array($sql2)) {
        ?>
									<?php
        // var_dump($row2);
        
        echo htmlentities($row2['StudentRegno']);
        ?></td>
									<td><?php
        // var_dump($row2);
        
        echo htmlentities($row2['studentName']);
    }
    ?></td>




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



	<script src="assets/js/jquery-1.11.1.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script>
function courseAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'cid='+$("#course").val(),
type: "POST",
success:function(data){
$("#course-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

</script>


</body>
</html>
