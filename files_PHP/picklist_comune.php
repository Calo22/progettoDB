<?php

include "db.php";

$sql = "SELECT Id_comune, Provincia, Citta FROM Comune";
$select = '<select name="comune" required> <option value=""></option>';

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0)
{
    while ($row = mysqli_fetch_assoc($result))
    {
        $select.='<option value="'.$row['Id_comune'].'">'.$row['Citta'].'('.$row['Provincia'].')'.'</option>';
    }
}

$select.='</select>';

echo "<td>" .$select. "</td>";

?>