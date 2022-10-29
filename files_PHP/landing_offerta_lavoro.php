<html>
    
    <head>
        <title>Landing page offerta lavoro</title>
    </head>
    
    <body>
        
        <?php
        include "db.php";
        
        
        $id_candidato = $_GET["id_candidato"];
        $id_pos = $_GET["id_pos"];
        $status = "In attesa";
        
        echo $id_candidato. " " .$id_pos."<br/>";            
            
		$sql = "select * from Candidato where Id_candidato = $id_candidato";
		
		$result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0)
		{
        
			$sql = mysqli_prepare($conn, "INSERT INTO Offerta_lavoro(Professionista, Candidato, Posizione_aperta, Status)
								  VALUES (?, ?, ?, ?)");
			
			mysqli_stmt_bind_param($sql, 'iiis', $_COOKIE["id_professionista"], $id_candidato, $id_pos, $status);           
			
			if (mysqli_stmt_execute($sql) === TRUE)
			{
				echo "New record created successfully <br/>";
			}
			else
			{
				echo "Error: " . mysqli_error($sql). "<br/>";
			}
		
		}
		else
			echo "ID del candidato non presente nel database.\n\n";
        
        
        echo "<p> <a href=personale_professionista.php> Torna alla pagina riservata </a> </p>";
        
     
        mysqli_close($conn);
        
             
        ?>
            
    </body>
    
</html>