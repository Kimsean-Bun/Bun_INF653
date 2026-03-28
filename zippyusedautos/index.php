<?php
// Main public page controller
require_once('model/database.php');
require_once('model/vehicles_db.php');
require_once('model/makes_db.php');
require_once('model/types_db.php');
require_once('model/classes_db.php');

// Get action and parameters
$action = filter_input(INPUT_POST, 'action') ?? filter_input(INPUT_GET, 'action') ?? 'list_vehicles';
$sort_by = filter_input(INPUT_GET, 'sort') ?? 'price';
$filter_type = filter_input(INPUT_GET, 'filter_type');
$filter_value = filter_input(INPUT_GET, 'filter_value', FILTER_VALIDATE_INT);

// Execute action
switch ($action) {
    case 'list_vehicles':
    default:
        // Get all data for dropdowns
        $makes = get_all_makes();
        $types = get_all_types();
        $classes = get_all_classes();
        
        // Get vehicles with sorting and filtering
        $vehicles = get_all_vehicles($sort_by, $filter_type, $filter_value);
        
        // Include view
        include('view/vehicle_list.php');
        break;
}
?>
