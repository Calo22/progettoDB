<html>
    
    <head>
        <title>Landing page valutazione servizio</title>
    </head>
    
    <body>
        
        <?php
        include "db.php";
        
        $id_servizio = $_GET["id_servizio"];
        $valutazione_qp = $_GET["valutazione_qp"];
        $valutazione_dp = $_GET["valutazione_dp"];
        $valutazione_c = $_GET["valutazione_c"];
      
            
            $sql = mysqli_prepare($conn, "INSERT INTO Valutazione(Servizio, Cliente, Rapporto_QualitaPrezzo,
                                  Disponibilita_professionista, Consigliato) VALUES(?,?,?,?,?)");
        
            mysqli_stmt_bind_param($sql, 'iiddd', $id_servizio, $_COOKIE["id_cliente"], $valutazione_qp, $valutazione_dp, $valutazione_c);           
        
        
            if (mysqli_stmt_execute($sql) === TRUE)
            {
                echo "New record created successfully <br/>";
            }
            else
            {
                echo "Error: " . mysqli_error($sql). "<br/>";
            }
        
        
        
        echo "<p> <a href=personale_privato.php> Torna alla pagina riservata </a> </p>";
        
     
        mysqli_close($conn);
        
             
        ?>
            
    </body>
    
</html>