<link href="css/apts.css" rel="stylesheet">

<!-- begin initial php -->

<?php 

// 1.) there is no form to process, so skip the POST / GET vars part

$bdrms = $_GET['bdrms'];
$baths = $_GET['baths'];
$minRent = $_GET['minRent'];
$maxRent = $_GET['maxRent'];
$bldgID = $_GET['bldgID']; // from dynamic bldg menu (Any == -1)
$orderBy = $_GET['orderBy']; // how user wants to sort results
$ascDesc = $_GET['ascDesc'];// radio button choice of ASC or DESC



// 2+3.) Connect to mysql, and select the database

require_once("conn/connApts.php");

// 4.) write out the CRUD order (query) -- whatever it is you want to do

$query = "SELECT * from apartments, buildings, neighborhoods 
WHERE apartments.bldgID = buildings.IDbldg 
AND buildings.hoodID = neighborhoods.IDhood  
AND rent BETWEEN '$minRent' AND '$maxRent'";

// concat query if user chose a bldg from dynamic bldg menu

if($bldgID != -1){
    $query .= " AND bldgID='$bldgID'";
}

// concat query if user typed something into the search box

if($_GET['search'] != "") { // true if user typed something
    $search = $_GET['search'];
    $query .= " AND (aptDesc LIKE '%$search%'
    OR bldgDesc LIKE '%$search%'
    OR hoodDesc LIKE '%$search%'
    OR bldgName LIKE '%$search%'
    OR aptTitle LIKE '%$search%'
    OR address LIKE '%$search%')"; // LIKE === includes
}

// concat query for checkboxes -- "check" to see, one by one, if the checkoxes are actually checked

// if the 'doorman' variable is set (if it was checked) then concat onto the query

if(isset ($_GET['doorman'])) { 
    $query .= " AND isDoorman=1";
}

if(isset ($_GET['parking'])) { 
    $query .= " AND isParking=1";
}

if(isset ($_GET['pets'])) { 
    $query .= " AND isPets=1";
}

if(isset ($_GET['gym'])) { 
    $query .= " AND isGym=1";
}

// concat query for bed/bath if menu choice is not "any", meaning the field's value is not -1

if($bdrms != -1) {
    // if rounding doesn't change the value, it's an integer
    if($bdrms == round($bdrms)){
        $query .= " AND bdrms = '$bdrms'";
    }else{
        $bdrms = round($bdrms);
        $query .= " AND bdrms >='$bdrms'";
    }
}

if($baths != -1) { // if baths menu choice not "Any"
    // filter for baths (concat query)
    // multiply baths by 10 to get rid of pesky decimals!
    $baths10 = $baths * 10; // 1.5 becomes 15; 1.6 becomes 16
    // do we get a remainder when dividing my 5? If so, it is a plus-sign choice value (16, 21)
    if($baths10 % 5 == 0) { // a multiple of 5
        $query .= " AND baths='$baths'";
    }else{ // get got a remainder, hence, a plus sign choice
        // round down (foor the value)
    $baths -= 0.1;   
    $query .= " AND baths >= '$baths'";
    }
}

$query .=  " ORDER BY $orderBy $ascDesc"; // this line must be last

// Order by *columnName* *ASC/DESC* <-- Sort based on a column

// 5.) execute the order: read records from apartments table

$result = mysqli_query($conn, $query);  // the result will be an array of arrays, a matrix (or, a multi-dimensional array)

// $row = mysqli_fetch_array($result);

if (!$result) {
    echo mysqli_error($conn);
}  // if something went wrong, let me know

?> <!-- close initial php -->

<!doctype html>

<html lang="en-us">
    
<head>
    
    <meta charset="utf-8">
    
    <title>Apartment Search Results</title>
    
</head>

<body>
    
    <table width="800" border="1" cellpadding="5">
    
        <tr>
            <td colspan="14" align="center">
                <h1 align="center">Lofty Heights Apartments</h1>
                <h2><?php echo mysqli_num_rows($result); ?> Results Found</h2>
            </td>
        </tr>
        
        <?php
            if(mysqli_num_rows($result) == 0) { // no results
                echo '<tr>
                        <td colspan="14">
                            <h3 align="center">
                                Sorry! No results found! Please search again! <br>
                                <button onclick="window.history.back()">
                                    Search Again
                                </button>
                                <br> Redirecting...
                            </h3>
                        </td>
                      </tr>';
                
                // redired after 10 seconds of inactivity
                
                header("Refresh:10; url=searchApts.php", true, 303);
                
            }else{ // we got at least 1 result
                echo '<tr>
                        <th>ID</th>
                        <th>Apt</th>
                        <th>Building</th>
                        <th>Bedrooms</th>
                        <th>Baths</th>
                        <th>Rent</th>
                        <th>Floor</th>
                        <th>Sqft</th>
                        <th>Status</th>
                        <th>Neighborhood</th>
                        <th>Doorman</th>
                        <th>Pets</th>
                        <th>Gym</th>
                        <th>Parking</th>
                    </tr>';
                }
        ?>
        
        <?php
        while($row = mysqli_fetch_array($result)){
        ?>
        
        <tr>
            <td><?php echo $row['IDapt']; ?></td>
            <td><a href="aptDetails.php?IDapt=<?php echo $row['IDapt']; ?>"><?php echo $row['apt']; ?></a></td>
            <td><?php echo '<a href="bldgDetails.php?bldgID=' 
                  . $row['bldgID'] . '">' 
                  . $row['bldgName'] . '</a>';?> </td>
              
            <td><?php echo $row['bdrms'] == 0 ? 'Studio' : $row['bdrms'];
                  ?></td>
            <td><?php echo $row['baths']; ?></td>
            <td>$<?php echo number_format ($row['rent']); ?></td>
            <td><?php echo $row['floor']; ?></td>
            <td><?php echo number_format ($row['sqft']); ?></td>
            <td><?php if($row['isAvail'] == 0){
                      echo "Occupied";
                      }else{ // the value is 1
                      echo "Available";
                      } ?></td>
            <td><?php echo $row['hoodName']; ?></td>
            <td><?php if($row['isDoorman'] == 0){
                      echo 'No'; 
                      }else{ // the value is 1
                      echo 'Yes';
                      } ?></td>
            <td><?php echo $row['isPets'] == 0 ? 'No':'Yes'; ?></td>
            <td><?php echo $row['isGym'] == 0 ? 'No':'Yes'; ?></td>
            <td><?php echo $row['isParking'] == 0 ? 'No':'Yes'; ?></td>
          </tr>
        
    <?php } // end the while loop
        ?>
    
    </table>
    
</body>
   
</html>