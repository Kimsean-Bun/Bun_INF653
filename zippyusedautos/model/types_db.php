<?php
// Types database operations

function get_all_types() {
    $db = get_db_connection();
    
    $query = "SELECT * FROM types ORDER BY type_name";
    
    $statement = $db->prepare($query);
    $statement->execute();
    $types = $statement->fetchAll();
    $statement->closeCursor();
    
    return $types;
}

function get_type_by_id($type_id) {
    $db = get_db_connection();
    
    $query = "SELECT * FROM types WHERE type_id = :type_id";
    
    $statement = $db->prepare($query);
    $statement->bindValue(':type_id', $type_id);
    $statement->execute();
    $type = $statement->fetch();
    $statement->closeCursor();
    
    return $type;
}

function add_type($type_name) {
    $db = get_db_connection();
    
    $query = "INSERT INTO types (type_name) VALUES (:type_name)";
    
    $statement = $db->prepare($query);
    $statement->bindValue(':type_name', $type_name);
    $statement->execute();
    $statement->closeCursor();
}

function delete_type($type_id) {
    $db = get_db_connection();
    
    // Check if type is used by any vehicles
    $check_query = "SELECT COUNT(*) as count FROM vehicles WHERE type_id = :type_id";
    $check_stmt = $db->prepare($check_query);
    $check_stmt->bindValue(':type_id', $type_id);
    $check_stmt->execute();
    $result = $check_stmt->fetch();
    $check_stmt->closeCursor();
    
    if ($result['count'] > 0) {
        throw new Exception("Cannot delete type: It is being used by " . $result['count'] . " vehicle(s).");
    }
    
    $query = "DELETE FROM types WHERE type_id = :type_id";
    
    $statement = $db->prepare($query);
    $statement->bindValue(':type_id', $type_id);
    $statement->execute();
    $statement->closeCursor();
}
?>
