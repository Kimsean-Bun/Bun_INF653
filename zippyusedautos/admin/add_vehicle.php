<?php
// Add vehicle controller
require_once('../model/database.php');
require_once('../model/vehicles_db.php');
require_once('../model/makes_db.php');
require_once('../model/types_db.php');
require_once('../model/classes_db.php');

// Get action
$action = filter_input(INPUT_POST, 'action');

// Execute action
if ($action === 'add_vehicle') {
    $year = filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT);
    $model = filter_input(INPUT_POST, 'model');
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    $make_id = filter_input(INPUT_POST, 'make_id', FILTER_VALIDATE_INT);
    $type_id = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);
    $class_id = filter_input(INPUT_POST, 'class_id', FILTER_VALIDATE_INT);
    
    if ($year && $model && $price && $make_id && $type_id && $class_id) {
        add_vehicle($year, $model, $price, $make_id, $type_id, $class_id);
        header('Location: index.php?message=Vehicle added successfully');
        exit();
    } else {
        $error = "All fields are required!";
    }
}

// Get data for dropdowns
$makes = get_all_makes();
$types = get_all_types();
$classes = get_all_classes();

include('../view/admin/add_vehicle_form.php');
?>
