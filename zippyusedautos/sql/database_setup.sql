-- Zippy Used Autos Database Setup
DROP DATABASE IF EXISTS zippyusedautos;
CREATE DATABASE zippyusedautos;
USE zippyusedautos;

-- Create makes table
CREATE TABLE makes (
    make_id INT AUTO_INCREMENT PRIMARY KEY,
    make_name VARCHAR(50) NOT NULL UNIQUE
);

-- Create types table
CREATE TABLE types (
    type_id INT AUTO_INCREMENT PRIMARY KEY,
    type_name VARCHAR(50) NOT NULL UNIQUE
);

-- Create classes table
CREATE TABLE classes (
    class_id INT AUTO_INCREMENT PRIMARY KEY,
    class_name VARCHAR(50) NOT NULL UNIQUE
);

-- Create vehicles table with foreign keys
CREATE TABLE vehicles (
    vehicle_id INT AUTO_INCREMENT PRIMARY KEY,
    year INT NOT NULL,
    model VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    make_id INT NOT NULL,
    type_id INT NOT NULL,
    class_id INT NOT NULL,
    FOREIGN KEY (make_id) REFERENCES makes(make_id) ON DELETE RESTRICT,
    FOREIGN KEY (type_id) REFERENCES types(type_id) ON DELETE RESTRICT,
    FOREIGN KEY (class_id) REFERENCES classes(class_id) ON DELETE RESTRICT
);

-- Insert makes data
INSERT INTO makes (make_id, make_name) VALUES
(1, 'Chevy'),
(2, 'Ford'),
(3, 'Cadillac'),
(4, 'Nissan'),
(5, 'Hyundai'),
(6, 'Dodge'),
(7, 'Infiniti'),
(8, 'Buick');

-- Insert types data
INSERT INTO types (type_id, type_name) VALUES
(1, 'SUV'),
(2, 'Truck'),
(3, 'Sedan'),
(4, 'Coupe');

-- Insert classes data
INSERT INTO classes (class_id, class_name) VALUES
(1, 'Utility'),
(2, 'Economy'),
(3, 'Luxury'),
(4, 'Sports');

-- Insert vehicles data
INSERT INTO vehicles (year, model, price, make_id, type_id, class_id) VALUES
(2009, 'Suburban', 18999.00, 1, 1, 1),
(2011, 'F150', 22999.00, 2, 2, 1),
(2012, 'Escalade', 24999.00, 3, 1, 3),
(2018, 'Rogue', 34999.00, 4, 1, 2),
(2016, 'Sonata', 29999.00, 5, 3, 2),
(2020, 'Challenger', 49999.00, 6, 4, 4),
(2015, 'Tahoe', 26999.00, 1, 1, 1),
(2017, 'QX80', 54999.00, 7, 1, 3),
(2015, 'Fusion', 19999.00, 2, 3, 2),
(2014, 'XTS', 19999.00, 3, 3, 3);
