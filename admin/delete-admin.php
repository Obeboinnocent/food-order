<?php 
    // include constants
    include('../config/constants.php');

    // Getting id of the admin to be deleted
    echo $id = $_GET['id'];

    //SQL query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute the query
    $res = mysqli_query($conn, $sql);

    //Check whether the query is executed successfully or not
    if($res==true){
        //Query executed successfully and admin deleted successfully
        // echo "Admin deleted successfully";
        // Create session variable to display message 
        $_SESSION['delete'] = "<div class='success'>Admin deleted successfully</div>";
        //Redirect to manage admin page
        header("location:".SITEURL.'admin/manage-admin.php');
    }else{
        //Failed to delete admin
        // echo "Failed to delete admin";
        $_SESSION['delete'] = "<div class='error'>Failed to delete admin. Try again later</div>";
        //Redirect page to delete admin page
        header("location:".SITEURL.'admin/manage-admin.php');
    }

    //Redirect to Manage admin page with Message(Success/error)

?>
