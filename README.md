# audits_eko
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