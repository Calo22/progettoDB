<html>
    
    <head>
        <title>Landing page invio richiesta prestazione</title>
    </head>
    
    <body>
        
        <?php
        include "db.php";
        
        $id_servizio = $_GET["servizio"];
        $status = "In attesa";
        
        
   
                   
        
        $sql = mysqli_prepare($conn, "INSERT INTO Prestazione(Cliente, Servizio, Status) VALUES (?,?,?)");
        
        mysqli_stmt_bind_param($sql, 'iis', $_COOKIE['id_cliente'], $id_servizio, $status);
        
        if (mysqli_stmt_execute($sql) === TRUE)
        {
            echo "New record created successfully <br/>";
        }
        else
        {
            echo "Error: " . mysqli_error($sql) . "<br/>";
        }
        
        echo "<p><a href=personale_privato.php> Torna alla pagina riservata </a></p>";
      
    
        
      
        mysqli_close($conn);
        
             
        ?>
            
    </body>
    
</html>