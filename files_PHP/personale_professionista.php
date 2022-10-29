<html>
    
    <head>
        <title> Pagina riservata (Professionista) </title>
    </head>
    
    <body>
        
        <?php
        include "db.php";
        
        $sql = "select * from Contatto join Utente on Contatto.Utente = $_COOKIE[id_utente]
            and Contatto.Utente = Utente.Id_utente join Professionista on Professionista.Utente = $_COOKIE[id_utente]
            join Settore on Professionista.Settore = Settore.Id_settore";

    	$result = mysqli_query($conn, $sql);
        
            $row = mysqli_fetch_assoc($result);


            echo "<table border='1' class='blueTable'>".
                "<tr> <td>Codice utente</td> <td>". $_COOKIE["id_utente"] ."</td> </tr>".
                "<tr> <td>Codice professionista</td> <td>". $_COOKIE["id_professionista"] ."</td> </tr>".
                "<tr> <td>Nome società</td> <td>". $row["Nome_societa"] ."</td> </tr>".
                "<tr> <td>Intestatario</td> <td>". $row["Intestatario"] ."</td> </tr>".
                "<tr> <td>Sede</td> <td>". $row["Sede"] ."</td> </tr>".
                "<tr> <td>Settore</td> <td>". $row["Nome_settore"] ."</td> </tr>".
                "<tr> <td>Descrizione società</td> <td>". $row["Descrizione_societa"] ."</td> </tr>".
                "<tr> <td>Telefono</td> <td>". $row["Telefono"] ."</td> </tr>".
                "<tr> <td>eMail</td> <td>". $row["eMail"] ."</td> </tr>".
                "</table> <br/>";
        
                
        if($row["Datore_lavoro"] != 1)
        {
            echo "<table> <form action='landing_azione_pro.php' method='GET' name='form'> <tr> <td> <b> Cerchi dipendenti per la tua azienda? Specificalo cliccando </b> </td>".
                "<td align='center'> <input name='submit_datore' type='submit' value='QUI'/> </td> </tr> </form> </table><br>";

        }
        
        
        if($row["Fornitore_servizi"] != 1)
        {
            echo "<table> <form action='landing_azione_pro.php' method='GET' name='form'> <tr> <td> <b> Vuoi offrire i tuoi servizi ai clienti? Specificalo cliccando </b> </td>".
                "<td align='center'> <input name='submit_fornitore' type='submit' value='QUI'/> </td> </tr> </form> </table><br>";
        }
        
        
        echo "<form action='pubblica_privato.php' method='GET' name='form'> <table>".
            "<tr> <th> Cerca un privato inserendo il suo ID </th>".
            "<td> <input type='number' name='id_privato' min=0 required/> </td>".
           "<td> <input name='reset' type='reset' value='CANCELLA' /> </td>".
           "<td> <input name='submit' type='submit' value='VAI'/> </td> </tr>".
          "</table> </form>";
                
        echo "<hr>";
        
        
        $sql = "select Datore_lavoro, Fornitore_servizi from Professionista where Utente = $_COOKIE[id_utente]";
        
        $result = mysqli_query($conn, $sql);
        
        $row1 = mysqli_fetch_assoc($result);
        
        if ($row1["Datore_lavoro"] == 1)
        {
            echo "<h1> Specifica quali sono le posizioni aperte presso la tua azienda cliccando ".
                "<a href=aggiungi_pos_aperta.php> qui </a> </h1>";
                
            $sql = "select Id_PosizioneAperta, Ruolo, Posizione_aperta.Descrizione as Desc_pos, Posti_disponibili, Stipendio_mensile, Contratto.Tipo_contratto, Descrizione_contratto, Citta, Esperienza, Qualifica_richiesta.Descrizione as Desc_qual,
                Tipologia, Descrizione_titolo from Posizione_aperta join Professionista on Posizione_aperta.Professionista = Professionista.Id_professionista
                and Posizione_aperta.Professionista = $_COOKIE[id_professionista] join Comune on Posizione_aperta.Comune = Comune.Id_comune
                join Contratto on Contratto.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta join Requisito on Requisito.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta
                join Qualifica_richiesta on Qualifica_richiesta.Requisito = Requisito.Id_requisito join Titolo_richiesto on Titolo_richiesto.Requisito = Requisito.Id_requisito";
        
            $result = mysqli_query($conn, $sql);
        
            if (mysqli_num_rows($result) > 0)
            {
                echo "<table border='1' class='blueTable'>".
                    "<th colspan=14>POSIZIONI APERTE</th>".
                    "<tr> <th> ID </th> <th> Ruolo </th> <th> Descrizione </th> <th> Posti disponibili </th> <th> Stipendio mensile </th> <th> Contratto </th> <th> Dettagli contratto </th> <th> Città </th>".
                    "<th> Esperienza richiesta </th> <th> Qualifica e/o attestato richiesto </th> <th> Tipologia titolo richiesto </th> <th> Titolo richiesto </th> </tr>";

                
                while ($row = mysqli_fetch_assoc($result))
                {
                   
                    echo "<form action='offri_lavoro.php' method='GET' name='form'> <tr> <td align='center'> <input name='id_pos' type='number' value=$row[Id_PosizioneAperta] hidden>".
                    $row["Id_PosizioneAperta"] ."</td> <td>". $row["Ruolo"] ."</td> <td>". $row["Desc_pos"] ."</td> <td>". $row["Posti_disponibili"] ."</td> <td>". $row["Stipendio_mensile"] ."</td>".
                    "<td>". $row["Tipo_contratto"] ."</td> <td>". $row["Descrizione_contratto"] ."</td> <td>". $row["Citta"] ."</td> <td>". $row["Esperienza"] ."</td> <td>". $row["Desc_qual"] ."</td>".
                    "<td>". $row["Tipologia"] ."</td> <td>". $row["Descrizione_titolo"] ."</td>".
                    "<td align='center'> <input name='submit' type='submit' value='OFFRI LAVORO'/> </td>".
                    "<td align='center'> <input name='submit' type='submit' value='CANCELLA'/> </td> </tr> </form>";
                }
            
                echo "</table> <br>";
            }
            
            
            $sql = "select * from Offerta_lavoro where Professionista = $_COOKIE[id_professionista]";
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0)
            {
                  echo "<h1 align='center'><u> OFFERTE DI LAVORO (RICHIESTE IN USCITA) </u></h1>";
                
            $sql = "select Id_PosizioneAperta, Ruolo, Posizione_aperta.Descrizione as Desc_pos, Posti_disponibili, Stipendio_mensile, Contratto.Tipo_contratto,
                Citta, Esperienza, Qualifica_richiesta.Descrizione as Desc_qual, Tipologia, Descrizione_titolo, Candidato, Data_ora from Posizione_aperta
                join Professionista on Posizione_aperta.Professionista = Professionista.Id_professionista and Posizione_aperta.Professionista = $_COOKIE[id_professionista]
                join Comune on Posizione_aperta.Comune = Comune.Id_comune join Contratto on Contratto.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta join Requisito on Requisito.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta
                join Qualifica_richiesta on Qualifica_richiesta.Requisito = Requisito.Id_requisito join Titolo_richiesto on Titolo_richiesto.Requisito = Requisito.Id_requisito
                join Offerta_lavoro on Professionista.Id_professionista = Offerta_lavoro.Professionista and Posizione_aperta.Id_PosizioneAperta = Offerta_lavoro.Posizione_aperta and Offerta_lavoro.Status = 'In attesa' join Candidato on
                Candidato.Id_candidato = Offerta_lavoro.Candidato";
                
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0)
            {
                echo "<table border='1' class='blueTable' align='center'>".
                    "<th colspan=14>OFFERTE DI LAVORO (IN ATTESA DI RISPOSTA)</th>".
                    "<tr> <th> ID </th> <th> Ruolo </th> <th> Descrizione </th> <th> Posti disponibili </th> <th> Stipendio mensile </th> <th> Contratto </th> <th> Città </th>".
                    "<th> Esperienza richiesta </th> <th> Qualifica e/o attestato richiesto </th> <th> Tipologia titolo richiesto </th> <th> Titolo richiesto </th>".
                    "<th> Candidato </th> <th> Data e ora invio richiesta </th> </tr>";

                
                while ($row = mysqli_fetch_assoc($result))
                {
                   
                    echo "<form action='landing_off_can_professionista.php' method='GET' name='form'> <tr> <td align='center'> <input name='id_pos' type='number' value=$row[Id_PosizioneAperta] hidden>".
                    $row["Id_PosizioneAperta"] ."</td> <td>". $row["Ruolo"] ."</td> <td>". $row["Desc_pos"] ."</td> <td>".
                    $row["Posti_disponibili"] ."</td> <td>". $row["Stipendio_mensile"] ."</td>".
                    "<td>". $row["Tipo_contratto"] ."</td> <td>". $row["Citta"] ."</td> <td>". $row["Esperienza"] ."</td> <td>". $row["Desc_qual"] ."</td>".
                    "<td>". $row["Tipologia"] ."</td> <td>". $row["Descrizione_titolo"] ."</td>".
                    "<td> <input name='id_candidato' type='number' value=$row[Candidato] hidden>". $row["Candidato"] ."</td> <td>". $row["Data_ora"] ."</td>".
                    "<td align='center'> <input name='submit' type='submit' value='CANCELLA'/> </td> </tr> </form>";
                }
            
                echo "</table> <br>";
            }
            
            
            $sql = "select Id_PosizioneAperta, Ruolo, Posizione_aperta.Descrizione as Desc_pos, Posti_disponibili, Stipendio_mensile, Contratto.Tipo_contratto,
                Citta, Esperienza, Qualifica_richiesta.Descrizione as Desc_qual, Tipologia, Descrizione_titolo, Candidato, Data_ora from Posizione_aperta
                join Professionista on Posizione_aperta.Professionista = Professionista.Id_professionista and Posizione_aperta.Professionista = $_COOKIE[id_professionista]
                join Comune on Posizione_aperta.Comune = Comune.Id_comune join Contratto on Contratto.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta join Requisito on Requisito.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta
                join Qualifica_richiesta on Qualifica_richiesta.Requisito = Requisito.Id_requisito join Titolo_richiesto on Titolo_richiesto.Requisito = Requisito.Id_requisito
                join Offerta_lavoro on Professionista.Id_professionista = Offerta_lavoro.Professionista and Posizione_aperta.Id_PosizioneAperta = Offerta_lavoro.Posizione_aperta and Offerta_lavoro.Status = 'Accettata' join Candidato on
                Candidato.Id_candidato = Offerta_lavoro.Candidato";
                
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0)
            {
                echo "<table border='1' class='blueTable'>".
                    "<th colspan=13>OFFERTE DI LAVORO (ACCETTATE)</th>".
                    "<tr> <th> ID </th> <th> Ruolo </th> <th> Descrizione </th> <th> Posti disponibili </th> <th> Stipendio mensile </th> <th> Contratto </th> <th> Città </th>".
                    "<th> Esperienza richiesta </th> <th> Qualifica e/o attestato richiesto </th> <th> Tipologia titolo richiesto </th> <th> Titolo richiesto </th>".
                    "<th> Candidato </th> <th> Data e ora invio richiesta </th> </tr>";

                
                while ($row = mysqli_fetch_assoc($result))
                {
                   
                    echo "<tr> <td align='center'>". $row["Id_PosizioneAperta"] ."</td> <td>". $row["Ruolo"] ."</td> <td>". $row["Desc_pos"] ."</td> <td>".
                    $row["Posti_disponibili"] ."</td> <td>". $row["Stipendio_mensile"] ."</td>".
                    "<td>". $row["Tipo_contratto"] ."</td> <td>". $row["Citta"] ."</td> <td>". $row["Esperienza"] ."</td> <td>". $row["Desc_qual"] ."</td>".
                    "<td>". $row["Tipologia"] ."</td> <td>". $row["Descrizione_titolo"] ."</td>".
                    "<td>". $row["Candidato"] ."</td> <td>". $row["Data_ora"] ."</td> </tr>";
                }
            
                echo "</table> <br>";
            }
            
            
            $sql = "select Id_PosizioneAperta, Ruolo, Posizione_aperta.Descrizione as Desc_pos, Posti_disponibili, Stipendio_mensile, Contratto.Tipo_contratto,
                Citta, Esperienza, Qualifica_richiesta.Descrizione as Desc_qual, Tipologia, Descrizione_titolo, Candidato, Data_ora from Posizione_aperta
                join Professionista on Posizione_aperta.Professionista = Professionista.Id_professionista and Posizione_aperta.Professionista = $_COOKIE[id_professionista]
                join Comune on Posizione_aperta.Comune = Comune.Id_comune join Contratto on Contratto.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta join Requisito on Requisito.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta
                join Qualifica_richiesta on Qualifica_richiesta.Requisito = Requisito.Id_requisito join Titolo_richiesto on Titolo_richiesto.Requisito = Requisito.Id_requisito
                join Offerta_lavoro on Professionista.Id_professionista = Offerta_lavoro.Professionista and Posizione_aperta.Id_PosizioneAperta = Offerta_lavoro.Posizione_aperta and Offerta_lavoro.Status = 'Rifiutata' join Candidato on
                Candidato.Id_candidato = Offerta_lavoro.Candidato";
                
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0)
            {
                echo "<table border='1' class='blueTable'>".
                    "<th colspan=13>OFFERTE DI LAVORO (RIFIUTATE)</th>".
                    "<tr> <th> ID </th> <th> Ruolo </th> <th> Descrizione </th> <th> Posti disponibili </th> <th> Stipendio mensile </th> <th> Contratto </th> <th> Città </th>".
                    "<th> Esperienza richiesta </th> <th> Qualifica e/o attestato richiesto </th> <th> Tipologia titolo richiesto </th> <th> Titolo richiesto </th>".
                    "<th> Candidato </th> <th> Data e ora invio richiesta </th> </tr>";

                
                while ($row = mysqli_fetch_assoc($result))
                {
                   
                    echo "<tr> <td align='center'>". $row["Id_PosizioneAperta"] ."</td> <td>". $row["Ruolo"] ."</td> <td>". $row["Desc_pos"] ."</td> <td>".
                    $row["Posti_disponibili"] ."</td> <td>". $row["Stipendio_mensile"] ."</td>".
                    "<td>". $row["Tipo_contratto"] ."</td> <td>". $row["Citta"] ."</td> <td>". $row["Esperienza"] ."</td> <td>". $row["Desc_qual"] ."</td>".
                    "<td>". $row["Tipologia"] ."</td> <td>". $row["Descrizione_titolo"] ."</td>".
                    "<td>". $row["Candidato"] ."</td> <td>". $row["Data_ora"] ."</td> </tr>";
                }
            
                echo "</table> <br>";
            }
            
            }
            
            $sql = "select * from Candidatura join Posizione_aperta on Candidatura.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta
                join Professionista on Posizione_aperta.Professionista = Professionista.Id_professionista and
                Professionista = $_COOKIE[id_professionista]";
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0)
            {
            echo "<h1 align='center'><u> CANDIDATURE (RICHIESTE IN ENTRATA) </u></h1>";

            
            $sql = "select Id_candidatura, Id_PosizioneAperta, Ruolo, Posizione_aperta.Descrizione as Desc_pos, Posti_disponibili, Stipendio_mensile, Contratto.Tipo_contratto,
                Citta, Esperienza, Qualifica_richiesta.Descrizione as Desc_qual, Tipologia, Descrizione_titolo, Candidato, Data_ora from Posizione_aperta
                join Professionista on Posizione_aperta.Professionista = Professionista.Id_professionista and Posizione_aperta.Professionista = $_COOKIE[id_professionista]
                join Comune on Posizione_aperta.Comune = Comune.Id_comune join Contratto on Contratto.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta join Requisito on Requisito.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta
                join Qualifica_richiesta on Qualifica_richiesta.Requisito = Requisito.Id_requisito join Titolo_richiesto on Titolo_richiesto.Requisito = Requisito.Id_requisito
                join Candidatura on Candidatura.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta and Candidatura.Status = 'In attesa' join Candidato on
                Candidato.Id_candidato = Candidatura.Candidato";
                
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0)
            {
                echo "<table border='1' class='blueTable'>".
                    "<th colspan=15>CANDIDATURE(IN ATTESA DI RISPOSTA)</th>".
                    "<tr> <th> ID </th> <th> Ruolo </th> <th> Descrizione </th> <th> Posti disponibili </th> <th> Stipendio mensile </th> <th> Contratto </th> <th> Città </th>".
                    "<th> Esperienza richiesta </th> <th> Qualifica e/o attestato richiesto </th> <th> Tipologia titolo richiesto </th> <th> Titolo richiesto </th>".
                    "<th> Candidato </th> <th> Data e ora invio richiesta </th> </tr>";

                
                while ($row = mysqli_fetch_assoc($result))
                {
                   
                    echo "<form action='landing_off_can_professionista.php' method='GET' name='form'> <tr> <td align='center'> <input name='candidatura' type='number' value=$row[Id_candidatura] hidden>".
                    $row["Id_PosizioneAperta"] ."</td> <td>". $row["Ruolo"] ."</td> <td>". $row["Desc_pos"] ."</td> <td>".
                    $row["Posti_disponibili"] ."</td> <td>". $row["Stipendio_mensile"] ."</td>".
                    "<td>". $row["Tipo_contratto"] ."</td> <td>". $row["Citta"] ."</td> <td>". $row["Esperienza"] ."</td> <td>". $row["Desc_qual"] ."</td>".
                    "<td>". $row["Tipologia"] ."</td> <td>". $row["Descrizione_titolo"] ."</td>".
                    "<td> <input name='id_candidato' type='number' value=$row[Candidato] hidden>".
                    $row["Candidato"] ."</td> <td>". $row["Data_ora"] ."</td>".
                    "<td align='center'> <input name='submit' type='submit' value='ACCETTA'/> </td>".
                    "<td align='center'> <input name='submit' type='submit' value='RIFIUTA'/> </td> </tr> </form>";
                }
            
                echo "</table> <br>";
            }
            
            
            $sql = "select Id_PosizioneAperta, Ruolo, Posizione_aperta.Descrizione as Desc_pos, Posti_disponibili, Stipendio_mensile, Contratto.Tipo_contratto,
                Citta, Esperienza, Qualifica_richiesta.Descrizione as Desc_qual, Tipologia, Descrizione_titolo, Candidato, Data_ora from Posizione_aperta
                join Professionista on Posizione_aperta.Professionista = Professionista.Id_professionista and Posizione_aperta.Professionista = $_COOKIE[id_professionista]
                join Comune on Posizione_aperta.Comune = Comune.Id_comune join Contratto on Contratto.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta join Requisito on Requisito.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta
                join Qualifica_richiesta on Qualifica_richiesta.Requisito = Requisito.Id_requisito join Titolo_richiesto on Titolo_richiesto.Requisito = Requisito.Id_requisito
                join Candidatura on Candidatura.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta and Candidatura.Status = 'Accettata' join Candidato on
                Candidato.Id_candidato = Candidatura.Candidato";
                
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0)
            {
                echo "<table border='1' class='blueTable'>".
                    "<th colspan=13>CANDIDATURE(ACCETTATE)</th>".
                    "<tr> <th> ID </th> <th> Ruolo </th> <th> Descrizione </th> <th> Posti disponibili </th> <th> Stipendio mensile </th> <th> Contratto </th> <th> Città </th>".
                    "<th> Esperienza richiesta </th> <th> Qualifica e/o attestato richiesto </th> <th> Tipologia titolo richiesto </th> <th> Titolo richiesto </th>".
                    "<th> Candidato </th> <th> Data e ora invio richiesta </th> </tr>";

                
                while ($row = mysqli_fetch_assoc($result))
                {
                   
                    echo "<tr> <td align='center'>". $row["Id_PosizioneAperta"] ."</td> <td>". $row["Ruolo"] ."</td> <td>". $row["Desc_pos"] ."</td> <td>".
                    $row["Posti_disponibili"] ."</td> <td>". $row["Stipendio_mensile"] ."</td>".
                    "<td>". $row["Tipo_contratto"] ."</td> <td>". $row["Citta"] ."</td> <td>". $row["Esperienza"] ."</td> <td>". $row["Desc_qual"] ."</td>".
                    "<td>". $row["Tipologia"] ."</td> <td>". $row["Descrizione_titolo"] ."</td>".
                    "<td>". $row["Candidato"] ."</td> <td>". $row["Data_ora"] ."</td> </tr>";
                }
            
                echo "</table> <br>";
            }
            
            
            $sql = "select Id_PosizioneAperta, Ruolo, Posizione_aperta.Descrizione as Desc_pos, Posti_disponibili, Stipendio_mensile, Contratto.Tipo_contratto,
                Citta, Esperienza, Qualifica_richiesta.Descrizione as Desc_qual, Tipologia, Descrizione_titolo, Candidato, Data_ora from Posizione_aperta
                join Professionista on Posizione_aperta.Professionista = Professionista.Id_professionista and Posizione_aperta.Professionista = $_COOKIE[id_professionista]
                join Comune on Posizione_aperta.Comune = Comune.Id_comune join Contratto on Contratto.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta join Requisito on Requisito.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta
                join Qualifica_richiesta on Qualifica_richiesta.Requisito = Requisito.Id_requisito join Titolo_richiesto on Titolo_richiesto.Requisito = Requisito.Id_requisito
                join Candidatura on Candidatura.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta and Candidatura.Status = 'Rifiutata' join Candidato on
                Candidato.Id_candidato = Candidatura.Candidato";
                
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0)
            {
                echo "<table border='1' class='blueTable'>".
                    "<th colspan=13>CANDIDATURE(RIFIUTATE)</th>".
                    "<tr> <th> ID </th> <th> Ruolo </th> <th> Descrizione </th> <th> Posti disponibili </th> <th> Stipendio mensile </th> <th> Contratto </th> <th> Città </th>".
                    "<th> Esperienza richiesta </th> <th> Qualifica e/o attestato richiesto </th> <th> Tipologia titolo richiesto </th> <th> Titolo richiesto </th>".
                    "<th> Candidato </th> <th> Data e ora invio richiesta </th> </tr>";

                
                while ($row = mysqli_fetch_assoc($result))
                {
                   
                    echo "<tr> <td align='center'>". $row["Id_PosizioneAperta"] ."</td> <td>". $row["Ruolo"] ."</td> <td>". $row["Desc_pos"] ."</td> <td>".
                    $row["Posti_disponibili"] ."</td> <td>". $row["Stipendio_mensile"] ."</td>".
                    "<td>". $row["Tipo_contratto"] ."</td> <td>". $row["Citta"] ."</td> <td>". $row["Esperienza"] ."</td> <td>". $row["Desc_qual"] ."</td>".
                    "<td>". $row["Tipologia"] ."</td> <td>". $row["Descrizione_titolo"] ."</td>".
                    "<td>". $row["Candidato"] ."</td> <td>". $row["Data_ora"] ."</td> </tr>";
                }
            
                echo "</table> <br>";
            }

            
            }
        }
        
        echo "<hr>";
        
        
        if ($row1["Fornitore_servizi"] == 1)
        {
            echo "<h1> Specifica quali sono i servizi offerti dalla tua azienda cliccando ".
                "<a href=aggiungi_servizio.php> qui </a> </h1>";
                
            $sql = "select Id_servizio, Descrizione, Prezzo, Disponibilita
                from Professionista join Servizio on Professionista.Id_professionista = Servizio.Professionista
                and Servizio.Professionista = $_COOKIE[id_professionista]";

                
            $result = mysqli_query($conn, $sql);
        
            if (mysqli_num_rows($result) > 0)
            {
                echo "<table border='1' class='blueTable' align='center'>".
                    "<th colspan=6>SERVIZI OFFERTI</th>".
                    "<tr> <th> ID </th> <th> Descrizione </th> <th> Prezzo </th> <th> Disponibilità </th> </tr>";

                
                while ($row = mysqli_fetch_assoc($result))
                {
                   
                    echo "<form action='landing_azione_servizio_pro.php' method='GET' name='form'> <tr> <td align='center'> <input name='servizio' type='number' value=$row[Id_servizio] hidden>".
                    $row["Id_servizio"] ."</td> <td>". $row["Descrizione"] ."</td> <td>". $row["Prezzo"] ."</td> <td>". $row["Disponibilita"] ."</td>".
                    "<td align='center'> <input name='submit' type='submit' value='CANCELLA'/> </td> </tr> </form>";
                }
            
                echo "</table> <br>";
            }
            
            
            $sql = "select Id_servizio, Id_cliente, Nome_societa, Settore.Nome_settore as Settore, Servizio.Descrizione as Descrizione, Prezzo, Disponibilita
                    from Cliente join Prestazione on Cliente.Id_cliente = Prestazione.Cliente and Status = 'In attesa' join Servizio on Servizio.Id_servizio = Prestazione.Servizio
                    join Professionista on Servizio.Professionista = Professionista.Id_professionista and Servizio.Professionista =  $_COOKIE[id_professionista]
                    join Settore on Professionista.Settore = Settore.Id_settore";
                
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0)
            {
                echo "<table border='1' class='blueTable' align='center'>".
                    "<th colspan=9>SERVIZI IN ATTESA DI CONFERMA</th>".
                    "<tr> <th> ID servizio </th> <th> ID cliente </th> <th> Nome azienda </th> <th> Settore </th> <th> Descrizione </th>".
                    "<th> Prezzo </th> <th> Disponibilità </th> </tr>";

                
                while ($row = mysqli_fetch_assoc($result))
                {
                   
                    echo "<form action='landing_azione_servizio_pro.php' method='GET' name='form'> <tr> <td align='center'>".
                    "<input name='servizio' type='number' value=$row[Id_servizio] hidden>". $row["Id_servizio"] .
                    "</td> <td align='center'> <input name='cliente' type='number' value=$row[Id_cliente] hidden>". $row["Id_cliente"] ."</td> <td>".
                    $row["Nome_societa"] ."</td> <td>". $row["Settore"] ."</td> <td>". $row["Descrizione"] ."</td> <td>".
                    $row["Prezzo"] ."</td> <td>". $row["Disponibilita"] ."</td>".
                    "<td align='center'> <input name='submit' type='submit' value='ACCETTA'/> </td>".
                    "<td align='center'> <input name='submit' type='submit' value='RIFIUTA'/> </td> </tr> </form>";
                }
            
                echo "</table> <br>";
            }
            
            
            $sql = "select Id_servizio, Id_cliente, Nome_societa, Settore.Nome_settore as Settore, Servizio.Descrizione as Descrizione, Prezzo, Disponibilita
                    from Cliente join Prestazione on Cliente.Id_cliente = Prestazione.Cliente and Status = 'In corso' join Servizio on Servizio.Id_servizio = Prestazione.Servizio
                    join Professionista on Servizio.Professionista = Professionista.Id_professionista and Servizio.Professionista =  $_COOKIE[id_professionista]
                    join Settore on Professionista.Settore = Settore.Id_settore";
                
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0)
            {
                echo "<table border='1' class='blueTable' align='center'>".
                    "<th colspan=8>SERVIZI IN CORSO</th>".
                    "<tr> <th> ID servizio </th> <th> ID cliente </th> <th> Nome azienda </th> <th> Settore </th> <th> Descrizione </th>".
                    "<th> Prezzo </th> <th> Disponibilità </th> </tr>";

                
                while ($row = mysqli_fetch_assoc($result))
                {
                   
                    echo "<form action='landing_azione_servizio_pro.php' method='GET' name='form'> <tr> <td align='center'>".
                    "<input name='servizio' type='number' value=$row[Id_servizio] hidden>". $row["Id_servizio"] .
                    "</td> <td align='center'> <input name='cliente' type='number' value=$row[Id_cliente] hidden>". $row["Id_cliente"] ."</td> <td>".
                    $row["Nome_societa"] ."</td> <td>". $row["Settore"] ."</td> <td>". $row["Descrizione"] ."</td> <td>".
                    $row["Prezzo"] ."</td> <td>". $row["Disponibilita"] ."</td>".
                    "<td align='center'> <input name='submit' type='submit' value='TERMINA'/> </td> </tr> </form>";
                }
            
                echo "</table> <br>";
            }
            
            
            $sql = "select Id_servizio, Id_cliente, Nome_societa, Settore.Nome_settore as Settore, Servizio.Descrizione as Descrizione, Prezzo, Disponibilita
                    from Cliente join Prestazione on Cliente.Id_cliente = Prestazione.Cliente and Status = 'Terminata' join Servizio on Servizio.Id_servizio = Prestazione.Servizio
                    join Professionista on Servizio.Professionista = Professionista.Id_professionista and Servizio.Professionista =  $_COOKIE[id_professionista]
                    join Settore on Professionista.Settore = Settore.Id_settore";
                
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0)
            {
                echo "<table border='1' class='blueTable' align='center'>".
                    "<th colspan=8>SERVIZI CONCLUSI</th>".
                    "<tr> <th> ID servizio </th> <th> ID cliente </th> <th> Nome azienda </th> <th> Settore </th> <th> Descrizione </th>".
                    "<th> Prezzo </th> <th> Disponibilità </th> </tr>";

                
                while ($row = mysqli_fetch_assoc($result))
                {
                   
                    echo "<tr> <td align='center'>". $row["Id_servizio"] ."</td> <td align='center'>". $row["Id_cliente"] ."</td> <td>".
                    $row["Nome_societa"] ."</td> <td>". $row["Settore"] ."</td> <td>". $row["Descrizione"] ."</td> <td>".
                    $row["Prezzo"] ."</td> <td>". $row["Disponibilita"] ."</td> </tr>";
                }
            
                echo "</table> <br><br>";
            }
            
            
            $sql = "select distinct Recensione.Descrizione as Recensione, Id_servizio, Cliente.Id_cliente as Id_cliente
                from Cliente join Prestazione on Cliente.Id_cliente = Prestazione.Cliente join Servizio on Prestazione.Servizio = Servizio.Id_servizio
                and Servizio.Professionista = $_COOKIE[id_professionista] join Recensione
                on Recensione.Cliente = Cliente.Id_cliente and Recensione.Servizio = Servizio.Id_servizio";
                
                
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
                    from Professionista join Servizio on Professionista.Id_professionista = Servizio.Professionista and Servizio.Professionista = $_COOKIE[id_professionista]
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

            
        mysqli_close($conn);
        
        ?>
    
    </body>
    
</html>