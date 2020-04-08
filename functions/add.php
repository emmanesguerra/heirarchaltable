<?php

include_once '../dbconnection.php';
include_once '../Library/hierarchy.php';



try {
    if(isset($_POST) && empty($_POST)) {
        throw new Exception('Post data are required.');
    }
    if(isset($_POST['name']) && empty($_POST['name'])) {
        throw new Exception('Name field is required.');
    }
    $parent = null;
    if(isset($_POST['parent_id']) && !empty($_POST['parent_id'])) {
        $sql = "SELECT * FROM $dbtable where id = " . $_POST['parent_id'];
        $result = $conn->query($sql);
        if ($result->num_rows > 0) { 
            $parent = $result->fetch_assoc();
        }
    }
    
    /*
     * Step 1
     * Adjust lft and rgt value of the succeeding records base on parent's rgt IF PARENT EXISTS
     */
    $hierarchyLib = new hierarchy($dbtable, $conn);
    if($parent) {
        $hierarchyLib->updateLftPlus($parent['rgt']);
        $hierarchyLib->updateRgtPlus($parent['rgt']);
        $left = $parent['rgt'];
        $lvl = $parent['lvl'] + 1;
    } else {
        $left = $hierarchyLib->getLastRgt() + 1;
        $lvl = 1;
    }
    $right = $left + 1;
    $name = $_POST['name'];
    
    /*
     * Step 2
     * Insert the new record with regards to parent's old rgt value
     */
    $sql = "INSERT INTO $dbtable (lft, rgt, lvl,name)
            VALUES ($left, $right, $lvl,'$name')";
    if ($conn->query($sql) === TRUE) {
        header('Location: http://localhost/hierarchaltable/index.php');
        exit;
    } else {
        throw new Exception($conn->error);
    }
} catch (Exception $ex) {
    echo $ex->getMessage() . ". Click the link to return back to <a href='../index.php'>index page</a>";
}
