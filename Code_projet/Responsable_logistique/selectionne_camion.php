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















//requete pour lire la liste des camions 

$query = "SELECT immatriculation FROM camion" ;
if($resultat = $mysqli->query($query))
{
  $lescamions = array();
  while($uncamion = $resultat->fetch_assoc()) 
  {
     $lescamions[] = $uncamion;
  }
  $resultat->free();
}
else
{
  echo "Erreur de requête : ".$mysqli->error;
  exit();
}



// formulaire pour identifier les données envoyées d’un camion
echo "<p><form method='post'>";
echo "<h3>Identifier les données envoyées d’un camion</h3>";
echo "camion :<SELECT id='camion' name='camion'>";
   foreach($lescamions as $uncamion)
   {
      $immatriculation = $uncamion['immatriculation'];
      echo "<OPTION>$immatriculation";
   }
   echo "</SELECT>\t";

echo "<p><input type='submit' name='Identifier' value='Identifier les données' /></p>";
echo "</form></p>";


// on a cliqué sur le bouton identifier
if(isset($_POST['Identifier']))
{
   $immatriculation = $_POST['camion'];
   
   // afficher le tableau de lidentification des données envoyées d’un camion
   $query = "SELECT camion.temperature,actif.nom  AS 'actif' FROM actif JOIN beacon ON actif.id_ACTIF = beacon.id_ZONE JOIN camion ON actif.id_BEACON = beacon.id_BEACON WHERE camion.immatriculation = '$immatriculation'";

   
   
   if($resultat = $mysqli->query($query))
   {
      
      // tableau PHP contenant les en-têtes de colonnes
      $entetes = ["camion", "actif","temperature"];
      // tableau des actifs et temperature
      $donnees = array();
      // pour chaque enregistrement
      if($ligne = $resultat->fetch_assoc()) 
      {
         $actif = $ligne['actif'];
         
         $temperature = $ligne['temperature'];
         $donnees[] = [$immatriculation, $actif,$temperature];
      }
      $resultat->free();
      echo "<hr style='border-top:1px dotted #000;'' />";
      echo '<center>';
      AfficherTableau($entetes, $donnees, $centrer=true);
           echo '</center>';

     

   }
   else
      echo "Erreur de requête : ".$mysqli->error;

}
   

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
