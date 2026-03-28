<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Types | Zippy Used Autos Admin</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header class="admin-header">
        <div class="container">
            <h1>Zippy Admin Panel</h1>
            <p class="tagline">Manage Types</p>
        </div>
    </header>

    <nav class="admin-nav">
        <div class="container">
            <ul>
                <li><a href="index.php">Manage Vehicles</a></li>
                <li><a href="add_vehicle.php">Add Vehicle</a></li>
                <li><a href="makes.php">Manage Makes</a></li>
                <li><a href="types.php" class="active">Manage Types</a></li>
                <li><a href="classes.php">Manage Classes</a></li>
            </ul>
        </div>
    </nav>

    <main class="container">
        <?php if (isset($message)): ?>
            <div class="message success"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        
        <?php if (isset($error)): ?>
            <div class="message error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <h2>Add New Type</h2>
        <form method="POST">
            <input type="hidden" name="action" value="add_type">
            <div class="form-group">
                <label for="type_name">Type Name:</label>
                <input type="text" id="type_name" name="type_name" required>
            </div>
            <button type="submit" class="btn btn-success">Add Type</button>
        </form>

        <h2 style="margin-top: 2rem;">All Types</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($types as $type): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($type['type_id']); ?></td>
                        <td><?php echo htmlspecialchars($type['type_name']); ?></td>
                        <td>
                            <form method="POST" style="display: inline;" 
                                  onsubmit="return confirm('Are you sure you want to delete this type?');">
                                <input type="hidden" name="action" value="delete_type">
                                <input type="hidden" name="type_id" value="<?php echo $type['type_id']; ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Zippy Used Autos - Admin Panel</p>
        </div>
    </footer>
</body>
</html>
