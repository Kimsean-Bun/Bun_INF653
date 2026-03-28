<?php
// Makes controller
require_once('../model/database.php');
require_once('../model/makes_db.php');

// Get action
$action = filter_input(INPUT_POST, 'action') ?? filter_input(INPUT_GET, 'action') ?? 'list_makes';

// Execute action
switch ($action) {
    case 'add_make':
        $make_name = filter_input(INPUT_POST, 'make_name');
        if ($make_name) {
            try {
                add_make($make_name);
                header('Location: makes.php?message=Make added successfully');
                exit();
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        } else {
            $error = "Make name is required!";
        }
        $makes = get_all_makes();
        include('../view/admin/makes_list.php');
        break;
        
    case 'delete_make':
        $make_id = filter_input(INPUT_POST, 'make_id', FILTER_VALIDATE_INT);
        if ($make_id) {
            try {
                delete_make($make_id);
                header('Location: makes.php?message=Make deleted successfully');
                exit();
            } catch (Exception $e) {
                $error = $e->getMessage();
                $makes = get_all_makes();
                include('../view/admin/makes_list.php');
            }
        }
        break;
        
    case 'list_makes':
    default:
        $makes = get_all_makes();
        $message = filter_input(INPUT_GET, 'message');
        include('../view/admin/makes_list.php');
        break;
}
?>
