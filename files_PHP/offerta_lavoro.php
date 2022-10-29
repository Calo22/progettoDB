<html>
    <head>
        
        <title> Offerta lavoro </title>
        
    </head>
    
    <body>
        
        <p> <h1>Ricerca potenziale dipendente</h1> </p>
        
        <form action="landing.php" method="GET" name="form">
            <table border="1" class="blueTable">
                 <tr>
                    <td>Nome</td>
                    <td> <input name="nome" id="nome" type="text" /> </td>
                </tr>
                <tr>
                    <td>Cognome</td>
                    <td> <input name="cognome" id="cognome" type="text" /> </td>
                </tr>
                <tr>
                    <td>Titolo di studio</td>
                    <td> <input name="titolo" id="titolo" type="text" /> </td>
                </tr>
                <tr>
                    <td>Qualifica e/o certificato</td>
                    <td> <input name="qualifica" id="qualifica" type="text" /> </td>
                </tr>
                <tr>
                    <td>Settore</td>
                    <?php
                        include "picklist_settore.php";
                    ?>
                </tr>
                <tr>
                    <td>Esperienza passata</td>
                    <td> <textarea name="esperienza" id="esperienza" rows="10"></textarea> </td>
                </tr>
                <tr>
                    <td>Disponibilità allo spostamento</td>
                    <td> <input name="disponibilita" id="si" type="radio" value="si" /> </td>
                </tr>
                <tr>
                    <td align="center"> <input name="reset" type="reset" value="CANCELLA" /></td>
                    <td align="center"> <input name="submit" type="submit" value="RICERCA"/> </td>
                </tr>
            </table>
            
        </form>
        
    </body>
    
    
</html>