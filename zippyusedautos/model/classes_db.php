<?php
// Classes database operations

function get_all_classes() {
    $db = get_db_connection();
    
    $query = "SELECT * FROM classes ORDER BY class_name";
    
    $statement = $db->prepare($query);
    $statement->execute();
    $classes = $statement->fetchAll();
    $statement->closeCursor();
    
    return $classes;
}

function get_class_by_id($class_id) {
    $db = get_db_connection();
    
    $query = "SELECT * FROM classes WHERE class_id = :class_id";
    
    $statement = $db->prepare($query);
    $statement->bindValue(':class_id', $class_id);
    $statement->execute();
    $class = $statement->fetch();
    $statement->closeCursor();
    
    return $class;
}

function add_class($class_name) {
    $db = get_db_connection();
    
    $query = "INSERT INTO classes (class_name) VALUES (:class_name)";
    
    $statement = $db->prepare($query);
    $statement->bindValue(':class_name', $class_name);
    $statement->execute();
    $statement->closeCursor();
}

function delete_class($class_id) {
    $db = get_db_connection();
    
    // Check if class is used by any vehicles
    $check_query = "SELECT COUNT(*) as count FROM vehicles WHERE class_id = :class_id";
    $check_stmt = $db->prepare($check_query);
    $check_stmt->bindValue(':class_id', $class_id);
    $check_stmt->execute();
    $result = $check_stmt->fetch();
    $check_stmt->closeCursor();
    
    if ($result['count'] > 0) {
        throw new Exception("Cannot delete class: It is being used by " . $result['count'] . " vehicle(s).");
    }
    
    $query = "DELETE FROM classes WHERE class_id = :class_id";
    
    $statement = $db->prepare($query);
    $statement->bindValue(':class_id', $class_id);
    $statement->execute();
    $statement->closeCursor();
}
?>
