<html>
    <head>
        
        <title> Aggiungi posizione aperta </title>
        
    </head>
    
    <body>
        
        <p> <h1>Aggiungi posizione aperta</h1> </p>
        
        <form action="landing_pos_aperta.php" method="GET" name="form">
            <table border="1" class="blueTable">                
                <tr>
                    <td>Ruolo</td>
                    <td> <input name="ruolo" id="ruolo" type="text" required /> </td>
                </tr>
                <tr>
                    <td>Descrizione</td>
                    <td> <textarea name="descrizione_pos" id="descrizione_pos" rows="15" cols="40" required ></textarea> </td>
                </tr>
                <tr>
                    <td>Stipendio mensile</td>
                    <td> <input type="number" name="stipendio" id="stipendio" min="0" required /> </td>
                </tr>
                <tr>
                    <td>Contratto</td>
                    <td> <input name="tipo_contratto" id="indeterminato" type="radio" value="Tempo indeterminato" />
                            <label for="indeterminato">INDETERMINATO</label><br>
                         <input name="tipo_contratto" id="determinato" type="radio" value="Tempo determinato" />
                            <label for="determinato">DETERMINATO</label><br>
                    </td>
                </tr>
                <tr>
                    <td>Dettagli contratto offerto</td>
                    <td> <textarea name="descrizione_contratto" id="descrizione_contratto" rows="10" cols="40"></textarea> </td>

                </tr>
                <tr>
                    <td>Città</td>
                    <?php
                        include "picklist_comune.php";
                    ?>
                </tr>
                <tr>
                    <td>Esperienza richiesta</td>
                    <td> <textarea name="esperienza" id="esperienza" rows="20" cols="40" required ></textarea> </td>
                </tr>
                <tr>
                    <td>Posti disponibili</td>
                    <td> <input type="number" name="posti" id="posti" min="1" required /> </td>
                </tr>
                <tr>
                    <td>Qualifica e/o attestato richiesto</td>
                    <td> <input name="qualifica" id="qualifica" type="text" required /> </td>
                </tr>
                <tr>
                    <td>Titolo di studio</td>
                    <td>
                        <select name="titolo" required>
                            <option value=""></option>
                            <option value="elementare">Licenza elementare</option>
                            <option value="media">Licenza Media</option>
                            <option value="superiore">Diploma di scuola superiore</option>
                            <option value="laurea_triennale">Laurea di primo livello</option>
                            <option value="laurea_ciclo_unico">Laurea specialistica a ciclo unico</option>
                            <option value="specialistica">Laurea specialistica</option>
                            <option value="master_livello1">Master di primo livello</option>
                            <option value="master_livello2">Master di secondo livello</option>
                            <option value="dottorato">Dottorato di ricerca</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Dettagli titolo di studio</td>
                    <td> <input name="descrizione_titolo" id="descrizione_titolo" type="text" required /> </td>
                </tr>
                <tr>
                    <td align="center"> <input name="reset" type="reset" value="CANCELLA" /></td>
                    <td align="center"> <input name="submit" type="submit" value="AGGIUNGI"/> </td>
                </tr>
            </table>   
            
        </form>
        
        <p> <h1>Per tornare alla pagina personale clicca <a href=personale_professionista.php>qui</a> </h1> </p>

        
    </body>
    
    
</html>