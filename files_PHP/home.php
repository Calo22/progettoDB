<html>
    <head>
        <title> Pagina iniziale</title>
    </head>
    <body>
        <?php
        // unset cookies
        if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-1000);
        setcookie($name, '', time()-1000, '/');
                }
        }
        ?>
        <form action="landing_accesso.php" method="GET" name="form">
            <table align="center">
                <th colspan="2"> LOGIN </th>
                <tr>
                    <td align="center"> eMail: <input name="email" id="email" type="email" /> </td>
                </tr>
                <tr>
                    <td> <input name="reset" type="reset" value="CANCELLA" /></td>
                    <td> <input name="submit" type="submit" value="ACCEDI" /></td>                    
                </tr>
            </table>            
        </form>
        
        <table border="1" cellpadding=20 align="center">
            <th colspan="2"> REGISTRATI </th>
            <tr>
                <td> <a href="form_reg_azienda.php"> AZIENDA </a> </td>
                <td> <a href="form_reg_privato.php"> PRIVATO </a> </td>
            </tr>
        </table>
    </body>
    
</html>