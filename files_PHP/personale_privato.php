<html>
    
    <head>
        <title> Pagina riservata (Privato) </title>
    </head>
    
    <body>
        
        <?php
        include "db.php";
        
        $sql = "select * from Contatto join Utente on Contatto.Utente = $_COOKIE[id_utente]
            and Contatto.Utente = Utente.Id_utente join Privato on Privato.Utente = $_COOKIE[id_utente]";

    	$result = mysqli_query($conn, $sql);
        
            $row = mysqli_fetch_assoc($result);


            echo "<table border='1' class='blueTable'>".
                "<tr> <td>Codice utente</td> <td>". $_COOKIE["id_utente"] ."</td> </tr>".
                "<tr> <td>Codice privato</td> <td>". $_COOKIE["id_privato"] ."</td> </tr>".
                "<tr> <td>Nome</td> <td>". $row["Nome"] ."</td> </tr>".
                "<tr> <td>Cognome</td> <td>". $row["Cognome"] ."</td> </tr>".
                "<tr> <td>Data di nascita</td> <td>". $row["Data_nascita"] ."</td> </tr>".
                "<tr> <td>Residenza</td> <td>". $row["Residenza"] ."</td> </tr>".
                "<tr> <td>Telefono</td> <td>". $row["Telefono"] ."</td> </tr>".
                "<tr> <td>eMail</td> <td>". $row["eMail"] ."</td> </tr>".
                "</table><br>";
                
                
            $sql = "select Id_candidato from Privato join Candidato
                on Privato.Id_privato = Candidato.Privato and Candidato.Privato = $_COOKIE[id_privato]";
        
            $result = mysqli_query($conn, $sql);


            $sql = "select Id_cliente from Privato join Cliente
                on Privato.Id_privato = Cliente.Privato and Cliente.Privato = $_COOKIE[id_privato]";
        
            $result1 = mysqli_query($conn, $sql);


            if (mysqli_num_rows($result) != 1)
            {
	            echo "<h1> Cerchi un impiego? Specificalo cliccando <a href=candidato_cliente.php> QUI </a></h1>";
            }

            if (mysqli_num_rows($result1) != 1)
            {
                echo "<h1> Vuoi un servizio? Specificalo cliccando <a href=candidato_cliente.php> QUI </a></h1>";
            }
            
                            
            echo "<form action='pubblica_professionista.php' method='GET' name='form'> <table>".
                    "<tr> <th> Cerca un professionista inserendo il suo ID </th>".
                    "<td> <input type='number' name='id_pro' min=0  required/> </td>".
                    "<td> <input name='reset' type='reset' value='CANCELLA' /> </td>".
                    "<td> <input name='submit' type='submit' value='VAI'/> </td> </tr>".
                    "</table> </form>";
             
            echo "<hr>";
            
            
     
        
        if (isset($_COOKIE['id_candidato']))
        {
            
            echo  "<h1> Per aggiungere informazioni personali inerenti a candidature lavorative clicca <a href='cerco_lavoro_info.php'> QUI </a> </h1>";
            
            echo "<h1> Per cercare un lavoro clicca <a href='ricerca_lavoro.php'> QUI </a> </h1>";

       
       
        $sql = "select Id_titolo_posseduto, Tipologia as Tipo_titolo, Descrizione_titolo from Titolo_posseduto join Candidato
                on Titolo_posseduto.Candidato = Candidato.Id_candidato and Candidato.Id_candidato = $_COOKIE[id_candidato]";
            
    	$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0)
        {
            echo "<table border='1' class='blueTable'>".
                "<th colspan=3>Titolo/i di studio</th>".
                "<tr> <th> Tipologia </th> <th> Dettaglio </th> </tr>";
                
            while ($row = mysqli_fetch_assoc($result))
            {
                       
                echo "<form action='landing_del_info_candidato.php' method='GET' name='form'> <tr> <input name='id_titolo' type='number' value=$row[Id_titolo_posseduto] hidden>".
                    "<td>". $row["Tipo_titolo"] ."</td> <td>". $row["Descrizione_titolo"] ."</td>".
                    "<td align='center'> <input name='submit' type='submit' value='ELIMINA'/> </td> </tr> </form>";
            }
            
            echo "</table> <br>";
            
        }
        
        
        
        $sql = "select Id_qualifica_posseduta, Descrizione_qual_poss from Qualifica_posseduta join Candidato
                on Qualifica_posseduta.Candidato = Candidato.Id_candidato and Candidato.Id_candidato = $_COOKIE[id_candidato]";
        
        $result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0)
        {
            echo "<table border='1' class='blueTable'>".
                "<th colspan=2>Attestato/i</th>";
                
            while ($row = mysqli_fetch_assoc($result))
            {
                   
                echo "<form action='landing_del_info_candidato.php' method='GET' name='form'> <tr> <input name='id_qualifica' type='number' value=$row[Id_qualifica_posseduta] hidden>".
                    "<td>". $row["Descrizione_qual_poss"] ."</td>".
                    "<td align='center'> <input name='submit' type='submit' value='ELIMINA'/> </td> </tr> </form>";
            }
            
            echo "</table> <br>";
        }
        
        
        
        $sql = "select Disponibilita_mobilita from Candidato where Id_candidato = $_COOKIE[id_candidato]";
        
        $result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_assoc($result);
            
            if ($row["Disponibilita_mobilita"] != NULL)
            {
                echo "<table border='1' class='blueTable'>".                   
                    "<th>Disponibile allo spostamento</th>".
                    "<form action='landing_del_info_candidato.php' method='GET' name='form'> <input name='id_candidato' type='number' value=$_COOKIE[id_candidato] hidden>";
            
                if ($row["Disponibilita_mobilita"] == 1)
                {
                    echo "<tr> <td>SI</td> </tr>";
                }
                else if ($row["Disponibilita_mobilita"] == 0)
                {
                    echo "<tr> <td>NO</td> </tr>";
                }
                
                echo "<tr> <td align='center'> <input name='submit' type='submit' value='ELIMINA'/> </td> </tr> </form>";

                echo "</table> <br>";
            }
        }
        
        
        
        $sql = "select Id_ruolo_ricercato, Ruolo_ricercato.Ruolo as Ruolo_ric, Settore.Nome_settore as Set_ruolo, Descrizione_ruolo from Ruolo_ricercato
                join Candidato on Ruolo_ricercato.Candidato = Candidato.Id_candidato
                and Candidato = $_COOKIE[id_candidato] join Settore on Ruolo_ricercato.Settore = Settore.Id_settore";
        
        $result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0)
        {
            echo "<table border='1' class='blueTable'>".
                "<th colspan=4>Preferenza/e lavorativa/e</th>".
                "<tr> <th> Ruolo </th> <th> Settore </th> <th> Dettagli </th> </tr>";

                
            while ($row = mysqli_fetch_assoc($result))
            {
                   
                echo "<form action='landing_del_info_candidato.php' method='GET' name='form'> <input name='id_ruolo_ric' type='number' value=$row[Id_ruolo_ricercato] hidden>".
                    "<tr> <td>". $row["Ruolo_ric"] ."</td> <td>". $row["Set_ruolo"] ."</td> <td>". $row["Descrizione_ruolo"] ."</td>".
                    "<td align='center'> <input name='submit' type='submit' value='ELIMINA'/> </td> </tr> </form>";
            }
            
            echo "</table> <br>";
        }
        
        
        
        $sql = "select Id_esperienza, Esperienza.Presso as Presso_esp, Ruolo_esp, Settore.Nome_settore as Settore_esp, Descrizione_esp from Esperienza
                join Candidato on Esperienza.Candidato = Candidato.Id_candidato and Candidato.Id_candidato = $_COOKIE[id_candidato]
                join Settore on Esperienza.Settore_esp = Settore.Id_settore";
        
        $result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0)
        {
            echo "<table border='1' class='blueTable'>".
                "<th colspan=5>Esperienze lavorative</th>".
                "<tr> <th> Ruolo </th> <th> Presso </th> <th> Settore </th> <th> Dettagli </th> </tr>";

                
            while ($row = mysqli_fetch_assoc($result))
            {
                echo "<form action='landing_del_info_candidato.php' method='GET' name='form'> <input name='id_esperienza' type='number' value=$row[Id_esperienza] hidden>". 
                "<tr> <td>". $row["Ruolo_esp"] ."</td> <td>". $row["Presso_esp"] ."</td> <td>". $row["Settore_esp"] ."</td> <td>". $row["Descrizione_esp"] ."</td>".
                "<td align='center'> <input name='submit' type='submit' value='ELIMINA'/> </td> </tr> </form>";

            }
            
            echo "</table> <br>";
        }
        
        // ***************************************CANDIDATURE(RICHIESTE IN USCITA)********************************************
            $sql = "select Id_candidatura, Id_PosizioneAperta, Professionista.Nome_societa as Presso, Ruolo, Posizione_aperta.Descrizione as Desc_pos,
                Stipendio_mensile, Contratto.Tipo_contratto, Citta, Data_ora from Posizione_aperta
                join Professionista on Posizione_aperta.Professionista = Professionista.Id_professionista
                join Comune on Posizione_aperta.Comune = Comune.Id_comune join Contratto on Contratto.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta 
                join Candidatura on Candidatura.Candidato = $_COOKIE[id_candidato] and Candidatura.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta";
            
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0)  
            {
                
            echo "<h1 align='center'><u> CANDIDATURE (RICHIESTE IN USCITA) </u></h1>";

        
        
        
            $sql = "select Id_candidatura, Id_PosizioneAperta, Professionista.Nome_societa as Presso, Ruolo, Posizione_aperta.Descrizione as Desc_pos,
                Stipendio_mensile, Contratto.Tipo_contratto, Citta, Data_ora from Posizione_aperta
                join Professionista on Posizione_aperta.Professionista = Professionista.Id_professionista
                join Comune on Posizione_aperta.Comune = Comune.Id_comune join Contratto on Contratto.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta 
                join Candidatura on Candidatura.Candidato = $_COOKIE[id_candidato] and Candidatura.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta
                and Candidatura.Status = 'In attesa'";
                
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0)
            {
                echo "<table border='1' class='blueTable' align='center'>".
                    "<th colspan=9>CANDIDATURE(IN ATTESA DI RISPOSTA)</th>".
                    "<tr> <th> ID </th> <th> Nome società </th> <th> Ruolo </th> <th> Descrizione </th> <th> Stipendio mensile </th> <th> Contratto </th> <th> Città </th>".
                    "<th> Data e ora invio richiesta </th> </tr>";

                
                while ($row = mysqli_fetch_assoc($result))
                {
                   
                    echo "<form action='landing_off_can_privato.php' method='GET' name='form'> <tr> <input name='id_candidatura' type='number' value=$row[Id_candidatura] hidden> <td align='center'>".
                    $row["Id_PosizioneAperta"] ."</td> <td>". $row["Presso"] ."</td> <td>". $row["Ruolo"] ."</td> <td>". $row["Desc_pos"] ."</td> <td>".
                    $row["Stipendio_mensile"] ."</td> <td>". $row["Tipo_contratto"] ."</td> <td>". $row["Citta"] ."</td> <td>". $row["Data_ora"] ."</td>".
                    "<td align='center'> <input name='submit' type='submit' value='CANCELLA'/> </td> </tr> </form>";
                }
            
                echo "</table> <br>";
            }
            
            
            $sql = "select Id_PosizioneAperta, Professionista.Nome_societa as Presso, Ruolo, Posizione_aperta.Descrizione as Desc_pos,
                Stipendio_mensile, Contratto.Tipo_contratto, Citta, Data_ora from Posizione_aperta
                join Professionista on Posizione_aperta.Professionista = Professionista.Id_professionista
                join Comune on Posizione_aperta.Comune = Comune.Id_comune join Contratto on Contratto.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta 
                join Candidatura on Candidatura.Candidato = $_COOKIE[id_candidato] and Candidatura.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta
                and Candidatura.Status = 'Accettata'";
                
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0)
            {
                echo "<table border='1' class='blueTable' align = 'center'>".
                    "<th colspan=9>CANDIDATURE(ACCETTATE)</th>".
                    "<tr> <th> ID </th> <th> Nome società </th> <th> Ruolo </th> <th> Descrizione </th> <th> Stipendio mensile </th> <th> Contratto </th> <th> Città </th>".
                    "<th> Data e ora confermata </th> </tr>";

                
                while ($row = mysqli_fetch_assoc($result))
                {
                   
                    echo "<tr> <td align='center'>" . $row["Id_PosizioneAperta"] ."</td> <td>". $row["Presso"] ."</td> <td>". $row["Ruolo"] ."</td> <td>". $row["Desc_pos"] ."</td> <td>".
                    $row["Stipendio_mensile"] ."</td> <td>". $row["Tipo_contratto"] ."</td> <td>". $row["Citta"] ."</td> <td>". $row["Data_ora"] ."</td>";
                }
            
                echo "</table> <br>";
            }
            
            
            $sql = "select Id_PosizioneAperta, Professionista.Nome_societa as Presso, Ruolo, Posizione_aperta.Descrizione as Desc_pos,
                Stipendio_mensile, Contratto.Tipo_contratto, Citta, Data_ora from Posizione_aperta
                join Professionista on Posizione_aperta.Professionista = Professionista.Id_professionista
                join Comune on Posizione_aperta.Comune = Comune.Id_comune join Contratto on Contratto.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta 
                join Candidatura on Candidatura.Candidato = $_COOKIE[id_candidato] and Candidatura.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta
                and Candidatura.Status = 'Rifiutata'";
                
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0)
            {
                echo "<table border='1' class='blueTable' align = 'center'>".
                    "<th colspan=9>CANDIDATURE(RIFIUTATE)</th>".
                    "<tr> <th> ID </th> <th> Nome società </th> <th> Ruolo </th> <th> Descrizione </th> <th> Stipendio mensile </th> <th> Contratto </th> <th> Città </th>".
                    "<th> Data e ora rifiutata </th> </tr>";

                
                while ($row = mysqli_fetch_assoc($result))
                {
                   
                    echo "<tr> <td align='center'>" . $row["Id_PosizioneAperta"] ."</td> <td>". $row["Presso"] ."</td> <td>". $row["Ruolo"] ."</td> <td>". $row["Desc_pos"] ."</td> <td>".
                    $row["Stipendio_mensile"] ."</td> <td>". $row["Tipo_contratto"] ."</td> <td>". $row["Citta"] ."</td> <td>". $row["Data_ora"] ."</td>";
                }
            
                echo "</table> <br>";
            }
            
            }
            
            // ***************************************OFFERTE DI LAVORO(RICHIESTE IN ENTRATA)********************************************
            
            $sql = "select Id_OffertaLavoro, Id_PosizioneAperta, Professionista.Nome_societa as Presso, Ruolo, Posizione_aperta.Descrizione as Desc_pos, Posti_disponibili, Stipendio_mensile, Contratto.Tipo_contratto,
                Citta, Data_ora from Posizione_aperta join Professionista on Posizione_aperta.Professionista = Professionista.Id_professionista
                join Comune on Posizione_aperta.Comune = Comune.Id_comune join Contratto on Contratto.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta 
                join Offerta_lavoro on Professionista.Id_professionista = Offerta_lavoro.Professionista and Posizione_aperta.Id_PosizioneAperta = Offerta_lavoro.Posizione_aperta
                join Candidato on Candidato.Id_candidato = Offerta_lavoro.Candidato and Candidato.Id_candidato = $_COOKIE[id_candidato]";
            
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0) 
            {
            
             echo "<h1 align='center'><u> OFFERTE DI LAVORO (RICHIESTE IN ENTRATA) </u></h1>";
            
            
            
            $sql = "select Id_OffertaLavoro, Id_PosizioneAperta, Professionista.Nome_societa as Presso, Ruolo, Posizione_aperta.Descrizione as Desc_pos, Posti_disponibili, Stipendio_mensile, Contratto.Tipo_contratto,
                Citta, Data_ora from Posizione_aperta join Professionista on Posizione_aperta.Professionista = Professionista.Id_professionista
                join Comune on Posizione_aperta.Comune = Comune.Id_comune join Contratto on Contratto.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta 
                join Offerta_lavoro on Professionista.Id_professionista = Offerta_lavoro.Professionista and Posizione_aperta.Id_PosizioneAperta = Offerta_lavoro.Posizione_aperta and Offerta_lavoro.Status = 'In attesa'
                join Candidato on Candidato.Id_candidato = Offerta_lavoro.Candidato and Candidato.Id_candidato = $_COOKIE[id_candidato]";
                
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0)
            {
                echo "<table border='1' class='blueTable' align='center'>".
                    "<th colspan=10>OFFERTE DI LAVORO (IN ATTESA DI RISPOSTA)</th>".
                    "<tr> <th> ID </th> <th> Nome società </th> <th> Ruolo </th> <th> Descrizione </th> <th> Stipendio mensile </th> <th> Contratto </th> <th> Città </th>".
                    "<th> Data e ora invio richiesta </th> </tr>";

                
                while ($row = mysqli_fetch_assoc($result))
                {
                   
                    echo "<form action='landing_off_can_privato.php' method='GET' name='form'> <tr> <input name='id_offerta' type='number' value=$row[Id_OffertaLavoro] hidden> <td align='center'>".
                    $row["Id_PosizioneAperta"] ."</td> <td>". $row["Presso"] ."</td> <td>". $row["Ruolo"] ."</td> <td>". $row["Desc_pos"] ."</td> <td>".
                    $row["Stipendio_mensile"] ."</td> <td>". $row["Tipo_contratto"] ."</td> <td>". $row["Citta"] ."</td> <td>". $row["Data_ora"] ."</td>".
                    "<td align='center'> <input name='submit' type='submit' value='ACCETTA'/> </td>".
                    "<td align='center'> <input name='submit' type='submit' value='RIFIUTA'/> </td> </tr> </form>";
                }
            
                echo "</table> <br>";
            }
            
            
            
            $sql = "select Id_PosizioneAperta, Professionista.Nome_societa as Presso, Ruolo, Posizione_aperta.Descrizione as Desc_pos, Posti_disponibili, Stipendio_mensile, Contratto.Tipo_contratto,
                Citta, Data_ora from Posizione_aperta join Professionista on Posizione_aperta.Professionista = Professionista.Id_professionista
                join Comune on Posizione_aperta.Comune = Comune.Id_comune join Contratto on Contratto.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta 
                join Offerta_lavoro on Professionista.Id_professionista = Offerta_lavoro.Professionista and Posizione_aperta.Id_PosizioneAperta = Offerta_lavoro.Posizione_aperta and Offerta_lavoro.Status = 'Accettata'
                join Candidato on Candidato.Id_candidato = Offerta_lavoro.Candidato and Candidato.Id_candidato = $_COOKIE[id_candidato]";
                
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0)
            {
                echo "<table border='1' class='blueTable' align = 'center'>".
                    "<th colspan=8>OFFERTE DI LAVORO (ACCETTATE)</th>".
                    "<tr> <th> ID </th> <th> Nome società </th> <th> Ruolo </th> <th> Descrizione </th> <th> Stipendio mensile </th> <th> Contratto </th> <th> Città </th>".
                    "<th> Data e ora confermata </th> </tr>";

                
                while ($row = mysqli_fetch_assoc($result))
                {
                   
                    echo "<tr> <td align='center'>". $row["Id_PosizioneAperta"] ."</td> <td>". $row["Presso"] ."</td> <td>". $row["Ruolo"] ."</td> <td>". $row["Desc_pos"] ."</td> <td>".
                    $row["Stipendio_mensile"] ."</td> <td>". $row["Tipo_contratto"] ."</td> <td>". $row["Citta"] ."</td> <td>". $row["Data_ora"] ."</td> </tr>";
                }
            
                echo "</table> <br>";
            }
            
            
            $sql = "select Id_PosizioneAperta, Professionista.Nome_societa as Presso, Ruolo, Posizione_aperta.Descrizione as Desc_pos, Posti_disponibili, Stipendio_mensile, Contratto.Tipo_contratto,
                Citta, Data_ora from Posizione_aperta join Professionista on Posizione_aperta.Professionista = Professionista.Id_professionista
                join Comune on Posizione_aperta.Comune = Comune.Id_comune join Contratto on Contratto.Posizione_aperta = Posizione_aperta.Id_PosizioneAperta 
                join Offerta_lavoro on Professionista.Id_professionista = Offerta_lavoro.Professionista and Posizione_aperta.Id_PosizioneAperta = Offerta_lavoro.Posizione_aperta and Offerta_lavoro.Status = 'Rifiutata'
                join Candidato on Candidato.Id_candidato = Offerta_lavoro.Candidato and Candidato.Id_candidato = $_COOKIE[id_candidato]";
                
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0)
            {
                echo "<table border='1' class='blueTable' align = 'center'>".
                    "<th colspan=8>OFFERTE DI LAVORO (RIFIUTATE)</th>".
                    "<tr> <th> ID </th> <th> Nome società </th> <th> Ruolo </th> <th> Descrizione </th> <th> Stipendio mensile </th> <th> Contratto </th> <th> Città </th>".
                    "<th> Data e ora rifiutata </th> </tr>";

                
                while ($row = mysqli_fetch_assoc($result))
                {
                   
                    echo "<tr> <td align='center'>". $row["Id_PosizioneAperta"] ."</td> <td>". $row["Presso"] ."</td> <td>". $row["Ruolo"] ."</td> <td>". $row["Desc_pos"] ."</td> <td>".
                    $row["Stipendio_mensile"] ."</td> <td>". $row["Tipo_contratto"] ."</td> <td>". $row["Citta"] ."</td> <td>". $row["Data_ora"] ."</td> </tr>";
                }
            
                echo "</table> <br>";
            }
            
                                  
            }
        
        }
        
        echo "<hr>";
            
        
        
        if (isset($_COOKIE['id_cliente']))
        {
            
            
            echo "<h1> Per cercare un servizio clicca <a href='ricerca_servizio.php'> QUI </a> </h1>";
            
            
            $sql = "select Id_prestazione, Id_servizio, Nome_societa, Settore.Nome_settore as Settore, Servizio.Descrizione as Descrizione, Prezzo, Disponibilita
                from Prestazione join Cliente on Prestazione.Cliente = Cliente.Id_cliente and
                Prestazione.Cliente = $_COOKIE[id_cliente] and Status = 'In attesa' join Servizio
                on Prestazione.Servizio = Servizio.Id_servizio join Professionista
                on Servizio.Professionista = Professionista.Id_professionista join Settore
                on Professionista.Settore = Settore.Id_settore";
                
                
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0)
            {
                echo "<table border='1' class='blueTable' align = 'center'>".
                    "<th colspan=8>SERVIZI IN ATTESA DI CONFERMA</th>".
                    "<tr> <th> ID servizio </th> <th> Nome azienda </th> <th> Settore </th> <th> Descrizione </th>".
                    "<th> Prezzo </th> <th> Disponibilità </th> </tr>";

                
                while ($row = mysqli_fetch_assoc($result))
                {
                   
                    echo "<form action='landing_azione_servizio_privato.php' method='GET' name='form'> <tr>".
                    "<td align='center'> <input name='prestazione' type='number' value=$row[Id_prestazione] hidden>".
                    $row["Id_servizio"] ."</td> <td>". $row["Nome_societa"] ."</td> <td>".
                    $row["Settore"] ."</td> <td>". $row["Descrizione"] ."</td> <td>".
                    $row["Prezzo"] ."</td> <td>". $row["Disponibilita"] ."</td>".
                    "<td align='center'> <input name='submit' type='submit' value='CANCELLA'/> </td> </tr> </form>";
                }
            
                echo "</table> <br>";
            }
            
            
            $sql = "select Id_servizio, Nome_societa, Settore.Nome_settore as Settore, Servizio.Descrizione as Descrizione, Prezzo, Disponibilita
                from Prestazione join Cliente on Prestazione.Cliente = Cliente.Id_cliente and
                Prestazione.Cliente = $_COOKIE[id_cliente] and Status = 'In corso' join Servizio
                on Prestazione.Servizio = Servizio.Id_servizio join Professionista
                on Servizio.Professionista = Professionista.Id_professionista join Settore
                on Professionista.Settore = Settore.Id_settore";
                
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0)
            {
                echo "<table border='1' class='blueTable' align = 'center'>".
                    "<th colspan=8>SERVIZI IN CORSO</th>".
                    "<tr> <th> ID servizio </th> <th> Nome azienda </th> <th> Settore </th> <th> Descrizione </th>".
                    "<th> Prezzo </th> <th> Disponibilità </th> </tr>";

                
                while ($row = mysqli_fetch_assoc($result))
                {
                   
                    echo "<tr> <td align='center'>". $row["Id_servizio"] ."</td> <td>". $row["Nome_societa"] ."</td> <td>".
                    $row["Settore"] ."</td> <td>". $row["Descrizione"] ."</td> <td>".
                    $row["Prezzo"] ."</td> <td>". $row["Disponibilita"] ."</td> </tr>";
                }
            
                echo "</table> <br>";
            }
            
            
            $sql = "select Id_recensione, Recensione.Descrizione as Recensione, Id_servizio, Nome_societa,
                Settore.Nome_settore as Settore, Servizio.Descrizione as Descrizione, Prezzo, Disponibilita
                from Prestazione join Cliente on Prestazione.Cliente = Cliente.Id_cliente and
                Prestazione.Cliente = $_COOKIE[id_cliente] and Status = 'Terminata' join Servizio
                on Prestazione.Servizio = Servizio.Id_servizio join Professionista
                on Servizio.Professionista = Professionista.Id_professionista join Settore
                on Professionista.Settore = Settore.Id_settore left join Recensione
                on Recensione.Cliente = Cliente.Id_cliente and Recensione.Servizio = Servizio.Id_servizio";
                
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0)
            {
                echo "<table border='1' class='blueTable' align = 'center'>".
                    "<th colspan=8>SERVIZI CONCLUSI E RECENSITI</th>".
                    "<tr> <th> ID servizio </th> <th> Nome azienda </th> <th> Settore </th> <th> Descrizione </th>".
                    "<th> Prezzo </th> <th> Disponibilità </th> </tr>";

                
                while ($row = mysqli_fetch_assoc($result))
                {
                    if($row["Id_recensione"] == NULL)
                    {
                        echo "<form action='edit_recensione.php' method='GET' name='form'> <tr>".
                        "<td align='center'> <input name='id_servizio' type='number' value=$row[Id_servizio] hidden>".
                        $row["Id_servizio"] ."</td> <td>". $row["Nome_societa"] ."</td> <td>".
                        $row["Settore"] ."</td> <td>". $row["Descrizione"] ."</td> <td>".
                        $row["Prezzo"] ."</td> <td>". $row["Disponibilita"] ."</td> <td align='center'>".
                        "<input name='submit' type='submit' value='SCRIVI RECENSIONE'/> </td> </tr> </form>";
                    }
                    else
                    {
                        echo "<form action='edit_recensione.php' method='GET' name='form'> <tr>".
                        "<td align='center'> <input name='id_servizio' type='number' value=$row[Id_servizio] hidden>".
                        "<input name='id_recensione' type='number' value=$row[Id_recensione] hidden>".
                        "<input name='descrizione' type='text' value=$row[Recensione] hidden>".
                        $row["Id_servizio"] ."</td> <td>". $row["Nome_societa"] ."</td> <td>".
                        $row["Settore"] ."</td> <td>". $row["Descrizione"] ."</td> <td>".
                        $row["Prezzo"] ."</td> <td>". $row["Disponibilita"] ."</td> <td align='center'>".
                        "<input name='submit' type='submit' value='MODIFICA recensione'/> </td> <td align='center'>".
                        "<input name='submit' type='submit' value='ELIMINA recensione'/> </td> </tr> </form>";   
                    }
                }
            
                echo "</table> <br>";
                
                echo "<form action='valutazione.php' method='GET' name='form'> <table>".
                    "<tr> <th> Inserisci ID del servizio che vuoi valutare </th>".
                    "<td> <input type='number' name='id_servizio' min=0 required/> </td>".
                    "<td> <input name='reset' type='reset' value='CANCELLA' /> </td>".
                    "<td> <input name='submit' type='submit' value='VAI'/> </td> </tr>".
                    "</table> </form>";
                
                
            }
            
            
            $sql = "select Id_recensione, Recensione.Descrizione as Recensione, Id_servizio, Nome_societa,
                Settore.Nome_settore as Settore, Servizio.Descrizione as Descrizione, Prezzo, Disponibilita
                from Prestazione join Cliente on Prestazione.Cliente = Cliente.Id_cliente and
                Prestazione.Cliente = $_COOKIE[id_cliente] and Status = 'Terminata' join Servizio
                on Prestazione.Servizio = Servizio.Id_servizio join Professionista
                on Servizio.Professionista = Professionista.Id_professionista join Settore
                on Professionista.Settore = Settore.Id_settore join Recensione
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
                        "<tr> <th> Recensione </th> <td>". $row["Recensione"] ."</td> </tr>".
                        "<tr> <td colspan=2 align='center'>----------------------------------------------</td></tr> ";
                    }

                }
                
                echo "</table><br><br>";
                
            }
            
            
            $sql = "select Id_servizio, Rapporto_QualitaPrezzo, Disponibilita_professionista, Consigliato, Generale, Valutazione.Data_ora as Data_ora          
                from Prestazione join Cliente on Prestazione.Cliente = Cliente.Id_cliente and
                Prestazione.Cliente = $_COOKIE[id_cliente] and Status = 'Terminata' join Servizio
                on Prestazione.Servizio = Servizio.Id_servizio join Valutazione on Valutazione.Servizio = Servizio.Id_servizio
                and Valutazione.Cliente = Cliente.Id_cliente";
                
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0)
            {
            
                echo "<h1 align='center'> Valutazioni </h1>";
                echo "<table border='1' class='blueTable' align = 'center'>".
                    "<th colspan=6>DETTAGLIO</th>".
                    "<tr> <th> ID servizio </th> <th> Rapporto Qualità/Prezzo </th> <th> Disponibilità professionista </th> <th> Consigliato </th>".
                    "<th> Generale </th> <th> Data e ora </th> </tr>";
                    
 
                while ($row = mysqli_fetch_assoc($result))
                {
                    {
                        echo "<tr> <td align='center'>". $row["Id_servizio"] ."</td> <td align='center'>". $row["Rapporto_QualitaPrezzo"] ."</td> <td align='center'>".
                        $row["Disponibilita_professionista"] ."</td> <td align='center'>". $row["Consigliato"] ."</td> <td align='center'>". $row["Generale"] ."</td> <td align='center'>".
                        $row["Data_ora"] ."</td></tr>";
                        
                    }

                }
                
                echo "</table><br>";
                
            }
            

        }   
            
                            

        mysqli_close($conn);
        
        ?>
    
    </body>
    
</html>