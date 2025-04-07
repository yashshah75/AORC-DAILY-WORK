<?php 
    require_once('database/db.php'); 
    $uid = $_GET['id'];
?>

<form method="POST">
    <p>Are you sure you want to proceed?</p>
        <button type="submit" name="confirm">Yes</button>
        <button type="submit" name="cancel">No</button>
</form>
<?php

    if(isset($_POST['confirm']))
    {
        $query = "DELETE FROM post WHERE ID='$uid'";

        $data = mysqli_query($conn, $query);
        
        if($data)
        {
            
            echo "DELETED";
            header('location:allpost.php');
        }
        else{
            echo "Failed to deleted";
        }
}
?>

</body>
</html>
