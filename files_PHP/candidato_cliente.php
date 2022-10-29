<html>
        <head>
            <title> Scelta Candidato/Cliente </title>
        </head>
        
        <body>
            <form action="landing_candidato_cliente.php" method="GET" name="form">
                <table>
                    <tr>
                        <input type="checkbox" name="candidato" value="Candidato">
                        <label> Cerco un impiego</label><br>
                        <input type="checkbox" name="cliente" value="Cliente">
                        <label> Voglio un servizio</label><br>
                    </tr>
                    <tr>
                        <td align="center"> <input name="reset" type="reset" value="CANCELLA" /></td>
                        <td align="center"> <input name="submit" type="submit" value="INVIA"/> </td>
                    </tr>
                </table>
            </form>
            
        </body>
</html>