<?php
			//connessione a MySQL
				$conn = mysqli_connect("localhost", "root", "");
			//verifica di riuscita della connessione 
				if (!$conn)
				{
					echo "Problemi nello stabilire la connessione.";
				}
			//verifica di riuscito accesso al database
				if (!mysqli_select_db($conn, "applicazione1"))
				{
					mysqli_close($conn);
					echo "Errore di accesso al database applicazione1.";			
				}

?>