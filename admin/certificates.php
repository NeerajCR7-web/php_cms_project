<?php
include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if(isset($_GET['delete'])) {
    $query = 'DELETE FROM certificates 
              WHERE id = '.$_GET['delete'].' 
              LIMIT 1';
    mysqli_query($connect, $query);
    
    set_message('Certificate has been deleted');
    header('Location: certificates.php');
    die();
}

include('includes/header.php');

$query = 'SELECT * FROM certificates ORDER BY date DESC';
$result = mysqli_query($connect, $query);
?>

<h2>Manage Certificates</h2>

<table>
    <tr>
        <th></th>
        <th align="center">ID</th>
        <th align="left">Title</th>
        <th align="left">Organization</th>
        <th align="center">Date</th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    <?php while($record = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td align="center">
            <img src="image.php?type=certificate&id=<?php echo $record['id']; ?>&width=100&height=100">
        </td>
        <td align="center"><?php echo $record['id']; ?></td>
        <td align="left"><?php echo htmlentities($record['title']); ?></td>
        <td align="left"><?php echo htmlentities($record['organization']); ?></td>
        <td align="center"><?php echo $record['date']; ?></td>
        <td align="center"><a href="certificates_photo.php?id=<?php echo $record['id']; ?>">Photo</a></td>
        <td align="center"><a href="certificates_edit.php?id=<?php echo $record['id']; ?>">Edit</a></td>
        <td align="center">
            <a href="certificates.php?delete=<?php echo $record['id']; ?>" 
               onclick="return confirm('Are you sure you want to delete this certificate?');">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<p><a href="certificates_add.php"><i class="fas fa-plus-square"></i> Add Certificate</a></p>

<?php include('includes/footer.php'); ?>