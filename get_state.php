<?php
include_once('con.php');
if (!empty($_POST["country"])) {
    $country = $_POST["country"];
    $state = $_POST["state"];
    $query = "SELECT state FROM states WHERE country_id='$country'";
    $result = mysqli_query($con, $query);
    echo "<option>Select a state</option>";
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if(!isset($state)){
                echo "<option value='" . $row['state'] . "'>" . $row['state'] . "</option>";
            }else{
                echo "<option value='" . $row['state'] . "'" . ($row['state'] == $state ? ' selected="selected"' : '') . ">" . $row['state'] . "</option>";
            }
        }
    } else {
        echo "<option value=''>No states found</option>";
    }
}
?>
