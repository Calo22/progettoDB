<html>
    
    <head>
        <title> Landing page azione servizio professionista</title>
    </head>
    
    <body>
        
        <?php
        include "db.php";

        $submit = $_GET["submit"];
		$servizio = $_GET["servizio"];

        
		if($submit == "ACCETTA" || $submit == "RIFIUTA" || $submit == "TERMINA")
		{
			$cliente = $_GET["cliente"];
		}
		
        
        if ($submit == "ACCETTA")
        {			
            $sql = "update Prestazione set Status = 'In corso' where Servizio = $servizio and Cliente = $cliente";
        }
        else if ($submit == "RIFIUTA")
        {	
            $sql = "delete from Prestazione where Servizio = $servizio and Cliente = $cliente";
        }
        else if ($submit == "TERMINA")
        {
            $sql = "update Prestazione set Status = 'Terminata' where Servizio = $servizio and Cliente = $cliente";

        }
        else if ($submit == "CANCELLA")
        {			
            $sql = "delete from Servizio where Id_servizio = $servizio";
        }

        
        $result = mysqli_query($conn, $sql);
        
        if($result)
        {
            echo "Aggiornamento dati eseguito correttamente. </br>";
        }
        else
        {
            echo "Errore. </br>";
        }
        
        echo "<p> <a href=personale_professionista.php> Torna alla pagina riservata </a> </p>";
        
        
        mysqli_close($conn);
        
        ?>
    
    </body>
    
</html>