<?php
include("../top.php");
include("../param.inc.php");
include("../fonctions_tableaux.php");

?>


<body style="padding: 0;">
<?php
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE,PORT);
if ($mysqli -> connect_errno)
{
   echo "<p>Erreur de connexion : ".$mysqli->connect_error."</p>";
      exit();
}


 
   
   // afficher le tableau de lidentification des données envoyées d’un camion
   $query = "SELECT camion.immatriculation, actif.nom FROM camion JOIN actif ON actif.id_ACTIF";

   
   
   if($resultat = $mysqli->query($query))
   {
      
      // tableau PHP contenant les en-têtes de colonnes
      $entetes = ["camion", "actif"];
      // tableau des camion et des actifs
      $donnees = array();
      // pour chaque enregistrement
      if($ligne = $resultat->fetch_assoc()) 
      {
         $camion = $ligne['immatriculation'];
         
         $actif = $ligne['nom'];
         $donnees[] = [$camion, $actif];
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
          location.href = "responsable_logistique.php";
        }
     </script>


</body>

</html>
