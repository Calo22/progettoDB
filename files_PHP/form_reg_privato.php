<html>
    <head>
        
        <title> Registrazione privato </title>
        
    </head>
    
    <body>
        
        <p> <h1 align="center">Registrazione privato</h1> </p>
        
        <form action="landing_reg_privato.php" method="GET" name="form">
            <table border="1" class="blueTable" align="center">
                
                <tr>
                    <td>Nome</td>
                    <td> <input name="nome" id="nome" type="text" /> </td>
                </tr>
                <tr>
                    <td>Cognome</td>
                    <td> <input name="cognome" id="cognome" type="text" /> </td>
                </tr>
                <tr>
                    <td>Data di nascita</td>
                    <td align="center"> <input name="data_nascita" id="data_nascita" type="date" /> </td>
                </tr>
                <tr>
                    <td>Residenza</td>
                    <?php
                        include "picklist_comune.php";
                    ?>
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
                    <td>Cerco lavoro</td>
                    <td> <input name="scelta" id="cerco" type="radio" value="cerco" /> </td>
                </tr>
                <tr>
                    <td>Voglio un servizio</td>
                    <td> <input name="scelta" id="voglio_servizio" type="radio" value="voglio" /> </td>
                </tr>
                <tr>
                    <td align="center"> <input name="reset" type="reset" value="CANCELLA" /></td>
                    <td align="center"> <input name="submit" type="submit" value="INVIA"/> </td>
                </tr>
            </table>
            
        </form>
        
    </body>
    
    
</html>