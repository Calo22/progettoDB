<html>
    
    <head>
        <title>Landing page aggiungi recensione</title>
    </head>
    
    <body>
        
        <?php
        include "db.php";
        
        $id_servizio = $_GET["id_servizio"];
        $recensione = $_GET["recensione"];
        $id_recensione = $_GET["id_recensione"];
        $submit = $_GET["submit"];
        
        
   
                   
        if ($submit == "INVIA")
        {
            $sql = mysqli_prepare($conn, "INSERT INTO Recensione(Servizio, Cliente, Descrizione) VALUES (?,?,?)");
        
            mysqli_stmt_bind_param($sql, 'iis', $id_servizio, $_COOKIE['id_cliente'], $recensione);
        
            if (mysqli_stmt_execute($sql) === TRUE)
            {
                echo "New record created successfully <br/>";
            }
            else
            {
                echo "Error: " . mysqli_error($sql) . "<br/>";
            }
        }
        
        
        
        if ($submit == "MODIFICA EFFETTUATA!")
        {
            $sql = "update Recensione set Descrizione = '$recensione' where Id_recensione = $id_recensione";
            $result = mysqli_query($conn, $sql);
            
            if($result)
            {
                echo "<p>Modifica effettuata correttamente!</p>";
            }
            else
                echo "<p>Modifica NON andata a buon fine</p>";

        }
        
        
        
        
        echo "<p><a href=personale_privato.php> Torna alla pagina riservata </a></p>";
      
    

        mysqli_close($conn);
        
             
        ?>
            
    </body>
    
</html>