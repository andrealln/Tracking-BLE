<?php
function afficherTableau($entetes, $contenu, $centrer)
{
	echo "<table border width=600>";
	foreach($entetes as $titre) 
		echo("<th>$titre</th>");
	foreach($contenu as $ligne) 
	{
		echo("<tr>");
		foreach($ligne as $case)
			if($centrer)
	    		echo("<td><center>".$case."</center></td>");
	    	else
	    		echo("<td>".$case."</td>");
		echo("</tr>");
	}
	echo "</table>";
}
?>
