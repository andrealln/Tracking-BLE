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















//requete pour lire la liste des actifs 

$query = "SELECT nom FROM actif" ;
if($resultat = $mysqli->query($query))
{
  $lesactifs = array();
  while($unactif = $resultat->fetch_assoc()) 
  {
     $lesactifs[] = $unactif;
  }
  $resultat->free();
}
else
{
  echo "Erreur de requête : ".$mysqli->error;
  exit();
}



// formulaire pour identifier le camion d’un actif
echo "<p><form method='post'>";
echo "<h3>Identifier le camion d’un actif</h3>";
echo "actif :<SELECT id='actif' name='actif'>";
   foreach($lesactifs as $unactif)
   {
      $nom = $unactif['nom'];
      echo "<OPTION>$nom";
   }
   echo "</SELECT>\t";

echo "<p><input type='submit' name='Identifier' value='Identifier le camion' /></p>";
echo "</form></p>";


// on a cliqué sur le bouton identifier
if(isset($_POST['Identifier']))
{
   $nom = $_POST['actif'];
   
   // afficher le tableau de l'identification  d'un actif dans un camion
   $query = "SELECT camion.immatriculation AS 'camion' FROM camion JOIN beacon ON camion.id_CAMION = beacon.id_CAMION JOIN actif ON actif.id_BEACON = beacon.id_BEACON WHERE actif.nom = '$nom'";
   
   if($resultat = $mysqli->query($query))
   {
      
      // tableau PHP contenant les en-têtes de colonnes
      $entetes = ["Actif", "camion"];
      // tableau des actifs
      $donnees = array();
      // pour chaque enregistrement
      if($ligne = $resultat->fetch_assoc()) 
      {
         $camion = $ligne['camion'];
         echo "<p>$camion</p>";
         $donnees[] = [$nom, $camion];
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
