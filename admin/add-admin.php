<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>

        <?php
if(isset($_SESSION['add'])) //checking whether the session is set or not
{
    echo $_SESSION['add']; //display the session message if set
    unset($_SESSION['add']); //remove session message
}
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" value="Add Admin" name="submit" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>


    </div>
</div>



<?php
include('partials/footer.php');
?>

<?php
//Process the value from Form and save it in database

//Check whether the submit button is clicked or nor

if (isset($_POST['submit'])) {
    // Button Clicked
    // echo "Button Clicked";

    //1. Get the data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // password encryption with MD5

    //2. SQL query to save the data into database
    $sql = "INSERT INTO tbl_admin SET
        full_name='$full_name',
        username='$username',
        password='$password'
    ";


    // 3. Executing query and saving data into database
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    //4. check wether the (query is executed) data is inserted or not and display appropriate message

    if ($res == TRUE) {
        //Data inserted
        //echo "Data inserted";
        //create a session variable to display message
        $_SESSION['add'] = "Admin added successfully";
        //redirect page to manage admin page
        header("location:" . SITEURL . 'admin/manage-admin.php');
    } else {
        //Failed to insert data
        //echo "Failed to insert data";
        //create a session variable to display message
        $_SESSION['add'] = "Failed to Add Admin";
        //redirect page to Add admin page
        header("location:" . SITEURL . 'admin/add-admin.php');
    }
}
?>