<!DOCTYPE html>

<html>

<head>
    
    <title>Thank You</title>
    
    <link href="css/signin.css" rel="stylesheet">
    
    <?php
    
	    // import the connection script
        require_once("conn/conn.php");
    
        // form vars
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $startDate = $_POST['startDate'];
    
        // take the form variables and query the database with a C-for-CRUD call INSERT INTO   
        $query = "INSERT INTO students(firstName, lastName, email, phone, startDate) VALUES('$firstName', '$lastName', '$email', '$phone', '$startDate')";
    
        mysqli_query($conn, $query);
    
        // Works for signing up Neil Brady -- but not for Brady O'Neal. - WHY?
        // Works for Travis Darnaud -- but not for Travis d'Arnaud -- WHY, OH WHY?
        // Mystery solved: the single quotes are messing up the SQL query, which is a string. Quotes within quotes. To fix this we must Escape the Strings!
    
    ?>
    
</head>

<body>
    
    <div class="thankyou">

         <h1 align="center">Thanks for signing in!</h1>
        
         <button onclick="goBack()">BACK</button>
        
    </div>
    
	<script>
        
        // emulate browser back button (return to cached page)
		function goBack() {
			window.history.back();
		}
        
	</script>
    
</body>
    
</html>