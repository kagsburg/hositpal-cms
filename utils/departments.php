<?php 

function get_department_sections(PDO $conn, $department_id)
{
    $stmt = $conn->prepare("SELECT * FROM department_sections WHERE department_id=? AND status=1 ORDER BY section_name ASC");
    $stmt->execute([$department_id]);
    $getallsections = $stmt->fetchAll();
    return $getallsections;
}

function get_department(PDO $conn, $department_id)
{
    $stmt = $conn->prepare("SELECT * FROM departments WHERE department_id=? AND status=1");
    $stmt->execute([$department_id]);
    $getdepartment = $stmt->fetch();
    return $getdepartment;
}

// BREAD / CRUD 
function get_all_sections(PDO $conn)
{
    $stmt = $conn->prepare("SELECT * FROM department_sections WHERE status=1 ORDER BY section_name ASC");
    $stmt->execute();
    $getallsections = $stmt->fetchAll();
    return $getallsections;
}

function get_section_by_id(PDO $conn, $section_id)
{
    $stmt = $conn->prepare("SELECT * FROM department_sections WHERE section_id=? AND status=1");
    $stmt->execute([$section_id]);
    $getsection = $stmt->fetch();
    return $getsection;
}

function create_section(PDO $conn, $section_name, $department_id)
{
    $stmt = $conn->prepare("INSERT INTO department_sections (section_name, department_id) VALUES (?, ?)");
    $stmt->execute([$section_name, $department_id]);
    return $conn->lastInsertId();
}

function section_exists(PDO $conn, $section_name, $department_id)
{
    $stmt = $conn->prepare("SELECT * FROM department_sections WHERE section_name=? AND department_id=? AND status=1");
    $stmt->execute([$section_name, $department_id]);
    $getsection = $stmt->fetch();
    return $getsection ? true : false;
}

function update_section(PDO $conn, $section_id, $section_name)
{
    $stmt = $conn->prepare("UPDATE department_sections SET section_name=? WHERE section_id=?");
    $stmt->execute([$section_name, $section_id]);
    return $stmt->rowCount();
}

function deactivate_section(PDO $conn, $section_id)
{
    $stmt = $conn->prepare("UPDATE department_sections SET status=0 WHERE section_id=?");
    $stmt->execute([$section_id]);
    return $stmt->rowCount();
}

function activate_section(PDO $conn, $section_id)
{
    $stmt = $conn->prepare("UPDATE department_sections SET status=1 WHERE section_id=?");
    $stmt->execute([$section_id]);
    return $stmt->rowCount();
}

function delete_section(PDO $conn, $section_id)
{
    $stmt = $conn->prepare("DELETE FROM department_sections WHERE section_id=?");
    $stmt->execute([$section_id]);
    return $stmt->rowCount();
}

// SQl to create table department_sections
// CREATE TABLE `department_sections` (
//     `section_id` INT(11) NOT NULL AUTO_INCREMENT,
//     `section_name` VARCHAR(255) NOT NULL,
//     `status` INT(11) NOT NULL DEFAULT '1',
//     PRIMARY KEY (`section_id`)
// )
// COLLATE='utf8_general_ci'
// ENGINE=InnoDB
// AUTO_INCREMENT=1
// ;
// 
// Add department
// ALTER TABLE `department_sections` ADD `department_id` INT(11) NOT NULL AFTER `section_id`;
