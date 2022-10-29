<html>
    
    <head>
        <title> Landing page azione servizio privato</title>
    </head>
    
    <body>
        
        <?php
        include "db.php";
        
        
        $id_prestazione = $_GET["prestazione"];
        
        
        $sql = "delete from Prestazione where Id_prestazione = $id_prestazione";
        
        
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