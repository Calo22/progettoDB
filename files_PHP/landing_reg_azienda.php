<html>
    
    <head>
        <title>Landing page per registrazione azienda</title>
    </head>
    
    <body>
        
        <?php
        include "db.php";
        
        $nome = $_GET["nome"];
        $settore = $_GET["settore"];
        $id_comune = $_GET["comune"];
        $intestatario = $_GET["intestatario"];
        $descrizione = $_GET["descrizione"];
        $telefono = $_GET["telefono"];
        $email = $_GET["email"];
        $scelta = $_GET["scelta"];
        
        $categoria = "Professionista";
        
        echo $nome. " " .$settore. " " .$id_comune. " " .$intestatario. " " .$descrizione. " "
            .$telefono. " " .$email. " " .$scelta ."<br/>";
            
            
        
        $sql = mysqli_prepare($conn, "INSERT INTO Utente(Categoria) VALUES (?)");
        
        mysqli_stmt_bind_param($sql, 's', $categoria);
        
        if (mysqli_stmt_execute($sql) === TRUE)
        {
            echo "New record created successfully <br/>";
        }
        else
        {
            echo "Error: " . mysqli_error($sql);
        } 
      
        
        if ($scelta == "datore")
        {
            $datore = 1;
            $fornitore = 0;          
        }
        else
        {
            $datore = 0;
            $fornitore = 1;

        }
        
        $sql = "select Citta from Comune where Id_comune = $id_comune";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        
        $comune = $row["Citta"];
        
        echo $comune . "<br>";
        
        $sql = "SELECT max(Id_utente) FROM Utente";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($result);
        
        echo $row[0]. "<br/>";
        setcookie("id_utente", $row[0]);
        
        
        $sql = mysqli_prepare($conn, "INSERT INTO Professionista(Utente, Descrizione_societa, Datore_lavoro,
                              Fornitore_servizi, Sede, Settore, Nome_societa, Intestatario) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        
        mysqli_stmt_bind_param($sql, 'isiisiss', $row[0], $descrizione, $datore, $fornitore, $comune, $settore, $nome, $intestatario);           
        
        if (mysqli_stmt_execute($sql) === TRUE)
        {
            echo "New record created successfully <br/>";
        }
        else
        {
            echo "Error: " . mysqli_error($sql);
        }
        
        
        $sql = mysqli_prepare($conn, "INSERT INTO Contatto(Utente, Telefono, eMail) VALUES (?, ?, ?)");
        
        mysqli_stmt_bind_param($sql, 'iis', $row[0], $telefono, $email);
        
        if (mysqli_stmt_execute($sql) === TRUE)
        {
            echo "New record created successfully <br/>";
        }
        else
        {
            echo "Error: " . mysqli_error($sql);
        }
        
        $sql = "SELECT max(Id_professionista) FROM Professionista";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($result);
        
        echo $row[0]. "<br/>";
        setcookie("id_professionista", $row[0]);
        
        
         echo "<p> <a href=personale_professionista.php> Vai alla pagina riservata del professionista </a> </p>";

        
        mysqli_close($conn);
        
             
        ?>
            
    </body>
    
</html>