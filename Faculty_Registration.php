<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Registration</title>
    <link rel="stylesheet" href="style_2.css">
    <link rel="shortcut icon" type="image" href="logo.png">
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

    <br><br><br><br>
    <h4><u>New Faculty Registration</u></h4>
    <br>


    <form action="Faculty_Registration.php" method="POST">

        <label for="NSU_Faculty_id">Faculty ID: </label>
        <input type="number" name="NSU_Faculty_id" id="NSU_Faculty_id" placeholder="Faculty ID" maxlength="10" minlength="10" required> <br>

        <label for="NID">NID Number: </label>
        <input type="number" name="NID" id="NID" placeholder="Insert NID/Birth Certificate Number" maxlength="17" required> <br>

        <label for="Name">Full Name: </label>
        <input type="text" name="Name" id="Name" placeholder="Insert Name" required><br>

        <label for="Faculty_Initial">Faculty Initial: </label>
        <input type="text" name="Faculty_Initial" id="Faculty_Initial" placeholder="Insert Name" required><br>
       
        <label for="Address">Addess: </label>
        <input type="text" name="Address" id="Address" placeholder="Insert Address" required> <br>

        <label for="Phone_No">Contact Number: </label>
        <input type="text" name="Phone_No" id="Phone_No" placeholder="Insert Contact Number" required> <br>
        
        <label for="Date_Of_Birth">Date of Birth: </label>
        <input type="date" name="Date_Of_Birth" id="Date_Of_Birth" placeholder="Insert Date of birth" required> <br>

        <label for="DoseDate1">Date of First Dose: </label>
        <input type="date" name="DoseDate1" id="DoseDate1" placeholder="Insert Date of First Dose"> <br>

        <label for="DoseDate2">Date of Second Dose: </label>
        <input type="date" name="DoseDate2" id="DoseDate2" placeholder="Insert Date of Second Dose"> <br>

        <br>
        <div align="center">
            <input type="submit" name="Submit" value="Submit" class="button">
        </div>
    </form>
</body>
</html>

<?php 
    $con = mysqli_connect("localhost","root","","non_vaccinated_information");

    if(isset($_POST['Submit'])){
        

        $NID = $_POST['NID'];
        $NSU_Faculty_id = $_POST['NSU_Faculty_id'];
        $Name = $_POST['Name'];
        $Address = $_POST['Address'];
        $Phone_No = $_POST['Phone_No'];
        $Date_Of_Birth = $_POST['Date_Of_Birth'];
        $Faculty_Initial = $_POST['Faculty_Initial'];

        // check if available or not
        $squery1="select * from faculty where NID='$NID'";
        $sresult1=mysqli_query($con,$squery1);  
        
        if(mysqli_num_rows($sresult1) == 0){
            $query = "insert into faculty(NID, Name, Address, Phone_No, Date_Of_Birth) 
                values('$NID','$Name','$Address','$Phone_No','$Date_Of_Birth')";

            $result = mysqli_query($con,$query);
            
            if(!is_null($NSU_Faculty_id)){
                $iquery2 = "insert into nsu_faculty(NSU_Faculty_id,Faculty_Initial,NID) 
                values('$NSU_Faculty_id','$Faculty_Initial', '$NID')";

                $iresult2 = mysqli_query($con,$iquery2);
            }
            

            if($result){
                echo "<script>alert('Successfully Inserted Done !!')</script>";
            }
        } else {
            echo "<script>alert('Duplicate Data Found !!')</script>";
        }
        
    }

    mysqli_close($con);
?>