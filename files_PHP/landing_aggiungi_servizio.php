<html>
    
    <head>
        <title>Landing page aggiungi servizio</title>
    </head>
    
    <body>
        
        <?php
        include "db.php";
        
    
        $descrizione = $_GET["descrizione"];
        $prezzo = $_GET["prezzo"];
        
        
        echo $descrizione. " " .$prezzo. "<br/>";            
            
        if (!isset($_GET["disponibilita"]))
		{
			$sql = mysqli_prepare($conn, "INSERT INTO Servizio(Professionista, Descrizione, Prezzo)
                              VALUES (?, ?, ?)");
        
			mysqli_stmt_bind_param($sql, 'isi', $_COOKIE["id_professionista"], $descrizione, $prezzo);
		}			
		
		if (isset($_GET["disponibilita"]))
		{
			$disponibilita = $_GET["disponibilita"];

			$sql = mysqli_prepare($conn, "INSERT INTO Servizio(Professionista, Descrizione, Prezzo, Disponibilita)
                              VALUES (?, ?, ?, ?)");
        
			mysqli_stmt_bind_param($sql, 'isis', $_COOKIE["id_professionista"], $descrizione, $prezzo, $disponibilita);
		}	
		
		
		
        
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