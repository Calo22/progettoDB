<html>
    
    <head>
        <title>Landing page per registrazione privato</title>
    </head>
    
    <body>
        
        <?php
        include "db.php";
        
        $nome = $_GET["nome"];
        $cognome = $_GET["cognome"];
        $data_nascita = $_GET["data_nascita"];
        $id_comune = $_GET["comune"];
        $telefono = $_GET["telefono"];
        $email = $_GET["email"];
        $scelta = $_GET["scelta"];
        
        $categoria = "Privato";
        
        echo $nome. " " .$cognome. " " .$data_nascita. " " .$id_comune. " " .$telefono. " "
            .$email. " " .$scelta ."<br/>";
                      
        
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

    
        $sql = mysqli_prepare($conn, "INSERT INTO Privato(Utente, Nome, Cognome, Data_nascita, Residenza)
                              VALUES (?, ?, ?, ?, ?)");
        
        mysqli_stmt_bind_param($sql, 'issss', $row[0], $nome, $cognome, $data_nascita, $comune);           
        
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
        
        $sql = "SELECT max(Id_privato) FROM Privato";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($result);
        
        echo $row[0]. "<br/>";
        setcookie("id_privato", $row[0]);

           
        if ($scelta == "cerco")
        {
            $sql = mysqli_prepare($conn, "INSERT INTO Candidato(Privato) VALUES (?)");
        
            mysqli_stmt_bind_param($sql, 'i', $row[0]);
        
            if (mysqli_stmt_execute($sql) === TRUE)
            {
                echo "New record created successfully <br/>";
                
                $sql = "SELECT max(Id_candidato) FROM Candidato";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_row($result);
        
                echo $row[0]. "<br/>";
                setcookie("id_candidato", $row[0]);
                
                echo "<p> <b> Clicca <a href=cerco_lavoro_info.php> QUI </a> per aggiungere altre informazioni su di te".
                    " o procedere direttamente alla ricerca di un impiego su misura.</b> </p>";
            }
            else
            {
                echo "Error: " . mysqli_error($sql);
            }
        }
        else
        {
            $sql = mysqli_prepare($conn, "INSERT INTO Cliente(Privato) VALUES (?)");
        
            mysqli_stmt_bind_param($sql, 'i', $row[0]);
        
            if (mysqli_stmt_execute($sql) === TRUE)
            {
                echo "New record created successfully <br/>";
                
                $sql = "SELECT max(Id_cliente) FROM Cliente";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_row($result);
        
                echo $row[0]. "<br/>";
                setcookie("id_cliente", $row[0]);
                
                echo "<p> <b> Clicca <a href=ricerca_servizio.php> QUI </a> per cercare un servizio.</b> </p>";
            }
            else
            {
                echo "Error: " . mysqli_error($sql);
            }
        }

        
      
        mysqli_close($conn);
        
             
        ?>
            
    </body>
    
</html>