<?php
include 'deprecate.php';
session_start();
include ('../includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    $chos ;
    if (isset($_POST['submit'])) {
        $test = $_POST['testname'];
        //var_dump("insert into test(testname) values('$test')");
        $ret = mysql_query("insert into test(test_name) values('$test')");
        if ($ret) {
            $_SESSION['msg'] = "Test add Successfully !!";
        } else {
            $_SESSION['msg'] = "Error : Not Adding Alreay Exist";
        }
    }
    
    if (isset($_POST['refat'])) {
        $testname = $_POST['test_name'];
        $chos=$testname;
        
        $addque= $_POST['addque'];
        $ans1= $_POST['ans1'];
        $ans2= $_POST['ans2'];
        $ans3= $_POST['ans3'];
        $ans4= $_POST['ans4'];
        $anstrue= $_POST['anstrue'];
        //var_dump("insert into question(test_name,que_desc,ans1,ans2,ans3,ans4,true_ans) values ('$testname','$addque','$ans1','$ans2','$ans3','$ans4','$anstrue')");
        $ret = mysql_query("insert into question(test_name,que_desc,ans1,ans2,ans3,ans4,true_ans) values ('$testname','$addque','$ans1','$ans2','$ans3','$ans4','$anstrue')");
        if ($ret) {
            $_SESSION['msg'] = "Question add Successfully !!";
        } else {
            $_SESSION['msg'] = "Error : Not Adding Alreay Exist";
        }
        }
        
        if(isset($_GET['del']))
        {
            mysql_query("delete from question where que_id = '".$_GET['id']."'");
            $_SESSION['delmsg']="question deleted !!";
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
					<h1 class="page-head-line">Add Test</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-heading">ADD TEST</div>
						<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


						<div class="panel-body">
							<form name="dept" method="post" enctype="multipart/form-data">

								<label>Enter Test Name : </label> <input type="text"
									name="testname" class="form-control" id="testname"
									placeholder="enter Test name" required />
							




<br>

								<button type="submit" name="submit" id="submit"
									class="btn btn-default">Add</button>
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
						<h1 class="page-head-line">Add Questions</h1>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">Add Questions</div>
							<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>

<form name="form1" method="post" onSubmit="return check();">

							<div class="form-group">
								<label for="test_name">Test </label> <select class="form-control"
									name="test_name" id="test_name" onBlur="courseAvailability()"
									required="required">
									<option value="">Select Test</option>   
   <?php
$sql = mysql_query("select * from test");
while ($row = mysql_fetch_array($sql)) {
    ?>
<option value="<?php echo htmlentities($row['test_name']);?>"><?php echo htmlentities($row['test_name']);?></option>
<?php }


?><option selected="true" value="<?php echo htmlentities($row['test_name']);?>"><?php echo htmlentities($chos);?></option>

    </select> <span id="course-availability-status1"
									style="font-size: 12px;">
							
							</div>



							
  
    <label><font color="red">Enter Question lable ? :</font> </label> <input type="text"
									name="addque" class="form-control" id="addque"
									placeholder="Enter Question" required />
    <label>Enter Answer1 : </label> <input type="text"
									name="ans1" class="form-control" id="ans1"
									placeholder="Enter Answer1" required />     
    
   <label>Enter Answer2 : </label> <input type="text"
									name="ans2" class="form-control" id="ans2"
									placeholder="Enter Answer2" required /> 
	<label>Enter Answer3 : </label> <input type="text"
									name="ans3" class="form-control" id="ans3"
									placeholder="Enter Answer3" required /> 
	<label>Enter Answer4 : </label> <input type="text"
									name="ans4" class="form-control" id="ans4"
									placeholder="Enter Answer4" required />     								  
  <label><font color="green">Enter true Answer number(1,2,3,4):</font> </label> <input type="text"
									name="anstrue" class="form-control" id="anstrue"
									placeholder="Enter True Answer" required />   
    
    <br>
    
   <button type="refat" value="Add" name="refat" id="Add"
										class="btn btn-default">Add A Question</button>
   
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
                        <div class="panel-heading">
                            Questions
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                            <input class="col-md-12" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Course" title="Type in a name">
					
                                <table class="table" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Question lable</th>
                                            <th>Answer 1 </th>
                                            <th>Answer 2 </th>
                                            <th>Answer 3 </th>
                                            <th>Answer 4 </th>
                                            
                                            <th>Correct Answer </th>
                                            <th>Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysql_query("select * from question");// WHERE test_name='$chos'
$cnt=1;
while($row=mysql_fetch_array($sql))
{
?>

                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['que_desc']);?></td>
                                            <td><?php echo htmlentities($row['ans1']);?></td>
                                            <td><?php echo htmlentities($row['ans2']);?></td>
                                            <td><?php echo htmlentities($row['ans3']);?></td>
                                            <td><?php echo htmlentities($row['ans4']);?></td>
                                            <td><?php echo htmlentities($row['true_ans']);?></td>
                                             <td>
                                            <a href="edit-question.php?id=<?php echo $row['que_id']?>">
<button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button> </a>                                        
  <a href="quiz.php?id=<?php echo $row['que_id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
                                            <button class="btn btn-danger">Delete</button>
</a>
                                            </td>
                                         
                                        </tr>
<?php 
$cnt++;
} ?>

                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                     <!--  End  Bordered Table  -->
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
