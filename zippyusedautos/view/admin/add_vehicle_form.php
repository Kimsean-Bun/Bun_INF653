<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vehicle | Zippy Used Autos Admin</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header class="admin-header">
        <div class="container">
            <h1>Zippy Admin Panel</h1>
            <p class="tagline">Add New Vehicle</p>
        </div>
    </header>

    <nav class="admin-nav">
        <div class="container">
            <ul>
                <li><a href="index.php">Manage Vehicles</a></li>
                <li><a href="add_vehicle.php" class="active">Add Vehicle</a></li>
                <li><a href="makes.php">Manage Makes</a></li>
                <li><a href="types.php">Manage Types</a></li>
                <li><a href="classes.php">Manage Classes</a></li>
            </ul>
        </div>
    </nav>

    <main class="container">
        <?php if (isset($error)): ?>
            <div class="message error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <h2>Add New Vehicle</h2>
        
        <form method="POST">
            <input type="hidden" name="action" value="add_vehicle">
            
            <div class="form-group">
                <label for="year">Year:</label>
                <input type="number" id="year" name="year" required min="1900" max="<?php echo date('Y') + 1; ?>">
            </div>
            
            <div class="form-group">
                <label for="model">Model:</label>
                <input type="text" id="model" name="model" required>
            </div>
            
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" required min="0">
            </div>
            
            <div class="form-group">
                <label for="make_id">Make:</label>
                <select id="make_id" name="make_id" required>
                    <option value="">-- Select Make --</option>
                    <?php foreach ($makes as $make): ?>
                        <option value="<?php echo $make['make_id']; ?>">
                            <?php echo htmlspecialchars($make['make_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="type_id">Type:</label>
                <select id="type_id" name="type_id" required>
                    <option value="">-- Select Type --</option>
                    <?php foreach ($types as $type): ?>
                        <option value="<?php echo $type['type_id']; ?>">
                            <?php echo htmlspecialchars($type['type_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="class_id">Class:</label>
                <select id="class_id" name="class_id" required>
                    <option value="">-- Select Class --</option>
                    <?php foreach ($classes as $class): ?>
                        <option value="<?php echo $class['class_id']; ?>">
                            <?php echo htmlspecialchars($class['class_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <button type="submit" class="btn btn-success">Add Vehicle</button>
            <a href="index.php" class="btn btn-primary">Cancel</a>
        </form>
    </main>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Zippy Used Autos - Admin Panel</p>
        </div>
    </footer>
</body>
</html>
