<html>
    
    <head>
        <title>Landing page invio candidatura</title>
    </head>
    
    <body>
        
        <?php
        include "db.php";
        
        $id_pos = $_GET["id_pos"];
        $status = 'In attesa';
        
 
                   
        
        $sql = mysqli_prepare($conn, "INSERT INTO Candidatura(Posizione_aperta, Candidato, Status) VALUES (?,?,?)");
        
        mysqli_stmt_bind_param($sql, 'iis', $id_pos, $_COOKIE['id_candidato'], $status);
        
        
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