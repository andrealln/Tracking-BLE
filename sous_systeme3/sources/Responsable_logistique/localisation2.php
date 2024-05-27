<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Localisation sur Google Maps</title>
    <style>
        /* Styling pour définir la taille de la carte */
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body>

<h2>Localisation sur Google Maps</h2>

<?php
    
// Récupérez la latitude et la longitude à partir des paramètres GET
$latitude = isset($_GET['latitude']) ? $_GET['latitude'] : 0;
$longitude = isset($_GET['longitude']) ? $_GET['longitude'] : 0;

// Affichez la carte avec la latitude et la longitude spécifiées
echo "<div id='map'></div>";
?>

<script>
    // Initialisez la carte Google Maps avec la latitude et la longitude spécifiées
    function initMap() {
        var latitude = <?php echo $latitude; ?>;
        var longitude = <?php echo $longitude; ?>;
        
        // Vérifiez si la latitude et la longitude sont valides
        if (latitude !== 0 && longitude !== 0) {
            var myLatLng = {lat: latitude, lng: longitude};
            
            // Créez la carte
            var map = new google.maps.Map(document.getElementById('map'), {
                center: myLatLng,
                zoom: 15
            });

            // Ajoutez un marqueur à l'emplacement spécifié
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: 'Emplacement'
            });
        }
    }
</script>

<!-- Clé API Google Maps -->
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPQO48GqGIZ84UBDbdWBEzImd_8a8zTCM&callback=initMap">
    </script>
</body>
</html>
