<html>
    
    <head>
        <title> Landing page offerta/candidatura professionista </title>
    </head>
    
    <body>
        
        <?php
        include "db.php";
        

        $submit = $_GET["submit"];
        
       
        
        
        if ($submit == "CANCELLA")
        {
			$id_pos = $_GET["id_pos"];
			$id_candidato = $_GET["id_candidato"];
			
            $sql = "delete from Offerta_lavoro where Offerta_lavoro.Posizione_aperta = $id_pos and Offerta_lavoro.Candidato = $id_candidato";
        }
        else if ($submit == "ACCETTA")
        {
			$id_candidatura = $_GET["candidatura"];
			
            $sql = "update Candidatura set Status = 'Accettata' where Id_candidatura = $id_candidatura";
        }
        else if ($submit == "RIFIUTA")
        {
			$id_candidatura = $_GET["candidatura"];
			
            $sql = "update Candidatura set Status = 'Rifiutata' where Id_candidatura = $id_candidatura";
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