<!DOCTYPE html>

<html>

<head>
    
    <title>Thank You</title>
    <link href="css/signin.css" rel="stylesheet" type="text/css">
    
    <?php
    
        require_once('conn/conn.php');
        $query = "SELECT * FROM students ORDER BY lastName";    
        $result = mysqli_query($conn, $query);
    
    ?>
    
    <style>
        
        .title-row {
            background-color: aquamarine;
        }
        
        .header-row {
            background-color: darkslategrey;
            color: beige;
        }
        
    </style>
    
</head>

<body>
    
  <br><br>
	
  <div class="studentList">
	
    <table width="700px" border="1px" cellpadding="5px" align="center">
        
            <tr>
                <td colspan="6" align="center" class="title-row">
                    <h3>Code Immersives Students
					<br/><br/>
					<a href="signin.php">STUDENT SIGN IN FORM</a></h3>
                </td>
            </tr>
        
            <tr class="title-row"> 
                <td>First Name</td>
                <td>Last Name</td>
                <td>Email</td>
                <td>Phone</td>
				<td>Class</td>
            </tr>
            
        <?php while($row=mysqli_fetch_array($result)) { ?>
        
            <tr class="header-row">
                 <td><?php echo $row['firstName']; ?></td>
                 <td><?php echo $row['lastName']; ?></td>
                 <td><?php echo $row['email']; ?></td>
                 <td><?php echo $row['phone']; ?></td>
				 <td><?php echo $row['startDate']; ?></td>
            </tr>
        
        <?php } ?>
        
        </table>
	  
	</div>
    
</body>
    
</html>