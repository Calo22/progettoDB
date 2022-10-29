<html>
    
    <head>
        <title>Landing page delete info candidato</title>
    </head>
    
    <body>
        
        <?php
        include "db.php";
        
        
        if(isset($_GET["id_titolo"]))
        {
            $id_titolo = $_GET["id_titolo"];
            $sql = "delete from Titolo_posseduto where Id_titolo_posseduto = $id_titolo";
        }
        
        
        if(isset($_GET["id_qualifica"]))
        {
            $id_qualifica = $_GET["id_qualifica"];
            $sql = "delete from Qualifica_posseduta where Id_qualifica_posseduta = $id_qualifica";
        }

        
        if(isset($_GET["id_candidato"]))
        {
            $sql = "update Candidato set Disponibilita_mobilita = 'NULL' where Id_candidato = $_COOKIE[id_candidato]";
        }
        
        
        if(isset($_GET["id_ruolo_ric"]))
        {
            $id_ruolo_ric = $_GET["id_ruolo_ric"];
            $sql = "delete from Ruolo_ricercato where Id_ruolo_ricercato = $id_ruolo_ric";
        }
        
        
        if(isset($_GET["id_esperienza"]))
        {
            $id_esperienza = $_GET["id_esperienza"];
            $sql = "delete from Esperienza where Id_esperienza = $id_esperienza";
        }
        

        $result = mysqli_query($conn, $sql);
        
        if($result)
        {
            echo "<p>Dati eliminati correttamente</p>";
        }
        else
            echo "<p>Si è verificato un errore.</p>";
            
        
        
        echo "<p> <a href=personale_privato.php> Torna alla pagina riservata </a> </p>";
        
        
        
        mysqli_close($conn);
             
        ?>
            
    </body>
    
</html>

        