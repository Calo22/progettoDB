<html>
    
    <head>
        <title>Landing page scelta Candidato/Cliente</title>
    </head>
    
    <body>
        
        <?php
        include "db.php";
        
        if (isset($_GET["candidato"]))
        {
            
            $sql = mysqli_prepare($conn, "INSERT INTO Candidato(Privato)
                              VALUES (?)");
        
            mysqli_stmt_bind_param($sql, 'i', $_COOKIE["id_privato"]);           
        
            if (mysqli_stmt_execute($sql) === TRUE)
            {
                echo "New record created successfully <br/>";
            }
            else
            {
                echo "Error: " . mysqli_error($sql). "<br/>".
                    "Questo utente è già un candidato! <br/>";
            }
        
        }
        
        
        if (isset($_GET["cliente"]))
        {
            
            $sql = mysqli_prepare($conn, "INSERT INTO Cliente(Privato)
                              VALUES (?)");
        
            mysqli_stmt_bind_param($sql, 'i', $_COOKIE["id_privato"]);           
        
            if (mysqli_stmt_execute($sql) === TRUE)
            {
                echo "New record created successfully <br/>";
            }
            else
            {
                echo "Error: " . mysqli_error($sql). "<br/>".
                    "Questo utente è già un cliente! <br/>";
            }
        
        }
        
        
        echo "<p> <a href=personale_privato.php> Torna alla pagina riservata </a> </p>";
        
     
        mysqli_close($conn);
        
             
        ?>
            
    </body>
    
</html>