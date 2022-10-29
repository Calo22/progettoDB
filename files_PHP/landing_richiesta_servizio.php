<html>
    
    <head>
        <title>Landing page richiesta servizio</title>
    </head>
    
    <body>
        
        <?php
        include "db.php";
        
        
        $servizio = $_GET["servizio"];
        $status = 'In attesa';
        
        echo $servizio. "<br/>";            
            
        
        $sql = mysqli_prepare($conn, "INSERT INTO Prestazione(Cliente, Servizio, Status)
                              VALUES (?, ?, ?)");
        
        mysqli_stmt_bind_param($sql, 'iis', $_COOKIE["id_cliente"], $servizio, $status);           
        
        if (mysqli_stmt_execute($sql) === TRUE)
        {
            echo "New record created successfully <br/>";
        }
        else
        {
            echo "Error: " . mysqli_error($sql). "<br/>";
        }
        
        
        echo "<p> <a href=personale_privato.php> Torna alla pagina riservata </a> </p>";
        
      
        mysqli_close($conn);
        
             
        ?>
            
    </body>
    
</html>