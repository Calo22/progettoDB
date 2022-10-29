<html>
    <head>
        <title> Offerta lavoro per posizione aperta</title>
    </head>
    <body>
        <?php
        include "db.php";
        
        $sql = "select Id_PosizioneAperta, Ruolo, Posizione_aperta.Descrizione as Desc_pos, Posti_disponibili, Stipendio_mensile, Contratto.Tipo_contratto, Citta, Esperienza, Qualifica_richiesta.Descrizione as Desc_qual,
                Tipologia, Descrizione_titolo from Posizione_aperta join Professionista on Posizione_aperta.Professionista = Professionista.Id_professionista
                and Posizione_aperta.Professionista = $_COOKIE[id_professionista] join Comune on Posizione_aperta.Comune = Comune.Id_comune
                join Contratto on Contratto.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta join Requisito on Requisito.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta
                join Qualifica_richiesta on Qualifica_richiesta.Requisito = Requisito.Id_requisito join Titolo_richiesto on Titolo_richiesto.Requisito = Requisito.Id_requisito";
        
            $result = mysqli_query($conn, $sql);
        
            if (mysqli_num_rows($result) > 0)
            {
                echo "<table border='1' class='blueTable'>".
                    "<th colspan=12>POSIZIONI APERTE</th>".
                    "<tr> <th> ID </th> <th> Ruolo </th> <th> Descrizione </th> <th> Posti disponibili </th> <th> Stipendio mensile </th> <th> Contratto </th> <th> Città </th>".
                    "<th> Esperienza richiesta </th> <th> Qualifica e/o attestato richiesto </th> <th> Tipologia titolo richiesto </th> <th> Titolo richiesto </th> </tr>";

                
                while ($row = mysqli_fetch_assoc($result))
                {
                   
                    echo "<form action='landing_offerta_lavoro2.php' method='GET' name='form'> <tr> <td align='center'> <input name='id_pos' type='number' value=$row[Id_PosizioneAperta] hidden>".
                    $row["Id_PosizioneAperta"] ."</td> <td>". $row["Ruolo"] ."</td> <td>". $row["Desc_pos"] ."</td> <td>". $row["Posti_disponibili"] ."</td> <td>". $row["Stipendio_mensile"] ."</td>".
                    "<td>". $row["Tipo_contratto"] ."</td> <td>". $row["Citta"] ."</td> <td>". $row["Esperienza"] ."</td> <td>". $row["Desc_qual"] ."</td>".
                    "<td>". $row["Tipologia"] ."</td> <td>". $row["Descrizione_titolo"] ."</td>".
                    "<td align='center'> <input name='submit' type='submit' value='OFFRI LAVORO'/> </td> </tr> </form>";
                }
            
                echo "</table> <br>";
            }
            
            
        echo "<p> <a href=personale_professionista.php> Torna alla pagina riservata </a> </p>";

        
        
        ?>
    </body>
</html>