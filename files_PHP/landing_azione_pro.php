<html>
    
    <head>
        <title>Landing page Professionista Datore/Fornitore </title>
    </head>
    
    <body>
        
        <?php
        include "db.php";
        
        
        if(isset($_GET["submit_datore"]))
        {
            $sql = "update Professionista set Datore_lavoro = 1 where Id_professionista = $_COOKIE[id_professionista]";
        }
        
        
        if(isset($_GET["submit_fornitore"]))
        {
            $sql = "update Professionista set Fornitore_servizi = 1 where Id_professionista = $_COOKIE[id_professionista]";
        }
        
        
        $result = mysqli_query($conn, $sql);
        
        if($result)
        {
            echo "<p>Modalità operativa aggiornata correttamente.</p>";
        }
        else
            echo "<p>Si è verificato un errore.</p>";
            
        
        
        
        
        echo "<p> <a href=personale_professionista.php> Torna alla pagina riservata </a> </p>";
        
        
        
        mysqli_close($conn);
             
        ?>
            
    </body>
    
</html>