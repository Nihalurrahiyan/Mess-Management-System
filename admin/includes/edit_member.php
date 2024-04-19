<?php
if (isset($_GET['mem_id'])) {
    $the_member = $_GET['mem_id'];
}
$query = "SELECT * FROM member WHERE mid='{$the_member}'";
$select_member = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($select_member)) {
    $db_username = $row['member_name'];
    $db_number = $row['mem_number'];
    $db_password = $row['mem_pass'];
    $db_role = $row['mem_role'];

}

if (isset($_POST['submit_reg']) && $_POST['randcheck'] == $_SESSION['rand']) {
    $uname = strtolower($_POST['username']);
    $mem_number = strtolower($_POST['number']);
    $upass = strtolower($_POST['password']);
    $urole = strtolower($_POST['userrole']);
    if (!empty($uname) && !empty($mem_number) && !empty($upass) && !empty($urole)) {


        $query = "UPDATE member SET ";
        $query .= "member_name = '{$uname}', ";
        $query .= "mem_number = '{$mem_number}', ";
        $query .= "mem_pass = '{$upass}', ";
        $query .= "mem_role = '{$urole}' ";
        $query .= "WHERE mid = {$the_member} ";

        $register_query = mysqli_query($connection, $query);
        if (!$register_query) {
            die('cannot connect' . mysqli_error($connection));
        } else {
            echo "<h6>Successfully Created</h6>";

        }
    } else {
        echo "<h6>Sorry Failed</h6>";

    }
}


?>


<!-- Page Content -->


<section id="login">
    <div class="">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">

                    <h3 style="text-align:center;padding-bottom:20px;">Edit Member</h3>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                        <?php
                        $rand = rand();
                        $_SESSION['rand'] = $rand;
                        ?>
                        <input type="hidden" name="randcheck" value="<?php echo $rand; ?>">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control"
                                value="<?php echo $db_username; ?>" placeholder="Enter Desired Username">
                        </div>
                        <div class="form-group">
                            <label for="number" class="sr-only">University Number</label>
                            <input type="text" name="number" value="<?php echo $db_number; ?>" id="number" class="form-control" placeholder="University Number eg:KMC20CS033">
                      
                            </div>
                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" value="<?php echo $db_password; ?>" id="key"
                                class="form-control" placeholder="Password">
                        </div>


                        <select class="form-control" name="userrole" id="exampleFormControlSelect1">
                            <?php

                            
                             if ($db_role = 'user'){
                                echo "<option value='user'>User</option>";
                                echo "<option value='admin'>admin</option>";

                            }else  {
                                echo "<option value='admin'>admin</option>";
                                echo "<option value='user'>User</option>";
                            }


                            ?>


                        </select>
                        <br>
                        <input type="submit" name="submit_reg" id="btn-login" class="btn btn-custom btn-lg btn-primary btn-block"
                            value="Update">
                    </form>
                    <br>

                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


<footer>
    <div class="container-fluid">
        <div class="author_content bg_secondary">
            <h5>&copy; 2023 Developed By Group N</h5>
        </div>
    </div>
</footer>