<html>
    
    <head>
        <title> Offerta lavoro </title>
    </head>
    
    <body>
        
        <?php
        include "db.php";
        
        
        $id = $_GET["id_pos"];
        $submit = $_GET["submit"];
        
        echo $id . $submit;
        
        if($submit == "OFFRI LAVORO")
        {
        $sql = "select Id_PosizioneAperta, Ruolo, Posizione_aperta.Descrizione as Desc_pos, Posti_disponibili, Stipendio_mensile, Contratto.Tipo_contratto, Citta, Esperienza, Qualifica_richiesta.Descrizione as Desc_qual,
                Tipologia, Descrizione_titolo from Posizione_aperta join Professionista on Posizione_aperta.Professionista = Professionista.Id_professionista
                and Posizione_aperta.Professionista = $_COOKIE[id_professionista] and Posizione_aperta.Id_PosizioneAperta = $id join Comune on Posizione_aperta.Comune = Comune.Id_comune
                join Contratto on Contratto.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta join Requisito on Requisito.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta
                join Qualifica_richiesta on Qualifica_richiesta.Requisito = Requisito.Id_requisito join Titolo_richiesto on Titolo_richiesto.Requisito = Requisito.Id_requisito";
        
        $result = mysqli_query($conn, $sql);
        
        echo "<table border='1' class='blueTable'>".
            "<th colspan=12>LAVORO DA OFFRIRE</th>".
            "<tr> <th> ID </th> <th> Ruolo </th> <th> Descrizione </th> <th> Posti disponibili </th> <th> Stipendio mensile </th> <th> Contratto </th> <th> Città </th>".
            "<th> Esperienza richiesta </th> <th> Qualifica e/o attestato richiesto </th> <th> Tipologia titolo richiesto </th> <th> Titolo richiesto </th> </tr>";

        $row = mysqli_fetch_assoc($result);        
                   
        echo "<tr> <td align='center'> <input name='id_pos' type='number' value=$row[Id_PosizioneAperta] hidden>". $row["Id_PosizioneAperta"] ."</td> <td>". $row["Ruolo"] ."</td> <td>".
            $row["Desc_pos"] ."</td> <td>". $row["Posti_disponibili"] ."</td> <td>". $row["Stipendio_mensile"] ."</td>".
            "<td>". $row["Tipo_contratto"] ."</td> <td>". $row["Citta"] ."</td> <td>". $row["Esperienza"] ."</td> <td>". $row["Desc_qual"] ."</td>".
            "<td>". $row["Tipologia"] ."</td> <td>". $row["Descrizione_titolo"] ."</td> </tr>";
                
            
        echo "</table> <br>";
        
        echo "<form action='landing_offerta_lavoro.php' method='GET' name='form'>".
                "<table border='1'>".                
                "<tr>".
                    "<td><b>Inserisci l'ID del Candidato a cui offrire il lavoro</b></td>".
                    "<td> <input name='id_candidato' type='number' required/> </td>".
                    "<td align='center'> <input name='submit' type='submit' value='INVIA'/> </td>".
                "</tr>".                
                    "<input name='id_pos' type='number' value=$id hidden>".               
                "</table>".            
            "</form>";
            
        }
        
        else if($submit == "CANCELLA")
        {
            $sql = "delete from Posizione_aperta where Id_PosizioneAperta = $id";
            $result = mysqli_query($conn, $sql);
            
            if($result)
            {
                echo "<p> Posizione aperta eliminata correttamente </p>";
            }
            else
            {
                echo "<p> Si è verificato un errore </p>";
            }

            
        }
        
        
        echo "<p> <a href=personale_professionista.php> Vai alla pagina riservata del professionista </a> </p>";

        
           
            
        mysqli_close($conn);
        
        ?>
    
    </body>
    
</html>