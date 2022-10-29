<html>
    
    <head>
        <title>Landing page offerta lavoro posizione aperta</title>
    </head>
    
    <body>
        
        <?php
        include "db.php";
        
        $id_pos = $_GET["id_pos"];
        $status = 'In attesa';
        
        echo $id_pos . $_COOKIE["id_professionista"] . $_COOKIE["id_candidato"] . $status . "<br/>";            
            
        
        $sql = mysqli_prepare($conn, "INSERT INTO Offerta_lavoro(Professionista, Candidato, Posizione_aperta, Status)
                              VALUES (?, ?, ?, ?)");
        
        mysqli_stmt_bind_param($sql, 'iiis', $_COOKIE["id_professionista"], $_COOKIE["id_candidato"], $id_pos, $status);
        
        
        if (mysqli_stmt_execute($sql) === TRUE)
        {
            echo "New record created successfully <br/>";
        }
        else
        {
            echo "Error: " . mysqli_error($sql). "<br/>";
        }
        
        
        echo "<p> <a href=personale_professionista.php> Torna alla pagina riservata </a> </p>";
        
 
        mysqli_close($conn);
        
             
        ?>
            
    </body>
    
</html>