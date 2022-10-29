<html>
    
    <head>
        <title>Landing page aggiornamento info</title>
    </head>
    
    <body>
        
        <?php
        include "db.php";
        
        if(isset($_GET["ruolo_preferito"]))
        {
            $ruolo = $_GET["ruolo_preferito"];
            $settore = $_GET["settore"];
			
			if (!isset($_GET["descrizione"]))
			{
				$sql = mysqli_prepare($conn, "INSERT INTO Ruolo_ricercato(Ruolo, Candidato, Settore)
                                  VALUES (?, ?, ?)");
        
				mysqli_stmt_bind_param($sql, 'sii', $ruolo, $_COOKIE["id_candidato"], $settore);
			}
			else
			{
			
				$descrizione = $_GET["descrizione"];
				
				$sql = mysqli_prepare($conn, "INSERT INTO Ruolo_ricercato(Ruolo, Candidato, Descrizione_ruolo, Settore)
									  VALUES (?, ?, ?, ?)");
			
				mysqli_stmt_bind_param($sql, 'sisi', $ruolo, $_COOKIE["id_candidato"], $descrizione, $settore);
			}
			
			
        
            if (mysqli_stmt_execute($sql) === TRUE)
            {
                echo "New record created successfully <br/>";
            }
            else
            {
                echo "Error: " . mysqli_error($sql);
            }
        
        }
        
		
		
        if(isset($_GET["impiego_passato"]))
        {
            $impiego = $_GET["impiego_passato"];
            $azienda = $_GET["azienda"];
            $settore = $_GET["settore"];
            $descrizione = $_GET["descrizione_impiego"];
            
            $sql = mysqli_prepare($conn, "INSERT INTO Esperienza(Descrizione_esp, Candidato, Settore_esp, Presso, Ruolo_esp)
                                  VALUES (?, ?, ?, ?, ?)");
        
            mysqli_stmt_bind_param($sql, 'siiss', $descrizione, $_COOKIE["id_candidato"], $settore , $azienda, $impiego);
        
            if (mysqli_stmt_execute($sql) === TRUE)
            {
                echo "New record created successfully <br/>";
            }
            else
            {
                echo "Error: " . mysqli_error($sql);
            }
        
        }
        
		
		
        if(isset($_GET["titolo"]))
        {
            $titolo = $_GET["titolo"];
            $descrizione = $_GET["descrizione_titolo"];
            
            $sql = mysqli_prepare($conn, "INSERT INTO Titolo_posseduto(Tipologia, Descrizione_titolo, Candidato)
                                  VALUES (?, ?, ?)");
        
            mysqli_stmt_bind_param($sql, 'ssi', $titolo, $descrizione, $_COOKIE["id_candidato"]);
        
            if (mysqli_stmt_execute($sql) === TRUE)
            {
                echo "New record created successfully <br/>";
            }
            else
            {
                echo "Error: " . mysqli_error($sql);
            }
        
        }
        
		
		
        if(isset($_GET["certificato"]))
        {
            $certificato = $_GET["certificato"];
            
            $sql = mysqli_prepare($conn, "INSERT INTO Qualifica_posseduta(Descrizione_qual_poss, Candidato) VALUES (?, ?)");
        
            mysqli_stmt_bind_param($sql, 'si', $certificato, $_COOKIE["id_candidato"]);
        
            if (mysqli_stmt_execute($sql) === TRUE)
            {
                echo "New record created successfully <br/>";
            }
            else
            {
                echo "Error: " . mysqli_error($sql);
            }
        
        }
        

        if(isset($_GET["scelta"]))
        {
            $scelta = $_GET["scelta"];
            
            if ($scelta == "si")
                $scelta = 1;
            else if ($scelta == "no")
                $scelta = 0;
            else
                $scelta = NULL;
            
            $sql = mysqli_prepare($conn, "UPDATE Candidato SET Disponibilita_mobilita = ? WHERE Id_candidato = $_COOKIE[id_candidato]");
        
            mysqli_stmt_bind_param($sql, 'i', $scelta);
        
            if (mysqli_stmt_execute($sql) === TRUE)
            {
                echo "New record created successfully <br/>";
            }
            else
            {
                echo "Error: " . mysqli_error($sql);
            }
        
        }
		
        echo "<p> <a href=personale_privato.php> Torna alla pagina riservata </a> </p>";
        
        mysqli_close($conn);
        
             
        ?>
            
    </body>
    
</html>