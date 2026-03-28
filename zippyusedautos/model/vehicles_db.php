<?php
// Vehicle database operations

function get_all_vehicles($sort_by = 'price', $filter_type = null, $filter_value = null) {
    $db = get_db_connection();
    
    $query = "SELECT v.*, m.make_name, t.type_name, c.class_name 
              FROM vehicles v
              JOIN makes m ON v.make_id = m.make_id
              JOIN types t ON v.type_id = t.type_id
              JOIN classes c ON v.class_id = c.class_id";
    
    // Add filter if specified
    if ($filter_type && $filter_value) {
        switch ($filter_type) {
            case 'make':
                $query .= " WHERE v.make_id = :filter_value";
                break;
            case 'type':
                $query .= " WHERE v.type_id = :filter_value";
                break;
            case 'class':
                $query .= " WHERE v.class_id = :filter_value";
                break;
        }
    }
    
    // Add sorting
    switch ($sort_by) {
        case 'year':
            $query .= " ORDER BY v.year DESC";
            break;
        case 'price':
        default:
            $query .= " ORDER BY v.price DESC";
            break;
    }
    
    $statement = $db->prepare($query);
    
    if ($filter_type && $filter_value) {
        $statement->bindValue(':filter_value', $filter_value);
    }
    
    $statement->execute();
    $vehicles = $statement->fetchAll();
    $statement->closeCursor();
    
    return $vehicles;
}

function get_vehicle_by_id($vehicle_id) {
    $db = get_db_connection();
    
    $query = "SELECT v.*, m.make_name, t.type_name, c.class_name 
              FROM vehicles v
              JOIN makes m ON v.make_id = m.make_id
              JOIN types t ON v.type_id = t.type_id
              JOIN classes c ON v.class_id = c.class_id
              WHERE v.vehicle_id = :vehicle_id";
    
    $statement = $db->prepare($query);
    $statement->bindValue(':vehicle_id', $vehicle_id);
    $statement->execute();
    $vehicle = $statement->fetch();
    $statement->closeCursor();
    
    return $vehicle;
}

function add_vehicle($year, $model, $price, $make_id, $type_id, $class_id) {
    $db = get_db_connection();
    
    $query = "INSERT INTO vehicles (year, model, price, make_id, type_id, class_id) 
              VALUES (:year, :model, :price, :make_id, :type_id, :class_id)";
    
    $statement = $db->prepare($query);
    $statement->bindValue(':year', $year);
    $statement->bindValue(':model', $model);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':make_id', $make_id);
    $statement->bindValue(':type_id', $type_id);
    $statement->bindValue(':class_id', $class_id);
    $statement->execute();
    $statement->closeCursor();
}

function delete_vehicle($vehicle_id) {
    $db = get_db_connection();
    
    $query = "DELETE FROM vehicles WHERE vehicle_id = :vehicle_id";
    
    $statement = $db->prepare($query);
    $statement->bindValue(':vehicle_id', $vehicle_id);
    $statement->execute();
    $statement->closeCursor();
}
?>
