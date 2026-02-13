<?php
include "components/pdo.php";

$sql = "SELECT * FROM users";
$stmt = $pdo->query($sql);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>View Users</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="h4 mb-0">Users</h1>
      <div>
        <a href="add.php" class="btn btn-primary">Add User</a>
        <?php if (count($users) > 0): ?>
          <button class="btn btn-danger" onclick="confirmDeleteAll()">Delete All</button>
        <?php endif; ?>
      </div>
    </div>

    <?php if (isset($_GET["deleted"]) && $_GET["deleted"] == 1): ?>
      <div class="alert alert-success alert-dismissible fade show">
        User deleted successfully!
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>

    <?php if (isset($_GET["deleted_all"]) && $_GET["deleted_all"] == 1): ?>
      <div class="alert alert-success alert-dismissible fade show">
        All users deleted successfully!
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>

    <?php if (isset($_GET["updated"]) && $_GET["updated"] == 1): ?>
      <div class="alert alert-success alert-dismissible fade show">
        User updated successfully!
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>

    <div class="card shadow-sm">
      <div class="card-body">
        <?php if (count($users) > 0): ?>
          <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">First Name</th>
                  <th scope="col">Last Name</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($users as $user): ?>
                  <tr>
                    <td><?php echo htmlspecialchars((string) $user["id"], ENT_QUOTES, "UTF-8"); ?></td>
                    <td><?php echo htmlspecialchars($user["firstname"], ENT_QUOTES, "UTF-8"); ?></td>
                    <td><?php echo htmlspecialchars($user["lastname"], ENT_QUOTES, "UTF-8"); ?></td>
                    <td>
                      <a href="update.php?id=<?php echo $user["id"]; ?>" class="btn btn-sm btn-warning">Edit</a>
                      <button onclick="confirmDelete(<?php echo $user['id']; ?>)" class="btn btn-sm btn-danger">Delete</button>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php else: ?>
          <p class="text-muted mb-0">No users found. Add your first user.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function confirmDelete(userId) {
      if (confirm('Are you sure you want to delete this user?')) {
        window.location.href = 'delete.php?id=' + userId;
      }
    }

    function confirmDeleteAll() {
      if (confirm('Are you sure you want to delete ALL users? This cannot be undone!')) {
        window.location.href = 'delete.php?delete_all=1';
      }
    }
  </script>
</body>
</html>