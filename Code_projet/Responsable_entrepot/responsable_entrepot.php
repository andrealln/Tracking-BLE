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
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
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

<h1>Responsable entrepot</h1>


    <div class="button-container">
        <div>
            <button onclick="responsableGateway()">Gérer les Gateways</button>
            
        </div>

        <div>
            <button onclick="responsableAssocierActif()">Associer un Actif à un beacon</button>
            
        </div>


        <div>
            <button onclick="responsableVisuActif()">Actifs par zone</button>
            
        </div>

        <div>
            <button onclick="responsableVisuDateHeure()">Date-Heure d'entrée-sortie</button>
            
        </div>

        <div>
            <button onclick="responsableIdentifierZone()">Zone d'un actif</button>
            
        </div>
    </div>


   

    <script>
        function responsableGateway() {
          location.href = "gateway.php";
        }

        function responsableAssocierActif() {
          location.href = "associer_actif_beacon.php";
        }


        function responsableVisuActif() {
          location.href = "visu_actif_zone.php";
        }


        function responsableVisuDateHeure() {
          location.href = "visu_date_heure.php";
        }


        function responsableIdentifierZone() {
          location.href = "identifier_zone.php";
        }


    </script>



</body>

</html>