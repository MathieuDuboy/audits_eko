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
  .h4, h4 {
    font-size: 1.1rem;
  }
  .detail_element {
    font-size: 0.8rem;
  }
  li {
    font-size: 0.8rem;
  }

  </style>
</head>
<body>
  <?php
  include('php/config.php');

  ?>
  <input type="hidden" name="id_audit_audit" id="id_audit_audit" value="<?php echo $_GET['id_audit']; ?>" />
  <div class="row">
    <div class="col-6">
      <div class="card-deck mb-3" style="margin:10px">
        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <?php
            $sql2 = "SELECT audits2018_affectation_element.id as unique_id, audits2018_affectation_element.tag, audits2018_affectation_element.nb, audits2018_affectation_element.ordre, audits2018_liste_elements.id, audits2018_liste_elements.nom, audits2018_liste_elements.categorie  from audits2018_affectation_element INNER JOIN audits2018_liste_elements ON audits2018_affectation_element.id_element = audits2018_liste_elements.id WHERE audits2018_affectation_element.categorie = 'Postes de travail' AND audits2018_affectation_element.id_audit = '".$_GET['id_audit']."' ORDER BY audits2018_affectation_element.id";
            $result2=mysqli_query($db,$sql2);
            $nb = mysqli_num_rows($result2);
            ?>
            <h4 class="my-0 font-weight-normal">Postes de travail (<?php echo $nb; ?>)<span style="float:right"></span></h4>
          </div>
          <div class="card-body">
            <?php
            $numero_de_carte = 0;
            while($row2 = mysqli_fetch_array($result2))  {
            ?>
            <h4 data-element="<?php echo $numero_de_carte; ?>" data-state="invisible" class="nom_element card-title pricing-card-title"><small class="text-muted"><i class="fas fa-desktop"></i> <?php echo $row2['nom']; ?> <?php echo $row2['tag'];
            if($row2['nb'] != '1') {
              echo ' ('.$row2['nb'].')';
            }
            ?>
          </small></h1>
            <ul class="mt-3 mb-4 detail_element" id="element_<?php echo $numero_de_carte; ?>">
              <?php
              $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$row2['unique_id']."'";
              $result3=mysqli_query($db,$sql3);
              $tab_specifications_deja_affecte = [];
              while($row3 = mysqli_fetch_array($result3))   {
                $tab_specifications_deja_affecte[] = $row3['id_specification'];

                ?>
                <li><b><?php echo $row3['nom']; ?></b> <span style="float:right"><?php if($row3['valeur'] != '') echo $row3['valeur']; else echo 'N.C.' ?> </span></li>
                <?php
              }
              $sql3a = "SELECT * FROM `liste_specifications` WHERE `id_element` =  '".$row2['id']."' ";
              $result3a=mysqli_query($db,$sql3a);
              $tab_specifications_a_affecter = [];
              while($row3a = mysqli_fetch_array($result3a))    {
                $tab_specifications_a_affecter[] = $row3a['id'];
              }
              $result = array_diff($tab_specifications_a_affecter, $tab_specifications_deja_affecte);
              $id_restantes = implode(",",$result);
              if(count($result) == 0)  {
                # code...
              }else {
                ?><li><i class="add_spe_restantes fas fa-plus-square" data-idelementaffectation="<?php echo $row2['unique_id']; ?>" data-idrestantes="<?php echo $id_restantes; ?>"></i> <?php echo count($result); ?> spécification(s) disponible(s)</li><?php
              }
              ?>
            </ul>
            <?php
            $numero_de_carte++;
            }
            ?>
          </div>
        </div>
        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <?php
            $sql2 = "SELECT audits2018_affectation_element.id as unique_id, audits2018_affectation_element.tag, audits2018_affectation_element.nb, audits2018_affectation_element.ordre, audits2018_liste_elements.id, audits2018_liste_elements.nom, audits2018_liste_elements.categorie  from audits2018_affectation_element INNER JOIN audits2018_liste_elements ON audits2018_affectation_element.id_element = audits2018_liste_elements.id WHERE audits2018_affectation_element.categorie = 'Connexions Internet' AND audits2018_affectation_element.id_audit = '".$_GET['id_audit']."' ORDER BY audits2018_affectation_element.id";
            $result2=mysqli_query($db,$sql2);
            $nb = mysqli_num_rows($result2);
            ?>
            <h4 class="my-0 font-weight-normal">Connexions Internet (<?php echo $nb; ?>)<span style="float:right"></span></h4>
          </div>
          <div class="card-body">
            <?php
            while($row2 = mysqli_fetch_array($result2))  {
            ?>
            <h4 data-element="<?php echo $numero_de_carte; ?>" data-state="invisible" class="nom_element card-title pricing-card-title"><small class="text-muted"><i class="fab fa-connectdevelop"></i> <?php echo $row2['nom']; ?> <?php echo $row2['tag']; if($row2['nb'] != '1') {
              echo ' ('.$row2['nb'].')';
            }
            ?></small></h1>
            <ul class="mt-3 mb-4 detail_element" id="element_<?php echo $numero_de_carte; ?>">
              <?php
              $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$row2['unique_id']."'";
              $result3=mysqli_query($db,$sql3);
              $tab_specifications_deja_affecte = [];
              while($row3 = mysqli_fetch_array($result3))   {
                $tab_specifications_deja_affecte[] = $row3['id_specification'];

                ?>
                <li><b><?php echo $row3['nom']; ?></b> <span style="float:right"><?php if($row3['valeur'] != '') echo $row3['valeur']; else echo 'N.C.' ?> </span></li>
                <?php
              }
              $sql3a = "SELECT * FROM `liste_specifications` WHERE `id_element` =  '".$row2['id']."' ";
              $result3a=mysqli_query($db,$sql3a);
              $tab_specifications_a_affecter = [];
              while($row3a = mysqli_fetch_array($result3a))    {
                $tab_specifications_a_affecter[] = $row3a['id'];
              }
              $result = array_diff($tab_specifications_a_affecter, $tab_specifications_deja_affecte);
              $id_restantes = implode(",",$result);
              if(count($result) == 0)  {
                # code...
              }else {
                ?><li><i class="add_spe_restantes fas fa-plus-square" data-idelementaffectation="<?php echo $row2['unique_id']; ?>" data-idrestantes="<?php echo $id_restantes; ?>"></i> <?php echo count($result); ?> spécification(s) disponible(s)</li><?php
              }
              ?>
            </ul>
            <?php
            $numero_de_carte++;
            }
            ?>
          </div>
        </div>
      </div>
      <div class="card-deck mb-3" style="margin:10px">
        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <?php
            $sql2 = "SELECT audits2018_affectation_element.id as unique_id, audits2018_affectation_element.tag, audits2018_affectation_element.nb, audits2018_affectation_element.ordre, audits2018_liste_elements.id, audits2018_liste_elements.nom, audits2018_liste_elements.categorie  from audits2018_affectation_element INNER JOIN audits2018_liste_elements ON audits2018_affectation_element.id_element = audits2018_liste_elements.id WHERE audits2018_affectation_element.categorie = 'Téléphonie Fixe' AND audits2018_affectation_element.id_audit = '".$_GET['id_audit']."' ORDER BY audits2018_affectation_element.id";
            $result2=mysqli_query($db,$sql2);
            $nb = mysqli_num_rows($result2);
            ?>
            <h4 class="my-0 font-weight-normal">Téléphonie Fixe (<?php echo $nb; ?>)<span style="float:right"></span></h4>
          </div>
          <div class="card-body">
            <?php
            while($row2 = mysqli_fetch_array($result2))  {
            ?>
            <h4 data-element="<?php echo $numero_de_carte; ?>" data-state="invisible" class="nom_element card-title pricing-card-title"><small class="text-muted"><i class="fas fa-phone"></i> <?php echo $row2['nom']; ?> <?php echo $row2['tag']; if($row2['nb'] != '1') {
              echo ' ('.$row2['nb'].')';
            }
            ?></small></h1>
            <ul class="mt-3 mb-4 detail_element" id="element_<?php echo $numero_de_carte; ?>">
              <?php
              $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$row2['unique_id']."'";
              $result3=mysqli_query($db,$sql3);
              $tab_specifications_deja_affecte = [];
              while($row3 = mysqli_fetch_array($result3))   {
                $tab_specifications_deja_affecte[] = $row3['id_specification'];

                ?>
                <li><b><?php echo $row3['nom']; ?></b> <span style="float:right"><?php if($row3['valeur'] != '') echo $row3['valeur']; else echo 'N.C.' ?> </span></li>
                <?php
              }
              $sql3a = "SELECT * FROM `liste_specifications` WHERE `id_element` =  '".$row2['id']."' ";
              $result3a=mysqli_query($db,$sql3a);
              $tab_specifications_a_affecter = [];
              while($row3a = mysqli_fetch_array($result3a))    {
                $tab_specifications_a_affecter[] = $row3a['id'];
              }
              $result = array_diff($tab_specifications_a_affecter, $tab_specifications_deja_affecte);
              $id_restantes = implode(",",$result);
              if(count($result) == 0)  {
                # code...
              }else {
                ?><li><i class="add_spe_restantes fas fa-plus-square" data-idelementaffectation="<?php echo $row2['unique_id']; ?>" data-idrestantes="<?php echo $id_restantes; ?>"></i> <?php echo count($result); ?> spécification(s) disponible(s)</li><?php
              }
              ?>
            </ul>
            <?php
            $numero_de_carte++;
            }
            ?>
          </div>
        </div>
        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <?php
            $sql2 = "SELECT audits2018_affectation_element.id as unique_id, audits2018_affectation_element.tag, audits2018_affectation_element.nb, audits2018_affectation_element.ordre, audits2018_liste_elements.id, audits2018_liste_elements.nom, audits2018_liste_elements.categorie  from audits2018_affectation_element INNER JOIN audits2018_liste_elements ON audits2018_affectation_element.id_element = audits2018_liste_elements.id WHERE audits2018_affectation_element.categorie = 'Téléphonie Mobile' AND audits2018_affectation_element.id_audit = '".$_GET['id_audit']."' ORDER BY audits2018_affectation_element.id";
            $result2=mysqli_query($db,$sql2);
            $nb = mysqli_num_rows($result2);
            ?>
            <h4 class="my-0 font-weight-normal">Téléphonie Mobile (<?php echo $nb; ?>)<span style="float:right"></span></h4>
          </div>
          <div class="card-body">
            <?php
            while($row2 = mysqli_fetch_array($result2))  {
            ?>
            <h4 data-element="<?php echo $numero_de_carte; ?>" data-state="invisible" class="nom_element card-title pricing-card-title"><small class="text-muted"><i class="fas fa-mobile"></i> <?php echo $row2['nom']; ?> <?php echo $row2['tag']; if($row2['nb'] != '1') {
              echo ' ('.$row2['nb'].')';
            }
            ?></small></h1>
            <ul class="mt-3 mb-4 detail_element" id="element_<?php echo $numero_de_carte; ?>">
              <?php
              $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$row2['unique_id']."'";
              $result3=mysqli_query($db,$sql3);
              $tab_specifications_deja_affecte = [];
              while($row3 = mysqli_fetch_array($result3))   {
                $tab_specifications_deja_affecte[] = $row3['id_specification'];

                ?>
                <li><b><?php echo $row3['nom']; ?></b> <span style="float:right"><?php if($row3['valeur'] != '') echo $row3['valeur']; else echo 'N.C.' ?> </span></li>
                <?php
              }
              $sql3a = "SELECT * FROM `liste_specifications` WHERE `id_element` =  '".$row2['id']."' ";
              $result3a=mysqli_query($db,$sql3a);
              $tab_specifications_a_affecter = [];
              while($row3a = mysqli_fetch_array($result3a))    {
                $tab_specifications_a_affecter[] = $row3a['id'];
              }
              $result = array_diff($tab_specifications_a_affecter, $tab_specifications_deja_affecte);
              $id_restantes = implode(",",$result);
              if(count($result) == 0)  {
                # code...
              }else {
                ?><li><i class="add_spe_restantes fas fa-plus-square" data-idelementaffectation="<?php echo $row2['unique_id']; ?>" data-idrestantes="<?php echo $id_restantes; ?>"></i> <?php echo count($result); ?> spécification(s) disponible(s)</li><?php
              }
              ?>
            </ul>
            <?php
            $numero_de_carte++;
            }
            ?>
          </div>
        </div>
      </div>
      <div class="card-deck mb-3" style="margin:10px">
        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <?php
            $sql2 = "SELECT audits2018_affectation_element.id as unique_id, audits2018_affectation_element.tag, audits2018_affectation_element.nb, audits2018_affectation_element.ordre, audits2018_liste_elements.id, audits2018_liste_elements.nom, audits2018_liste_elements.categorie  from audits2018_affectation_element INNER JOIN audits2018_liste_elements ON audits2018_affectation_element.id_element = audits2018_liste_elements.id WHERE audits2018_affectation_element.categorie = 'Réseau' AND audits2018_affectation_element.id_audit = '".$_GET['id_audit']."' ORDER BY audits2018_affectation_element.id";
            $result2=mysqli_query($db,$sql2);
            $nb = mysqli_num_rows($result2);
            ?>
            <h4 class="my-0 font-weight-normal">Réseau (<?php echo $nb; ?>)<span style="float:right"></span></h4>
          </div>
          <div class="card-body">
            <?php
            while($row2 = mysqli_fetch_array($result2))  {
            ?>
            <h4 data-element="<?php echo $numero_de_carte; ?>" data-state="invisible" class="nom_element card-title pricing-card-title"><small class="text-muted"><i class="fas fa-bezier-curve"></i> <?php echo $row2['nom']; ?> <?php echo $row2['tag']; if($row2['nb'] != '1') {
              echo ' ('.$row2['nb'].')';
            }
            ?></small></h1>
            <ul class="mt-3 mb-4 detail_element" id="element_<?php echo $numero_de_carte; ?>">
              <?php
              $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$row2['unique_id']."'";
              $result3=mysqli_query($db,$sql3);
              $tab_specifications_deja_affecte = [];
              while($row3 = mysqli_fetch_array($result3))   {
                $tab_specifications_deja_affecte[] = $row3['id_specification'];

                ?>
                <li><b><?php echo $row3['nom']; ?></b> <span style="float:right"><?php if($row3['valeur'] != '') echo $row3['valeur']; else echo 'N.C.' ?> </span></li>
                <?php
              }
              $sql3a = "SELECT * FROM `liste_specifications` WHERE `id_element` =  '".$row2['id']."' ";
              $result3a=mysqli_query($db,$sql3a);
              $tab_specifications_a_affecter = [];
              while($row3a = mysqli_fetch_array($result3a))    {
                $tab_specifications_a_affecter[] = $row3a['id'];
              }
              $result = array_diff($tab_specifications_a_affecter, $tab_specifications_deja_affecte);
              $id_restantes = implode(",",$result);
              if(count($result) == 0)  {
                # code...
              }else {
                ?><li><i class="add_spe_restantes fas fa-plus-square" data-idelementaffectation="<?php echo $row2['unique_id']; ?>" data-idrestantes="<?php echo $id_restantes; ?>"></i> <?php echo count($result); ?> spécification(s) disponible(s)</li><?php
              }
              ?>
            </ul>
            <?php
            $numero_de_carte++;
            }
            ?>
          </div>
        </div>
        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <?php
            $sql2 = "SELECT audits2018_affectation_element.id as unique_id, audits2018_affectation_element.tag, audits2018_affectation_element.nb, audits2018_affectation_element.ordre, audits2018_liste_elements.id, audits2018_liste_elements.nom, audits2018_liste_elements.categorie  from audits2018_affectation_element INNER JOIN audits2018_liste_elements ON audits2018_affectation_element.id_element = audits2018_liste_elements.id WHERE audits2018_affectation_element.categorie = 'Messagerie' AND audits2018_affectation_element.id_audit = '".$_GET['id_audit']."' ORDER BY audits2018_affectation_element.id";
            $result2=mysqli_query($db,$sql2);
            $nb = mysqli_num_rows($result2);
            ?>
            <h4 class="my-0 font-weight-normal">Messagerie (<?php echo $nb; ?>)<span style="float:right"></span></h4>
          </div>
          <div class="card-body">
            <?php
            while($row2 = mysqli_fetch_array($result2))  {
            ?>
            <h4 data-element="<?php echo $numero_de_carte; ?>" data-state="invisible" class="nom_element card-title pricing-card-title"><small class="text-muted"><i class="fas fa-comment-alt"></i> <?php echo $row2['nom']; ?> <?php echo $row2['tag']; if($row2['nb'] != '1') {
              echo ' ('.$row2['nb'].')';
            }
            ?></small></h1>
            <ul class="mt-3 mb-4 detail_element" id="element_<?php echo $numero_de_carte; ?>">
              <?php
              $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$row2['unique_id']."'";
              $result3=mysqli_query($db,$sql3);
              $tab_specifications_deja_affecte = [];
              while($row3 = mysqli_fetch_array($result3))   {
                $tab_specifications_deja_affecte[] = $row3['id_specification'];

                ?>
                <li><b><?php echo $row3['nom']; ?></b> <span style="float:right"><?php if($row3['valeur'] != '') echo $row3['valeur']; else echo 'N.C.' ?> </span></li>
                <?php
              }
              $sql3a = "SELECT * FROM `liste_specifications` WHERE `id_element` =  '".$row2['id']."' ";
              $result3a=mysqli_query($db,$sql3a);
              $tab_specifications_a_affecter = [];
              while($row3a = mysqli_fetch_array($result3a))    {
                $tab_specifications_a_affecter[] = $row3a['id'];
              }
              $result = array_diff($tab_specifications_a_affecter, $tab_specifications_deja_affecte);
              $id_restantes = implode(",",$result);
              if(count($result) == 0)  {
                # code...
              }else {
                ?><li><i class="add_spe_restantes fas fa-plus-square" data-idelementaffectation="<?php echo $row2['unique_id']; ?>" data-idrestantes="<?php echo $id_restantes; ?>"></i> <?php echo count($result); ?> spécification(s) disponible(s)</li><?php
              }
              ?>
            </ul>
            <?php
            $numero_de_carte++;
            }
            ?>
          </div>
        </div>
      </div>
      <div class="card-deck mb-3" style="margin:10px">
        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <?php
            $sql2 = "SELECT audits2018_affectation_element.id as unique_id, audits2018_affectation_element.tag, audits2018_affectation_element.nb, audits2018_affectation_element.ordre, audits2018_liste_elements.id, audits2018_liste_elements.nom, audits2018_liste_elements.categorie  from audits2018_affectation_element INNER JOIN audits2018_liste_elements ON audits2018_affectation_element.id_element = audits2018_liste_elements.id WHERE audits2018_affectation_element.categorie = 'Partage documentaire' AND audits2018_affectation_element.id_audit = '".$_GET['id_audit']."' ORDER BY audits2018_affectation_element.id";
            $result2=mysqli_query($db,$sql2);
            $nb = mysqli_num_rows($result2);
            ?>
            <h4 class="my-0 font-weight-normal">Partage documentaire (<?php echo $nb; ?>)<span style="float:right"></span></h4>
          </div>
          <div class="card-body">
            <?php
            while($row2 = mysqli_fetch_array($result2))  {
            ?>
            <h4 data-element="<?php echo $numero_de_carte; ?>" data-state="invisible" class="nom_element card-title pricing-card-title"><small class="text-muted"><i class="fas fa-file"></i> <?php echo $row2['nom']; ?> <?php echo $row2['tag']; if($row2['nb'] != '1') {
              echo ' ('.$row2['nb'].')';
            }
            ?></small></h1>
            <ul class="mt-3 mb-4 detail_element" id="element_<?php echo $numero_de_carte; ?>">
              <?php
              $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$row2['unique_id']."'";
              $result3=mysqli_query($db,$sql3);
              $tab_specifications_deja_affecte = [];
              while($row3 = mysqli_fetch_array($result3))   {
                $tab_specifications_deja_affecte[] = $row3['id_specification'];

                ?>
                <li><b><?php echo $row3['nom']; ?></b> <span style="float:right"><?php if($row3['valeur'] != '') echo $row3['valeur']; else echo 'N.C.' ?> </span></li>
                <?php
              }
              $sql3a = "SELECT * FROM `liste_specifications` WHERE `id_element` =  '".$row2['id']."' ";
              $result3a=mysqli_query($db,$sql3a);
              $tab_specifications_a_affecter = [];
              while($row3a = mysqli_fetch_array($result3a))    {
                $tab_specifications_a_affecter[] = $row3a['id'];
              }
              $result = array_diff($tab_specifications_a_affecter, $tab_specifications_deja_affecte);
              $id_restantes = implode(",",$result);
              if(count($result) == 0)  {
                # code...
              }else {
                ?><li><i class="add_spe_restantes fas fa-plus-square" data-idelementaffectation="<?php echo $row2['unique_id']; ?>" data-idrestantes="<?php echo $id_restantes; ?>"></i> <?php echo count($result); ?> spécification(s) disponible(s)</li><?php
              }
              ?>
            </ul>
            <?php
            $numero_de_carte++;
            }
            ?>
          </div>
        </div>
        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <?php
            $sql2 = "SELECT audits2018_affectation_element.id as unique_id, audits2018_affectation_element.tag, audits2018_affectation_element.nb, audits2018_affectation_element.ordre, audits2018_liste_elements.id, audits2018_liste_elements.nom, audits2018_liste_elements.categorie  from audits2018_affectation_element INNER JOIN audits2018_liste_elements ON audits2018_affectation_element.id_element = audits2018_liste_elements.id WHERE audits2018_affectation_element.categorie = 'Logiciel' AND audits2018_affectation_element.id_audit = '".$_GET['id_audit']."' ORDER BY audits2018_affectation_element.id";
            $result2=mysqli_query($db,$sql2);
            $nb = mysqli_num_rows($result2);
            ?>
            <h4 class="my-0 font-weight-normal">Logiciel (<?php echo $nb; ?>)<span style="float:right"></span></h4>
          </div>
          <div class="card-body">
            <?php
            while($row2 = mysqli_fetch_array($result2))  {
            ?>
            <h4 data-element="<?php echo $numero_de_carte; ?>" data-state="invisible" class="nom_element card-title pricing-card-title"><small class="text-muted"><i class="fab fa-microsoft"></i> <?php echo $row2['nom']; ?> <?php echo $row2['tag']; if($row2['nb'] != '1') {
              echo ' ('.$row2['nb'].')';
            }
            ?></small> </h1>
            <ul class="mt-3 mb-4 detail_element" id="element_<?php echo $numero_de_carte; ?>">
              <?php
              $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$row2['unique_id']."'";
              $result3=mysqli_query($db,$sql3);
              $tab_specifications_deja_affecte = [];
              while($row3 = mysqli_fetch_array($result3))   {
                $tab_specifications_deja_affecte[] = $row3['id_specification'];

                ?>
                <li><b><?php echo $row3['nom']; ?></b> <span style="float:right"><?php if($row3['valeur'] != '') echo $row3['valeur']; else echo 'N.C.' ?> </span></li>
                <?php
              }
              $sql3a = "SELECT * FROM `liste_specifications` WHERE `id_element` =  '".$row2['id']."' ";
              $result3a=mysqli_query($db,$sql3a);
              $tab_specifications_a_affecter = [];
              while($row3a = mysqli_fetch_array($result3a))    {
                $tab_specifications_a_affecter[] = $row3a['id'];
              }
              $result = array_diff($tab_specifications_a_affecter, $tab_specifications_deja_affecte);
              $id_restantes = implode(",",$result);
              if(count($result) == 0)  {
                # code...
              }else {
                ?><li><i class="add_spe_restantes fas fa-plus-square" data-idelementaffectation="<?php echo $row2['unique_id']; ?>" data-idrestantes="<?php echo $id_restantes; ?>"></i> <?php echo count($result); ?> spécification(s) disponible(s)</li><?php
              }
              ?>
            </ul>
            <?php
            $numero_de_carte++;
            }
            ?>
          </div>
        </div>
      </div>
      <div class="card-deck mb-3" style="margin:10px">
        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <?php
            $sql2 = "SELECT audits2018_affectation_element.id as unique_id, audits2018_affectation_element.tag, audits2018_affectation_element.nb, audits2018_affectation_element.ordre, audits2018_liste_elements.id, audits2018_liste_elements.nom, audits2018_liste_elements.categorie  from audits2018_affectation_element INNER JOIN audits2018_liste_elements ON audits2018_affectation_element.id_element = audits2018_liste_elements.id WHERE audits2018_affectation_element.categorie = 'Antivirus' AND audits2018_affectation_element.id_audit = '".$_GET['id_audit']."' ORDER BY audits2018_affectation_element.id";
            $result2=mysqli_query($db,$sql2);
            $nb = mysqli_num_rows($result2);
            ?>
            <h4 class="my-0 font-weight-normal">Antivirus (<?php echo $nb; ?>)<span style="float:right"></span></h4>
          </div>
          <div class="card-body">
            <?php
            while($row2 = mysqli_fetch_array($result2))  {
            ?>
            <h4 data-element="<?php echo $numero_de_carte; ?>" data-state="invisible" class="nom_element card-title pricing-card-title"><small class="text-muted"><i class="fas fa-file-medical"></i> <?php echo $row2['nom']; ?> <?php echo $row2['tag']; if($row2['nb'] != '1') {
              echo ' ('.$row2['nb'].')';
            }
            ?></small></h1>
            <ul class="mt-3 mb-4 detail_element" id="element_<?php echo $numero_de_carte; ?>">
              <?php
              $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$row2['unique_id']."'";
              $result3=mysqli_query($db,$sql3);
              $tab_specifications_deja_affecte = [];
              while($row3 = mysqli_fetch_array($result3))   {
                $tab_specifications_deja_affecte[] = $row3['id_specification'];

                ?>
                <li><b><?php echo $row3['nom']; ?></b> <span style="float:right"><?php if($row3['valeur'] != '') echo $row3['valeur']; else echo 'N.C.' ?> </span></li>
                <?php
              }
              $sql3a = "SELECT * FROM `liste_specifications` WHERE `id_element` =  '".$row2['id']."' ";
              $result3a=mysqli_query($db,$sql3a);
              $tab_specifications_a_affecter = [];
              while($row3a = mysqli_fetch_array($result3a))    {
                $tab_specifications_a_affecter[] = $row3a['id'];
              }
              $result = array_diff($tab_specifications_a_affecter, $tab_specifications_deja_affecte);
              $id_restantes = implode(",",$result);
              if(count($result) == 0)  {
                # code...
              }else {
                ?><li><i class="add_spe_restantes fas fa-plus-square" data-idelementaffectation="<?php echo $row2['unique_id']; ?>" data-idrestantes="<?php echo $id_restantes; ?>"></i> <?php echo count($result); ?> spécification(s) disponible(s)</li><?php
              }
              ?>
            </ul>
            <?php
            $numero_de_carte++;
            }
            ?>
          </div>
        </div>
        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <?php
            $sql2 = "SELECT audits2018_affectation_element.id as unique_id, audits2018_affectation_element.tag, audits2018_affectation_element.nb, audits2018_affectation_element.ordre, audits2018_liste_elements.id, audits2018_liste_elements.nom, audits2018_liste_elements.categorie  from audits2018_affectation_element INNER JOIN audits2018_liste_elements ON audits2018_affectation_element.id_element = audits2018_liste_elements.id WHERE audits2018_affectation_element.categorie = 'Sauvegarde' AND audits2018_affectation_element.id_audit = '".$_GET['id_audit']."' ORDER BY audits2018_affectation_element.id";
            $result2=mysqli_query($db,$sql2);
            $nb = mysqli_num_rows($result2);
            ?>
            <h4 class="my-0 font-weight-normal">Sauvegarde (<?php echo $nb; ?>)<span style="float:right"></span></h4>
          </div>
          <div class="card-body">
            <?php
            while($row2 = mysqli_fetch_array($result2))  {
            ?>
            <h4 data-element="<?php echo $numero_de_carte; ?>" data-state="invisible" class="nom_element card-title pricing-card-title"><small class="text-muted"><i class="fas fa-save"></i> <?php echo $row2['nom']; ?> <?php echo $row2['tag']; if($row2['nb'] != '1') {
              echo ' ('.$row2['nb'].')';
            }
            ?></small></h1>
            <ul class="mt-3 mb-4 detail_element" id="element_<?php echo $numero_de_carte; ?>">
              <?php
              $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$row2['unique_id']."'";
              $result3=mysqli_query($db,$sql3);
              $tab_specifications_deja_affecte = [];
              while($row3 = mysqli_fetch_array($result3))   {
                $tab_specifications_deja_affecte[] = $row3['id_specification'];

                ?>
                <li><b><?php echo $row3['nom']; ?></b> <span style="float:right"><?php if($row3['valeur'] != '') echo $row3['valeur']; else echo 'N.C.' ?> </span></li>
                <?php
              }
              $sql3a = "SELECT * FROM `liste_specifications` WHERE `id_element` =  '".$row2['id']."' ";
              $result3a=mysqli_query($db,$sql3a);
              $tab_specifications_a_affecter = [];
              while($row3a = mysqli_fetch_array($result3a))    {
                $tab_specifications_a_affecter[] = $row3a['id'];
              }
              $result = array_diff($tab_specifications_a_affecter, $tab_specifications_deja_affecte);
              $id_restantes = implode(",",$result);
              if(count($result) == 0)  {
                # code...
              }else {
                ?><li><i class="add_spe_restantes fas fa-plus-square" data-idelementaffectation="<?php echo $row2['unique_id']; ?>" data-idrestantes="<?php echo $id_restantes; ?>"></i> <?php echo count($result); ?> spécification(s) disponible(s)</li><?php
              }
              ?>
            </ul>
            <?php
            $numero_de_carte++;
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="card-deck mb-3" style="margin:10px">
        <div class="card shadow-sm">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Points forts <span style="float:right"><button type="button" data-type="fort" class="button_add_pt btn btn-info btn-sm"><i class="fas fa-plus-square"></i> Affecter</button></span></h4>
          </div>
          <div class="card-body">
            <?php
            $a = 0;
            $sql3a = "SELECT * FROM `audits2018_pts_forts_faibles` INNER JOIN  audits2018_affectation_pts_forts_faibles ON  audits2018_pts_forts_faibles.id = audits2018_affectation_pts_forts_faibles.id_pts_forts_faibles WHERE `id_audit` =  '".$_GET['id_audit']."' AND audits2018_affectation_pts_forts_faibles.type = 'fort' ";
            $result3a=mysqli_query($db,$sql3a);
            while($row3a = mysqli_fetch_array($result3a))    {
              ?><h4 class=" card-title pricing-card-title"><small class="text-muted"><i class="fas fa-thumbs-up"></i> <?php echo $row3a['nom']; ?><span style="float:right"><i data-id="<?php echo $row3a['id']; ?>" class="edit_pt fas fa-edit" style="cursor: pointer;"></i> <i data-id="<?php echo $row3a['id']; ?>" class="remove_pt fas fa-trash" style="color: red; cursor: pointer;"></i></span></small></h1>
                <ul class="" id="pt_fort_<?php echo $a; ?>" style="list-style: none;">
                  <li><?php echo $row3a['commentaires']; ?></li>
                </ul>
                <?php
            $a++;
            }
            ?>
          </div>
        </div>
      </div>
      <div class="card-deck mb-3" style="margin:10px">
        <div class="card shadow-sm">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Points faibles <span style="float:right"><button type="button" data-type="faible" class="button_add_pt btn btn-info btn-sm"><i class="fas fa-plus-square"></i> Affecter</button></span></h4>
          </div>
          <div class="card-body">
            <?php
            $a = 0;
            $sql3a = "SELECT * FROM `audits2018_pts_forts_faibles` INNER JOIN  audits2018_affectation_pts_forts_faibles ON  audits2018_pts_forts_faibles.id = audits2018_affectation_pts_forts_faibles.id_pts_forts_faibles WHERE `id_audit` =  '".$_GET['id_audit']."' AND audits2018_affectation_pts_forts_faibles.type = 'faible' ";
            $result3a=mysqli_query($db,$sql3a);
            while($row3a = mysqli_fetch_array($result3a))    {
              ?><h4 class=" card-title pricing-card-title"><small class="text-muted"><i class="fas fa-thumbs-up"></i> <?php echo $row3a['nom']; ?><span style="float:right"><i data-id="<?php echo $row3a['id']; ?>" class="edit_pt fas fa-edit" style="cursor: pointer;"></i> <i data-id="<?php echo $row3a['id']; ?>" class="remove_pt fas fa-trash" style="color: red; cursor: pointer;"></i></span></small></h1>
                <ul class="" id="pt_fort_<?php echo $a; ?>" style="list-style: none;">
                  <li><?php echo $row3a['commentaires']; ?></li>
                </ul>
                <?php
            $a++;
            }
            ?>
          </div>
        </div>
      </div>
      <div class="card-deck mb-3" style="margin:10px">
        <div class="card shadow-sm">
          <span style="float:right;margin:10px"><button type="button" id="goto_index" class="btn btn-outline-primary btn-sm"><i class="fas fa-undo"></i> Retour Accueil</button> <button type="button" id="goto_step1" class="btn btn-info btn-sm"><i class="fas fa-backward"></i> Go to Step 1</button> <button type="button" id="goto_step3" class="btn btn-info btn-sm"><i class="fas fa-play"></i> Go to Step 3</button></span>
        </div>
      </div>
    </div>
  </div>

  <!-- // MODALE AJOUT ELEMENT -->
  <div class="modal" id="modale_add_pt" role="dialog" tabindex="-1">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Affecter un Point Fort/Faible</h5><button aria-label="Close" class="close" data-dismiss="modal" type=
          "button"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body" id="body_add_pt">

        </div>
        <div class="modal-footer">
          <button class="refresh btn btn-info" type="button">Recommencer</button>
          <button class="btn btn-primary" data-dismiss="modal" id="valider_add_pt" type="submit">Valider</button>
          <button class="btn btn-secondary" data-dismiss="modal" type="button">Fermer</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="modale_edit_pt" role="dialog" tabindex="-1">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Affecter un Point Fort/Faible</h5><button aria-label="Close" class="close" data-dismiss="modal" type=
          "button"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body" id="body_edit_pt">

        </div>
        <div class="modal-footer">
          <button class="refresh btn btn-info" type="button">Recommencer</button>
          <button class="btn btn-primary" data-dismiss="modal" id="valider_edit_pt" type="submit">Valider</button>
          <button class="btn btn-secondary" data-dismiss="modal" type="button">Fermer</button>
        </div>
      </div>
    </div>
  </div>
  <!-- // FIN MODALE AJOUT ELEMENT -->



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

    $("#goto_step1").click(function() {
      var id = $("#id_audit_audit").val();
      window.location = "step1.php?id_audit="+id;
    });
    $("#goto_step3").click(function() {
      var id = $("#id_audit_audit").val();
      window.location = "step3.php?id_audit="+id;
    });
    $("#goto_index").click(function() {
      var id = $("#id_audit_audit").val();
      window.location = "index.php";
    });

    // la base
    $('#more').hide();
    $('.detail_element').hide();
    $('.nom_element').click(function()  {
      var id_element = $(this).data("element");
      var state = $(this).data("state");
      if (state == 'invisible') {
        $("#element_" + id_element).show(1000);
        $(this).data("state", "visible");
      } else {
        $("#element_" + id_element).hide(1000);
        $(this).data("state", "invisible");
      }
    });
    $('.fa-plus-square').css( 'cursor', 'pointer' );
    $('.fa-edit').css( 'cursor', 'pointer' );
    $('.fa-trash').css( 'cursor', 'pointer' );
    $('.nom_element').css( 'cursor', 'pointer' );
    // la base

    // le reste
    $(".button_add_pt").click(function() {
      var type = $(this).data("type");
      var id_audit = $("#id_audit_audit").val();
      $('#body_add_pt').load('php/template/step2/affecter_pt.php?id_audit='+id_audit+'&type='+type,function(contenu){
        $('#modale_add_pt').modal({show:true});
        $('#body_add_pt').html(contenu);
      });
    })

    $("#valider_add_pt").click(function()  {
      var serial = $("#mon_pt").serialize();
      console.log(serial);
      $.ajax({
        url: "php/template/step2/traitement_add_pt.php",
        type: 'GET',
        data: serial,
        success: function(data) {
          console.log(data);
          window.location.reload();
        }
      });
    });

    $("#valider_edit_pt").click(function()  {
      var serial = $("#mon_pt_edit").serialize();
      console.log(serial);
      $.ajax({
        url: "php/template/step2/traitement_edit_pt.php",
        type: 'GET',
        data: serial,
        success: function(data) {
          console.log(data);
          window.location.reload();
        }
      });
    });

    $('.refresh').click(function() {
      window.location.reload();
    });
    $(".edit_pt").click(function() {
      var id = $(this).data("id");
      $('#body_edit_pt').load('php/template/step2/edit_pt.php?id='+id,function(contenu){
        $('#modale_edit_pt').modal({show:true});
        $('#body_edit_pt').html(contenu);
      });
    })
    $(".remove_pt").click(function() {
      swal({
        title: 'Etes-vous certain ?',
        text: "Cette action est irréversible !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, Supprimer !',
        cancelButtonText: 'Annuler'
      }).then((result) => {
        if (result.value) {
          var id = $(this).data("id");
          $.ajax({
            url: "php/template/step2/delete_pt.php?id="+id,
            type: 'GET',
            success: function(data) {
              console.log(data);
              window.location.reload();
            }
          });
        }
      })
    })

  });
  </script>
</body>
</html>
