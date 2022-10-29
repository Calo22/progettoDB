<html>
    <head>
        
        <title> Cerco lavoro info</title>
        
    </head>
    
    <body>
        
        <p> <h1>Fornisci più informazioni per trovare più facilmente il lavoro che desideri
                ed essere contattato direttamente dalle aziende.</h1> </p>
        
        <form action="landing_aggiorna_info.php" method="GET" name="preferenza">
            <table border="1" class="blueTable">
                <th colspan="2"> Preferenza occupazione </th>
                <tr>
                    <td>Ruolo ricercato</td>
                    <td> <input name="ruolo_preferito" id="ruolo" type="text" required/> </td>
                </tr>
                <tr>
                    <td>Settore</td>
                    <?php
                        include "picklist_settore.php";
                    ?>
                </tr>
                <tr>
                    <td>Descrizione</td>
                    <td> <textarea name="descrizione" id="descrizione" rows="10"></textarea> </td>                </tr>
                <tr>
                    <td align="center"> <input name="reset" type="reset" value="CANCELLA" /></td>
                    <td align="center"> <input name="submit" type="submit" value="AGGIUNGI"/> </td>
                </tr>
            </table>
        </form>
        
        <form action="landing_aggiorna_info.php" method="GET" name="esperienza">
            <table border="1" class="blueTable">
                <th colspan="2"> Impiego passato </th>
                <tr>
                    <td>Ruolo ricoperto</td>
                    <td> <input name="impiego_passato" id="ruolo" type="text" required/> </td>
                </tr>
                <tr>
                    <td>Presso(in quale azienda?)</td>
                    <td> <input name="azienda" id="azienda" type="text" required /> </td>
                </tr>
                <tr>
                    <td>Settore</td>
                    <?php
                        include "picklist_settore.php";
                    ?>
                </tr>
                <tr>
                    <td>Descrizione</td>
                    <td> <textarea name="descrizione_impiego" id="descrizione" rows="10" required></textarea> </td>                </tr>
                </tr>
                <tr>
                    <td align="center"> <input name="reset" type="reset" value="CANCELLA" /></td>
                    <td align="center"> <input name="submit" type="submit" value="AGGIUNGI"/> </td>
                </tr>
            </table>            
        </form>
        
        <form action="landing_aggiorna_info.php" method="GET" name="titolo">
            <table border="1" class="blueTable">
                <th colspan="2"> Altre informazioni </th>
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
                    <td>Descrizione titolo</td>
                    <td> <input name="descrizione_titolo" type="text" required /> </td>
                </tr>
                <tr>
                    <td align="center"> <input name="reset" type="reset" value="CANCELLA" /></td>
                    <td align="center"> <input name="submit" type="submit" value="AGGIUNGI"/> </td>
                </tr>
            </table>           
        </form>
        
        <form action="landing_aggiorna_info.php" method="GET" name="certificato">
            <table border="1" class="blueTable">
                <th colspan="2"> Altre informazioni </th>
                <tr>
                    <td>Qualifica e/o attestato posseduto</td>
                    <td> <input name="certificato" id="certificato" type="text" required /> </td>
                </tr>
                <tr>
                    <td align="center"> <input name="reset" type="reset" value="CANCELLA" /></td>
                    <td align="center"> <input name="submit" type="submit" value="AGGIUNGI"/> </td>
                </tr>
            </table>           
        </form>
        
        <form action="landing_aggiorna_info.php" method="GET" name="spostamento">
            <table border="1" class="blueTable">
                <th colspan="2"> Altre informazioni </th>
                <tr>
                    <td>Disponibilità allo spostamento</td>
                    <td> <input name="scelta" id="si" type="radio" value="si" />
                            <label for="si">SI</label><br>
                         <input name="scelta" id="no" type="radio" value="no" />
                            <label for="no">NO</label><br>
                         <input name="scelta" id="non_specificato" type="radio" value="" />
                            <label for="non_specificato">Non specificato</label><br>
                    </td>
                </tr>
                <tr>
                    <td align="center"> <input name="reset" type="reset" value="CANCELLA" /></td>
                    <td align="center"> <input name="submit" type="submit" value="AGGIUNGI"/> </td>
                </tr>
            </table>           
        </form>
        
    <p><a href=personale_privato.php>Vai alla pagina riservata</a></p>
        
    <p> <h1>Quando hai finito di aggiornare le tue informazioni, puoi procedere alla ricerca
            del tuo lavoro cliccando <a href="ricerca_lavoro.php">QUI</a>. </h1> </p>
        
        
    </body>
    
    
</html>