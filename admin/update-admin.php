<?php
    include('partials/menu.php');
?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Admin</h1>
            <br>

            <?php
                //Get id of the seleted admin
                $id=$_GET['id'];
                //Select SQL Query to get the details
                $sql="SELECT * FROM tbl_admin WHERE id=$id";
                //Execute the query
                $res=mysqli_query($conn, $sql);
                // Check whether the query is executed
                if($res==true){
                    //Check whether the data is available or not
                    $count= mysqli_num_rows($res);
                    //Check whether we have admin data or not
                    if($count==1){
                        //Get the details
                        // echo "Admin available"
                        $row=mysqli_fetch_assoc($res);
                        $fullname = $row['full_name'];
                        $username = $row['username'];
                    }else{
                        //Redirect to manage admin page
                        header('loaction:'.SITEURL.'admin/manage-admin.php');
                    }
                }
            ?>

            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name: </td>
                        <td>
                            <input type="text" name="full_name" value="<?php echo $fullname; ?>" class="enter">
                        </td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td>
                            <input type="text" name="username" value="<?php echo $username; ?>" class="enter">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <input type="submit" name="submit" value="Update Admin" class="btn-submit btn-secondary">
                        </td>
                    </tr>
                    
                </table>
            </form>
        </div>
    </div>

<?php

    //Check whether the submit button is clicked or not 
    if(isset($_POST['submit'])){
        // echo "Button Clicked";
        //Get all the values from form to update
        $id = $_POST['id'];
        $fullname = $_POST['full_name'];
        $username = $_POST['username'];

        //Create sql query to update admin
        $sql = "UPDATE tbl_admin SET
        full_name = '$fullname',
        username = '$username' 
        WHERE id=$id
        ";

        //Execute the query

        $res = mysqli_query($conn,$sql);
        //Check whether the code is executed successfully
        if($res==true){
            //Query executed and admin updated 
            $_SESSION['update'] = "<div class='success'>Admin updated successfully!!</div>";
            //Redirect to  Manage admin page 
            header('location:'.SITEURL.'admin/manage-admin.php');
        }else{
            //Failed to update admin
            $_SESSION['update'] = "<div class='error'>Failed to update admin!!</div>";
            //Redirect to  Manage admin page 
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
?>


<?php
    include('partials/footer.php');
?>