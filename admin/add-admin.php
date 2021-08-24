<?php
include("partials/menu.php");
?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Admin</h1>
            <br>

            <?php
                if(isset($_SESSION['add'])){  //Checking whether the session is set or not
                    echo $_SESSION['add'];  //Displaying session message
                    unset($_SESSION['add']);    //Removing session message
                }
            ?>
            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name: </td>
                        <td><input type="text" name="full_name" placeholder="Enter full name" class="enter"></td>
                    </tr>

                    <tr>
                        <td>Username: </td>
                        <td>
                            <input type="text" name="username" placeholder="Enter username" class="enter">
                        </td>
                    </tr>

                    <tr>
                        <td>Password</td>
                        <td>
                            <input type="password" name="password" placeholder="Enter password" class="enter">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add admin" class="btn-submit btn-secondary">
                        </td>
                    </tr>

                    
                </table>
                
            </form>
        </div>
    </div>

<?php
    include("partials/footer.php"); 
?>

<?php
    //Process the value and save it in database
    // Check whether the button is clicked or not
    if(isset($_POST['submit']))
    {
        //Button clicked
        // echo "Button clicked";

        //1. Get data from the form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //Password encryption with md5

        //2. SQL to save data to database
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";

        
        // 3. executing query and saving data to database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // 4. Check whether the data has been saved or not and display appropriate message
        if($res==TRUE)
        {
            // Data is inserted
            // echo "Data inserted";
            //Create a session variable to display message
            $_SESSION['add'] = "<div class='success'>Admin added successfully</div>";
            //Redirect page 
            header("location:".SITEURL.'admin/manage-admin.php');
        } 
        else
        {
            // Failed to insert data 
            // echo "Failed to insert data";
            //Create a session variable to display message
            $_SESSION['add'] = "<div class='error'>Failed to add admin</div>";
            //Redirect page to add admin
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }
?>