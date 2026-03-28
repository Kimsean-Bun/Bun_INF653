<?php
// Classes controller
require_once('../model/database.php');
require_once('../model/classes_db.php');

// Get action
$action = filter_input(INPUT_POST, 'action') ?? filter_input(INPUT_GET, 'action') ?? 'list_classes';

// Execute action
switch ($action) {
    case 'add_class':
        $class_name = filter_input(INPUT_POST, 'class_name');
        if ($class_name) {
            try {
                add_class($class_name);
                header('Location: classes.php?message=Class added successfully');
                exit();
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        } else {
            $error = "Class name is required!";
        }
        $classes = get_all_classes();
        include('../view/admin/classes_list.php');
        break;
        
    case 'delete_class':
        $class_id = filter_input(INPUT_POST, 'class_id', FILTER_VALIDATE_INT);
        if ($class_id) {
            try {
                delete_class($class_id);
                header('Location: classes.php?message=Class deleted successfully');
                exit();
            } catch (Exception $e) {
                $error = $e->getMessage();
                $classes = get_all_classes();
                include('../view/admin/classes_list.php');
            }
        }
        break;
        
    case 'list_classes':
    default:
        $classes = get_all_classes();
        $message = filter_input(INPUT_GET, 'message');
        include('../view/admin/classes_list.php');
        break;
}
?>
