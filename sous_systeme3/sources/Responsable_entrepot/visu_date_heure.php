<?php
include("../top.php");
include("../param.inc.php");
include("../fonctions_tableaux.php");

?>

<h3> visualise les dates-heures d’entrée et de sortie des supports de charge </h3>
<body style="padding: 0;">
<?php
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE,PORT);
if ($mysqli -> connect_errno)
{
   echo "<p>Erreur de connexion : ".$mysqli->connect_error."</p>";
      exit();
}


 
   
   // afficher le tableau de lidentification date heure d'entree d'un actif
   $query = "SELECT nom,DateHeureEntree FROM actif JOIN beacon ON actif.id_BEACON = beacon.id_BEACON";

   
   
   if($resultat = $mysqli->query($query))
   {
      
      // tableau PHP contenant les en-têtes de colonnes
      $entetes = ["actif", "Date Heure Entrée"];
      // tableau date heure d'entree et des actifs
      $donnees = array();
      // pour chaque enregistrement
      while($ligne = $resultat->fetch_assoc()) 
      {
         $actif = $ligne['nom'];
         
         $DateHeureEntree = $ligne['DateHeureEntree'];
         $donnees[] = [$actif, $DateHeureEntree];
      }
      $resultat->free();
      echo "<hr style='border-top:1px dotted #000;'' />";
      echo '<center>';
      AfficherTableau($entetes, $donnees, $centrer=true);
           echo '</center>';

     

   }
   else
      echo "Erreur de requête : ".$mysqli->error;

  // afficher le tableau de lidentification date heure de sortie d'un actif
  $query = "SELECT nom,DateHeureSortie FROM actif JOIN beacon ON actif.id_BEACON = beacon.id_BEACON";

   
   
   if($resultat = $mysqli->query($query))
   {
      
      // tableau PHP contenant les en-têtes de colonnes
      $entetes = ["actif", "Date Heure Sortie"];
      // tableau date heure de sortie et des actifs
      $donnees = array();
      // pour chaque enregistrement
      while($ligne = $resultat->fetch_assoc()) 
      {
         $actif = $ligne['nom'];
         
         $DateHeureEntree = $ligne['DateHeureSortie'];
         $donnees[] = [$actif, $DateHeureSortie];
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
