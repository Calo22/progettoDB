<html>
    
    <head>
        <title> Landing page ricerca lavoro</title>
    </head>
    
    <body>
        
        <?php
        include "db.php";
        
        
            if($_GET["stipendio_da"] != NULL)
            {
                $stip_da = $_GET["stipendio_da"];
                
                $stip_min = "and Contratto.Stipendio_mensile >= $stip_da";
            }
            else
                $stip_min="";
                
                
            
            if($_GET["stipendio_a"] != NULL)
            {
                $stip_a = $_GET["stipendio_a"];
                
                $stip_max = "and Contratto.Stipendio_mensile <= $stip_a";
            }
            else
                $stip_max="";
                
                
			
            if(isset($_GET["tipo_contratto"]))
            {
                $tipo_contratto = $_GET["tipo_contratto"];
                
                $contratto = "and Contratto.Tipo_contratto = '$tipo_contratto'";
            }
            else
                $contratto="";
                
                
                
            if($_GET["ruolo"] != NULL)
            {
                $ruolo = $_GET["ruolo"];
                
                $ruolo_sql = "and Posizione_aperta.Ruolo = '$ruolo'";
            }
            else
                $ruolo_sql="";
                
            
             
            if($_GET["id_professionista"] != NULL)
            {
                $id_professionista = $_GET["id_professionista"];
                
                $professionista = "and Posizione_aperta.Professionista = $id_professionista";
            }
            else
                $professionista ="";
                
                
            
            if($_GET["azienda"] != NULL)
            {
                $azienda = $_GET["azienda"];
                
                $azienda_sql = "and Professionista.Nome_societa like '$azienda%'";
            }
            else
                $azienda_sql ="";
                
                
                
            if($_GET["qualifica"] != NULL)
            {
                $qualifica = $_GET["qualifica"];
                
                $qualifica_sql = "and Qualifica_richiesta.Descrizione = '$qualifica'";
            }
            else
                $qualifica_sql ="";
                
                
                
            if($_GET["titolo"] != NULL)
            {
                $titolo = $_GET["titolo"];
                
                $titolo_sql = "and Titolo_richiesto.Tipologia = '$titolo'";
            }
            else
                $titolo_sql ="";
                
                
                
            if($_GET["provincia"] != NULL)
            {
                $provincia = $_GET["provincia"];
                
                $provincia_sql = "and Comune.Provincia = '$provincia'";
            }
            else
                $provincia_sql ="";
                
                
                
            if($_GET["comune"] != NULL)
            {
                $comune = $_GET["comune"];
                
                $comune_sql = "and Comune.Id_comune = $comune";
            }
            else
                $comune_sql ="";
                
                
            
            if($_GET["settore"] != NULL)
            {
                $settore = $_GET["settore"];
                
                $settore_sql = "join Settore on Professionista.Settore = Settore.Id_settore and Settore.Id_settore = $settore";
            }
            else
                $settore_sql ="";
                
                
            echo $stip_min . $stip_max . $contratto . $ruolo_sql . $professionista . $azienda_sql . $qualifica_sql .
                $titolo_sql . $provincia_sql . $comune_sql . $settore_sql;
                
            
            $sql = "select Nome_societa, Id_PosizioneAperta, Ruolo, Posizione_aperta.Descrizione as Desc_pos, Posti_disponibili, Stipendio_mensile,
                Contratto.Tipo_contratto, Citta, Esperienza, Qualifica_richiesta.Descrizione as Desc_qual, Tipologia, Descrizione_titolo
                from Posizione_aperta join Professionista on Posizione_aperta.Professionista = Professionista.Id_professionista $professionista $ruolo_sql $azienda_sql
                join Comune on Posizione_aperta.Comune = Comune.Id_comune $provincia_sql $comune_sql join Contratto on Contratto.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta $stip_min $stip_max $contratto
                join Requisito on Requisito.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta join Qualifica_richiesta on Qualifica_richiesta.Requisito = Requisito.Id_requisito $qualifica_sql
                join Titolo_richiesto on Titolo_richiesto.Requisito = Requisito.Id_requisito $titolo_sql $settore_sql";
                
            
            $result = mysqli_query($conn, $sql);
            
        
            if (mysqli_num_rows($result) > 0)
            {
                echo "<table border='1' class='blueTable'>".
                    "<th colspan=13>POSIZIONI APERTE</th>".
                    "<tr> <th> Nome azienda </th> <th> ID </th> <th> Ruolo </th> <th> Descrizione </th> <th> Posti disponibili </th> <th> Stipendio mensile </th> <th> Contratto </th> <th> Città </th>".
                    "<th> Esperienza richiesta </th> <th> Qualifica e/o attestato richiesto </th> <th> Tipologia titolo richiesto </th> <th> Titolo richiesto </th> </tr>";

                
                while ($row = mysqli_fetch_assoc($result))
                {
                   
                    echo "<form action='candidatura_lavoro.php' method='GET' name='form'> <tr> <td>". $row["Nome_societa"] ."</td> <td align='center'> <input name='id_pos' type='number' value=$row[Id_PosizioneAperta] hidden>".
                    $row["Id_PosizioneAperta"] ."</td> <td>". $row["Ruolo"] ."</td> <td>". $row["Desc_pos"] ."</td> <td>". $row["Posti_disponibili"] ."</td> <td>". $row["Stipendio_mensile"] ."</td>".
                    "<td>". $row["Tipo_contratto"] ."</td> <td>". $row["Citta"] ."</td> <td>". $row["Esperienza"] ."</td> <td>". $row["Desc_qual"] ."</td>".
                    "<td>". $row["Tipologia"] ."</td> <td>". $row["Descrizione_titolo"] ."</td>".
                    "<td align='center'> <input name='submit' type='submit' value='MI VOGLIO CANDIDARE!'/> </td> </tr> </form>";
                }
            
                echo "</table> <br>";
            }   
            
			
			echo "<p> <a href=ricerca_lavoro.php> Torna a ricerca lavoro </a> </p>";
			echo "<p> <a href=personale_privato.php> Torna alla pagina riservata </a> </p>";

            
        mysqli_close($conn);
        
        ?>
    
    </body>
    
</html>