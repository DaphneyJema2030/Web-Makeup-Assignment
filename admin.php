<?php
require '../connect.php'; // adjust path as needed
session_start();

// Security: only allow Admins
if ($_SESSION['usertype'] !== 'admin') {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Authors</title>
    <style>
        table { border-collapse: collapse; width: 80%; margin: 20px auto; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #007bff; color: #fff; }
        .btn { padding: 6px 12px; text-decoration: none; border-radius: 4px; }
        .btn-update { background-color: #28a745; color: white; }
        .btn-delete { background-color: #dc3545; color: white; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Manage Authors</h2>
    <div style="text-align:center;">
        <a href="add_author.php" class="btn btn-update">+ Add New Author</a>
    </div>
    <br>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Fetch only authors
        $sql = "SELECT * FROM users WHERE UserType='author'";
        $result = mysqli_query($mysqli, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['userId']}</td>
                        <td>{$row['Full_Name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone_Number']}</td>
                        <td>{$row['User_Name']}</td>
                        <td>
                            <a href='update_author.php?updateid={$row['userId']}' class='btn btn-update'>Update</a>
                            <a href='delete_author.php?deleteid={$row['userId']}' class='btn btn-delete'>Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6' style='text-align:center;'>No authors found.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</body>
</html>
