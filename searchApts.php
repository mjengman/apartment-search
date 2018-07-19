<?php

// load the buildings for the SELECT menu

    require_once("conn/connApts.php");

    $query = "SELECT IDbldg, bldgName FROM buildings ORDER BY bldgName ASC";

    $result = mysqli_query($conn, $query);

    echo mysqli_error($conn); // check to see if we have any errors

?>

<!DOCTYPE html>

<html lang="en">
    
<head>
    
    <title>Apartment Search</title>
    
    <link href="css/apts.css" rel="stylesheet">
    
</head>

<body>
    
    <div id="container">
        
    <h1>Apartment Search</h1>
    
    <form method="get" action="searchAptsProc.php" onsubmit="return validateMinMaxRent()">
        
        <!-- We used "get" here because we are only GETting information -->
        
        <!--  -->
        <p class="search">Search:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <!-- ghetto spacing my form -->
            
            <input type="search" name="search" class="search"  id="search"></p>
        
        <p>Building:
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <!-- ghetto spacing my form -->
            <select name="bldgID" id="bldgID">
                <option value="-1">Any</option>
                <?php
                    while($row=mysqli_fetch_array($result)) {
                    echo '<option value="' . $row['IDbldg'] . '">' .$row['bldgName'] . '</option>';
                }
                ?>     
            </select>
            
        </p>
        
        <p>Min Rent: 
            &nbsp;&nbsp;&nbsp; <!-- ghetto spacing my form -->
          <select name="minRent" id="minRent">
            <option value="0">Any</option>
            
            <?php 
              $i = 1000;
              
              while($i <= 5000){
                echo '<option value="' . $i . '">$' . number_format($i) . '</option>';
                $i += 250;
              }
            ?>   
          </select>
        </p>

          <p>Max Rent:
              &nbsp;&nbsp; <!-- ghetto spacing my form -->
            <select name="maxRent" id="maxRent">
              <option value="99999">Any</option>
              <?php 
                $i = 2000;
                while($i <= 7500){
                echo '<option value="' . $i . '">$' . number_format($i) . '</option>';
                $i += 500;
                }
              ?>
            </select>
          </p>
        
        <p>Bedrooms:
            &nbsp; <!-- ghetto spacing my form -->
            <select name="bdrms" id="bdrms">
                <option value="-1" selected>Any</option>
                <option value="0">Studio</option>
                <option value="1">1 bedroom</option>
                <option value="1.1">1+ bedroom</option>
                <option value="2">2 bedrooms</option>
                <option value="2.1">2+ bedrooms</option>
                <option value="3">3 bedrooms</option>
            </select>
        </p>
            
        <p>Baths:
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <!-- ghetto spacing my form -->
          <select name="baths" id="baths">
            <option value="-1" selected>Any</option>
            <option value="1">1 Bath</option>
            <option value="1.5">1 1/2 Baths</option>
            <option value="1.6">1 1/2+ Baths</option>
            <option value="2">2 Baths</option>
            <option value="2.1">2+ Baths</option>
            <option value="2.5">2.5 Baths</option>
          </select>
        </p>
        
        <h2>Building Amenities</h2>
        
        <p><label><input type="checkbox" class="cbW" name="doorman" value="doorman"> Doorman</label></p>
        <p><label><input type="checkbox" class="cbW" name="pets" value="pets"> Pet-friendly</label></p>
        <p><label><input type="checkbox" class="cbW" name="parking" value="parking"> Parking</label></p>
        <p><label><input type="checkbox" class="cbW" name="gym" value="gym"> Gym</label></p>
        
        <!-- let user choose how results are ordered -->
        
        <p>Sort results by:&nbsp;&nbsp;&nbsp;&nbsp;
            <select name="orderBy" id="orderBy">
                <option value="bdrms">Bedrooms</option>
                <option value="bldgID">Building</option>
                <option value="rent">Rent</option>
                <option value="sqft">Square Feet</option>
            </select> </p>
            
              <!-- let user specify number of results per page -->
        
        <p>Results per page:
            <select name="rowsPerPg" id="rowsPerPg">
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
        </p>
        
        
        <!-- let user choose ASC or DESC order of results-->
        
            
         <p>   
            <input type="radio" name="ascDesc" class="cbW" id="asc" value="ASC" checked>
            <label for="asc">Ascending</label>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="ascDesc" class="cbW" id="desc" value="DESC">
            <label for="desc">Descending</label>
            
        </p>
        
      
        <p><button>Submit</button></p>
        
    </form>
        
        </div> <!-- close #container -->
    
    <script>
        
      function validateMinMaxRent(){
          
        let minRent = Number(document.querySelector('#minRent').value);
        let maxRent = Number(document.querySelector('#maxRent').value);
        
        if(minRent >= maxRent){
          alert('Please choose a min rent value that is less than the max rent value');
          return false;
        }
      }
    
    </script>

</body>
    
</html>