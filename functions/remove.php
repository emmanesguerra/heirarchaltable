<?php

include_once '../dbconnection.php';
include_once '../Library/hierarchy.php';



try {
    if(isset($_POST) && empty($_POST)) {
        throw new Exception('Post data are required.');
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
     * Check if node has children, if child exists. Dont allow to delete the node
     */
    if($node['lft'] + 1 != $node['rgt']) {
        throw new Exception("Node's with child cannot be deleted.");
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
     * Delete the node record
     */
    $nodeID = $node['id'];
    $sql = "DELETE FROM $dbtable WHERE id = $nodeID";
    if ($conn->query($sql) === TRUE) {
        header('Location: http://localhost/hierarchaltable/index.php');
        exit;
    } else {
        throw new Exception($conn->error);
    }
} catch (Exception $ex) {
    echo $ex->getMessage() . ". Click the link to return back to <a href='../index.php'>index page</a>";
}
