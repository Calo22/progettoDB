<html>
    <head>
        <title> Edit recensione </title>
    </head>
    <body>
        <?php
        include "db.php";
        
        
        $submit = $_GET["submit"];
        
        
        if($submit == "SCRIVI RECENSIONE")
        {
			$servizio = $_GET["id_servizio"];
			
            echo "<h1> Scrivi una recensione per il servizio di ID '$servizio' </h1>".
                "<table border='1' class='blueTable'>
                <form action='landing_edit_recensione.php' method='GET' name='form'>".
                "<input name='id_servizio' type='number' value=$servizio hidden>".
                "<th>Recensione</th>
                    <tr> <td> <textarea name='recensione' id='recensione' rows='25' cols='100'></textarea> </td> </tr>
                <tr> <td align='right'> <input name='submit' type='reset' value='CANCELLA'/>
                <input name='submit' type='submit' value='INVIA'/> </td> </tr> </form> </table>";
        }
        
        
        if ($submit == "MODIFICA recensione")
        {
		
			$servizio = $_GET["id_servizio"];
			$recensione = $_GET["descrizione"];
			$id_recensione = $_GET["id_recensione"];
			
            echo "<h1> Modifica la recensione per il servizio di ID '$servizio' </h1>".
                "<table border='1' class='blueTable'>
                <form action='landing_edit_recensione.php' method='GET' name='form'>".
                "<input name='id_recensione' type='number' value=$id_recensione hidden>".
                "<th>Recensione</th>
                    <tr> <td> <textarea name='recensione' id='recensione' rows='25' cols='100'>$recensione</textarea> </td> </tr>
                <tr> <td align='right'> <input name='submit' type='submit' value='MODIFICA EFFETTUATA!'/> </td> </tr> </form> </table>"; 
        }
        
        
        if ($submit == "ELIMINA recensione")
        {

			$id_recensione = $_GET["id_recensione"];
		
            $sql = "delete from Recensione where Id_recensione = $id_recensione";
            $result = mysqli_query($conn, $sql);
            
            if($result)
            {
                echo "<p>Recensione eliminata correttamente!</p>";
            }
            else
                echo "<p>Eliminazione NON andata a buon fine</p>";
        }
        
        
        echo "<p><a href=personale_privato.php> Torna alla pagina riservata </a></p>";

        
        
        ?>
    </body>
</html>