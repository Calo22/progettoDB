<html>
    <head>
        
        <title> Aggiungi servizio </title>
        
    </head>
    
    <body>
        
        <p> <h1>Aggiungi servizio</h1> </p>
        
        <form action="landing_aggiungi_servizio.php" method="GET" name="form">
            <table border="1" class="blueTable">
                <tr>
                    <td>Descrizione</td>
                    <td> <textarea name="descrizione" id="descrizione" rows="15" cols="40" required ></textarea> </td>
                </tr>
                <tr>
                    <td>Prezzo</td>
                    <td> <input type="number" name="prezzo" id="prezzo" min="0" required /> </td>
                </tr>
                <tr>
                    <td>Disponibilità</td>
                    <td> <input name="disponibilita" id="immediata" type="radio" value="Immediata" />
                            <label for="indeterminato">Immediata</label><br>
                         <input name="disponibilita" id="non_immediata" type="radio" value="Non immediata" />
                            <label for="determinato">Non immediata</label><br>
                         <input name="disponibilita" id="non_specificata" type="radio" value="Non specificata" />
                            <label for="non_specificato">Non specificata</label>
                    </td>
                </tr>
                <tr>
                    <td align="center"> <input name="reset" type="reset" value="CANCELLA" /></td>
                    <td align="center"> <input name="submit" type="submit" value="AGGIUNGI"/> </td>
                </tr>
            </table>
            
        </form>
        
        <p><a href=personale_professionista.php>Torna alla pagina riservata</a></p>
        
    </body>
    
    
</html>