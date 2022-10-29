<html>
    
    <head>
        <title> Landing Accesso </title>
    </head>
    
    <body>
        
        <?php
        include "db.php";
        
        $email = $_GET["email"];
        
        if ($email != "")
        {
            $sql = "select Id_utente, Categoria from Contatto join Utente on Contatto.eMail = '$email' and
                Contatto.Utente = Utente.Id_utente";
            
			$result = mysqli_query($conn, $sql);
            
			if (mysqli_num_rows($result) > 0)
			{
                
                $row = mysqli_fetch_assoc($result);
                setcookie("id_utente", $row["Id_utente"]);
                
				echo "Credenziali corrette. Benvenuto utente numero ". $row['Id_utente'] ."! Puoi proseguire: ";

                              
                    if ($row["Categoria"] == "Privato")
					{
						$sql = "select Id_privato from Privato where Utente = $row[Id_utente]"; 
						
						$result = mysqli_query($conn, $sql);
						
						$row = mysqli_fetch_assoc($result);
						
						setcookie("id_privato", $row["Id_privato"]);
						
						
						
						$sql = "select Id_candidato from Candidato where Privato = $row[Id_privato]"; 
						
						$result = mysqli_query($conn, $sql);
						
						if (mysqli_num_rows($result) > 0)
						{
							$row1 = mysqli_fetch_assoc($result);
							setcookie("id_candidato", $row1["Id_candidato"]);

						}
						
						
						
						$sql = "select Id_cliente from Cliente where Privato = $row[Id_privato]"; 
						
						$result = mysqli_query($conn, $sql);
						
						if (mysqli_num_rows($result) > 0)
						{
							$row1 = mysqli_fetch_assoc($result);
							setcookie("id_cliente", $row1["Id_cliente"]);

						}
												
						

                        echo "<a href=personale_privato.php>Vai alla pagina personale</a>";
					}
                    else
					{
						$sql = "select Id_professionista from Professionista where Utente = $row[Id_utente]"; 
						
						$result = mysqli_query($conn, $sql);
						
						$row = mysqli_fetch_assoc($result);
						
						setcookie("id_professionista", $row["Id_professionista"]);
						
                        echo "<a href=personale_professionista.php>Vai alla pagina personale</a>";
						
					}
                
                
			}
            else
            {
                echo "<h1> Credenziali inserite non presenti nel database. </h1>".
                    "<a href=home.php>Torna indietro</a>";
            }
        }
        
        else
        {
            echo "<h1> Immettere le credenziali. </h1>".
                    "<a href=home.php>Torna indietro</a>";
        }
        
        
        mysqli_close($conn);
        
             
        ?>
            
    </body>
    
</html>