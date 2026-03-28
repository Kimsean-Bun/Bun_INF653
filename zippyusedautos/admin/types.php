<?php
// Types controller
require_once('../model/database.php');
require_once('../model/types_db.php');

// Get action
$action = filter_input(INPUT_POST, 'action') ?? filter_input(INPUT_GET, 'action') ?? 'list_types';

// Execute action
switch ($action) {
    case 'add_type':
        $type_name = filter_input(INPUT_POST, 'type_name');
        if ($type_name) {
            try {
                add_type($type_name);
                header('Location: types.php?message=Type added successfully');
                exit();
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        } else {
            $error = "Type name is required!";
        }
        $types = get_all_types();
        include('../view/admin/types_list.php');
        break;
        
    case 'delete_type':
        $type_id = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);
        if ($type_id) {
            try {
                delete_type($type_id);
                header('Location: types.php?message=Type deleted successfully');
                exit();
            } catch (Exception $e) {
                $error = $e->getMessage();
                $types = get_all_types();
                include('../view/admin/types_list.php');
            }
        }
        break;
        
    case 'list_types':
    default:
        $types = get_all_types();
        $message = filter_input(INPUT_GET, 'message');
        include('../view/admin/types_list.php');
        break;
}
?>
