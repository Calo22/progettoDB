<?php

include "db.php";

$sql = "SELECT Id_settore, Nome_settore FROM Settore";
$select = '<select name="settore"> <option value=""></option>';

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0)
{
    while ($row = mysqli_fetch_assoc($result))
    {
        $select.='<option value="'.$row['Id_settore'].'">'.$row['Nome_settore'].'</option>';
    }
}

$select.='</select>';

echo "<td>" .$select. "</td>";

?>