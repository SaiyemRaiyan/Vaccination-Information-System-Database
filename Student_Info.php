<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
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

    <h4>Student Information (Update)</h4>
    <br>

    <form action="Student_Info.php" method="POST">

        <label for="NSU_id">NSU ID: </label>
        <input type="number" name = "NSU_id" id = "NSU_id" placeholder="Insert NSU ID"   maxlength="10" required> <br>
        
        <label for="NID_Birth_Certificate">NID or Birth Certificate Number: </label>
        <input type="number" name = "NID_Birth_Certificate" id = "NID_Birth_Certificate" placeholder="Insert NID/Birth Certificate Number" maxlength="17" required> <br>

        <label for="Name">Full Name: </label>
        <input type="text" name = "Name" id = "Name" placeholder="Insert Name" required><br>
       
        <label for="Address">Addess: </label>
        <input type="text" name = "Address" id = "Address" placeholder="Insert Address" required> <br>

        <label for="Phone_No">Contact Number: </label>
        <input type="text" name = "Phone_No" id = "Phone_No" placeholder="Insert Contact Number" required> <br>
        
        <label for="Date_Of_Birth">Date of Birth: </label>
        <input type="date" name = "Date_Of_Birth" id = "Date_Of_Birth" placeholder="Insert Date of birth" required> <br>

        <label for="DoseDate1">Date of First Dose: </label>
        <input type="date" name = "DoseDate1" id = "DoseDate1" placeholder="Insert Date of First Dose"> <br>

        <label for="DoseDate2">Date of Second Dose: </label>
        <input type="date" name = "DoseDate2" id = "DoseDate2" placeholder="Insert Date of Second Dose"> <br>

        <br>
        <div align="center">
            <input type="submit" name = "Submit" value="Submit" class="button">
        </div>
    </form>
</body>
</html>

<?php  
        $NID_Birth_Certificate = $_POST['NID_Birth_Certificate'];
        $Name = $_POST['Name'];
        $Address = $_POST['Address'];
        $Phone_No = $_POST['Phone_No'];
        $Date_Of_Birth = $_POST['Date_Of_Birth'];
        $DoseDate1 = $_POST['DoseDate1'];
        $DoseDate2 = $_POST['DoseDate2'];
        $NSU_id = $_POST['NSU_id'];

    if(isset($_POST['Submit'])){
        $con = mysqli_connect("localhost","root","","non_vaccinated_information");
        
        // retrival check
        // for nsuer    
        $squery1="select * from student where NID_Birth_Certificate='$NID_Birth_Certificate'";
        $sresult1=mysqli_query($con,$squery1);  
        // for nsuer
        $squery2="select * from nsuer where NID_Birth_Certificate='$NID_Birth_Certificate'";
        $sresult2=mysqli_query($con,$squery2);  

        mysqli_close($con);
    }


    // insert into vaccinated_information 
    if($sresult1){
        $con = mysqli_connect("localhost","root","","vaccinated_information");
        
        $iquery1 = "insert into student( NID_Birth_Certificate, Name, Address, Phone_No, Date_Of_Birth,DoseDate1, DoseDate2) 
                values('$NID_Birth_Certificate','$Name','$Address','$Phone_No','$Date_Of_Birth','$DoseDate1','$DoseDate2')";

        $iresult1 = mysqli_query($con,$iquery1);

        if($sresult2){
            $iquery2 = "insert into nsuer( NID_Birth_Certificate,NSU_id) 
                values('$NID_Birth_Certificate','$NSU_id')";

            $iresult2 = mysqli_query($con,$iquery2);
        }

        if($iresult1){
            echo "<script>alert('Successfully Data Inserted into vaccinated information Done !!')</script>";
        }


        mysqli_close($con);
    }

    // delete 
    if($sresult1){
        //connecting
        $con = mysqli_connect("localhost","root","","non_vaccinated_information");
        
        // "NSUER" table delet check + delete
            if($sresult2){
                $dquery2 = "delete from nsuer where NID_Birth_Certificate='$NID_Birth_Certificate'";
                $dresult2=mysqli_query($con,$dquery2);
            }
        
        // Normal Student delete
        $dquery1 = "delete from student where NID_Birth_Certificate='$NID_Birth_Certificate'";
        $dresult1=mysqli_query($con,$dquery1);  
    
        
        if ($con->query($dquery1) == TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }


        mysqli_close($con);
    }
  
?>