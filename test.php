<?php 
//after session out page will redirect to login page
session_start();
if(!isset($_SESSION["email"]))
{
header("Location:reg_login.php");	
}
?>
<?php
$db=mysqli_connect("localhost","root","","ukanlibrary");
@$UID=$_SESSION["email"];
$res=mysqli_query($db,"select * from booklib where email='".$UID."'");
$row=mysqli_fetch_row($res); 
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Update Profile</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>
<?php 	include('reg_head.php');?>
<div class="container">
<div class="col-md-12 col-md-offset-0">
<div class="panel panel-primary" style="background-color:#9CF;">
<div class="panel-heading"><h3>Update Profile</h3></div>
<div class="panel-body">
<form action="#" method="post" enctype="multipart/form-data">
<b>First name:</b>
<div class="form-group">
<input type="text" class="form-control" value="<?php echo $row[0];?>" name="FNM" />
</div>
<b>Last name:</b>
<div class="form-group">
<input type="text" class="form-control" value="<?php echo $row[1];?>" name="LNM" />
</div>
<b>Email-id:</b>
<div class="form-group">
<input
type="email" class="form-control" readonly value="<?php echo $row[2];?>" name="UID" />
</div>
<div class="form-group">
<b>Date of Birth (DOB):<br/></b>
<input type="text" class="form-control" value="<?php echo $row[3];?>" name="dob" />
</div>
<b>Password:</b>
<div class="form-group">
<input type="password" class="form-control" value="<?php echo $row[4];?>" name="PWD" />
</div>
<b>Confirm password:</b>
<div class="form-group">
<input type="password" class="form-control" name="CPWD" />
</div>
<?php 
if((@$_POST["PWD"])!=(@$_POST["CPWD"]))
{
	echo '<script>window.alert("Both passwords are not same");</script>';
}
?>
<div class="form-group">
<b>Phone number:<br/></b>
<input type="text" class="form-control" placeholder="eg.9876543210" value="<?php echo $row[5];?>" name="phone" />
</div>
<div class="form-group">
<b>Profile image:</b></br>(only jpg and png,less than 2mb)</br>
<img src="pimages/<?php echo $row[6]; ?>" height="100px" width="100px"/></br>
<input type="file" name="file" id="fileToUpload">
</div>
<!--dropdown list for book category -->
<select name="op1">
<option value="<?php echo $row[7];?>"><?php echo $row[7];?></option>
<option value="">-----------------------</option>
<option value="Male">Male</option>
<option value="Female">Female</option>
<option value="Others">Others</option>
</select>
</br>
</br>
<!--dropdown list for country -->
<select name="op2">
<option value="<?php echo $row[8];?>"><?php echo $row[8];?></option>
<option value="">-----------------------</option>
<option value="Australia">Australia</option>
<option value="USA">USA</option>
<option value="Iceland">Iceland</option>
<option value="India">India</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Nigeria">Nigeria</option>
<option value="Russia">Russia</option>
</select>
<br/><br/>
<div class="form-group">
<input type="submit" class="btn btn-success" value="Update" name="updt" />
<input type="submit" class="btn btn-danger" value="Delete" name="del" />
<input type="submit" class="btn btn-primary" value="Cancel" name="cncl" />
</div>
<?php
//to check whether all these feilds are filled or not
if((@$_POST["updt"])=="Update")
{
 if(((@$_POST["PWD"])==NULL)||(($_POST["CPWD"])==NULL)||(($_POST["phone"])==NULL)||(($_POST["op1"])==NULL)||(($_POST["UID"])==NULL)||(($_POST["LNM"])==NULL)||(($_POST["FNM"])==NULL)||(($_POST["op2"])==NULL)||(($_POST["dob"])==NULL))
   { 
	echo '<script>window.alert("Any feild should not be left blank");</script>';
   }
else if((@$_POST["PWD"])==(@$_POST["CPWD"]))
   { //for updating the record
     include('test_update.php');
	 updaterecord();
   }
}
if((@$_POST["del"])=="Delete")
{   //for deleting the record
    include('test_delete.php');
	deleterecord();
}
if((@$_POST["cncl"])=="Cancel")
{
	header("Location:reg_welcome.php");
}
?>
</form>
</div>
<div class="container"></div></div>
<div class="clearfix"></div>
</div></div>
<!--for including php file of footer -->
<?php 	include('reg_foot.php');?>
</body>
</html>