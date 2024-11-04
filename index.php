<?php
// Tell the server that you will be tracking session variables
session_start(); // starts a new session or resumes the existing session based on a session identifier passed via a GET or POST request, or passed via a cookie
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset = "utf-8"> <!-- tells the browser to use UTF-8 encoding -->
    <meta name="viewport" contents="width=device-width; initial-scale=1"> <!-- sets the viewport to the width of the device and sets the initial zoom level to 1 -->
    <!--
    This program will allow the user to add, delete, and display an Employee Directory List, which will be stored in a 2D array.
    CSC 235 Server-Side Development
    Wyatt Fredrickson
    Written: 11/2/2024
    Revised: N/A
    -->
    <title>**Employee Management System**</title> <!-- sets the title of the page -->
    <link rel="stylesheet" type="text/css" href="styles.css"> <!-- links to an external CSS file for styling -->
</head>






<body>
    <?php
    // The filename of the currently executing script to be used as the action=" " attribute of the form element
    $self = htmlspecialchars($_SERVER['PHP_SELF']); // gets the filename of the currently executing script and stores it in the variable $self
    // htmlspecialchars() function converts special characters to HTML entities

    // Check to see if the page has been viewed already
    // The hidSubmitFlag will not exist if this is the first time
    if(array_key_exists('hidSubmitFlag', $_POST)) { // checks to see if the submit flag variable exists in the POST array
        //echo "<h2></h2>"; // prints a message to the screen for returning visitors
        $submitFlag = $_POST['hidSubmitFlag']; // 'hidSubmitFlag' is assigned the value of the submit flag from the POST array

        // Get the serialized array that was stored in the session variable
        $invenArray = unserialize(urldecode($_SESSION['serializedArray'])); // retrieves the serialized array from the SESSION variable, decodes it, and unserializes it
        switch($submitFlag) {
            case "01": addRecord(); // calls the addRecord() function if the submit flag is 01
            break;
            case "99": deleteRecord(); // calls the deleteRecord() function if the submit flag is 99
            break;
            default: displayInventory($invenArray); // calls the displayInventory() function if the submit flag is anything else
            // More cases can be added here
        }
    }
    else {
            echo "<h1>Employee Management System</h1>";
            // Since this is the first time, create the inventory array
            // ***AI GENERATED EMPLOYEE INFORMATION***
            $invenArray = array(); // creates an empty 2D array, which will be used to store the Employee Information

            $invenArray[0][0] = "Michael";
            $invenArray[0][1] = "Rohan";
            $invenArray[0][2] = "EMP000";
            $invenArray[0][3] = "567-990-2679";

            $invenArray[1][0] = "John";
            $invenArray[1][1] = "Fisher";
            $invenArray[1][2] = "EMP001";
            $invenArray[1][3] = "567-456-7890";

            $invenArray[2][0] = "David";
            $invenArray[2][1] = "Johnson";
            $invenArray[2][2] = "EMP002";
            $invenArray[2][3] = "060-123-4567";

            $invenArray[3][0] = "Laura";
            $invenArray[3][1] = "Martinez";
            $invenArray[3][2] = "EMP003";
            $invenArray[3][3] = "567-234-5678";

            $invenArray[4][0] = "Robert";
            $invenArray[4][1] = "Garcia";
            $invenArray[4][2] = "EMP004";
            $invenArray[4][3] = "731-345-6789";

            $invenArray[5][0] = "Sarah";
            $invenArray[5][1] = "Lee";
            $invenArray[5][2] = "EMP005";
            $invenArray[5][3] = "975-456-7890";

            $invenArray[6][0] = "Daniel";
            $invenArray[6][1] = "Anderson";
            $invenArray[6][2] = "EMP006";
            $invenArray[6][3] = "344-567-8901";

            $invenArray[7][0] = "Sophia";
            $invenArray[7][1] = "Clark";
            $invenArray[7][2] = "EMP007";
            $invenArray[7][3] = "478-678-9012";

            $invenArray[8][0] = "James";
            $invenArray[8][1] = "White";
            $invenArray[8][2] = "EMP008";
            $invenArray[8][3] = "196-789-0123";

            $invenArray[9][0] = "Mia";
            $invenArray[9][1] = "Hall";
            $invenArray[9][2] = "EMP009";
            $invenArray[9][3] = "506-890-1234";

            $invenArray[10][0] = "Henry";
            $invenArray[10][1] = "Allen";
            $invenArray[10][2] = "EMP010";
            $invenArray[10][3] = "532-901-2345";

            $invenArray[11][0] = "Olivia";
            $invenArray[11][1] = "Wright";
            $invenArray[11][2] = "EMP011";
            $invenArray[11][3] = "767-012-3456";

            $invenArray[12][0] = "Wyatt";
            $invenArray[12][1] = "McDonald";
            $invenArray[12][2] = "EMP012";
            $invenArray[12][3] = "234-012-3456";
            // Save the array inventory as a serialized session variable
            $_SESSION['serializedArray'] = urlencode(serialize($invenArray)); // $invenArray is serialized and then URL encoded and stored in the SESSION variable serializedArray
        }


    // Function to add a record
    function addRecord() {
        global $invenArray; // makes the $invenArray variable global
        // Add the new information into the global array $invenArray
        $invenArray[] = array($_POST['txtFirstName'], $_POST['txtLastName'], $_POST['txtCompanyID'], $_POST['txtPhoneNumber']);
        // Save the updated array in its session variable
        sort($invenArray); // sorts the array
        // Save the array inventory as a serialized session variable
        $_SESSION['serializedArray'] = urlencode(serialize($invenArray)); // $invenArray is serialized and then URL encoded and stored in the SESSION variable serializedArray
        echo "<h2>**Employee Added**</h2>"; // prints a message to the screen to indicate that the record was added
    }
    // Function to delete a record
    function deleteRecord() {
        global $invenArray; // makes the $invenArray variable global
        global $deleteMe; // makes the $deleteMe variable global
        // Get the selected index from the lstItem list box in the form
        $deleteMe = $_POST['lstItem']; // $deleteMe is assigned the value of the selected item from the list box in the form
        // Remove the selected index from the array
        unset($invenArray[$deleteMe]); // removes the selected item from the array
        // Save the updated array in its session variable
        $_SESSION['serializedArray'] = urlencode(serialize($invenArray)); // $invenArray is serialized and then URL encoded and stored in the SESSION variable serializedArray
        echo "<h2>**Employee Deleted**</h2>"; // prints a message to the screen to indicate that the record was deleted
    }
    // Function to display the inventory
    function displayInventory() {
        global $invenArray; // makes the $invenArray variable global
        echo "<table border='10'>"; // creates a table with a border of 10 pixels
        // Display the inventory
        echo "<tr>"; // creates a row
        echo "<th>First Name</th>";
        echo "<th>Last Name</th>";
        echo "<th>Company ID</th>";
        echo "<th>Phone Number</th>";
        echo "</tr>";
        // Using a for each loop to walk through each record or (row) in the array
        foreach($invenArray as $record) { // walks through each record in the array
            echo "<tr>"; // creates a row
            foreach($record as $value) { // walks through each value in the record
                echo "<td>$value</td>"; // creates a data cell
            }
            echo "</tr>"; // closes the row
        }
        echo "</table>"; // closes the table
    }
    ?>

    <p> <!-- creates a paragraph -->
    <h2>*Employee Directory List*<br /></h2> <!-- creates a level 2 heading -->
    <div class="table-container">
    <?php displayInventory(); ?> <!-- calls the displayInventory() function to display the inventory -->
    </div> <!-- creates a div with the class table-container for styling -->
    </p> <!-- closes the paragraph -->



