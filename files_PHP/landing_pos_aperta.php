<html>
    
    <head>
        <title> Landing page aggiunta posizione aperta </title>

    </head>
    
    <body>
        
        <?php
        include "db.php";
        
        $ruolo = $_GET["ruolo"];
        $descrizione_pos = $_GET["descrizione_pos"];
        $stipendio = $_GET["stipendio"];
        $dettagli_contratto = $_GET["descrizione_contratto"];
        $comune = $_GET["comune"];
        $esperienza = $_GET["esperienza"];
        $posti = $_GET["posti"];
        $qualifica = $_GET["qualifica"];
        $titolo = $_GET["titolo"];
        $descrizione_titolo = $_GET["descrizione_titolo"];
		
		if (!isset($_GET["tipo_contratto"]))
			$contratto = "Non specificato";
        
            
        echo $ruolo. " " .$descrizione_pos. " " .$stipendio. " " .$contratto. " " .$dettagli_contratto. " " .$comune. " "
            .$esperienza. " " .$posti. " " .$qualifica. " " .$titolo. " " .$descrizione_titolo. "<br/>";
            
                    
        $sql = mysqli_prepare($conn, "insert into Posizione_aperta(Comune, Professionista, Descrizione, Ruolo, Posti_disponibili)
                              values (?,?,?,?,?)");
        
        mysqli_stmt_bind_param($sql, 'iissi', $comune, $_COOKIE['id_professionista'], $descrizione_pos, $ruolo, $posti);
        
        if (mysqli_stmt_execute($sql) === TRUE)
        {
            echo "New record created successfully <br/>";
        }
        else
        {
            echo "Error: " . mysqli_error($sql) . "<br/>";
        }
        
        $sql = "SELECT max(Id_PosizioneAperta) FROM Posizione_aperta";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($result);
        
        echo $row[0]. "<br/>";
        
        
        $sql = mysqli_prepare($conn, "insert into Contratto(Posizione_aperta, Tipo_contratto, Stipendio_mensile, Descrizione_contratto)
                              values (?,?,?,?)");
        
        mysqli_stmt_bind_param($sql, 'isis', $row[0], $contratto, $stipendio, $dettagli_contratto);
        
        if (mysqli_stmt_execute($sql) === TRUE)
        {
            echo "New record created successfully <br/>";
        }
        else
        {
            echo "Error: " . mysqli_error($sql) . "<br/>";
        }
        
        
        $sql = mysqli_prepare($conn, "insert into Requisito(Posizione_aperta, Esperienza)
                              values (?,?)");
        
        mysqli_stmt_bind_param($sql, 'is', $row[0], $esperienza);
        
        if (mysqli_stmt_execute($sql) === TRUE)
        {
            echo "New record created successfully <br/>";
        }
        else
        {
            echo "Error: " . mysqli_error($sql) . "<br/>";
        }
        
        
        $sql = "SELECT max(Id_requisito) FROM Requisito";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($result);
        
        echo $row[0]. "<br/>";
        
        
        $sql = mysqli_prepare($conn, "insert into Qualifica_richiesta(Descrizione, Requisito)
                              values (?,?)");
        
        mysqli_stmt_bind_param($sql, 'si', $qualifica, $row[0]);
        
        if (mysqli_stmt_execute($sql) === TRUE)
        {
            echo "New record created successfully <br/>";
        }
        else
        {
            echo "Error: " . mysqli_error($sql) . "<br/>";
        }
        
        
        $sql = mysqli_prepare($conn, "insert into Titolo_richiesto(Requisito, Tipologia, Descrizione_titolo)
                              values (?,?, ?)");
        
        mysqli_stmt_bind_param($sql, 'iss', $row[0], $titolo, $descrizione_titolo);
        
        if (mysqli_stmt_execute($sql) === TRUE)
        {
            echo "New record created successfully <br/>";
        }
        else
        {
            echo "Error: " . mysqli_error($sql) . "<br/>";
        }
        
        
        echo "<p> <a href=personale_professionista.php> Vai alla pagina riservata del professionista </a> </p>";

        
        
    
        
        mysqli_close($conn);
        
             
        ?>
            
    </body>
    
</html>