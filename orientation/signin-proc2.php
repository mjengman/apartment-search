<!DOCTYPE html>

<html>

<head>
    
    <title>Thank You</title>
    
    <link href="css/signin.css" rel="stylesheet">
    
    <?php
    
    // add the new student to the table of the database
    // use INSERT INFO
    
    // 1.) import connection script
    
    // 2.) grab the incoming POST variables from the form
    
    // 3.) write the query string using INSERT INTO
    
    // 4.) execute the query
    
    // 5.) return to signin.php and click the logo to load all records from the table to see if new students appear
    
    // records load into table at signin-list.php
    
    
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