<?php
// admin/skills.php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (isset($_GET['delete'])) {
    $query = 'DELETE FROM skills WHERE id = ' . $_GET['delete'] . ' LIMIT 1';
    mysqli_query($connect, $query);

    set_message('Skill has been deleted');
    header('Location: skills.php');
    die();
}

include('includes/header.php');

$query  = 'SELECT * FROM skills ORDER BY name DESC';
$result = mysqli_query($connect, $query);
?>

<h2>Manage Skills</h2>

<table class="skills-table">
    <thead>
        <tr>
            <th>Logo</th>
            <th class="center">ID</th>
            <th>Name &amp; URL</th>
            <th class="center">Percent</th>
            <th class="center">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($record = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td class="center">
                <?php if (!empty($record['logo_url'])): ?>
                    <img src="<?= htmlentities($record['logo_url']) ?>" class="skill-logo">
                <?php endif; ?>
            </td>
            <td class="center"><?= $record['id'] ?></td>
            <td>
                <strong><?= htmlentities($record['name']) ?></strong><br>
                <small>
                  <a href="<?= htmlentities($record['url']) ?>" target="_blank">
                    <?= htmlentities($record['url']) ?>
                  </a>
                </small>
            </td>
            <td class="center"><?= $record['percent'] ?>%</td>
            <td class="actions">
                <a href="skills_edit.php?id=<?= $record['id'] ?>" class="btn-edit">
                  <i class="fas fa-edit"></i>
                </a>
                <a href="skills.php?delete=<?= $record['id'] ?>"
                   class="btn-delete"
                   onclick="return confirm('Are you sure you want to delete this skill?');">
                  <i class="fas fa-trash-alt"></i>
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<div class="add-skill">
    <a href="skills_add.php" class="btn-add">
      <i class="fas fa-plus-square"></i> Add Skill
    </a>
</div>

<style>
/* === Skills table styling, matching Projects & Certificates === */
.skills-table {
  width: 100%;
  border-collapse: collapse;
  margin: 20px 0;
  font-size: 0.9em;
  box-shadow: 0 0 20px rgba(0,0,0,0.1);
}

.skills-table thead tr {
  background-color: #6C63FF;
  color: #ffffff;
  text-align: left;
}

.skills-table th,
.skills-table td {
  padding: 12px 15px;
  vertical-align: middle;
}

.skills-table tbody tr {
  border-bottom: 1px solid #dddddd;
}

.skills-table tbody tr:nth-of-type(even) {
  background-color: #f3f3f3;
}

.skills-table tbody tr:last-of-type {
  border-bottom: 2px solid #6C63FF;
}

.skills-table tbody tr:hover {
  background-color: #f1f1f1;
}

.center {
  text-align: center;
}

.skill-logo {
  width: 100px;
  height: 100px;
  object-fit: contain;
  border-radius: 4px;
  border: 1px solid #ddd;
}

.actions {
  display: flex;
  gap: 10px;
  justify-content: center;
}

.btn-edit,
.btn-delete,
.btn-add {
  padding: 8px 12px;
  border-radius: 4px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
}

.btn-edit {
  background-color: #2196F3;
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

.add-skill {
  margin-top: 20px;
}
</style>

<?php include('includes/footer.php'); ?>
