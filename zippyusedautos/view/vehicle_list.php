<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zippy Used Autos - Quality Pre-Owned Vehicles</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Zippy Used Autos</h1>
            <p class="tagline">Your Trusted Source for Quality Pre-Owned Vehicles</p>
        </div>
    </header>

    <main class="container">
        <div class="controls">
            <div class="control-group">
                <label for="sort">Sort by:</label>
                <select id="sort" onchange="updateSort(this.value)">
                    <option value="price" <?php if ($sort_by === 'price') echo 'selected'; ?>>Price (High to Low)</option>
                    <option value="year" <?php if ($sort_by === 'year') echo 'selected'; ?>>Year (Newest First)</option>
                </select>
            </div>

            <div class="control-group">
                <label for="filter">Filter by:</label>
                <select id="filter" onchange="updateFilter(this.value)">
                    <option value="">All Vehicles</option>
                    <option value="make" <?php if ($filter_type === 'make') echo 'selected'; ?>>Make</option>
                    <option value="type" <?php if ($filter_type === 'type') echo 'selected'; ?>>Type</option>
                    <option value="class" <?php if ($filter_type === 'class') echo 'selected'; ?>>Class</option>
                </select>
            </div>

            <!-- Dynamic filter dropdown -->
            <?php if ($filter_type === 'make'): ?>
                <div class="control-group" id="filter-options">
                    <label for="filter-value">Select Make:</label>
                    <select id="filter-value" onchange="applyFilter('make', this.value)">
                        <option value="">All Makes</option>
                        <?php foreach ($makes as $make): ?>
                            <option value="<?php echo $make['make_id']; ?>" 
                                <?php if ($filter_value == $make['make_id']) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($make['make_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php elseif ($filter_type === 'type'): ?>
                <div class="control-group" id="filter-options">
                    <label for="filter-value">Select Type:</label>
                    <select id="filter-value" onchange="applyFilter('type', this.value)">
                        <option value="">All Types</option>
                        <?php foreach ($types as $type): ?>
                            <option value="<?php echo $type['type_id']; ?>" 
                                <?php if ($filter_value == $type['type_id']) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($type['type_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php elseif ($filter_type === 'class'): ?>
                <div class="control-group" id="filter-options">
                    <label for="filter-value">Select Class:</label>
                    <select id="filter-value" onchange="applyFilter('class', this.value)">
                        <option value="">All Classes</option>
                        <?php foreach ($classes as $class): ?>
                            <option value="<?php echo $class['class_id']; ?>" 
                                <?php if ($filter_value == $class['class_id']) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($class['class_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>
        </div>

        <div class="vehicle-count">
            Showing <?php echo count($vehicles); ?> vehicle<?php echo count($vehicles) != 1 ? 's' : ''; ?>
        </div>

        <div class="vehicle-grid">
            <?php if (empty($vehicles)): ?>
                <p class="no-vehicles">No vehicles found matching your criteria.</p>
            <?php else: ?>
                <?php foreach ($vehicles as $vehicle): ?>
                    <div class="vehicle-card">
                        <div class="vehicle-header">
                            <h2><?php echo htmlspecialchars($vehicle['year'] . ' ' . $vehicle['make_name'] . ' ' . $vehicle['model']); ?></h2>
                        </div>
                        <div class="vehicle-details">
                            <div class="detail-row">
                                <span class="label">Type:</span>
                                <span class="value"><?php echo htmlspecialchars($vehicle['type_name']); ?></span>
                            </div>
                            <div class="detail-row">
                                <span class="label">Class:</span>
                                <span class="value"><?php echo htmlspecialchars($vehicle['class_name']); ?></span>
                            </div>
                            <div class="detail-row">
                                <span class="label">Year:</span>
                                <span class="value"><?php echo htmlspecialchars($vehicle['year']); ?></span>
                            </div>
                        </div>
                        <div class="vehicle-price">
                            $<?php echo number_format($vehicle['price'], 2); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Zippy Used Autos. All rights reserved.</p>
        </div>
    </footer>

    <script>
        function updateSort(sortValue) {
            const url = new URL(window.location.href);
            url.searchParams.set('sort', sortValue);
            window.location.href = url.toString();
        }

        function updateFilter(filterType) {
            if (filterType === '') {
                window.location.href = 'index.php';
            } else {
                const url = new URL(window.location.href);
                url.searchParams.set('filter_type', filterType);
                url.searchParams.delete('filter_value');
                window.location.href = url.toString();
            }
        }

        function applyFilter(filterType, filterValue) {
            if (filterValue === '') {
                const url = new URL(window.location.href);
                url.searchParams.delete('filter_value');
                window.location.href = url.toString();
            } else {
                const url = new URL(window.location.href);
                url.searchParams.set('filter_type', filterType);
                url.searchParams.set('filter_value', filterValue);
                window.location.href = url.toString();
            }
        }
    </script>
</body>
</html>
