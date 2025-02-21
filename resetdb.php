<html>
    <head>
        <!-- Title of the page -->
        <title>About Page</title>

        <!-- The link for the external css file-->
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <?php
        $host = "localhost";  
        $user = "root";      
        $pswd = "";          
        $dbnm = "status_db"; 

        // Connecting to the database
        $conn = mysqli_connect($host, $user, $pswd, $dbnm);

        // Query to check if the table 'status_info' exists
        $query = "SELECT * FROM status_info";
        $tableExist = mysqli_query($conn, $query);

        // Checking if the table exists
        if (mysqli_num_rows($tableExist) > 0) {
            // Dropping the table 'status_info' if it exists
            $query_drop = "DROP TABLE status_info";
            $drop = mysqli_query($conn, $query_drop);
            // Displaying success message if the table is dropped successfully
            echo "<p>The database has been reset!</p>";
        } else {
            // Displaying message if the table does not exist
            echo "<p>The table does not exist!</p>";
        }
        ?>
        
        </br></br>
        
        <!-- Link to return to the home page -->
        <p style="text-align:right;"><a href="index.html">Return to Home Page</a></p>
    </body>
</html>
