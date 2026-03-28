<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Vehicles | Zippy Used Autos</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header class="admin-header">
        <div class="container">
            <h1>Zippy Admin Panel</h1>
            <p class="tagline">Vehicle Management</p>
        </div>
    </header>

    <nav class="admin-nav">
        <div class="container">
            <ul>
                <li><a href="index.php" class="active">Manage Vehicles</a></li>
                <li><a href="add_vehicle.php">Add Vehicle</a></li>
                <li><a href="makes.php">Manage Makes</a></li>
                <li><a href="types.php">Manage Types</a></li>
                <li><a href="classes.php">Manage Classes</a></li>
            </ul>
        </div>
    </nav>

    <main class="container">
        <?php if (isset($message)): ?>
            <div class="message success"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <h2>All Vehicles</h2>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Year</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Type</th>
                    <th>Class</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vehicles as $vehicle): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($vehicle['vehicle_id']); ?></td>
                        <td><?php echo htmlspecialchars($vehicle['year']); ?></td>
                        <td><?php echo htmlspecialchars($vehicle['make_name']); ?></td>
                        <td><?php echo htmlspecialchars($vehicle['model']); ?></td>
                        <td><?php echo htmlspecialchars($vehicle['type_name']); ?></td>
                        <td><?php echo htmlspecialchars($vehicle['class_name']); ?></td>
                        <td>$<?php echo number_format($vehicle['price'], 2); ?></td>
                        <td>
                            <form method="POST" style="display: inline;" 
                                  onsubmit="return confirm('Are you sure you want to delete this vehicle?');">
                                <input type="hidden" name="action" value="delete_vehicle">
                                <input type="hidden" name="vehicle_id" value="<?php echo $vehicle['vehicle_id']; ?>">
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