<!-- A form to add a record -->
 <div class="form-container">
<form action="<?php echo $self; ?> "method="POST" name="frmAdd"> <!-- creates a form and sets the action to the current page and the method to POST -->

    <fieldset id="fieldsetAdd"> <!-- creates a fieldset with the id fieldsetAdd for styling -->
        <legend>Add Employee</legend> <!-- creates a legend -->

        <label for="txtFirstName">First Name:</label> <!-- creates a label for the first name text input field -->
        <input type="text" name="txtFirstName" id="txtFirstName" value="First" size="10"/> <!-- creates a text input field for the first name -->
        <br /><br /> <!-- creates a line break -->

        <label for="txtLastName">Last Name:</label> <!-- creates a label for the last name text input field -->
        <input type="text" name="txtLastName" id="txtLastName" value="Last" size ="10" /> <!-- creates a text input field for the last name -->
        <br /><br /> <!-- creates a line break -->
    
        <label for="txtCompanyID">Company ID:</label> <!-- creates a label for the company ID text input field -->
        <input type="text" name="txtCompanyID" id="txtCompanyID" value="Company ID" size="10"/> <!-- creates a text input field for the company ID -->
        <br /><br /> <!-- creates a line break -->

        <label for="txtPhoneNumber">Phone Number:</label> <!-- creates a label for the phone number text input field -->
        <input type="text" name="txtPhoneNumber" id="txtPhoneNumber" value="Phone Number" size="10" /> <!-- creates a text input field for the phone number -->
        <br /><br /> <!-- creates a line break -->

        <!-- This field is used to determine if the page has been viewed already Code 01 = Add -->
        <input type='hidden' name='hidSubmitFlag' id='hidSubmitFlag' value='01' /> <!-- creates a hidden input field for the submit flag so the page knows it has been viewed. -->
        <input name="btnSubmit" type="submit" value="Submit Employee Information" /> <!-- creates a submit button -->


    </fieldset> <!-- closes the fieldset -->
</form> <!-- closes the form -->



<!-- A form to delete a record -->
<form action="<?php echo $self; ?> "method="POST" name="frmDELETE"> <!-- creates a form and sets the action to the current page and the method to POST -->

    <fieldset id="fieldsetDelete"> <!-- creates a fieldset with the id fieldsetDelete for styling -->
    <legend>Remove Employee</legend> <!-- creates a legend -->

    <select name="lstItem" size="1"> <!-- creates a list box -->
        <?php
            // Populate the list box using data from the array
            foreach($invenArray as $index => $lstRecord) {
                // Make the value the index and the text displayed the description from the array
                // The index will be used by deleteRecord()
                echo "<option value='" . $index . "'>" . $lstRecord[2] . "</option>\n"; // creates an option for the list box
            }
        ?>
        </select> <!-- closes the list box -->
        <!-- This field is used to determine if the page has been viewed already Code 99 = Delete -->
        <input type='hidden' name='hidSubmitFlag' id='hidSubmitFlag' value='99' /><br /><br /> <!-- creates a hidden input field for the submit flag so the page knows it has been viewed. -->
        <input name="btnSubmit" type="submit" value="Delete Selected Employee" /> <!-- creates a submit button -->
    </fieldset> <!-- closes the fieldset -->
</form> <!-- closes the form -->
</div> <!-- creates a div with the class form-container for styling -->
</body> <!-- closes the body -->
</html> <!-- closes the html -->