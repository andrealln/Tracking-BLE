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

<h1>Responsable logistique</h1>


    <div class="button-container">
        <div>
            <button onclick="responsable1()">Gérer la liste des camions</button>
            
        </div>

        <div>
            <button onclick="responsable2()">Visualise les données d'un camion</button>
            
        </div>


        <div>
            <button onclick="responsable3()">Localisation d'un camion</button>
            
        </div>

        <div>
            <button onclick="responsable4()">Localisation d'un actif</button>
            
        </div>

        <div>
            <button onclick="responsable5()">Actifs dans les camions</button>
            
        </div>

        <div>
            <button onclick="responsable6()">Support de charge d'un camion</button>
            
        </div>
    </div>


   

    <script>
        function responsable1() {
          location.href = "camion.php";
        }

        function responsable2() {
          location.href = "selectionne_camion.php";
        }


        function responsable3() {
          location.href = "localisation.php";
        }


        function responsable4() {
          location.href = "visu_date_heure.php";
        }


        function responsable5() {
          location.href = "visu_support_charge_camion.php";
        }

        function responsable6() {
          location.href = "selectionne_support_charge.php";
        }



    </script>



</body>

</html>