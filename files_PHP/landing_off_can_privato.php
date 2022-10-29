<html>
    
    <head>
        <title> Landing page offerta/candidatura privato </title>
    </head>
    
    <body>
        
        <?php
        include "db.php";

        
        $submit = $_GET["submit"];
        

        
        if ($submit == "CANCELLA")
        {
			$id_candidatura = $_GET["id_candidatura"];
            $sql = "delete from Candidatura where Candidatura.Id_candidatura = $id_candidatura";
        }
        else if ($submit == "RIFIUTA")
        {
			$id_offerta = $_GET["id_offerta"];
            $sql = "update Offerta_lavoro set Status = 'Rifiutata' where Offerta_lavoro.Id_OffertaLavoro = $id_offerta";
        }
        else if ($submit == "ACCETTA")
        {
			$id_offerta = $_GET["id_offerta"];
            $sql = "update Offerta_lavoro set Status = 'Accettata' where Offerta_lavoro.Id_OffertaLavoro = $id_offerta";
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
        
        echo "<p> <a href=personale_privato.php> Torna alla pagina riservata </a> </p>";
        
        
        mysqli_close($conn);
        
        ?>
    
    </body>
    
</html>