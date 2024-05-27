### Andrea lallouni Etudiant3

## Journal de bord


### 01/2024 : Avancement sur le diagramme des cas d’utilisations .
### 01/2024 : Reformulation du cahier des charges et avancement sur le diagramme de déploiement.
- Repérage des balises
Tous les supports de charges et les outils sont équipés d'une petite balise appelée iBeacon. Ces balises sont détectées par des boîtiers spéciaux, fabriqués par BlueNetBeacon, qui utilisent la technologie BLE/wifi. Ces boîtiers sont en mode de lecture constante et envoient les données au tampon de données sous forme de messages JSON via des requêtes HTTP POST.

La configuration du boîtier BLE/wifi se fait via Bluetooth en utilisant une application appelée CheckBlue disponible sur le Play Store. Il faut simplement indiquer l'adresse internet (URL) et le numéro de port pour communiquer avec le tampon de données.

- Tampon de données
Un petit ordinateur appelé Raspberry Pi 4 agit comme un tampon de données. Il est placé entre les boîtiers de détection et le serveur. Temporairement, il stocke les données provenant des boîtiers de détection avant de les renvoyer au serveur à l'aide de requêtes HTTP POST.

Les données envoyées contiennent l'adresse électronique de la passerelle (gateway), suivie des informations de la balise au format JSON. Cela permet de savoir quelle passerelle a détecté chaque balise. Il existe plusieurs façons d'envoyer ces données au serveur :

En mode transparent, les données sont envoyées immédiatement au serveur.
Les données sont envoyées régulièrement, avec un intervalle que l'on peut configurer en heures ou en minutes.
Les données sont envoyées une fois par jour à une heure que l'on peut choisir.
Lorsque les données sont renvoyées, le tampon de données est vidé. La trame envoyée au serveur doit inclure l'adresse électronique de la passerelle. Avant l'envoi, on peut filtrer les données provenant des boîtiers de détection. On peut le faire en se basant sur le champ "Major" des balises ou sur une plage de puissance du signal (RSSI). Cela permet de ne prendre en compte que les balises utilisées sur les objets en mouvement et d'ignorer celles qui sont trop éloignées des boîtiers de détection.

Si une balise est détectée plusieurs fois dans la même zone de l'entrepôt, il n'est pas nécessaire de renvoyer toutes les données au serveur. Par exemple, si une balise avec le code "0001-004F" est détectée pour la première fois dans la zone n°1, l'information est envoyée au serveur, mais pas lors des détections suivantes dans la même zone. Si plus tard, la même balise est détectée dans la zone n°2, l'information est renvoyée au serveur pour indiquer que l'objet a été déplacé.

Si la même balise est détectée par deux boîtiers de détection, on prend en compte la puissance du signal la plus forte, celle qui correspond au boîtier de détection le plus proche. Par exemple, si la balise "0001-004F" est détectée par le boîtier de la zone n°1 avec une puissance du signal de -35 dBm, et par le boîtier de la zone n°2 avec une puissance du signal de -60 dBm, seule la trame provenant de la zone n°1 est renvoyée, et celle de la zone n°2 est ignorée.

La configuration du tampon de données et du filtrage ne nécessite pas l'utilisation de pages web ou de requêtes HTTP dans le cadre de ce projet. Elle peut être réalisée directement dans le fichier de configuration. Les paramètres de configuration, tels que l'adresse IP du serveur, sont enregistrés dans un fichier texte. La manière dont les données sont stockées dans le tampon de données n'est pas fixée, et il n'est pas nécessaire de conserver les données de manière permanente.

- Stockage sur le serveur
Le serveur remplit les rôles de serveur web et de base de données. Toutes les données reçues sont sauvegardées dans une base de données appelée MariaDB. On peut consulter ces données via des pages web. Les actions effectuées par le responsable de l'entrepôt et le responsable logistique sont détaillées dans la page suivante.

- Application mobile
L'application mobile développée pour ce projet permet à l'utilisateur de localiser un support de charge ou un outil dans l'entrepôt. Le smartphone fonctionne comme un détecteur de balises. L'utilisateur peut saisir manuellement le code "Major-Minor" de la balise recherchée ou le sélectionner dans une liste. L'application récupère cette liste depuis le serveur. L'utilisateur se guide en fonction de la distance estimée, même si la direction n'est pas indiquée. Projet Tracking BLE


### 01/2024 : Installation du serveur web et création de la base de donnée.
### 01/2024 : Diagramme de déploiement et d’exigence réalisé avec le groupe.


### 01/2024 : Mise en place du serveur OVH et amelioration du diagramme de déploiement.



### 01/2024 : Création de la base de données MCD MLD avec yahya et le cahier de recette

### 01/2024 : Maquettage des pages du responsable entrepot et logistique sur figma

### 26/01/2024 : Passage sur la première revue
### 01/2024 : Debut du codage des pages web du responsable logistique et entrepot en php
### 02/2024 : Création du diagramme de séquence des pages webs
### 02/2024 : préparation passage deuxième revue
### 02/2024 : passage deuxième revue
### 03/2024 : modification des pages figma
### 04/2024 : modification des diapos de la revue 2
### 05/2024 : préparation passage troisième revue
### 05/2024 : passage troisième revue


  


  

  

