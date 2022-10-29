<html>
    <head>
        
        <title> Registrazione azienda </title>
        
    </head>
    
    <body>
        
        <p> <h1 align="center">Registrazione azienda</h1> </p>
        
        <form action="landing_reg_azienda.php" method="GET" name="form">
            <table border="1" class="blueTable" align="center">
                
                <tr>
                    <td>Nome società</td>
                    <td> <input name="nome" id="nome" type="text" /> </td>
                </tr>
                <tr>
                    <td>Settore</td>
                    <?php
                        include "picklist_settore.php";
                    ?>
                </tr>
                <tr>
                    <td>Sede</td>
                    <?php
                        include "picklist_comune.php";
                    ?>
                </tr>
                <tr>
                    <td>Intestatario</td>
                    <td> <input name="intestatario" id="intestatario" type="text" /> </td>
                </tr>
                <tr>
                    <td>Descrizione società</td>
                    <td> <textarea name="descrizione" id="descrizione" rows="10"></textarea> </td>
                </tr>
                <tr>
                    <td>Telefono</td>
                    <td> <input name="telefono" id="telefono" type="tel" /> </td>
                </tr>
                <tr>
                    <td>eMail</td>
                    <td> <input name="email" id="email" type="email" /> </td>
                </tr>
                <tr>
                    <td>Datore di lavoro</td>
                    <td> <input name="scelta" id="datore" type="radio" value="datore" /> </td>
                </tr>
                <tr>
                    <td>Fornitore servizi</td>
                    <td> <input name="scelta" id="fornitore" type="radio" value="fornitore" /> </td>
                </tr>
                <tr>
                    <td align="center"> <input name="reset" type="reset" value="CANCELLA" /></td>
                    <td align="center"> <input name="submit" type="submit" value="INVIA"/> </td>
                </tr>
            </table>
            
        </form>
        
    </body>
    
    
</html>