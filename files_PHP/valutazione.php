<html>
    <head>
        <title> Valutazione servizio</title>
    </head>
    <body>
        <?php
        include "db.php";
        
        $id_servizio = $_GET["id_servizio"];
				
        
        $sql = "select Id_recensione, Recensione.Descrizione as Recensione, Id_servizio, Nome_societa,
                Settore.Nome_settore as Settore, Servizio.Descrizione as Descrizione, Prezzo, Disponibilita
                from Prestazione join Cliente on Prestazione.Cliente = Cliente.Id_cliente and
                Prestazione.Cliente = $_COOKIE[id_cliente] and Status = 'Terminata' and Prestazione.Servizio = $id_servizio
                join Servizio on Prestazione.Servizio = Servizio.Id_servizio join Professionista
                on Servizio.Professionista = Professionista.Id_professionista join Settore
                on Professionista.Settore = Settore.Id_settore left join Recensione
                on Recensione.Cliente = Cliente.Id_cliente and Recensione.Servizio = Servizio.Id_servizio";
                
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0)
        {
                echo "<table border='1' class='blueTable' align = 'center'>".
                    "<th colspan=8>SERVIZIO DA VALUTARE</th>".
                    "<tr> <th> ID servizio </th> <th> Nome azienda </th> <th> Settore </th> <th> Descrizione </th>".
                    "<th> Prezzo </th> <th> Disponibilità </th> </tr>";

                
                $row = mysqli_fetch_assoc($result);
                
                        echo "<tr> <td align='center'>".
                        $row["Id_servizio"] ."</td> <td>". $row["Nome_societa"] ."</td> <td>".
                        $row["Settore"] ."</td> <td>". $row["Descrizione"] ."</td> <td>".
                        $row["Prezzo"] ."</td> <td>". $row["Disponibilita"] ."</td> </tr>";
  
                echo "</table> <br>";
        }
        else
        {
            echo "<h1> Servizio non trovato. </h1>";

        }
        
        
        $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0)
            {
 
                while ($row = mysqli_fetch_assoc($result))
                {
                    if($row["Id_recensione"] != NULL)
                    {
                        echo "<table border='1' class='blueTable' align = 'center'>".
                        "<th colspan=4>RECENSIONE</th>".
                        "<tr> <td>". $row["Recensione"] ."</td> </tr>".
                        "</table> <br>";
                    }

                }
                
            
            
            
				echo "<form action='landing_valutazione.php' method='GET' name='form'>
					 <table border='1' class='blueTable' align='center'>           
						<tr>
							<input name='id_servizio' type='number' value=$id_servizio hidden>
							<td>Valutazione qualità/prezzo</td>
							<td> <input name='valutazione_qp' id='valutazione_qp'
									type='number' min='0' max='5' step='0.5' required /> <br>
							</td>
						</tr>                 
						<tr>
							<td>Valutazione disponibilità professionista</td>
							<td> <input name='valutazione_dp' id='valutazione_dp'
									type='number' min='0' max='5' step='0.5' required /> <br>
							</td>
						</tr>                
						<tr>
							<td>Valutazione consigliato</td>
							<td><input name='valutazione_c' id='valutazione_c'
									type='number' min='0' max='5' step='0.5' required /> <br>
							</td>
						</tr>
						 <tr>
							<td align='center'> <input name='reset' type='reset' value='CANCELLA' /></td>
							<td align='center'> <input name='submit' type='submit' value='VALUTA'/> </td>
						</tr>
					</table>
					
				</form>";
            
			}
            
        echo "<p><a href=personale_privato.php> Torna alla pagina riservata </a></p>";
        

        

        mysqli_close($conn);

        
        ?>
    </body>
</html>





