<?php
include("../top.php");
include("../param.inc.php");
include("../fonctions_tableaux.php");

?>

<h3> visualise la liste des actifs détectés dans chacune des zones de stockage</h3>
<body style="padding: 0;">
<?php
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE,PORT);
if ($mysqli -> connect_errno)
{
   echo "<p>Erreur de connexion : ".$mysqli->connect_error."</p>";
      exit();
}


 
   
   // afficher le tableau de lidentification des zones des actifs
   $query = "SELECT actif.nom AS anom,zone.nom AS znom FROM zone JOIN beacon JOIN actif ON actif.id_BEACON = beacon.id_BEACON";

   
   
   if($resultat = $mysqli->query($query))
   {
      
      // tableau PHP contenant les en-têtes de colonnes
      $entetes = ["actif", "zone"];
      // tableau des zones et des actifs
      $donnees = array();
      // pour chaque enregistrement
      while($ligne = $resultat->fetch_assoc()) 
      {
         $actif = $ligne['anom'];
         
         $zone = $ligne['znom'];
         $donnees[] = [$actif, $zone];
      }
      $resultat->free();
      echo "<hr style='border-top:1px dotted #000;'' />";
      echo '<center>';
      AfficherTableau($entetes, $donnees, $centrer=true);
           echo '</center>';

     

   }
   else
      echo "Erreur de requête : ".$mysqli->error;


   $mysqli->close();


 ?>
</head>


    <div class="button-container">
        <div>
            <button onclick="Retour()">Retour</button>
            
        </div>

    </div>

    <script>
        function Retour() {
          location.href = "responsable_entrepot.php";
        }
     </script>


</body>

</html>
