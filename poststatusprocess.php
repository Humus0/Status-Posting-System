<html>
    <head>
        <title>Post Status Process</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <h1>Status Posting System</h1>

        <div class="content">
            <?php
            // Database connection
            $host = "localhost";
            $user = "root";
            $pswd = "";
            $dbnm = "status_db";

            $conn = mysqli_connect($host, $user, $pswd, $dbnm);

            // Check if the table exists
            $query = "SHOW TABLES LIKE 'status_info'";
            $tableExist = mysqli_query($conn, $query);

            if (mysqli_num_rows($tableExist) == 0) {
                // If table does not exist, create it
                $sqlString = "CREATE TABLE status_info (
                    stcode VARCHAR(40) PRIMARY KEY, 
                    st VARCHAR(255), 
                    share VARCHAR(40), 
                    perm VARCHAR(255), 
                    post_date VARCHAR(40)
                )";
                if (!mysqli_query($conn, $sqlString)) {
                    die("Error creating table: " . mysqli_error($conn));
                }
            }

            // Now that the table exists, fetch existing status codes
            $row_val = array();
            $query = "SELECT stcode FROM status_info";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $row_val[] = $row["stcode"];
            }

            // Get form values
            $stcode = $_POST["stcode"];
            $st = $_POST["st"];
            $share = isset($_POST["share"]);  // Set default value for share
            $permission = isset($_POST["perm"]) && is_array($_POST["perm"]) ? $_POST["perm"] : [];
            $date = $_POST["date"];

            list($day, $month, $year) = explode('/', $date);

            // Validation patterns
            $patt_1 = '/^S\d{4}$/';
            $patt_2 = '/^[A-Za-z0-9 ,.?!]+$/';

            if (empty($stcode) || empty($st) || empty($share) || empty($permission) || empty($date)) {
                echo "<p>You cannot leave anything blank!</p>";
                
            } elseif (!preg_match($patt_1, $stcode)) {
                echo "<p>Invalid status code format! Must start with 'S' followed by four digits (e.g., 'S0001').</p>";
            } elseif (!preg_match($patt_2, $st)) {
                echo "<p>Invalid status format! Only letters, numbers, spaces, and , . ! ? are allowed.</p>";
            } elseif (in_array($stcode, $row_val)) {
                echo "<p>Status code already exists! Please try another.</p>";
            } elseif (!checkdate($month, $day, $year)) {
                echo "<p>Invalid date format!</p>";
            } else {
                // Convert permissions array to string
                $permValues = implode(', ', $permission);

                // Insert into database
                $sql = "INSERT INTO status_info (stcode, st, share, perm, post_date) 
                        VALUES ('$stcode', '$st', '$share', '$permValues', '$date')";
                
                if (mysqli_query($conn, $sql)) {
                    echo "<p>New status posted successfully!</p>";
                } 
                else {
                    echo "Error: " . mysqli_error($conn);
                }
            }

            mysqli_close($conn);
            ?>
        </div>

        <br><br>

        <label><a href="poststatusform.php">Post Status Page</a></label>
        <div class="right">
            <label><a href="index.html">Return to Home Page</a></label>
        </div>
    </body>
</html>
