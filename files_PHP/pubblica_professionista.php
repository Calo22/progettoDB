<html>
    
    <head>
        <title> Pagina pubblica (Professionista) </title>
    </head>
    
    <body>
        
        <?php
        include "db.php";
        
        $id_pro = $_GET["id_pro"];
				
        
        $sql = "select * from Professionista join Utente on Professionista.Utente = Utente.Id_utente
                and Professionista.Id_professionista = $id_pro join Contatto on Contatto.Utente = Utente.Id_utente
                join Settore on Professionista.Settore = Settore.Id_settore";
        
      

    	$result = mysqli_query($conn, $sql);
        
            $row = mysqli_fetch_assoc($result);
            
        if (mysqli_num_rows($result) > 0)
        {
            
            $id_utente = $row["Id_utente"];
            
            setcookie("id_professionista", $id_pro);

            echo "<table border='1' class='blueTable'>".
                "<tr> <td>Codice utente</td> <td>". $id_utente ."</td> </tr>".
                "<tr> <td>Codice professionista</td> <td>". $id_pro ."</td> </tr>".
                "<tr> <td>Nome società</td> <td>". $row["Nome_societa"] ."</td> </tr>".
                "<tr> <td>Intestatario</td> <td>". $row["Intestatario"] ."</td> </tr>".
                "<tr> <td>Sede</td> <td>". $row["Sede"] ."</td> </tr>".
                "<tr> <td>Settore</td> <td>". $row["Nome_settore"] ."</td> </tr>".
                "<tr> <td>Descrizione società</td> <td>". $row["Descrizione_societa"] ."</td> </tr>".
                "<tr> <td>Telefono</td> <td>". $row["Telefono"] ."</td> </tr>".
                "<tr> <td>eMail</td> <td>". $row["eMail"] ."</td> </tr>".
                "</table> </br>";
        
        
        
        $sql = "select Datore_lavoro from Professionista where Utente = $id_utente";
        
        $result = mysqli_query($conn, $sql);
        
        $row = mysqli_fetch_assoc($result);
        
        if ($row["Datore_lavoro"] == 1)
        {
                
            $sql = "select Id_PosizioneAperta, Ruolo, Posizione_aperta.Descrizione as Desc_pos, Posti_disponibili, Stipendio_mensile, Contratto.Tipo_contratto, Descrizione_contratto, Citta, Esperienza, Qualifica_richiesta.Descrizione as Desc_qual,
                Tipologia, Descrizione_titolo from Posizione_aperta join Professionista on Posizione_aperta.Professionista = Professionista.Id_professionista
                and Posizione_aperta.Professionista = $id_pro join Comune on Posizione_aperta.Comune = Comune.Id_comune
                join Contratto on Contratto.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta join Requisito on Requisito.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta
                join Qualifica_richiesta on Qualifica_richiesta.Requisito = Requisito.Id_requisito join Titolo_richiesto on Titolo_richiesto.Requisito = Requisito.Id_requisito";
        
            $result = mysqli_query($conn, $sql);
        
            if (mysqli_num_rows($result) > 0)
            {
                echo "<table border='1' class='blueTable'>".
                    "<th colspan=13>POSIZIONI APERTE</th>".
                    "<tr> <th> ID </th> <th> Ruolo </th> <th> Descrizione </th> <th> Posti disponibili </th> <th> Stipendio mensile </th> <th> Contratto </th> <th> Dettagli contratto </th> <th> Città </th>".
                    "<th> Esperienza richiesta </th> <th> Qualifica e/o attestato richiesto </th> <th> Tipologia titolo richiesto </th> <th> Titolo richiesto </th> </tr>";

                
                while ($row = mysqli_fetch_assoc($result))
                {
                   
                    echo "<form action='landing_invio_candidatura.php' method='GET' name='form'> <tr> <td align='center'> <input name='id_pos' type='number' value=$row[Id_PosizioneAperta] hidden>".
                    $row["Id_PosizioneAperta"] ."</td> <td>". $row["Ruolo"] ."</td> <td>". $row["Desc_pos"] ."</td> <td>". $row["Posti_disponibili"] ."</td> <td>". $row["Stipendio_mensile"] ."</td>".
                    "<td>". $row["Tipo_contratto"] ."</td> <td>". $row["Descrizione_contratto"] ."</td> <td>". $row["Citta"] ."</td> <td>". $row["Esperienza"] ."</td> <td>". $row["Desc_qual"] ."</td>".
                    "<td>". $row["Tipologia"] ."</td> <td>". $row["Descrizione_titolo"] ."</td>".
                    "<td align='center'> <input name='submit' type='submit' value='MI VOGLIO CANDIDARE!'/> </td> </tr> </form>";
                }
            
                echo "</table> <br>";
            }
            
           
        }
        
        
        $sql = "select Fornitore_servizi from Professionista where Utente = $id_utente";
        
        $result = mysqli_query($conn, $sql);
        
        $row = mysqli_fetch_assoc($result);
        
         
        if ($row["Fornitore_servizi"] == 1)
        {
                
            $sql = "select Id_servizio, Settore.Nome_settore as Categoria, Descrizione, Prezzo, Disponibilita
                from Professionista join Servizio on Professionista.Id_professionista = Servizio.Professionista
                and Servizio.Professionista = $id_pro
                join Settore on Professionista.Settore = Settore.Id_settore";

                
            $result = mysqli_query($conn, $sql);
        
            if (mysqli_num_rows($result) > 0)
            {
                echo "<table border='1' class='blueTable' align='center'>".
                    "<th colspan=6>SERVIZI OFFERTI</th>".
                    "<tr> <th> ID </th> <th> Tipologia </th> <th> Descrizione </th> <th> Prezzo </th> <th> Disponibilità </th> </tr>";

                
                while ($row = mysqli_fetch_assoc($result))
                {
                   
                    echo "<form action='landing_invio_servizio.php' method='GET' name='form'> <tr> <td align='center'> <input name='servizio' type='number' value=$row[Id_servizio] hidden>".
                    $row["Id_servizio"] ."</td> <td>". $row["Categoria"] ."</td> <td>". $row["Descrizione"] ."</td> <td>". $row["Prezzo"] ."</td> <td>". $row["Disponibilita"] ."</td>".
                    "<td align='center'> <input name='submit' type='submit' value='VOGLIO IL SERVIZIO!'/> </td> </tr> </form>";
                }
            
                echo "</table> <br>";
            }
            
            
             $sql = "select Recensione.Descrizione as Recensione, Id_servizio, Cliente.Id_cliente as Id_cliente
                from Cliente join Recensione on Cliente.Id_cliente = Recensione.Cliente join Servizio
                on Recensione.Servizio = Servizio.Id_servizio and Servizio.Professionista = $id_pro";
                
                
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0)
            {
            
                echo "<h1 align='center'> Recensioni </h1>";
                echo "<table border='1' class='blueTable' align = 'center'>".
                    "<th colspan=4>DETTAGLIO</th>"; 
 
                while ($row = mysqli_fetch_assoc($result))
                {
                    {
                        echo "<tr> <th> ID servizio </th> <td align='center'>". $row["Id_servizio"] ."</td> </tr>".
                        "<tr> <th> ID cliente </th> <td align='center'>". $row["Id_cliente"] ."</td> </tr>".
                        "<tr> <th> Recensione </th> <td>". $row["Recensione"] ."</td> </tr>".
                        "<tr> <td colspan=2 align='center'>----------------------------------------------</td></tr> ";
                    }

                }
                
                echo "</table><br><br>";
                
            }
            
            
            $sql = "select distinct Id_servizio, Rapporto_QualitaPrezzo_medio_vista.Conteggio as Numero_valutazioni, Media_Rapporto_qp, Media_Disponibilita_pro, Media_consigliato, Media_generale
                    from Professionista join Servizio on Professionista.Id_professionista = Servizio.Professionista and Servizio.Professionista = $id_pro
                    join Valutazione on Servizio.Id_servizio = Valutazione.Servizio
                    join Rapporto_QualitaPrezzo_medio_vista on Rapporto_QualitaPrezzo_medio_vista.Servizio = Servizio.Id_servizio
                    join Disponibilita_professionista_media_vista on Disponibilita_professionista_media_vista.Servizio = Servizio.Id_servizio 
                    join Consigliato_media_vista on Consigliato_media_vista.Servizio = Servizio.Id_servizio join Generale_media_vista
                    on Generale_media_vista.Servizio = Servizio.Id_servizio";
                    
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0)
            {
                echo "<h1 align='center'> Valutazioni </h1>";
                echo "<table border='1' class='blueTable' align = 'center'>".
                    "<th colspan=6>DETTAGLIO</th>".
                    "<tr> <th> ID servizio </th> <th> Numero valutazioni </th> <th> Rapporto qualità/prezzo(medio) </th> <th> Disponibilità professionista (media) </th>".
                    "<th> Consigliato(media) </th> <th> Generale(media) </th> </tr>";
                    
 
                while ($row = mysqli_fetch_assoc($result))
                {
                    {
                        echo "<tr> <td align='center'>". $row["Id_servizio"] ."</td> <td align='center'>". $row["Numero_valutazioni"] ."</td> <td align='center'>".
                        $row["Media_Rapporto_qp"] ."</td> <td align='center'>". $row["Media_Disponibilita_pro"] ."</td> <td align='center'>". $row["Media_consigliato"] ."</td> <td align='center'>".
                        $row["Media_generale"] ."</td></tr>";
                        
                    }

                }
                
                echo "</table><br>";
            }
            
            
            
        }
		
		
		}
        else
            echo "<p>ID professionista non trovato nel database.</p>";
        
        
        echo "<p><a href=personale_privato.php> Torna alla pagina riservata </a></p><br><br><br>";

        
        
            
        mysqli_close($conn);
        
        ?>
    
    </body>
    
</html>