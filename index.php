<?php include 'dbconnection.php'; ?>
<?php include 'source/common/header.php'?>

<div class="mainform">
    <form method="post" action="functions/add.php">
        <h3>Add Node</h3>
        <label>Name</label> <input type="textbox" name="name" /><br />
        <label>Parent ID</label> <input type="textbox" name="parent_id" /><br />
        <input type="submit" value="Submit" />
    </form> 
    <form method="post" action="functions/move.php">
        <h3>Move Node</h3>
        <label>ID</label> <input type="textbox" name="id" /><br />
        <label>Parent ID</label> <input type="textbox" name="parent_id" /><br />
        <input type="submit" value="Submit" />
    </form>
    <form method="post" action="functions/remove.php">
        <h3>Delete Node</h3>
        <label>ID</label> <input type="textbox" name="id" /><br />
        <input type="submit" value="Submit" />
    </form>
</div>
<br />
<br />

<div class="displaytable">
    <table cellspacing="5" cellpadding="10">
        <tr>
            <th colspan="5">Database Content</th>
        </tr>
        <tr>
            <th>ID</th>
            <th>LVL</th>
            <th>LEFT</th>
            <th style="width: 200px;">NAME</th>
            <th>RIGHT</th>
        </tr>
        <?php
        $sql = "SELECT * FROM $dbtable ORDER BY lft ASC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $name = $row["name"];
                if ($row['lvl'] == 1) {
                    $name = "<strong>" . $name . "</strong>";
                }
                for ($i = 1; $i < $row['lvl']; $i++) {
                    $name = ' &raquo; ' . $name;
                }
                echo "
                            <tr>
                                <td>" . $row["id"] . "</td>
                                <td>" . $row["lvl"] . "</td>
                                <td style='text-align:center'>" . $row["lft"] . "</td>
                                <td>" . $name . "</td>
                                <td style='text-align:center'>" . $row["rgt"] . "</td>
                            </tr>";
            }
        } else {
            echo "0 results";
        }
        
        ?>
    </table>
    <table cellspacing="5" cellpadding="10">
        <tr>
            <th colspan="5">Original DB Content <span id="hidebtn" class="hide" data-val="0">Show</span></th>
        </tr>
        <?php include 'source/common/originaldata.php'?>
    </table>
    
    
    <table cellspacing="5" cellpadding="10">
        <tr>
            <th colspan="5">Collapsible Data</th>
        </tr>
        <tr>
            <td>
                <ol class="tree-list">
                    <?php

                    $sql = "SELECT * FROM $dbtable WHERE lvl = 1 ORDER BY lft ASC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            displayData($row, $dbtable, $conn);
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>
                </ol>  
            </td>
        </tr>
    </table>  
    
</div>
<?php $conn->close();?>
<?php include 'source/common/footer.php'?>'


<?php 

function displayData($row, $dbtable, $conn) {
    
    $lvl = $row['lvl'] + 1;
    $sql = "SELECT * FROM $dbtable WHERE lft > ".$row['lft']." AND rgt < ".$row['rgt']." AND lvl = ".$lvl." ORDER BY lft ASC";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "<li><span  class='expand' data-val='0'>".$row['name']." + </span><ul class='subdata'>";
        while ($row2 = $result->fetch_assoc()) {
            displayData($row2, $dbtable, $conn);
        }
        echo "</ul></li>";
    } else {
        echo "<li>".$row['name']."</li>";
    }   
}
?>