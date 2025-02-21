<html>
    <head>
        <!-- Title of the page -->
        <title>Search Status Process</title>

        <!-- The link for the external css file-->
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <!-- Container for content -->
            <!-- Heading -->
            <h1>Status Information</h1>
            <div class="content">
                <?php
                $host = "localhost";  
                $user = "root";      
                $pswd = "";          
                $dbnm = "status_db"; 

                // Connecting to the database
                $conn = mysqli_connect($host, $user, $pswd, $dbnm);

                // Getting search keyword from the GET request
                    $search = $_GET["Search"];
                    // Query to select all rows from the 'status_info' table
                    //$query = "SELECT * FROM status_info";
                    $query = "SHOW TABLES LIKE 'status_info'";
                    $tableExist = mysqli_query($conn, $query);
                    // Checking if the 'status_info' table exists
                    if (mysqli_num_rows($tableExist) > 0) {
                        // Checking if the search keyword is empty
			if ($search == '') {
                            echo "<p>The search string is empty. Please enter a keyword to search.</p>";
                        } 
                        else{
                            $query = "SELECT st FROM status_info";
                            $stExist = mysqli_query($conn, $query);
                            $row_val = array();
                            // Fetching all 'st' values from the 'status_info' table and storing them in an array
                            while ($row = $stExist->fetch_assoc()) {
                                $row_val[] = $row["st"];
                            }
                            // Checking if the search keyword exists in the 'st' column
                            if (!in_array($search, $row_val)) {
                                echo "<p>Status not found. Please try a different keyword</p>";
                            } else {
                                // Query to select rows with the specified status from the 'status_info' table
                                $query = "SELECT * FROM status_info WHERE st='$search'";
                                $result = @mysqli_query($conn, $query);
                                $value = @mysqli_fetch_row($result);
                                // Displaying status information
                                while ($value) {
                                    echo "<label>Status: $value[1]</label>";
                                    echo "</br><label>Status Code:  $value[0]</label>";
                                    echo "</br></br><label>Share:   $value[2]</label>";
                                    echo "</br><label>Date Posted: $value[4]</label>";
                                    echo "</br><label>Permission: $value[3]</label></br></br>";
                                    echo"<hr>";
                                    $value = mysqli_fetch_row($result);
                                }
                            }
                        }
                    } else {
                        // If 'status_info' table does not exist, display a message
                        echo "<p>No status found in the system. Please go to the post status page to post one.</p>";
                        $add = "poststatusform.php";
                        echo "</br><label><a href=$add>Post Status Page</a></label></br>";
                    }
                // Closing database connection
                mysqli_close($conn);
                ?>
            </div>
        <!-- Links to search for another status and return to the Home Page -->
        </br></br></br>
        <label><a href="searchstatusform.html">Search for another status</a></label>
        <div class="right">
        <label><a href="index.html">Return to Home Page</a></label>
        </div>
    </body>
</html>
