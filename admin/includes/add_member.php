<?php include "../includes/config.php"; ?>
<?php

if (isset($_POST['submit_reg']) && $_POST['randcheck'] == $_SESSION['rand']) {
    $uname = strtolower($_POST['username']);
    $mem_number = strtolower($_POST['number']);
    $upass = strtolower($_POST['password']);
    
    if (!empty($uname) && !empty($mem_number) && !empty($upass)) {
        $upass = password_hash($upass, PASSWORD_BCRYPT, array('cost'=>10));
        $query = "INSERT INTO member(member_name,mem_number,mem_pass) ";
        $query .= "VALUES('{$uname}','{$mem_number}','{$upass}' ) ";
        $register_query = mysqli_query($connection, $query);
        if (!$register_query) {
            die('cannot connect' . mysqli_error($connection));
        } else {
            echo "<h6>Successfully Created</h6>";
            header('Location:members.php?source=add_member');
        }
    } else {
        echo "<h6>Sorry Failed</h6>";
        header('Location:members.php?source=add_member');
    }
}


?>


<!-- Page Content -->


<section id="login">
    <div class="">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">

                    <h3 style="text-align:Left;padding-bottom:20px;">Register New Member</h3>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                        <?php
                        $rand = rand();
                        $_SESSION['rand'] = $rand;
                        ?>
                        <input type="hidden" name="randcheck" value="<?php echo $rand; ?>">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control"
                                placeholder="Enter Desired Username">
                        </div>
                        <div class="form-group">
                            <label for="number" class="sr-only">University Number</label>
                            <input type="text" name="number" id="number" class="form-control"
                                placeholder="University Number eg:KMC20CS033">
                        </div>
                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>

                        <input type="submit" name="submit_reg" id="btn-login" class="btn btn-custom btn-lg btn-primary btn-block"
                            value="Register">
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
            <h5>&copy; 2023 Developed By Group 9</a></h5>
        </div>
    </div>
</footer>