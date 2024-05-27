<?php
include("top.php");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsable entrepot</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }

        h1 {
            color: #333;
        }

        button {
            background-color: #1966B6;
            color: white;
            padding: 20px 30px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 150px;
        }

        button:hover {
            background-color: #000000;
        }

        

        .button-container {
            display: flex;
            justify-content: space-around;
        }

        .button-container div {
            text-align: center; 
        }

    </style>
</head>



            <img src="Images/logo.gif" alt="Logo de votre site" style="height: 100px; padding: 5px;">
            <h1>Tracking-BLE</h1>
        </div>
    </div>

    <div class="button-container">
        <div>
            <button onclick="responsableEntrepot()">Responsable Entrepôt</button>
            
        </div>

        <div>
            <button onclick="responsableLogistique()">Responsable Logistique</button>
            
        </div>
    </div>

   

    <script>
        function responsableEntrepot() {
          location.href = "Responsable_entrepot/responsable_entrepot.php";
        }

        function responsableLogistique() {
          location.href = "Responsable_logistique/responsable_logistique.php";
        }

    </script>
</body>

</html>
