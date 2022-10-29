<html>
    <head>
        
        <title> Ricerca servizio</title>
        
    </head>
    
    <body>
        
        <p> <h1>Ricerca servizio</h1> </p>
        
        <form action="landing_ricerca_servizio.php" method="GET" name="form">
            <table border="1" class="blueTable">
                
                <tr>
                    <td>Valutazione generale(media)</td>
                    <td> Da: <input name="valutazione_gen_min" id="valutazione_gen_min"
                            type="number" min="0" max="4.5" step="0.5" /> <br>
                         A: <input name="valutazione_gen_max" id="valutazione_gen_max"
                            type="number" min="0.5" max="5" step="0.5" />
                    </td>
                </tr>                 
                <tr>
                    <td>Valutazione qualità/prezzo(media)</td>
                    <td> Da: <input name="valutazione_qp_min" id="valutazione_qp_min"
                            type="number" min="0" max="4.5" step="0.5" /> <br>
                         A: <input name="valutazione_qp_max" id="valutazione_qp_max"
                            type="number" min="0.5" max="5" step="0.5" />
                    </td>
                </tr>                 
                <tr>
                    <td>Valutazione disponibilità professionista(media)</td>
                    <td> Da: <input name="valutazione_dp_min" id="valutazione_dp_min"
                            type="number" min="0" max="4.5" step="0.5" /> <br>
                         A: <input name="valutazione_dp_max" id="valutazione_dp_max"
                            type="number" min="0.5" max="5" step="0.5" />
                    </td>
                </tr>                
                <tr>
                    <td>Valutazione consigliato(media)</td>
                    <td> Da: <input name="valutazione_c_min" id="valutazione_c_min"
                            type="number" min="0" max="4.5" step="0.5" /> <br>
                         A: <input name="valutazione_c_max" id="valutazione_c_max"
                            type="number" min="0.5" max="5" step="0.5" />
                    </td>
                </tr>
                <tr>
                    <td>Settore</td>
                    <?php
                        include "picklist_settore_ricerca.php";
                    ?>
                </tr>
                <tr>
                    <td>Disponibilità</td>
                    <td> <input name="disponibilita" id="immediata" type="radio" value="Immediata" />
                            <label for="immediata">Immediata</label><br>
                         <input name="disponibilita" id="non_specificato" type="radio" value="" />
                            <label for="non_specificato">INDIFFERENTE</label>
                    </td>
                </tr>
                <tr>
                    <td>Prezzo</td>
                    <td> Da: <input name="prezzo_min" id="prezzo_min" type="number" min="0" /> <br>
                         A: <input name="prezzo_max" id="prezzo_max" type="number" min="0" />
                    </td>
                </tr>
                <tr>
                    <td>ID professionista</td>
                    <td> <input name="id_pro" id="id_pro" type="number" min="0" /> </td>
                </tr>
                <tr>
                    <td>Nome azienda</td>
                    <td> <input name="azienda" id="azienda" type="text" /> </td>
                </tr>
                
                <tr>
                    <td align="center"> <input name="reset" type="reset" value="CANCELLA" /></td>
                    <td align="center"> <input name="submit" type="submit" value="RICERCA"/> </td>
                </tr>
            </table>
            
        </form>
        
        <p> <a href=personale_privato.php> Torna alla pagina riservata </a> </p>

        
    </body>
    
    
</html>