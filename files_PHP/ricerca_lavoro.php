<html>
    <head>
        
        <title> Ricerca lavoro </title>
        
    </head>
    
    <body>
        
        <p> <h1>Ricerca lavoro</h1> </p>
        
        <form action="landing_ricerca_lavoro.php" method="GET" name="form">
            <table border="1" class="blueTable">
                
                <tr>
                    <td>Stipendio(mensile)</td>
                    <td> Da: <input name="stipendio_da" id="stipendio_da" type="number" min="0" /> <br>
                         A: <input name="stipendio_a" id="stipendio_a" type="number" min="0" />
                    </td>
                </tr>
                <tr>
                    <td>Tipo contratto</td>
                    <td> <input name="tipo_contratto" id="indeterminato" type="radio" value="Tempo indeterminato" />
                            <label for="indeterminato">INDETERMINATO</label><br>
                         <input name="tipo_contratto" id="determinato" type="radio" value="Tempo determinato" />
                            <label for="determinato">DETERMINATO</label><br>
                    </td>
                </tr>
                <tr>
                    <td>Ruolo</td>
                    <td> <input name="ruolo" id="ruolo" type="text" /> </td>
                </tr>
                <tr>
                    <td>ID Professionista</td>
                    <td> <input name="id_professionista" id="id_professionista" type="number" min=0 /> </td>
                </tr>
                <tr>
                    <td>Azienda</td>
                    <td> <input name="azienda" id="azienda" type="text" /> </td>
                </tr>
                <tr>
                    <td>Qualifica e/o attestato richiesto</td>
                    <td> <input name="qualifica" id="qualifica" type="text" /> </td>
                </tr>
                <tr>
                    <td>Titolo di studio richiesto</td>
                    <td>
                        <select name="titolo">
                            <option value=""></option>
                            <option value="elementare">Licenza elementare</option>
                            <option value="media">Licenza Media</option>
                            <option value="superiore">Diploma di scuola superiore</option>
                            <option value="laurea_triennale">Laurea di primo livello</option>
                            <option value="laurea_ciclo_unico">Laurea specialistica a ciclo unico</option>
                            <option value="specialistica">Laurea specialistica</option>
                            <option value="master_livello1">Master di primo livello</option>
                            <option value="master_livello2">Master di secondo livello</option>
                            <option value="dottorato">Dottorato di ricerca</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Provincia</td>
                    <?php

                    include "db.php";

                    $sql = "SELECT distinct Provincia FROM Comune";
                    $select = '<select name="provincia"> <option value=""></option>';

                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0)
                    {
                        while ($row = mysqli_fetch_assoc($result))
                        {
                            $select.='<option value="'.$row['Provincia'].'">'.$row['Provincia'].'</option>';
                        }
                    }

                    $select.='</select>';

                    echo "<td>" .$select. "</td>";

                    ?>
                </tr>
                <tr>
                    <td>Città</td>
                    <?php
                        include "picklist_comune_ricerca.php";
                    ?>
                </tr>
                <tr>
                    <td>Settore</td>
                    <?php
                        include "picklist_settore_ricerca.php";
                    ?>
                </tr>
                <tr>
                    <td align="center"> <input name="reset" type="reset" value="CANCELLA" /></td>
                    <td align="center"> <input name="submit" type="submit" value="RICERCA"/> </td>
                </tr>
            </table>
            
        </form>
        
        <p><a href=personale_privato.php>Torna alla pagina riservata</a></p>
        
    </body>
    
    
</html>