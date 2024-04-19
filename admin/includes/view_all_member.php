<br>
<br>
<table class="table table-bordered table-hover">
    <thead>
        <th>
            Name
        </th>
        <th>
            Member ID
        </th>
        <th>
            Member University Number
        </th>
        <th>
            Member Role
        </th>
        <?php
        if (isset($_SESSION['mem_role'])) {
            $mem_role = $_SESSION['mem_role'];
            if ($mem_role == 'admin') {
                ?>

                <th>
                    Delete
                </th>
                <th>
                    Edit
                </th>

            <?php
            }
        }
        ?>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM member";
        $select_member = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_member)) {
            echo "<tr>";
            echo "<td>" . $row['member_name'] . "</td>";
            echo "<td>" . $row['mid'] . "</td>";
            echo "<td>" . $row['mem_number'] . "</td>";
            echo "<td>" . $row['mem_role'] . "</td>";
            if (isset($_SESSION['mem_role'])) {
                $mem_role = $_SESSION['mem_role'];
                if ($mem_role == 'admin') {
                    ?>

                    <td><a onClick="return confirm('are you sure want to delete?');"
                            href="members.php?delete=<?php echo $row['mid']; ?>">Delete</a></td>
                    <td><a href="members.php?source=edit_member&mem_id=<?php echo $row['mid']; ?>">Edit</a></td>

                <?php
                }
            }
            echo "</tr>";
        }
        ?>
        <?php
        if (isset($_GET['delete'])) {
            $the_post_id = $_GET['delete'];
            $query = "DELETE FROM member WHERE mid = {$the_post_id} ";
            $delete_query = mysqli_query($connection, $query);
            confirmQuery($delete_query);
            header("Location: members.php");
        }

        ?>
    </tbody>
</table>


<footer>
    <div class="container-fluid">
        <div class="author_content bg_secondary">
            <h5>&copy; 2023 Developed By Group N</h5>
        </div>
    </div>
</footer>