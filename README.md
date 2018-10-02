# audits_eko
## Démo 
http://mon-chatbot.com/audits/ 
<br /><br />
## Intégration sur Hébergement Eko 
1. Installer les nouvelles tables **audits2018_XXXX**<br />
Fichier .sql disponible ici : https://github.com/MathieuDuboy/audits_eko/blob/master/eko_audits.sql
2. Installer Client API FormAPI via Composer (https://getcomposer.org/)
Il suffit de taper la commande depuis le Terminal (dans le dossier /audits par exemple)<br />
```` composer require formapi/formapi ````
3. Modifier le fichier config.php (avec les identifants d'accès à ta base de données)
4. Modifier les droits du dossier /uploads (CHMOD en 755 minimum)
5. Lorsque tu souhaites lancer en PROD : Modifier les clés de Test FormAPI dans generer.php :<br />
Disponible ici : https://github.com/MathieuDuboy/audits_eko/blob/master/generer.php
6. Pour modifier le texte fixe de l'intro : RDV ligne 85 de step1.php : https://github.com/MathieuDuboy/audits_eko/blob/master/step1.php
7. Pour modifier les informations de base fixe de l'étape 3 : RDV ligne 166 : https://github.com/MathieuDuboy/audits_eko/blob/0cdc2d79ab9042ada4078b8347f529f5212ce8a4/step3.php#L166
