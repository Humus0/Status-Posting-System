
<html>
    <head>
        <title>Post Status Page</title>
       
        <!-- The link for the external css file-->
        <link rel="stylesheet" href="styles.css">

    </head>
    <body>
        <h1>Status Posting System</h1>

        <!-- Form for posting status -->
        <form action="poststatusprocess.php" method="POST">
            <!-- Input field for status code -->
            <label>Status Code:</label>
            <input type="text" name="stcode"/>

            </br></br>

            <!-- Input field for status -->
            <label>Status:</label>
            <input type="text" name="st"/>

            </br></br>

            <!-- Radio buttons for sharing options -->
            <label>Share:</label>
            <input type="radio" id="a" name="share" value="University"/>
            <label for="a">University</label>

            <input type="radio" id="b" name="share" value="Class"/>
            <label for="b">Class</label>

            <input type="radio" id="c" name="share" value="Private"/>
            <label for="c">Private</label>

            </br></br>

            <!-- Input field for date -->
            <label>Date:</label>
            <input type="text" id="date" name="date" value="<?php echo date('d/m/Y'); ?>">


            </br></br>

            <!-- Checkboxes for permission -->
            <label>Permission:</label>
            <input type="checkbox" id="d" name="perm[]" value="Allow Like"/>
            <label for="d">Allow Like</label>

            <input type="checkbox" id="e" name="perm[]" value="Allow Comment"/>
            <label for="e">Allow Comments</label>

            <input type="checkbox" id="f" name="perm[]" value="Allow Share"/>
            <label for="f">Allow Share</label>

            </br></br>

            <!-- Submit button -->
            <input type="submit" value="Submit"></input>

            </br></br>

            <!-- Link to return to home page -->
            <label><a href="index.html">Return to Home Page</a></label>
        </form>
    </body>
</html>
