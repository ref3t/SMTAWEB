<?php
include 'deprecate.php';
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}


?>
<html>

<!-- Mirrored from webqr.com/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jan 2019 07:48:22 GMT -->
<head>
<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin | Session</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
  <meta name="description" content="QR Code scanner" />
  <meta name="keywords" content="qrcode,qr code,scanner,barcode,javascript" />
  <meta name="language" content="English" />
  <meta name="copyright" content="Lazar Laszlo (c) 2011" />
  <meta name="Revisit-After" content="1 Days"/>
  <meta name="robots" content="index, follow"/>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Web QR</title>

<style type="text/css">
body{
    width:100%;
    text-align:center;
}
img{
    border:0;
}
#main{
    margin: 15px auto;
    background:white;
    overflow: auto;
	width: 750px;
}
#header{
    background:white;
}
#mainbody{
    background: white;
    width:100%;
}
#footer{
    background:white;
}
#mp1{
    text-align:center;
    font-size:35px;
}
#header ul{
    margin-bottom:0;
    margin-right:40px;
}
#header li{
    display:inline;
    padding-right: 0.5em;
    padding-left: 0.5em;
    font-weight: bold;
    border-right: 1px solid #333333;
}
#header li a{
    text-decoration: none;
    color: black;
}
p.quote1{
    
    font-weight:bold;
    margin-left:10%;
    margin-right:10%;
    color: black;
}
a{
	color: black;
}

div.button{
    height: 30px;
width: 100px;
border-radius: 10%;
background-color: gray;
border: 5px solid #666;
box-shadow: 4px 4px 4px #999;
font-weight: bold;
font-size: 1.5em;
text-align: center;
#vertical-align: middle;
color: white;
#line-height: 100px; /*or you could use 4em*/
	
}
div.button{
  background-color:gray;
}

div.button:hover{background-color:green;}

div.button:focus{background-color:red;}
</style>

<script type="text/javascript" src="llqrcode.js"></script>
<script type="text/javascript" src="../apis.google.com/js/plusone.js"></script>
<script type="text/javascript" src="webqr.js"></script>

<script type="text/javascript">

function create()
{
	
	document.getElementById("qrimage").innerHTML="";
    var data=document.getElementById("data").value;
	
	if(data === '' || data === null || data === undefined)
	{
		alert("Please enter any string you want to create QR");
	}
	else{
    document.getElementById("qrimage").innerHTML="<img src='https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl="+encodeURIComponent(data)+"'/>";
	}
}


function generate()
{
document.getElementById("qrimage").innerHTML="";
var d = new Date();
var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
   //document.getElementById("qrimage").innerHTML=" "+d.getDate() +" "+months[d.getMonth()]+" "+d.getFullYear();
	document.getElementById("qrimage").innerHTML="<img src='https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl="+encodeURIComponent(" "+d.getDate()+" "+months[d.getMonth()]+" "+d.getFullYear())+"'/>";

}
</script>

</head>

<body>
<?php include('includes/header.php');?>
    <!-- LOGO HEADER END-->
<?php if($_SESSION['alogin']!="")
{
 include('includes/menubar.php');
}
 ?>
 <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Generate QR Code  </h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
				  
<div id="main">

<div id="mainbody">

<table border="0" align="center">
<tr><td>
<p style="font-size:20px;text-align:center;" >Enter URL or text:</p>
<textarea cols="40" rows="3" id="data"></textarea>
</td></tr>
<tr>
</tr>
<tr><td align="center">
<br/>
<table >
<tr>
<td><div class="btn btn-info" onclick="create()">Create</div></td><td>     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><div class="btn btn-default" onclick="generate()">Generate</div>
</td>
</tr>
</table>
</td></tr>
<tr><td align="center">
<div id="qrimage">
</div>
</td></tr>

</table>
</div>

</div>
</div>
				  </div>
				  </div>
</body>


<!-- Mirrored from webqr.com/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jan 2019 07:48:22 GMT -->
</html>