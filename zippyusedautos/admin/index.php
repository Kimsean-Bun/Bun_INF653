<?php
// Admin index controller
require_once('../model/database.php');
require_once('../model/vehicles_db.php');

// Get action
$action = filter_input(INPUT_POST, 'action') ?? filter_input(INPUT_GET, 'action') ?? 'list_vehicles';

// Execute action
switch ($action) {
    case 'delete_vehicle':
        $vehicle_id = filter_input(INPUT_POST, 'vehicle_id', FILTER_VALIDATE_INT);
        if ($vehicle_id) {
            delete_vehicle($vehicle_id);
            header('Location: index.php?message=Vehicle deleted successfully');
            exit();
        }
        break;
        
    case 'list_vehicles':
    default:
        $vehicles = get_all_vehicles('price');
        $message = filter_input(INPUT_GET, 'message');
        include('../view/admin/vehicle_admin_list.php');
        break;
}
?>
