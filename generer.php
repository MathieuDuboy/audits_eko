<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="css/style.css" rel="stylesheet">
  <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" rel="stylesheet">
  <script src="js/jquery.easy-autocomplete.min.js"></script>
  <link rel="stylesheet" href="css/easy-autocomplete.min.css">
  <title>Audit Technique EKO</title>
  <style>
  .ui-front {
      z-index: 9999999 !important;
  }
  .modal-body p {
    word-wrap: break-word;
  }
  </style>
</head>
<body>
  <div class="row" style="margin:30px">
    <div class="col" >
    <?php
    $tab = array();
    // test api key api_test_C3ymQZRE3tPDAKp7bC
    // test secret : BDY0bH1qtpFF_yCIIZDPu09z-l0lRYm7qMt28ZTEZhQ
    require __DIR__ . '/vendor/autoload.php';

    $formapi = new FormAPI\Client();
    $formapi->getConfig()->setUsername("api_test_C3ymQZRE3tPDAKp7bC");
    $formapi->getConfig()->setPassword("BDY0bH1qtpFF_yCIIZDPu09z-l0lRYm7qMt28ZTEZhQ");

    $template_id = 'tpl_9jHNaSNYqpDfXELEGx';

    $data = new FormAPI\Model\CreateSubmissionBody();

    // Obligatoire
      $id_audit = sprintf("%03s", $_GET['id_audit']);
      $numero_audit = 'A'.date("Ymd")."".$id_audit;
      $vrai_id_requete = $_GET['id_audit'];
      $tab['AuditID'] = $numero_audit;
      include('php/config.php');
      $sql = "SELECT * from audits2018_audits  WHERE id = '".$_GET['id_audit']."'";
      $result=mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result);
      $nom_client = $row['nom_client'];
      $tab['AuditCompany'] = $nom_client;
      $tab['AuditDate'] = $row['date_ajout'];
      $tab['AuditAP'] = $row['commentaires'];
      $tab['PANote'] = $row['note'];
      $id_manager = $row['id_manager'];

      // postes de Travail à lister pour cet audit numero xxx
      $sql2 = "SELECT audits2018_affectation_element.id as unique_id, audits2018_affectation_element.tag, audits2018_affectation_element.nb, audits2018_affectation_element.ordre, audits2018_affectation_element.commentaires, audits2018_liste_elements.id, audits2018_liste_elements.nom, audits2018_liste_elements.categorie  from audits2018_affectation_element INNER JOIN audits2018_liste_elements ON audits2018_affectation_element.id_element = audits2018_liste_elements.id WHERE audits2018_affectation_element.categorie = 'Postes de travail' AND audits2018_affectation_element.id_audit = '".$_GET['id_audit']."' ORDER BY audits2018_affectation_element.id";
      $result2=mysqli_query($db,$sql2);
      $nb = mysqli_num_rows($result2);
      $numero_de_carte = 0;
      $liste = 1;
      while($row2 = mysqli_fetch_array($result2))  {
        $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$row2['unique_id']."'";
        $debut = 0;
        $result3=mysqli_query($db,$sql3);
        $tab_specifications_deja_affecte = [];
        while($row3 = mysqli_fetch_array($result3))   {
          if($row3['nom'] == 'PTBrand') { $tab_PT['PTBrand'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'PTFactor') { $tab_PT['PTFactor'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'PTProc') { $tab_PT['PTProc'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'PTRAM') { $tab_PT['PTRAM'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'PTDDType') { $tab_PT['PTDDType'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'PTDDCapa') { $tab_PT['PTDDCapa'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'PTDDOccup') { $tab_PT['PTDDOccup'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'PTScreen') { $tab_PT['PTScreen'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          $debut++;
        }
        $tab_PT['PTName'.$liste] = $row2['nom'].' '.$row2['tag'];
        $tab_PT['PTNB'.$liste] = $row2['nb'];
        $tab_PT['PTComment'.$liste] = $row2['commentaires'];
        $tab = array_merge($tab, $tab_PT);
        $liste++;
        $numero_de_carte++;
        $debut = 0;
      }
      // connexions Internet
      $sql2 = "SELECT audits2018_affectation_element.id as unique_id, audits2018_affectation_element.tag, audits2018_affectation_element.nb, audits2018_affectation_element.ordre, audits2018_affectation_element.commentaires, audits2018_liste_elements.id, audits2018_liste_elements.nom, audits2018_liste_elements.categorie  from audits2018_affectation_element INNER JOIN audits2018_liste_elements ON audits2018_affectation_element.id_element = audits2018_liste_elements.id WHERE audits2018_affectation_element.categorie = 'Connexions Internet' AND audits2018_affectation_element.id_audit = '".$_GET['id_audit']."' ORDER BY audits2018_affectation_element.id";
      $result2=mysqli_query($db,$sql2);
      $nb = mysqli_num_rows($result2);
      $numero_de_carte = 0;
      $liste = 1;
      while($row2 = mysqli_fetch_array($result2))  {
        $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$row2['unique_id']."'";
        $debut = 0;
        $result3=mysqli_query($db,$sql3);
        $tab_specifications_deja_affecte = [];
        while($row3 = mysqli_fetch_array($result3))   {
          if($row3['nom'] == 'CIOpe') { $tab_PT['CIOpe'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'CITech') { $tab_PT['CITech'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'CIDebit') { $tab_PT['CIDebit'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'CIFF') { $tab_PT['CIFF'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'CITarif') { $tab_PT['CITarif'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          $debut++;
        }
        $tab_PT['CINom'.$liste] = $row2['nom'].' '.$row2['tag'];
        $tab_PT['CIComment'.$liste] = $row2['commentaires'];
        $tab = array_merge($tab, $tab_PT);
        $liste++;
        $numero_de_carte++;
        $debut = 0;
      }
      // Telephonie fixe
      $sql2 = "SELECT audits2018_affectation_element.id as unique_id, audits2018_affectation_element.tag, audits2018_affectation_element.nb, audits2018_affectation_element.ordre, audits2018_affectation_element.commentaires, audits2018_liste_elements.id, audits2018_liste_elements.nom, audits2018_liste_elements.categorie  from audits2018_affectation_element INNER JOIN audits2018_liste_elements ON audits2018_affectation_element.id_element = audits2018_liste_elements.id WHERE audits2018_affectation_element.categorie = 'Téléphonie Fixe' AND audits2018_affectation_element.id_audit = '".$_GET['id_audit']."' ORDER BY audits2018_affectation_element.id";
      $result2=mysqli_query($db,$sql2);
      $nb = mysqli_num_rows($result2);
      $numero_de_carte = 0;
      $liste = 1;
      while($row2 = mysqli_fetch_array($result2))  {
        $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$row2['unique_id']."'";
        $debut = 0;
        $result3=mysqli_query($db,$sql3);
        $tab_specifications_deja_affecte = [];
        while($row3 = mysqli_fetch_array($result3))   {
          if($row3['nom'] == 'TFOpe') { $tab_PT['TFOpe'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'TFTech') { $tab_PT['TFTech'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'TFNB') { $tab_PT['TFNB'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'TFFF') { $tab_PT['TFFF'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'TFTarif') { $tab_PT['TFTarif'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          $debut++;
        }
        $tab_PT['TFNom'.$liste] = $row2['nom'].' '.$row2['tag'];
        $tab_PT['TFComment'.$liste] = $row2['commentaires'];
        $tab = array_merge($tab, $tab_PT);
        $liste++;
        $numero_de_carte++;
        $debut = 0;
      }
      // Telephonie Mobiles
      $tab_val = ["TMOpe", "TMTerminal", "TMFF", "TMTarif"];
      $sql2 = "SELECT audits2018_affectation_element.id as unique_id, audits2018_affectation_element.tag, audits2018_affectation_element.nb, audits2018_affectation_element.ordre, audits2018_affectation_element.commentaires, audits2018_liste_elements.id, audits2018_liste_elements.nom, audits2018_liste_elements.categorie  from audits2018_affectation_element INNER JOIN audits2018_liste_elements ON audits2018_affectation_element.id_element = audits2018_liste_elements.id WHERE audits2018_affectation_element.categorie = 'Téléphonie Mobile' AND audits2018_affectation_element.id_audit = '".$_GET['id_audit']."' ORDER BY audits2018_affectation_element.id";
      $result2=mysqli_query($db,$sql2);
      $nb = mysqli_num_rows($result2);
      $numero_de_carte = 0;
      $liste = 1;
      while($row2 = mysqli_fetch_array($result2))  {
        $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$row2['unique_id']."'";
        $debut = 0;
        $result3=mysqli_query($db,$sql3);
        $tab_specifications_deja_affecte = [];
        while($row3 = mysqli_fetch_array($result3))   {
          if($row3['nom'] == 'TMOpe') { $tab_PT['TMOpe'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'TMTerminal') { $tab_PT['TMTerminal'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'TMFF') { $tab_PT['TMFF'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'TMTarif') { $tab_PT['TMTarif'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          $debut++;
        }
        $tab_PT['TMNom'.$liste] = $row2['nom'].' '.$row2['tag'];
        $tab_PT['TMComment'.$liste] = $row2['commentaires'];
        $tab_PT['TMNB'.$liste] = $row2['nb'];
        $tab = array_merge($tab, $tab_PT);
        $liste++;
        $numero_de_carte++;
        $debut = 0;
      }
      // réseau
      $sql2 = "SELECT audits2018_affectation_element.id as unique_id, audits2018_affectation_element.tag, audits2018_affectation_element.nb, audits2018_affectation_element.ordre, audits2018_affectation_element.commentaires, audits2018_liste_elements.id, audits2018_liste_elements.nom, audits2018_liste_elements.categorie  from audits2018_affectation_element INNER JOIN audits2018_liste_elements ON audits2018_affectation_element.id_element = audits2018_liste_elements.id WHERE audits2018_affectation_element.categorie = 'Réseau' AND audits2018_affectation_element.id_audit = '".$_GET['id_audit']."' ORDER BY audits2018_affectation_element.id";
      $result2=mysqli_query($db,$sql2);
      $nb = mysqli_num_rows($result2);
      $numero_de_carte = 0;
      $liste = 1;
      while($row2 = mysqli_fetch_array($result2))  {
        $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$row2['unique_id']."'";
        $debut = 0;
        $result3=mysqli_query($db,$sql3);
        $tab_specifications_deja_affecte = [];
        while($row3 = mysqli_fetch_array($result3))   {
          if($row3['nom'] == 'RMarque') { $tab_PT['RMarque'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'RType') { $tab_PT['RType'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'RDebit') { $tab_PT['RDebit'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'RNB') { $tab_PT['RNB'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'RNBCo') { $tab_PT['RNBCo'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          $debut++;
        }
        $tab_PT['RNom'.$liste] = $row2['nom'].' '.$row2['tag'];
        $tab_PT['RNB'.$liste] = $row2['nb'];

        $tab_PT['RComment'.$liste] = $row2['commentaires'];
        $tab = array_merge($tab, $tab_PT);
        $liste++;
        $numero_de_carte++;
        $debut = 0;
      }
      // Messagerie
      $sql2 = "SELECT audits2018_affectation_element.id as unique_id, audits2018_affectation_element.tag, audits2018_affectation_element.nb, audits2018_affectation_element.ordre, audits2018_affectation_element.commentaires, audits2018_liste_elements.id, audits2018_liste_elements.nom, audits2018_liste_elements.categorie  from audits2018_affectation_element INNER JOIN audits2018_liste_elements ON audits2018_affectation_element.id_element = audits2018_liste_elements.id WHERE audits2018_affectation_element.categorie = 'Messagerie' AND audits2018_affectation_element.id_audit = '".$_GET['id_audit']."' ORDER BY audits2018_affectation_element.id";
      $result2=mysqli_query($db,$sql2);
      $nb = mysqli_num_rows($result2);
      $numero_de_carte = 0;
      $liste = 1;
      while($row2 = mysqli_fetch_array($result2))  {
        $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$row2['unique_id']."'";
        $debut = 0;
        $result3=mysqli_query($db,$sql3);
        $tab_specifications_deja_affecte = [];
        while($row3 = mysqli_fetch_array($result3))   {
          if($row3['nom'] == 'MF') { $tab_PT['MF'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'MMA') { $tab_PT['MMA'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'MC') { $tab_PT['MC'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'MU') { $tab_PT['MU'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'MA') { $tab_PT['MA'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          $debut++;
        }
        $tab_PT['MNom'.$liste] = $row2['nom'].' '.$row2['tag'];
        $tab_PT['MNB'.$liste] = $row2['nb'];
        $tab_PT['MComment'.$liste] = $row2['commentaires'];
        $tab = array_merge($tab, $tab_PT);
        $liste++;
        $numero_de_carte++;
        $debut = 0;
      }
      // Partage documentaire
      $sql2 = "SELECT audits2018_affectation_element.id as unique_id, audits2018_affectation_element.tag, audits2018_affectation_element.nb, audits2018_affectation_element.ordre, audits2018_affectation_element.commentaires, audits2018_liste_elements.id, audits2018_liste_elements.nom, audits2018_liste_elements.categorie  from audits2018_affectation_element INNER JOIN audits2018_liste_elements ON audits2018_affectation_element.id_element = audits2018_liste_elements.id WHERE audits2018_affectation_element.categorie = 'Partage documentaire' AND audits2018_affectation_element.id_audit = '".$_GET['id_audit']."' ORDER BY audits2018_affectation_element.id";
      $result2=mysqli_query($db,$sql2);
      $nb = mysqli_num_rows($result2);
      $numero_de_carte = 0;
      $liste = 1;
      while($row2 = mysqli_fetch_array($result2))  {
        $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$row2['unique_id']."'";
        $debut = 0;
        $result3=mysqli_query($db,$sql3);
        $tab_specifications_deja_affecte = [];
        while($row3 = mysqli_fetch_array($result3))   {
          if($row3['nom'] == 'PDType') { $tab_PT['PDType'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'PDFC') { $tab_PT['PDFC'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'PDC') { $tab_PT['PDC'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'PDU') { $tab_PT['PDU'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'PDGD') { $tab_PT['PDGD'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          $debut++;
        }
        $tab_PT['PDNom'.$liste] = $row2['nom'].' '.$row2['tag'];
        $tab_PT['PDComment'.$liste] = $row2['commentaires'];
        $tab = array_merge($tab, $tab_PT);
        $liste++;
        $numero_de_carte++;
        $debut = 0;
      }
      // Logiciel
      $sql2 = "SELECT audits2018_affectation_element.id as unique_id, audits2018_affectation_element.tag, audits2018_affectation_element.nb, audits2018_affectation_element.ordre, audits2018_affectation_element.commentaires, audits2018_liste_elements.id, audits2018_liste_elements.nom, audits2018_liste_elements.categorie  from audits2018_affectation_element INNER JOIN audits2018_liste_elements ON audits2018_affectation_element.id_element = audits2018_liste_elements.id WHERE audits2018_affectation_element.categorie = 'Logiciel' AND audits2018_affectation_element.id_audit = '".$_GET['id_audit']."' ORDER BY audits2018_affectation_element.id";
      $result2=mysqli_query($db,$sql2);
      $nb = mysqli_num_rows($result2);
      $numero_de_carte = 0;
      $liste = 1;
      while($row2 = mysqli_fetch_array($result2))  {
        $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$row2['unique_id']."'";
        $debut = 0;
        $result3=mysqli_query($db,$sql3);
        $tab_specifications_deja_affecte = [];
        while($row3 = mysqli_fetch_array($result3))   {
          if($row3['nom'] == 'LE') { $tab_PT['LE'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'LM') { $tab_PT['LM'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'LNBC') { $tab_PT['LNBC'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'LTH') { $tab_PT['LTH'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'LSO') { $tab_PT['LSO'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          $debut++;
        }
        $tab_PT['LNom'.$liste] = $row2['nom'].' '.$row2['tag'];
        $tab_PT['LComment'.$liste] = $row2['commentaires'];
        $tab = array_merge($tab, $tab_PT);
        $liste++;
        $numero_de_carte++;
        $debut = 0;
      }
      // Antivirus
      $sql2 = "SELECT audits2018_affectation_element.id as unique_id, audits2018_affectation_element.tag, audits2018_affectation_element.nb, audits2018_affectation_element.ordre, audits2018_affectation_element.commentaires, audits2018_liste_elements.id, audits2018_liste_elements.nom, audits2018_liste_elements.categorie  from audits2018_affectation_element INNER JOIN audits2018_liste_elements ON audits2018_affectation_element.id_element = audits2018_liste_elements.id WHERE audits2018_affectation_element.categorie = 'Antivirus' AND audits2018_affectation_element.id_audit = '".$_GET['id_audit']."' ORDER BY audits2018_affectation_element.id";
      $result2=mysqli_query($db,$sql2);
      $nb = mysqli_num_rows($result2);
      $numero_de_carte = 0;
      $liste = 1;
      while($row2 = mysqli_fetch_array($result2))  {
        $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$row2['unique_id']."'";
        $debut = 0;
        $result3=mysqli_query($db,$sql3);
        $tab_specifications_deja_affecte = [];
        while($row3 = mysqli_fetch_array($result3))   {
          if($row3['nom'] == 'AType') { $tab_PT['AType'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'ANBL') { $tab_PT['ANBL'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'ATarif') { $tab_PT['ATarif'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'AMan') { $tab_PT['AMan'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          $debut++;
        }
        $tab_PT['ANom'.$liste] = $row2['nom'].' '.$row2['tag'];
        $tab_PT['AComment'.$liste] = $row2['commentaires'];
        $tab = array_merge($tab, $tab_PT);
        $liste++;
        $numero_de_carte++;
        $debut = 0;
      }
      // Sauvegarde
      $sql2 = "SELECT audits2018_affectation_element.id as unique_id, audits2018_affectation_element.tag, audits2018_affectation_element.nb, audits2018_affectation_element.ordre, audits2018_affectation_element.commentaires, audits2018_liste_elements.id, audits2018_liste_elements.nom, audits2018_liste_elements.categorie  from audits2018_affectation_element INNER JOIN audits2018_liste_elements ON audits2018_affectation_element.id_element = audits2018_liste_elements.id WHERE audits2018_affectation_element.categorie = 'Sauvegarde' AND audits2018_affectation_element.id_audit = '".$_GET['id_audit']."' ORDER BY audits2018_affectation_element.id";
      $result2=mysqli_query($db,$sql2);
      $nb = mysqli_num_rows($result2);
      $numero_de_carte = 0;
      $liste = 1;
      while($row2 = mysqli_fetch_array($result2))  {
        $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$row2['unique_id']."'";
        $debut = 0;
        $result3=mysqli_query($db,$sql3);
        $tab_specifications_deja_affecte = [];
        while($row3 = mysqli_fetch_array($result3))   {
          if($row3['nom'] == 'SSupport') { $tab_PT['SSupport'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'SLog') { $tab_PT['SLog'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'SMon') { $tab_PT['SMon'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'SAuto') { $tab_PT['SAuto'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          if($row3['nom'] == 'SPer') { $tab_PT['SPer'.$liste] = (!$row3['valeur']) ? 'NC' : $row3['valeur'];}
          $debut++;
        }
        $tab_PT['SNom'.$liste] = $row2['nom'].' '.$row2['tag'];
        $tab_PT['SComment'.$liste] = $row2['commentaires'];
        $tab = array_merge($tab, $tab_PT);
        $liste++;
        $numero_de_carte++;
        $debut = 0;
      }
      // point forts
      $a = 0;
      $liste = 1;
      $sql3a = "SELECT * FROM `audits2018_pts_forts_faibles` INNER JOIN  audits2018_affectation_pts_forts_faibles ON  audits2018_pts_forts_faibles.id = audits2018_affectation_pts_forts_faibles.id_pts_forts_faibles WHERE `id_audit` =  '".$_GET['id_audit']."' AND audits2018_affectation_pts_forts_faibles.type = 'fort' ";
      $result3a=mysqli_query($db,$sql3a);
      while($row3a = mysqli_fetch_array($result3a))    {
          $tab_PT['PFTitle'.$liste] = (!$row3a['nom']) ? 'NC' : $row3a['nom'];
          $tab_PT['PFDesc'.$liste] = (!$row3a['commentaires']) ? 'NC' : $row3a['commentaires'];
          $tab = array_merge($tab, $tab_PT);
      $a++;
      $liste++;
      }
      // points faibles
      $a = 0;
      $liste = 1;
      $sql3a = "SELECT * FROM `audits2018_pts_forts_faibles` INNER JOIN  audits2018_affectation_pts_forts_faibles ON  audits2018_pts_forts_faibles.id = audits2018_affectation_pts_forts_faibles.id_pts_forts_faibles WHERE `id_audit` =  '".$_GET['id_audit']."' AND audits2018_affectation_pts_forts_faibles.type = 'faible' ";
      $result3a=mysqli_query($db,$sql3a);
      while($row3a = mysqli_fetch_array($result3a))    {
          $tab_PT['PFATitle'.$liste] = (!$row3a['nom']) ? 'NC' : $row3a['nom'];
          $tab_PT['PFADesc'.$liste] = (!$row3a['commentaires']) ? 'NC' : $row3a['commentaires'];
          $tab = array_merge($tab, $tab_PT);
      $a++;
      $liste++;
      }

      // ACtions urgentes
      $a = 0;
      $liste = 1;
      $sql3a = "SELECT * FROM `audits2018_affectation_tarif` WHERE `id_audit` =  '".$_GET['id_audit']."' AND type = 'OBLIGATOIRE' ";
      $result3a=mysqli_query($db,$sql3a);
      while($row3a = mysqli_fetch_array($result3a))    {
        $tab_PT['AUTitle'.$liste] = (!$row3a['nom']) ? 'NC' : $row3a['nom'];
        $tab_PT['AUPrix'.$liste] = (!$row3a['tarif']) ? 'NC' : $row3a['tarif'];
        $tab_PT['AUDesc'.$liste] = (!$row3a['commentaires']) ? 'NC' : $row3a['commentaires'];
        $tab = array_merge($tab, $tab_PT);
      $a++;
      $liste++;
      }
      // Actions necessaires
      $a = 0;
      $liste = 1;
      $sql3a = "SELECT * FROM `audits2018_affectation_tarif` WHERE `id_audit` =  '".$_GET['id_audit']."' AND type = 'RECOMMANDE' ";
      $result3a=mysqli_query($db,$sql3a);
      while($row3a = mysqli_fetch_array($result3a))    {
        $tab_PT['ANTitle'.$liste] = (!$row3a['nom']) ? 'NC' : $row3a['nom'];
        $tab_PT['ANPrix'.$liste] = (!$row3a['tarif']) ? 'NC' : $row3a['tarif'];
        $tab_PT['ANDesc'.$liste] = (!$row3a['commentaires']) ? 'NC' : $row3a['commentaires'];
        $tab = array_merge($tab, $tab_PT);
      $a++;
      $liste++;
      }
      // Actions recommandées
      $a = 0;
      $liste = 1;
      $sql3a = "SELECT * FROM `audits2018_affectation_tarif` WHERE `id_audit` =  '".$_GET['id_audit']."' AND type = 'CONFORT' ";
      $result3a=mysqli_query($db,$sql3a);
      while($row3a = mysqli_fetch_array($result3a))    {
        $tab_PT['ARTitle'.$liste] = (!$row3a['nom']) ? 'NC' : $row3a['nom'];
        $tab_PT['ARPrix'.$liste] = (!$row3a['tarif']) ? 'NC' : $row3a['tarif'];
        $tab_PT['ARDesc'.$liste] = (!$row3a['commentaires']) ? 'NC' : $row3a['commentaires'];
        $tab = array_merge($tab, $tab_PT);
      $a++;
      $liste++;
      }

      // Infos user
      $sql = "SELECT * FROM `users` WHERE `user_id` = ".$id_manager;
      $result3a=mysqli_query($db,$sql);
      $row3a = mysqli_fetch_array($result3a);

      $prenom = $row3a['first_name'];
      $nom = $row3a['last_name'];
      $mobile = $row3a['mobile'];
      $email = $row3a['email'];
      $tab['Interlocuteur'] = $prenom.' '.$nom;
      $tab['InterlocuteurMail'] = $email;
      $tab['InterlocuteurMobile'] = $mobile;
    //  $tab = array_merge($tab, $tab_PT);


      $data->setData($tab);
      $data->setTest(true);
      $response = $formapi->generatePDF($template_id, $data);

      $url = $response->getSubmission()->getDownloadUrl();
      ?><META HTTP-EQUIV="Refresh" CONTENT="1; URL=<?php echo $url;?>"><?php
      //echo '<pre>'; print_r($tab); echo '<pre/>';
      //header('Location : '. $response->getSubmission()->getDownloadUrl());
      //Exit();
    ?>
    </div>
  </div>
  <script src="https://unpkg.com/popper.js@1.14.3/dist/umd/popper.min.js">
   </script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js">
  </script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js">
  </script>
  <script src="js/jquery.easy-autocomplete.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.24.4/dist/sweetalert2.all.min.js">
  </script>

  <script>
  $(function()  {

  })
  </script>
</body>
</html>
