<?php
session_start();
include 'controller/db.php'; // Adjust path as necessary

// Check if user is logged in
if (!isset($_SESSION['User'])) {
    header('Location: index.php');
    exit();
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_compliance'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $query = "INSERT INTO compliance_records (title, description) VALUES (?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$title, $description]);
    } elseif (isset($_POST['edit_compliance'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $query = "UPDATE compliance_records SET title = ?, description = ? WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$title, $description, $id]);
    } elseif (isset($_POST['delete_compliance'])) {
        $id = $_POST['id'];
        $query = "DELETE FROM compliance_records WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
    }
}

// Fetch compliance records
$query = "SELECT * FROM compliance_records";
$stmt = $pdo->query($query);
$compliance_records = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'header.php'; ?>

<!-- Main content starts here -->
<div class="agile-grids">
    <div class="container">
        <h2>Add Compliance Record</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>
            <button type="submit" name="add_compliance" class="btn btn-primary">Add Compliance</button>
        </form>
    </div>
    <div class="container" id="edit-form" style="display: none;">
        <h2>Edit Compliance Record</h2>
        <form method="POST" action="">
            <input type="hidden" id="edit_id" name="id">
            <div class="form-group">
                <label for="edit_title">Title:</label>
                <input type="text" class="form-control" id="edit_title" name="title" required>
            </div>
            <div class="form-group">
                <label for="edit_description">Description:</label>
                <textarea class="form-control" id="edit_description" name="description" rows="4" required></textarea>
            </div>
            <button type="submit" name="edit_compliance" class="btn btn-primary">Update Compliance</button>
        </form>
    </div>
    <div class="container">
        <h2>Compliance Records</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($compliance_records as $record): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($record['id']); ?></td>
                        <td><?php echo htmlspecialchars($record['title']); ?></td>
                        <td><?php echo htmlspecialchars($record['description']); ?></td>
                        <td>
                            <button class="btn btn-info btn-edit" data-id="<?php echo htmlspecialchars($record['id']); ?>" data-title="<?php echo htmlspecialchars($record['title']); ?>" data-description="<?php echo htmlspecialchars($record['description']); ?>">Edit</button>
                            <form method="POST" action="" style="display: inline;">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($record['id']); ?>">
                                <button type="submit" name="delete_compliance" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Main content ends here -->

<?php include 'footer.php'; ?>
