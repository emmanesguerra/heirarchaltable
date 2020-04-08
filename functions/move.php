<?php

include_once '../dbconnection.php';
include_once '../Library/hierarchy.php';



try {
    if(isset($_POST) && empty($_POST)) {
        throw new Exception('Post data are required.');
    }
    if(isset($_POST['id']) && empty($_POST['id'])) {
        throw new Exception('ID field is required.');
    }
    if(isset($_POST['parent_id']) && empty($_POST['parent_id'])) {
        throw new Exception('Parent ID field is required.');
    }
    $node = null;
    if(isset($_POST['id']) && !empty($_POST['id'])) {
        $sql = "SELECT * FROM $dbtable where id = " . $_POST['id'];
        $result = $conn->query($sql);
        if ($result->num_rows > 0) { 
            $node = $result->fetch_assoc();
        }
    }
    /*
     * Step 1 - Validation
     * Check if node has children, if child exists. Dont allow to move the node
     */
    if($node['lft'] + 1 != $node['rgt']) {
        throw new Exception("Node's with child cannot be moved.");
    }
    
    /*
     * Step 2
     * Adjust lft and rgt value of the succeeding records base on node's rgt
     */
    $hierarchyLib = new hierarchy($dbtable, $conn);
    if($node) {
        $hierarchyLib->updateLftMinus($node['rgt']);
        $hierarchyLib->updateRgtMinus($node['rgt']);
    } else {
        throw new Exception('Record does not exists');
    }
    
    /*
     * Step 3
     * Get parent's new lft and rgt
     */
    $parent = null;
    if(isset($_POST['parent_id']) && !empty($_POST['parent_id'])) {
        $sql = "SELECT * FROM $dbtable where id = " . $_POST['parent_id'];
        $result = $conn->query($sql);
        if ($result->num_rows > 0) { 
            $parent = $result->fetch_assoc();
        }
    }
    /*
     * Step 4
     * Adjust lft and rgt value of the succeeding records base on parent's rgt
     */
    if($parent) {
        $hierarchyLib->updateLftPlus($parent['rgt']);
        $hierarchyLib->updateRgtPlus($parent['rgt']);
        $left = $parent['rgt'];
        $lvl = $parent['lvl'] + 1;
    } else {
        throw new Exception('Parent record does not exists');
    }
    $right = $left + 1;
    
    /*
     * Step 3
     * Update the node record
     */
    $nodeID = $node['id'];
    $sql = "UPDATE $dbtable SET lft = $left, rgt = $right, lvl = $lvl WHERE id = $nodeID";
    if ($conn->query($sql) === TRUE) {
        header('Location: http://localhost/hierarchaltable/index.php');
        exit;
    } else {
        throw new Exception($conn->error);
    }
} catch (Exception $ex) {
    echo $ex->getMessage() . ". Click the link to return back to <a href='../index.php'>index page</a>";
}
