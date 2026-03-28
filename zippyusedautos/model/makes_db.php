<?php
// Makes database operations

function get_all_makes() {
    $db = get_db_connection();
    
    $query = "SELECT * FROM makes ORDER BY make_name";
    
    $statement = $db->prepare($query);
    $statement->execute();
    $makes = $statement->fetchAll();
    $statement->closeCursor();
    
    return $makes;
}

function get_make_by_id($make_id) {
    $db = get_db_connection();
    
    $query = "SELECT * FROM makes WHERE make_id = :make_id";
    
    $statement = $db->prepare($query);
    $statement->bindValue(':make_id', $make_id);
    $statement->execute();
    $make = $statement->fetch();
    $statement->closeCursor();
    
    return $make;
}

function add_make($make_name) {
    $db = get_db_connection();
    
    $query = "INSERT INTO makes (make_name) VALUES (:make_name)";
    
    $statement = $db->prepare($query);
    $statement->bindValue(':make_name', $make_name);
    $statement->execute();
    $statement->closeCursor();
}

function delete_make($make_id) {
    $db = get_db_connection();
    
    // Check if make is used by any vehicles
    $check_query = "SELECT COUNT(*) as count FROM vehicles WHERE make_id = :make_id";
    $check_stmt = $db->prepare($check_query);
    $check_stmt->bindValue(':make_id', $make_id);
    $check_stmt->execute();
    $result = $check_stmt->fetch();
    $check_stmt->closeCursor();
    
    if ($result['count'] > 0) {
        throw new Exception("Cannot delete make: It is being used by " . $result['count'] . " vehicle(s).");
    }
    
    $query = "DELETE FROM makes WHERE make_id = :make_id";
    
    $statement = $db->prepare($query);
    $statement->bindValue(':make_id', $make_id);
    $statement->execute();
    $statement->closeCursor();
}
?>
