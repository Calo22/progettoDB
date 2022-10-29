 <html>
    
    <head>
        <title> Pagina pubblica (Privato) </title>
    </head>
    
    <body>
        
        <?php
        include "db.php";
        
		$id_privato = $_GET["id_privato"];
		
        
        $sql = "select * from Privato join Utente on Privato.Utente = Utente.Id_utente and Privato.Id_privato = $id_privato
                join Contatto on Contatto.Utente = Utente.Id_utente";

    	$result = mysqli_query($conn, $sql);
        
            $row = mysqli_fetch_assoc($result);
            
             
        if (mysqli_num_rows($result) > 0)
        {

            setcookie("id_privato", $id_privato);

            echo "<table border='1' class='blueTable'>".
                "<tr> <td>Codice utente</td> <td>". $row["Id_utente"] ."</td> </tr>".
                "<tr> <td>Codice privato</td> <td>". $id_privato ."</td> </tr>".
                "<tr> <td>Nome</td> <td>". $row["Nome"] ."</td> </tr>".
                "<tr> <td>Cognome</td> <td>". $row["Cognome"] ."</td> </tr>".
                "<tr> <td>Data di nascita</td> <td>". $row["Data_nascita"] ."</td> </tr>".
                "<tr> <td>Residenza</td> <td>". $row["Residenza"] ."</td> </tr>".
                "<tr> <td>Telefono</td> <td>". $row["Telefono"] ."</td> </tr>".
                "<tr> <td>eMail</td> <td>". $row["eMail"] ."</td> </tr>".
                "</table><br>";
                
            echo "<hr><br>";
            
            echo "<h1>Per offrire un lavoro a questo privato clicca <a href=scelta_offerta_lavoro.php> qui </a></h1>";

        }
        else
            echo "<p>ID privato non trovato nel database.</p>";

          
        $sql = "select Id_candidato from Privato join Candidato
                on Privato.Id_privato = Candidato.Privato and Candidato.Privato = $id_privato";
        
    	   $result = mysqli_query($conn, $sql);
        
        if   ($row = mysqli_fetch_assoc($result))
        {
            setcookie("id_candidato", $row["Id_candidato"]);
            
            
        $sql = "select Tipologia as Tipo_titolo, Descrizione_titolo from Titolo_posseduto join Candidato
                on Titolo_posseduto.Candidato = Candidato.Id_candidato and Candidato.Id_candidato = $row[Id_candidato]";
            
    	$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0)
        {
            echo "<table border='1' class='blueTable'>".
                "<th colspan=2>Titolo/i di studio</th>".
                "<tr> <th> Tipologia </th> <th> Dettaglio </th> </tr>";
                
            while ($row1 = mysqli_fetch_assoc($result))
            {
                       
                echo "<tr> <td>". $row1["Tipo_titolo"] ."</td> <td>". $row1["Descrizione_titolo"] ."</td> </tr>";
                    
            }
            
            echo "</table> <br>";
            
        }
        
        $sql = "select Descrizione_qual_poss from Qualifica_posseduta join Candidato
                on Qualifica_posseduta.Candidato = Candidato.Id_candidato and Candidato.Id_candidato = $row[Id_candidato]";
        
        $result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0)
        {
            echo "<table border='1' class='blueTable'>".
                "<th colspan=2>Attestato/i</th>";
                
            while ($row1 = mysqli_fetch_assoc($result))
            {
                   
                echo "<tr> <td>". $row1["Descrizione_qual_poss"] ."</td> </tr>";
            }
            
            echo "</table> <br>";
        }
        
        $sql = "select Disponibilita_mobilita from Candidato where Id_candidato = $row[Id_candidato]";
        
        $result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0)
        {
            $row1 = mysqli_fetch_assoc($result);
            
            if ($row1["Disponibilita_mobilita"] != NULL)
            {
                echo "<table border='1' class='blueTable'>".                   
                    "<th>Disponibile allo spostamento</th>";
            
                if ($row1["Disponibilita_mobilita"] == 1)
                {
                    echo "<tr> <td>SI</td> </tr>";
                }
                else if ($row1["Disponibilita_mobilita"] == 0)
                {
                    echo "<tr> <td>NO</td> </tr>";
                }

                echo "</table> <br>";
            }
        }
        
        $sql = "select Ruolo_ricercato.Ruolo as Ruolo_ric, Settore.Nome_settore as Set_ruolo, Descrizione_ruolo from Ruolo_ricercato
                join Candidato on Ruolo_ricercato.Candidato = Candidato.Id_candidato
                and Candidato = $row[Id_candidato] join Settore on Ruolo_ricercato.Settore = Settore.Id_settore";
        
        $result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0)
        {
            echo "<table border='1' class='blueTable'>".
                "<th colspan=3>Preferenza/e lavorativa/e</th>".
                "<tr> <th> Ruolo </th> <th> Settore </th> <th> Dettagli </th> </tr>";

                
            while ($row1 = mysqli_fetch_assoc($result))
            {
                   
                echo "<tr> <td>". $row1["Ruolo_ric"] ."</td> <td>". $row1["Set_ruolo"] ."</td> <td>". $row1["Descrizione_ruolo"] ."</td> </tr>";
            }
            
            echo "</table> <br>";
        }
        
        $sql = "select Esperienza.Presso as Presso_esp, Ruolo_esp, Settore.Nome_settore as Settore_esp, Descrizione_esp from Esperienza
                join Candidato on Esperienza.Candidato = Candidato.Id_candidato and Candidato.Id_candidato = $row[Id_candidato]
                join Settore on Esperienza.Settore_esp = Settore.Id_settore";
        
        $result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0)
        {
            echo "<table border='1' class='blueTable'>".
                "<th colspan=4>Esperienze lavorative</th>".
                "<tr> <th> Ruolo </th> <th> Presso </th> <th> Settore </th> <th> Dettagli </th> </tr>";

                
            while ($row1 = mysqli_fetch_assoc($result))
            {
                   
                echo "<tr> <td>". $row1["Ruolo_esp"] ."</td> <td>". $row1["Presso_esp"] ."</td> <td>". $row1["Settore_esp"] ."</td> <td>". $row1["Descrizione_esp"] ."</td> </tr>";

            }
            
            echo "</table> <br>";
        }
        
        }
        
        echo "<hr>";

                
        echo "<p> <a href=personale_professionista.php> Torna alla pagina riservata </a> </p>";


        mysqli_close($conn);
        
        ?>
    
    </body>
    
 </html>