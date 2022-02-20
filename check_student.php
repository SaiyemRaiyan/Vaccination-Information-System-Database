<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covid-19 Vaccine Information</title>
    <link rel="stylesheet" href="style_2.css">
</head>

<body>
        <div class="navbar">

        <div class="menu">
            <ul>
                <li><img class="logo" src="NSU logo.png" alt=""></li>
                <li><a href="Home.php">HOME</a></li>
                <li><a href="About.php">ABOUT</a></li>
                <li><a href="CheckPage.php">CHECK</a></li>
                <li><a href="InsertPage.php">UPDATE</a></li>
                <li><a href="RegistrationPage.php">REGISTRATION</a></li>
                
            </ul>
        </div>
        </div>
        
    <h4>Check Student Vaccination Status</h4>
    <br><br>

    <form action="check_student.php" method="POST">
        
        <label for="ID"> NID:  </label>
        <input type="text" name="ID" id="ID">
    
        <div align="center">
            <input type="submit" name="Search" class="button" value="Search">
        </div></br>
		<div align="center">
			<input type="submit" name="All_Student_Search" class="button" value="All_Student_Search" style=" width: 300px; height: 80px;">
		</div>
    </form>

</body>
</html>



<?php  

	if(isset($_POST['Search'])){
		$con = mysqli_connect("localhost","root","","vaccinated_information");
		$ID = $_POST['ID'];
		$query="select * from student where NID_Birth_Certificate='$ID'";
  		$result=mysqli_query($con,$query);	
	mysqli_close($con);
  		
  		}
  	if(isset($_POST['All_Student_Search'])){
  		$con = mysqli_connect("localhost","root","","vaccinated_information");
		$query="select * from student";
  		$result=mysqli_query($con,$query);
	mysqli_close($con);
  			
  		}	
?>




<!DOCTYPE html>
<html>
  	<body>
  		<table border="1px" style="width:800px; line-height:35px;" align="center">
</br></br></br>
			<tr style="color: #fff;" align="center">
 				<th>NID_Birth_Certificate</th>
 				<th>Name</th>
 				<th>DoseDate1</th>
 				<th>DoseDate2</th>
			</tr>
  	
	<?php 
		while($rows = mysqli_fetch_array($result)){
	?>	
		<tr style="color: #fff;" align="center">
			<td> <?php echo $rows['NID_Birth_Certificate']; ?></td>
    			<td> <?php echo $rows['Name']; ?> </td>
    			<td> <?php echo $rows['DoseDate1']; ?> </td>
    			<td> <?php echo $rows['DoseDate2']; ?> </td>
		</tr>
	<?php 
		}

	?>	
		</table>
	</body>
 </html>