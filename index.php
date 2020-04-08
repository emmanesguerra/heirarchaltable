<?php include 'dbconnection.php'; ?>

<style>
    * {
        font-family:"Courier New";
        margin: 4px;
    }
</style>

<div style="float: left; width: 100%">
    <form style="float: left; border: 1px #000 solid; padding: 10px; width: 450px" method="post" action="functions/add.php">
        <h3>Add Node</h3>
        <label style="float: left; width: 100px">Name</label> <input type="textbox" name="name" /><br />
        <label style="float: left; width: 100px">Parent ID</label> <input type="textbox" name="parent_id" /><br />
        <input type="submit" value="Submit" />
    </form> 
    <form style="float: left; border: 1px #000 solid; padding: 10px; width: 450px" method="post" action="functions/move.php">
        <h3>Move Node</h3>
        <label style="float: left; width: 100px">ID</label> <input type="textbox" name="id" /><br />
        <label style="float: left; width: 100px">Parent ID</label> <input type="textbox" name="parent_id" /><br />
        <input type="submit" value="Submit" />
    </form>
    <form style="float: left; border: 1px #000 solid; padding: 10px; width: 450px" method="post" action="functions/remove.php">
        <h3>Delete Node</h3>
        <label style="float: left; width: 100px">ID</label> <input type="textbox" name="id" /><br />
        <input type="submit" value="Submit" />
    </form>
</div>
<br />
<br />

<div style="float: left; width: 100%">
    <table style=" float: left; border: 1px #000 solid" cellspacing="5" cellpadding="10">
        <tr>
            <th colspan="5">DB Content</th>
        </tr>
        <tr>
            <th>ID</th>
            <th>LVL</th>
            <th>LEFT</th>
            <th style="width: 200px;">NAME</th>
            <th>RIGHT</th>
        </tr>
        <?php
        $sql = "SELECT * FROM $dbtable order by lft ASC";
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
        $conn->close();
        ?>
    </table>
    <table style="border: 1px #000 solid" cellspacing="5" cellpadding="10">
        <tr>
            <th colspan="5">Original Sql Content</th>
        </tr>
        <tbody><tr>
                <th>ID</th>
                <th>LVL</th>
                <th>LEFT</th>
                <th style="width: 200px;">NAME</th>
                <th>RIGHT</th>
            </tr>

            <tr>
                <td>1</td>
                <td>1</td>
                <td style="text-align:center">1</td>
                <td><strong>Animals</strong></td>
                <td style="text-align:center">30</td>
            </tr>
            <tr>
                <td>2</td>
                <td>2</td>
                <td style="text-align:center">2</td>
                <td> » Dogs</td>
                <td style="text-align:center">21</td>
            </tr>
            <tr>
                <td>5</td>
                <td>3</td>
                <td style="text-align:center">3</td>
                <td> »  » askal</td>
                <td style="text-align:center">10</td>
            </tr>
            <tr>
                <td>6</td>
                <td>4</td>
                <td style="text-align:center">4</td>
                <td> »  »  » askal 1</td>
                <td style="text-align:center">5</td>
            </tr>
            <tr>
                <td>10</td>
                <td>4</td>
                <td style="text-align:center">6</td>
                <td> »  »  » askal 2</td>
                <td style="text-align:center">7</td>
            </tr>
            <tr>
                <td>17</td>
                <td>4</td>
                <td style="text-align:center">8</td>
                <td> »  »  » askal 3</td>
                <td style="text-align:center">9</td>
            </tr>
            <tr>
                <td>7</td>
                <td>3</td>
                <td style="text-align:center">11</td>
                <td> »  » german sheperd</td>
                <td style="text-align:center">20</td>
            </tr>
            <tr>
                <td>11</td>
                <td>4</td>
                <td style="text-align:center">12</td>
                <td> »  »  » gs 1</td>
                <td style="text-align:center">17</td>
            </tr>
            <tr>
                <td>12</td>
                <td>5</td>
                <td style="text-align:center">13</td>
                <td> »  »  »  » gs 1.a</td>
                <td style="text-align:center">14</td>
            </tr>
            <tr>
                <td>18</td>
                <td>5</td>
                <td style="text-align:center">15</td>
                <td> »  »  »  » gs 1.b</td>
                <td style="text-align:center">16</td>
            </tr>
            <tr>
                <td>13</td>
                <td>4</td>
                <td style="text-align:center">18</td>
                <td> »  »  » gs 2</td>
                <td style="text-align:center">19</td>
            </tr>
            <tr>
                <td>8</td>
                <td>2</td>
                <td style="text-align:center">22</td>
                <td> » Cats</td>
                <td style="text-align:center">29</td>
            </tr>
            <tr>
                <td>9</td>
                <td>3</td>
                <td style="text-align:center">23</td>
                <td> »  » Siberian</td>
                <td style="text-align:center">28</td>
            </tr>
            <tr>
                <td>16</td>
                <td>4</td>
                <td style="text-align:center">24</td>
                <td> »  »  » Siberian 1</td>
                <td style="text-align:center">25</td>
            </tr>
            <tr>
                <td>19</td>
                <td>4</td>
                <td style="text-align:center">26</td>
                <td> »  »  » siberian 2</td>
                <td style="text-align:center">27</td>
            </tr>
            <tr>
                <td>15</td>
                <td>1</td>
                <td style="text-align:center">31</td>
                <td><strong>Cars</strong></td>
                <td style="text-align:center">32</td>
            </tr>    </tbody></table>
</div>