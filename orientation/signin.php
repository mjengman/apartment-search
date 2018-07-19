<!DOCTYPE html>
<html lang="en">
    
<head>
    
    <meta charset="UTF-8">
    <title>Code Immersives Orientation</title>
    
    <link href="css/signin-start.css" rel="stylesheet" type="text/css">
    

</head>

<body>
    
    <div class="container">
		
		<main>
		
			<a href="signin-list.php">
				<img src="images/code-immersives-logo.png" width="50%" height="auto">
			</a>
            
			<h2>WELCOME!</h2> 
			<h2>Code Immersives Orientation</h2>
			<h3>Tuesday, September 04, 2018</h3>
			<h3>All New Coding Students <br/>Please Fill Out Form</h3>
			<h4>You will be assigned a CodeImmersives email, but put your personal email here.</h4>

		</main>
		
		<aside>
            
            <h2>Please Sign In</h2>
            
            <form method="post" action="signin-proc.php">
            
                <input type="text" name="firstName" id="firstName" placeholder="First Name" required>
                
                <input type="text" name="lastName" id="lastName" placeholder="Last Name" required>
                
                <input type="email" name="email" id="email" placeholder="Email" required>
                
                <input type="text" name="phone" id="phone" placeholder="Phone" required>
                
                <br><strong>Start Date:</strong>
                <select name="startDate" id="startDate">
                    <option value="58">May 2018</option>
                    <option value="98" selected>Sept 2018</option>
                    <option value="19" selected>Jan 2019</option>
                </select>
                
                <input type="submit" name="submit" id="submit" value="SUBMIT">
            
            </form>
    
        </aside>
		
     </div><!-- close container -->
	
     <script>
    
        document.getElementById('firstName').value = "";
        document.getElementById('lastName').value = "";
        document.getElementById('email').value = "";
        document.getElementById('phone').value = "";
    
    </script>
	
</body>
    
</html>
