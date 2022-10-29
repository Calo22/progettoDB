<html>
    
    <head>
        <title> Landing page ricerca servizio</title>
    </head>
    
    <body>
        
        <?php
        include "db.php";

        
            if($_GET["valutazione_gen_min"] != NULL)
            {
                $valutazione_gen_da = $_GET["valutazione_gen_min"];
                
                $valutazione_gen_min = "and Media_generale >= $valutazione_gen_da";
            }
            else
                $valutazione_gen_min="";
                
                
            
            if($_GET["valutazione_gen_max"] != NULL)
            {
                $valutazione_gen_a = $_GET["valutazione_gen_max"];
                
                $valutazione_gen_max = "and Media_generale <= $valutazione_gen_a";
            }
            else
                $valutazione_gen_max="";
                
                
            
            if($_GET["valutazione_qp_min"] != NULL)
            {
                $valutazione_qp_da = $_GET["valutazione_qp_min"];
                
                $valutazione_qp_min = "and Media_Rapporto_qp >= $valutazione_qp_da";
            }
            else
                $valutazione_qp_min="";
                
                
                
            if($_GET["valutazione_qp_max"] != NULL)
            {
                $valutazione_qp_a = $_GET["valutazione_qp_max"];
                
                $valutazione_qp_max = "and Media_Rapporto_qp <= $valutazione_qp_a";
            }
            else
                $valutazione_qp_max="";
                
            
             
            if($_GET["valutazione_dp_min"] != NULL)
            {
                $valutazione_dp_da = $_GET["valutazione_dp_min"];
                
                $valutazione_dp_min = "and Media_Disponibilita_pro >= $valutazione_dp_da";
            }
            else
                $valutazione_dp_min ="";
                
                
            
            if($_GET["valutazione_dp_max"] != NULL)
            {
                $valutazione_dp_a = $_GET["valutazione_dp_max"];
                
                $valutazione_dp_max = "and Media_Disponibilita_pro <= $valutazione_dp_a";
            }
            else
                $valutazione_dp_max ="";
                
                
                
            if($_GET["valutazione_c_min"] != NULL)
            {
                $valutazione_c_da = $_GET["valutazione_c_min"];
                
                $valutazione_c_min = "and Media_consigliato >= $valutazione_c_da";
            }
            else
                $valutazione_c_min ="";
                
                
                
            if($_GET["valutazione_c_max"] != NULL)
            {
                $valutazione_c_a = $_GET["valutazione_c_max"];
                
                $valutazione_c_max = "and Media_consigliato <= $valutazione_c_a";
            }
            else
                $valutazione_c_max ="";
                
                
                
            if($_GET["settore"] != NULL)
            {
                $settore = $_GET["settore"];
                
                $settore_sql = "and Settore.Id_settore = $settore";
            }
            else
                $settore_sql ="";
                
                
                
            if(isset($_GET["disponibilita"]))
            {
                $disponibilita = $_GET["disponibilita"];
                
                $disponibilita_sql = "and Servizio.Disponibilita = '$disponibilita'";
            }
            else
                $disponibilita_sql ="";
                
                
            
            if($_GET["prezzo_min"] != NULL)
            {
                $prezzo_da = $_GET["prezzo_min"];
                
                $prezzo_min = "and Prezzo >= $prezzo_da";
            }
            else
                $prezzo_min ="";
                
                
            
            if($_GET["prezzo_max"] != NULL)
            {
                $prezzo_a = $_GET["prezzo_max"];
                
                $prezzo_max = "and Prezzo <= $prezzo_a";
            }
            else
                $prezzo_max ="";
                
                
                
            if($_GET["id_pro"] != NULL)
            {
                $id_pro = $_GET["id_pro"];
                
                $id_pro_sql = "and Professionista.Id_professionista = $id_pro";
            }
            else
                $id_pro_sql ="";
                
                
                
            if($_GET["azienda"] != NULL)
            {
                $azienda = $_GET["azienda"];
                
                $azienda_sql = "and Professionista.Nome_societa = '$azienda'";
            }
            else
                $azienda_sql ="";
                
                
            echo $valutazione_gen_min . $valutazione_gen_max . $valutazione_qp_min . $valutazione_qp_max .
                $valutazione_dp_min . $valutazione_dp_max . $valutazione_c_min . $valutazione_c_max . $settore_sql . $disponibilita_sql .
                $prezzo_min . $prezzo_max . $id_pro_sql . $azienda_sql;
            
                
            $sql = "select distinct Id_servizio, Nome_societa, Settore.Nome_settore as Settore, Descrizione, Prezzo, Disponibilita,
                Media_Rapporto_qp, Media_Disponibilita_pro, Media_consigliato, Media_generale from Professionista join Servizio
                on Professionista.Id_professionista = Servizio.Professionista";
     
            
            
            if ($valutazione_gen_min != NULL || $valutazione_gen_max != NULL || $valutazione_qp_min != NULL ||
                $valutazione_qp_max != NULL || $valutazione_dp_min != NULL || $valutazione_dp_max != NULL ||
                $valutazione_c_min != NULL || $valutazione_c_max != NULL)
            {
                $sql .= " $disponibilita_sql $prezzo_min $prezzo_max $id_pro_sql $azienda_sql join Settore on Settore.Id_settore = Professionista.Settore $settore_sql join Valutazione on Servizio.Id_servizio = Valutazione.Servizio
                    join Rapporto_QualitaPrezzo_medio_vista on Rapporto_QualitaPrezzo_medio_vista.Servizio = Servizio.Id_servizio $valutazione_qp_min $valutazione_qp_max
                    join Disponibilita_professionista_media_vista on Disponibilita_professionista_media_vista.Servizio = Servizio.Id_servizio $valutazione_dp_min $valutazione_dp_max
                    join Consigliato_media_vista on Consigliato_media_vista.Servizio = Servizio.Id_servizio $valutazione_c_min $valutazione_c_max join Generale_media_vista
                    on Generale_media_vista.Servizio = Servizio.Id_servizio $valutazione_gen_min $valutazione_gen_max";
            }
            else
            {
                $sql .= " $disponibilita_sql $prezzo_min $prezzo_max $id_pro_sql $azienda_sql
                    join Settore on Settore.Id_settore = Professionista.Settore $settore_sql left join Valutazione on Servizio.Id_servizio = Valutazione.Servizio
                    left join Rapporto_QualitaPrezzo_medio_vista on Rapporto_QualitaPrezzo_medio_vista.Servizio = Servizio.Id_servizio
                    left join Disponibilita_professionista_media_vista on Disponibilita_professionista_media_vista.Servizio = Servizio.Id_servizio
                    left join Consigliato_media_vista on Consigliato_media_vista.Servizio = Servizio.Id_servizio left join Generale_media_vista
                    on Generale_media_vista.Servizio = Servizio.Id_servizio";
            }
            
            
            $result = mysqli_query($conn, $sql);
            
        
            if (mysqli_num_rows($result) > 0)
            {
                echo "<table border='1' class='blueTable'>".
                    "<th colspan=11>SERVIZI</th>".
                    "<tr> <th> ID servizio </th> <th> Nome azienda </th> <th> Settore </th> <th> Descrizione </th>".
                    "<th> Prezzo </th> <th> Disponibilità </th> <th> Valutazione media Qualità/Prezzo </th> <th> Valutazione media disponibilità professionista </th>".
                    "<th> Valutazione media servizio consigliato </th> <th> Valutazione media generale </th> </tr>";

                
                while ($row = mysqli_fetch_assoc($result))
                {
                   
                    echo "<form action='landing_richiesta_servizio.php' method='GET' name='form'> <tr> <td align='center'> <input name='servizio' type='number' value=$row[Id_servizio] hidden>". $row["Id_servizio"] ."</td> <td>".
                    $row["Nome_societa"] ."</td> <td>". $row["Settore"] ."</td> <td>". $row["Descrizione"] ."</td> <td>". $row["Prezzo"] ."</td> <td>". $row["Disponibilita"] ."</td>".
                    "<td>". $row["Media_Rapporto_qp"] ."</td> <td>". $row["Media_Disponibilita_pro"] ."</td> <td>". $row["Media_consigliato"] ."</td> <td>". $row["Media_generale"] ."</td>".
                    "<td align='center'> <input name='submit' type='submit' value='VOGLIO IL SERVIZIO!'/> </td> </tr> </form>";
                }
            
            }   
             
               
            
         
            
            
            echo "</table> <br>";


			echo "<p> <a href=ricerca_servizio.php> Torna a ricerca servizio </a> </p>";
			echo "<p> <a href=personale_privato.php> Torna alla pagina riservata </a> </p>";
            
        mysqli_close($conn);
        
        ?>
    
    </body>
    
</html>