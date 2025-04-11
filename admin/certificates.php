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

<table class="certificate-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Certificate Details</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while($record = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td class="center"><?php echo $record['id']; ?></td>
            <td>
                <strong><?php echo htmlentities($record['title']); ?></strong>
                <div class="organization"><?php echo htmlentities($record['organization']); ?></div>
                <?php if($record['url']): ?>
                <div class="certificate-url">
                    <a href="<?php echo htmlentities($record['url']); ?>" target="_blank">
                        <i class="fas fa-external-link-alt"></i> View Certificate
                    </a>
                </div>
                <?php endif; ?>
            </td>
            <td class="center"><?php echo date('F Y', strtotime($record['date'])); ?></td>
            <td class="actions">
                <a href="certificates_edit.php?id=<?php echo $record['id']; ?>" class="btn-edit">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="certificates.php?delete=<?php echo $record['id']; ?>" 
                   class="btn-delete"
                   onclick="return confirm('Are you sure you want to delete this certificate?');">
                    <i class="fas fa-trash-alt"></i> Delete
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<div class="action-buttons">
    <a href="certificates_add.php" class="btn-add">
        <i class="fas fa-plus-square"></i> Add Certificate
    </a>
</div>

<style>
    .certificate-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    
    .certificate-table thead tr {
        background-color: #6C63FF;
        color: #ffffff;
        text-align: left;
    }
    
    .certificate-table th,
    .certificate-table td {
        padding: 12px 15px;
    }
    
    .certificate-table tbody tr {
        border-bottom: 1px solid #dddddd;
    }
    
    .certificate-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }
    
    .certificate-table tbody tr:last-of-type {
        border-bottom: 2px solid #6C63FF;
    }
    
    .certificate-table tbody tr:hover {
        background-color: #f1f1f1;
    }
    
    .center {
        text-align: center;
    }
    
    .organization {
        color: #666;
        font-size: 0.9em;
        margin: 5px 0;
    }
    
    .certificate-url a {
        color: #6C63FF;
        text-decoration: none;
        font-size: 0.85em;
    }
    
    .certificate-url a:hover {
        text-decoration: underline;
    }
    
    .actions {
        display: flex;
        gap: 10px;
    }
    
    .btn-edit, .btn-delete, .btn-add {
        padding: 8px 12px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 0.85em;
        display: inline-flex;
        align-items: center;
        gap: 5px;
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
        padding: 10px 15px;
        margin-top: 20px;
    }
    
    .action-buttons {
        margin-top: 20px;
    }
</style>

<?php include('includes/footer.php'); ?>