<?php
$apikey = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjkyZTc5M2Y1YzY3YTMxMDc0MTk3ZDdjZTdhMGQxZDIxOGNiN2ZiNDhjYWY5ODFmMDVlNGU3Yzg0ZmI2ZDZiZjVlZTA3YzhiZmNmNWE2ZDVmIn0.eyJhdWQiOiIwIiwianRpIjoiOTJlNzkzZjVjNjdhMzEwNzQxOTdkN2NlN2EwZDFkMjE4Y2I3ZmI0OGNhZjk4MWYwNWU0ZTdjODRmYjZkNmJmNWVlMDdjOGJmY2Y1YTZkNWYiLCJpYXQiOjE1MjI5NjM4NTksIm5iZiI6MTUyMjk2Mzg1OSwiZXhwIjoxNTU0NDk5ODU5LCJzdWIiOiIxMDkxOTc2MDkiLCJzY29wZXMiOltdfQ.ZkXV2RiRxAQ2aOlUaU9i_6QImr35RlTtc6jxlA2gIIB2hBB0D9qrYFJHPuPrEV1JA8JPRd_c-2p0LT8nBGW4Z_r2xlLxlzNBj2rr2qwHX8lfkqF2lJsSCsBfHHgoBsTRjgCvmW5YwWx7ItmS77feyKtmvHi-TO6NHEn98TTuPFcfkQNOHmCuAZnD0vQTP3BX4yiEVp_truIoARfB-4dbXjac51D-MfhbUyG6u0_sZlAVjJ3GOacQmOH3BP1uvnm6D_9Vjzarnbe-OLaUQiodgXOhuztofl7P3DAmCWaJ0ifPYcwYAis8xHUul25ZRUNY-iuYgtgZU9u0wLzpN7dQ9CNZT7jIzqtH2Wkou9Fw3kBBAAVAcSbVC38pwIe87A9bAdack3AULqgDbKS8oKoIl8Lu9RvSxfpNvKK7lMycZTeHQXjCR1Xawex5BTvWZz8yIPkVIYIZDRtmT2NTMW4a-qc1noXYIHDBH24V8XzzCS_Em9oKq9JjlVY5NbHJTNPRn7NWUdjgIKYAilikj3OIh8WogBvX1o-XGeIIfGceULwqZUW77t7jS4-xmXHAPw7a5p2b3XQ4XAB9Z-_Y6MmE5MeEjYs5qTcC3MmjKoQN0m0g8Awci9HtmmxqsejIjsimfAaumxYDWCuSpNc3GCj2icF8xj-ocBdFSKsuhbtsi3s';

// choix du template en fonctiopn du nombre de données
// génération du Json avec les champs (\n pour retour a la ligne)


$auj = date('Ymd');
$json = '{"document_id": "208250646","fillable_fields": {"ContractNb": "'.$contractnb.'","Company": "'.$company.'","Address": "'.$address.'","PostalCode" : "'.$postalcode.'","City": "'.$city.'","SIREN" : "'.$siren.'","Contact": "'.$contact.'","Mail" : "'.$mail.'","Phone": "'.$phone.'","Periode" : "'.$periode.'","PeriodeDebut" : "'.$periodedebut.'","PeriodeFin" : "'.$periodefin.'","QtyKiosk" : "'.$qtykiosk.'","QtyP1" : "'.$qtyp1.'","QtyBusiness" : "'.$qtybusiness.'","QtyBusinessEssentials" : "'.$qtybusinessessentials.'","QtyBusinessPremium" : "'.$qtybusinesspremium.'","QtySkype" : "'.$qtyskype.'","PriceKiosk" : "'.$pricekiosk.'","PriceP1" : "'.$pricep1.'","PriceBusiness" : "'.$pricebusiness.'","PriceBusinessEssentials" : "'.$pricebusinessessentials.'","PriceBusinessPremium" : "'.$pricebusinesspremium.'","PriceSkype" : "'.$priceskype.'","TotKiosk" : "'.$totkiosk.'","TotP1" : "'.$totp1.'","TotBusiness" : "'.$totbusiness.'","TotBusinessEssentials" : "'.$totbusinessessentials.'","TotBusinessPremium" : "'.$totbusinesspremium.'","TotSkype" : "'.$totskype.'","GrandTotal" : "'.$grandtot.'","Start" : "'.$start.'"}}';
$postParam = array('Json' => $json,'Content-Disposition:form-data');
$curl = curl_init();
$url= 'https://api.pdffiller.com/v2/templates/208250646';
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$apikey,'Content-Type: application/json'));
$result = curl_exec($curl);
$json = json_decode($result);
$id = $json->id;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,'https://api.pdffiller.com/v2/templates/'.$id.'/download');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPGET, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$apikey));
$response = curl_exec($ch);
// mettre le pdf dans le dossier
$pdfpath = '/var/www/vhosts/eko.team/my.eko.team/contractcenter/'.$file.'.pdf';
file_put_contents($pdfpath, $response);
// enreigstrer le lien dans la table


?>
