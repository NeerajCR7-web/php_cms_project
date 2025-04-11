<?php
include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if(isset($_GET['delete'])) {
    $query = 'DELETE FROM users WHERE id = '.$_GET['delete'].' LIMIT 1';
    mysqli_query($connect, $query);
    set_message('User has been deleted');
    header('Location: users.php');
    die();
}

include('includes/header.php');

$query = 'SELECT * FROM users '.(($_SESSION['id'] != 1 && $_SESSION['id'] != 4) ? 'WHERE id = '.$_SESSION['id'].' ' : '').'ORDER BY last,first';
$result = mysqli_query($connect, $query);
?>

<h2>Manage Users</h2>

<table class="user-table">
    <tr>
        <th align="center">ID</th>
        <th align="center">Photo</th>
        <th align="left">Name</th>
        <th align="left">Email</th>
        <th align="center">Active</th>
        <th align="center">Actions</th>
    </tr>
    <?php while($record = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td align="center"><?php echo $record['id']; ?></td>
        <td align="center">
            <?php if(!empty($record['photo'])): ?>
                <img src="data:image/jpeg;base64,<?php echo base64_encode($record['photo']); ?>" class="user-photo">
            <?php else: ?>
                <i class="fas fa-user-circle user-icon"></i>
            <?php endif; ?>
        </td>
        <td align="left"><?php echo htmlentities($record['first'].' '.$record['last']); ?></td>
        <td align="left"><a href="mailto:<?php echo htmlentities($record['email']); ?>"><?php echo htmlentities($record['email']); ?></a></td>
        <td align="center"><?php echo $record['active']; ?></td>
        <td align="center" class="actions">
            <a href="users_edit.php?id=<?php echo $record['id']; ?>" class="btn-edit"><i class="fas fa-edit"></i></a>
            <?php if($_SESSION['id'] != $record['id']): ?>
                <a href="users.php?delete=<?php echo $record['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this user?');">
                    <i class="fas fa-trash-alt"></i>
                </a>
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<p><a href="users_add.php" class="btn-add"><i class="fas fa-plus-square"></i> Add User</a></p>

<style>
    .user-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }
    
    .user-table th, .user-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #ddd;
    }
    
    .user-table th {
        background-color: #6C63FF;
        color: white;
    }
    
    .user-photo {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #ddd;
    }
    
    .user-icon {
        font-size: 24px;
        color: #6C63FF;
    }
    
    .actions {
        display: flex;
        gap: 10px;
        justify-content: center;
    }
    
    .btn-edit, .btn-delete, .btn-add {
        padding: 8px 12px;
        border-radius: 4px;
        text-decoration: none;
    }
    
    .btn-edit {
        background-color: #4CAF50;
        color: white;
    }
    
    .btn-delete {
        background-color: #f44336;
        color: white;
    }
    
    .btn-add {
        background-color: #6C63FF;
        color: white;
        display: inline-block;
        margin-top: 20px;
        padding: 10px 15px;
    }
</style>

<?php include('includes/footer.php'); ?>