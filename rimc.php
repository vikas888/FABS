<?php
	session_start();
	include('DBConnect.php');
	include('form_process/teachingProcess.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
<title>Research Publication </title>
  <?php
  		include('cssLinks.php');
  ?>
</head>
<script>
function onlyAmpersand(event)				
{
    	var e =event; 
   		var charCode = e.which || e.keyCode;
    		if (charCode == 38)
       			 return false;
			else
				 return true;

}
</script>
<body>
	<?php
		if(isset($_SESSION['username']) and $_SESSION['pbasYear']){
			echo '<div id="wrap">';
			include('header.php');
			$year=$_SESSION['pbasYear'];
     ?>
	 	<div class="container" style="background-color:#FFFFFF;">
	 		<div style="box-shadow:5px 5px 5px 5px #888888; padding:3px 3px 3px 3px;" class="text-primary">
				<center><h4><b>Teaching Learning And Evaluation Related Activities <span class="text-danger"><?php echo $_SESSION['pbasYear']; ?></span></b></h4></center>
			</div>
	 		<div class="col-md-4" id="myNav">
        <br><br>
        <div class="panel panel-primary" >
            <ul class="nav nav-tabs nav-pills"  data-offset-top="190" style="width:100%;">
                <li><a href="teachingLearningActivities.php">Lectures, Seminar,Tutorial, Practical, Contact Hours<div class="pull-right"><i class="icon-chevron-right" ></i></div></a></li>
                <li><li class="active"><a href="rimc.php">Reading/Instructional material consulted and additional knowledge resources provided to students<div class="pull-right"><i class="icon-chevron-right" ></i></div></a></li>
                <li><a href="tlm.php">Use of participatory and innovative Teaching-Learning Methodologies, Updating of subject contents<div class="pull-right"><i class="icon-chevron-right" ></i></div></a></li>
                <li><a href="edap.php">Examination Duties Assigned and Performed<div class="pull-right"><i class="icon-chevron-right" ></i></div></a></li>
                
            </ul>
        </div>
        </div>
        <br>
	   		 	<div class="col-sm-8">
	   		 		<br>						
						     <div class="panel panel-primary" style="padding:3px 3px 3px 3px;">
						
						
						<div class="panel-heading" >
							<h4 align="center" >Reading/Instructional material consulted and additional knowledge resources provided to students</h4>
						</div><!--end of panel heading div-->
						<br>
			   					<form role="form" name="resources" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" id="resourceForm">
			   					<div class="form-group">
			   					<input class="btn btn-primary" type="submit" value="Save" name="resourceSave" />
									<select name="course" style="width: 220px" onChange="showUser(this.value, this.name)">
										<option>--Course--</option>
										<?php 
											include('DBConnect.php');
											$user_id = $_SESSION['username'];
											$year=$_SESSION['pbasYear'];
											$query = mysqli_query($con,"SELECT * from teach_rimc WHERE User_Id='$user_id' and year='$year'");
											while($row = mysqli_fetch_assoc($query)){
										?>		<option><?php echo $row['Teach_RIMC_Course']; ?></option>
										<?php } ?>
									</select>
									<input type="submit" class="btn btn-primary"  value="Delete" name="resourceDelete" />
									<input type="reset" class="btn btn-primary" value="Reset" name="reset" />
								   <div id="res"><br />
		          					<label>Course / Paper</label>
				    					<input type="text" class="form-control required" onkeypress="return onlyAmpersand(event)" name="readingCourse" title="Please Enter Course Name" required="required"/>
                  					 <br><label>Consulted</label>
				    					<input type="textarea" class="form-control required" onkeypress="return onlyAmpersand(event)" name="consulted" title="Please Enter value" required="required"/>
		          					 <br><label>Prescribed</label>
				    					<input type="textarea" class="form-control required" onkeypress="return onlyAmpersand(event)" name="prescribed" title="Please Fill this information" required="required"/>
		   		  					 <br><label>Additional Resources Provided : </label>
				    					Yes<input type="radio" name="addiResources" onclick="document.getElementById('disappear').disabled = false;" value="Yes"/>
										No<input type="radio" name="addiResources" onclick="document.getElementById('disappear').disabled = true;" value="No"/>	
									  <input type="text" class="form-control required" onkeypress="return onlyAmpersand(event)" name="resrc" title="Please Fill this information" id="disappear" required="required"/>  					
			 					 </div><!--End if id res for Ajax -->
			 				  </div>
							<input class="btn btn-primary" type="submit" value="Save" name="resourceSave" />
									<select name="course" style="width: 220px" onChange="showUser(this.value, this.name)">
										<option>--Course--</option>
										<?php 
											include('DBConnect.php');
											$user_id = $_SESSION['username'];
											$year=$_SESSION['pbasYear'];
											$query = mysqli_query($con,"SELECT * from teach_rimc WHERE User_Id='$user_id' and year='$year'");
											while($row = mysqli_fetch_assoc($query)){
										?>		<option><?php echo $row['Teach_RIMC_Course']; ?></option>
										<?php } ?>
									</select>
									<input type="submit" class="btn btn-primary"  value="Delete" name="resourceDelete" />
									<input type="reset" class="btn btn-primary" value="Reset" name="reset" />
		    					</form>
	         			</div><!--end of form panel div-->
		 										
	         
		 				
				</div><!--End of col-sm-9 class -->
				
			</div><!--End of row class -->
	 	 </div><!--End of container class -->
	</div><!--end of wrap id -->
	 <?php
	      	include('footer.php');
	        include('jsLinks.php');
	?>
	<script>
		function showUser(value, name)
		{
			if (value=="")
  			{
  				document.getElementById("lect").innerHTML="";
  				return;
  			}
			if (window.XMLHttpRequest)
  			{// code for IE7+, Firefox, Chrome, Opera, Safari
  				xmlhttp=new XMLHttpRequest();
  			}
			else
  			{// code for IE6, IE5
  				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  			}
			xmlhttp.onreadystatechange=function()
  			{
 				 if (xmlhttp.readyState==4 && xmlhttp.status==200)
    			{  
					if(name == "lect"){
        			    document.getElementById("lect").innerHTML=xmlhttp.responseText;	
					}
					if(name == "course"){
						document.getElementById("res").innerHTML=xmlhttp.responseText;
					}
					if(name == "desc"){
        			    document.getElementById("inno").innerHTML=xmlhttp.responseText;	
					}
					if(name == "dut"){
        			    document.getElementById("duty").innerHTML=xmlhttp.responseText;	
					}
    			}
  			}
			xmlhttp.open("GET","form_process/teachingShow.php?val="+value+"&name="+name,true);
			xmlhttp.send();
		}
	</script>

	<?php
		  }
		  else{
		     header('location:index.php');
	      }
     ?>
</body>
</html>
