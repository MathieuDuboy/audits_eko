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
  <link rel="stylesheet" href="css/simplelightbox.min.css">

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

  </style>
</head>
<body>
  <?php include('php/config.php');
  $sql = "SELECT * from audits2018_audits  WHERE id = '".$_GET['id_audit']."'";
  $result=mysqli_query($db,$sql);
  $row = mysqli_fetch_array($result);

  ?>
  <!--<div class="row" style="margin:30px">
    <div class="col" >
        <button type="button" class="btn btn-primary" id="add_element">Ajouter/modifier Elément</button>
    </div>
  </div>-->

  <div class="row" style="margin:10px">
      <input type="hidden" name="id_audit_audit" id="id_audit_audit" value="<?php echo $_GET['id_audit']; ?>" />
      <div class="col-4" >
        <div class="form-group">
          <label for="nom">Nom de l'audit :</label>
          <input class="form-control" autocomplete="off" id="nom" name="nom" placeholder="Exemple : Démarrage" type="text" value="<?php echo $row['nom']; ?>">
        </div>
        <div class="form-group">
          <label for="nom">Etabli par :</label>
          <input class="form-control" id="manager" name="manager"  value="<?php echo $row['nom_manager']; ?>" type="text" autocomplete="off" value="">
          <input id="id_manager" name="id_manager"  type="hidden" value="<?php echo $row['id_manager']; ?>">
        </div>
        <div class="form-row" style="margin-bottom:10px">
          <div class="col-md-6">
            <label for="client">Client :</label>
            <input class="form-control" id="client" name="client"  type="text" value="<?php echo $row['nom_client']; ?>" autocomplete="off">
            <input id="id_client" name="id_client" value="<?php echo $row['id_client']; ?>" type="hidden">
            <input id="entreprise" name="entreprise"  type="hidden" value="<?php echo $row['entreprise']; ?>">
          </div>
          <div class="col-md-6">
            <label for="tech">Etat :</label>
            <select class="custom-select" id="etat" name="etat">
              <option selected value="<?php echo $row['etat']; ?>"><?php echo $row['etat']; ?></option>
              <option  value="Initialisé">Initialisé</option>
              <option  value="En cours Inventaire">En cours Inventaire</option>
              <option  value="En cours Points">En cours Points</option>
              <option  value="En cours Plan Action">En cours Plan Action</option>
              <option  value="Terminé">Terminé</option>
              <option  value="Terminé - Soumis client">Terminé - Soumis client</option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-4" >
        <div class="form-group">
          <label for="nom">Date :</label>
          <input class="form-control" autocomplete="off" id="date" name="date" value="<?php echo $row['date_ajout']; ?>" placeholder="" type="text" value="">
        </div>
        <div class="form-group">
          <label for="nom">Avant-Propos :</label>
          <?php $texte_de_base = 'Ceci est le texte de base à modifier par Mathieu. Il sera toujours le même lors d\'un ajout d\'audit. Le texte qui suivra sera alors modifiable à souhait.'; ?>
          <textarea class="form-control" id="commentaires" name="commentaires" rows="5"><?php if($row['commentaires'] == '') echo $texte_de_base; else echo $row['commentaires']; ?></textarea>
        </div>
      </div>
    </form>
    <div class="col-4" >
      <div class="form-group">
        <label for="nom">Gestion des photos :</label>
          <div class="small-demo">
            <div class="row">
              <?php
              $sql2a = "SELECT * from audits2018_fichiers  WHERE id_audit = '".$_GET['id_audit']."'";
              $result2a=mysqli_query($db,$sql2a);
              $nba = mysqli_num_rows($result2a);

              $sql2 = "SELECT * from audits2018_fichiers  WHERE id_audit = '".$_GET['id_audit']."' LIMIT 0,6";
              $result2=mysqli_query($db,$sql2);
              $nb = mysqli_num_rows($result2);
              while($row2 = mysqli_fetch_array($result2))  {
              ?>
                <div class="col-4"><a href="<?php echo $row2['chemin']; ?>"><img  style="margin-bottom: 5px" src="<?php echo $row2['chemin']; ?>" width="40"/></a> <button type="button" data-idfichier="<?php echo $row2['id']; ?>" class="remove_fichier btn btn-outline-primary btn-sm"><i class="fas fa-trash"></i></button></div>
              <?php
              }

              if($nba > 6) {
              ?>
                <div class="col-4" style="float:right;margin-top:10px"><button type="button" class="show_more btn btn-primary btn-sm"><span id="signe"><i class="fas fa-plus"></i></span> de photos</button></div>
              <?php
              }
              ?>
  			</div>
        <div class="row" id="more" style="margin-top:10px">
          <input type="hidden" name="hide_show" id="hide_show" value="hide" />

            <?php
              $sql2 = "SELECT * from audits2018_fichiers  WHERE id_audit = '".$_GET['id_audit']."' LIMIT 6,50";
              $result2=mysqli_query($db,$sql2);
              while($row2 = mysqli_fetch_array($result2))  {
              ?>
                <div class="col-4" ><a href="<?php echo $row2['chemin']; ?>"><img  style="margin-bottom: 5px" src="<?php echo $row2['chemin']; ?>" width="40"/></a> <button type="button" data-idfichier="<?php echo $row2['id']; ?>" class="remove_fichier btn btn-outline-primary btn-sm"><i class="fas fa-trash"></i></button></span></div>
              <?php
              }
            ?>
        </div>
      </div>
        <div class="row" style="margin-top:20px">
          <div class="col">
            <form method="post" action="php/upload.php"enctype="multipart/form-data">
              <div class="form-group" style="background-color:white">
                <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                <input type="hidden" name="id_audit" value="<?php echo $_GET['id_audit']; ?>" />
                <input type="hidden" name="retour_url" value="<?php $url = $_SERVER['REQUEST_URI']; echo $url; ?>" />
                <input name="userfile[]" class="form-control-file" multiple type="file" />
              </div>
              <span style="float:right"><button type="submit" id="telecharger" class="btn btn-outline-primary btn-sm"><i class="fas fa-download"></i> Télécharger</button> <button type="button" id="goto_index" class="btn btn-outline-primary btn-sm"><i class="fas fa-undo"></i> Retour Accueil</button> <button type="button" id="goto_step2" class="btn btn-info btn-sm"><i class="fas fa-play"></i> Go to Step 2</button></span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <hr/>
  <div class="card-deck mb-3" style="margin:10px">
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <?php
        $sql2 = "SELECT audits2018_affectation_element.id as unique_id, audits2018_affectation_element.tag, audits2018_affectation_element.nb, audits2018_affectation_element.ordre, audits2018_liste_elements.id, audits2018_liste_elements.nom, audits2018_liste_elements.categorie  from audits2018_affectation_element INNER JOIN audits2018_liste_elements ON audits2018_affectation_element.id_element = audits2018_liste_elements.id WHERE audits2018_affectation_element.categorie = 'Postes de travail' AND audits2018_affectation_element.id_audit = '".$_GET['id_audit']."' ORDER BY audits2018_affectation_element.id";
        $result2=mysqli_query($db,$sql2);
        $nb = mysqli_num_rows($result2);
        ?>
        <h4 class="my-0 font-weight-normal">Postes de travail <?php if($nb != 0) echo ': '.$nb.' <i class="fas fa-list"></i>'; ?> <span style="float:right"><button type="button" data-type="Postes de travail" class="button_affectation_element btn btn-info btn-sm"><i class="fas fa-plus-square"></i> Affecter</button></span></h4>
      </div>
      <div class="card-body">
        <?php
        $numero_de_carte = 0;
        while($row2 = mysqli_fetch_array($result2))  {

        ?>
        <h4 data-element="<?php echo $numero_de_carte; ?>" data-state="invisible" class="nom_element card-title pricing-card-title"><small class="text-muted"><i class="fas fa-desktop"></i> <?php echo $row2['nom'] ?> <?php echo $row2['tag'];
        if($row2['nb'] != '1') {
          echo ' ('.$row2['nb'].')';
        }
        ?>
      </small> <span style="float:right"><button type="button" data-idelementaffectation="<?php echo $row2['unique_id']; ?>" data-idelement="<?php echo $row2['id']; ?>" class="remove_element btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button> <button type="button" data-idelementaffectation="<?php echo $row2['unique_id']; ?>" data-idelement="<?php echo $row2['id']; ?>" data-type="Postes de travail" class="update_element btn btn-info btn-sm"><i class="fas fa-edit"></i></button></span></h1>
        <ul class="mt-3 mb-4 detail_element" id="element_<?php echo $numero_de_carte; ?>">
          <?php
          $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$row2['unique_id']."'";
          $result3=mysqli_query($db,$sql3);
          $tab_specifications_deja_affecte = [];
          while($row3 = mysqli_fetch_array($result3))   {
            $tab_specifications_deja_affecte[] = $row3['id_specification'];
            $tab_val = ["PTBrand", "PTFactor", "PTProc", "PTRAM", "PTDDType", "PTDDCapa", "PTDDOccup", "PTScreen"];
            $tab_nom = ["Marque", "Format", "Processeur", "RAM", "Type DD", "Capacité DD", "Tx Occup DD", "Ecran"];
            $key = array_search($row3['nom'], $tab_val);
            $nom = $tab_nom[$key];
            ?>
            <li><b><?php echo $nom; ?></b> <span style="float:right"><?php if($row3['valeur'] != '') echo $row3['valeur']; else echo 'N.C.' ?> <i data-element="<?php echo $numero_de_carte; ?>" data-id="<?php echo $row3['vrai_id']; ?>" class="edit_spe fas fa-edit"></i> <i data-id="<?php echo $row3['vrai_id']; ?>" data-element="<?php echo $numero_de_carte; ?>" class="remove_spe fas fa-trash" style="color:red"></i></span></li>
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
        <h4 class="my-0 font-weight-normal">Connexions Internet <?php if($nb != 0) echo ': '.$nb.' <i class="fas fa-list"></i>'; ?> <span style="float:right"><button type="button" data-type="Connexions Internet" class="button_affectation_element btn btn-info btn-sm"><i class="fas fa-plus-square"></i> Affecter</button></span></h4>
      </div>
      <div class="card-body">
        <?php
        while($row2 = mysqli_fetch_array($result2))  {
        ?>
        <h4 data-element="<?php echo $numero_de_carte; ?>" data-state="invisible" class="nom_element card-title pricing-card-title"><small class="text-muted"><i class="fab fa-connectdevelop"></i> <?php echo $row2['nom']; ?> <?php echo $row2['tag']; if($row2['nb'] != '1') {
          echo ' ('.$row2['nb'].')';
        }
        ?></small> <span style="float:right"><button type="button" data-idelementaffectation="<?php echo $row2['unique_id']; ?>" data-idelement="<?php echo $row2['id']; ?>" class="remove_element btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button> <button type="button" data-idelementaffectation="<?php echo $row2['unique_id']; ?>" data-idelement="<?php echo $row2['id']; ?>" data-type="Connexions Internet" class="update_element btn btn-info btn-sm"><i class="fas fa-edit"></i></button></span></h1>
        <ul class="mt-3 mb-4 detail_element" id="element_<?php echo $numero_de_carte; ?>">
          <?php
          $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$row2['unique_id']."'";
          $result3=mysqli_query($db,$sql3);
          $tab_specifications_deja_affecte = [];
          while($row3 = mysqli_fetch_array($result3))   {
            $tab_specifications_deja_affecte[] = $row3['id_specification'];
            $tab_val = ["CIOpe", "CITech", "CIDebit", "CIFF", "CITarif"];
            $tab_nom = ["Opérateur", "Techno", "Débit", "Forfait", "Tarif"];
            $key = array_search($row3['nom'], $tab_val);
            $nom = $tab_nom[$key];
            ?>
            <li><b><?php echo $nom; ?></b> <span style="float:right"><?php if($row3['valeur'] != '') echo $row3['valeur']; else echo 'N.C.' ?> <i data-element="<?php echo $numero_de_carte; ?>" data-id="<?php echo $row3['vrai_id']; ?>" class="edit_spe fas fa-edit"></i> <i data-id="<?php echo $row3['vrai_id']; ?>" data-element="<?php echo $numero_de_carte; ?>" class="remove_spe fas fa-trash" style="color:red"></i></span></li>
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
        $sql2 = "SELECT audits2018_affectation_element.id as unique_id, audits2018_affectation_element.tag, audits2018_affectation_element.nb, audits2018_affectation_element.ordre, audits2018_liste_elements.id, audits2018_liste_elements.nom, audits2018_liste_elements.categorie  from audits2018_affectation_element INNER JOIN audits2018_liste_elements ON audits2018_affectation_element.id_element = audits2018_liste_elements.id WHERE audits2018_affectation_element.categorie = 'Téléphonie Fixe' AND audits2018_affectation_element.id_audit = '".$_GET['id_audit']."' ORDER BY audits2018_affectation_element.id";
        $result2=mysqli_query($db,$sql2);
        $nb = mysqli_num_rows($result2);
        ?>
        <h4 class="my-0 font-weight-normal">Téléphonie Fixe <?php if($nb != 0) echo ': '.$nb.' <i class="fas fa-list"></i>'; ?> <span style="float:right"><button type="button" data-type="Téléphonie Fixe" class="button_affectation_element btn btn-info btn-sm"><i class="fas fa-plus-square"></i> Affecter</button></span></h4>
      </div>
      <div class="card-body">
        <?php
        while($row2 = mysqli_fetch_array($result2))  {
        ?>
        <h4 data-element="<?php echo $numero_de_carte; ?>" data-state="invisible" class="nom_element card-title pricing-card-title"><small class="text-muted"><i class="fas fa-phone"></i> <?php echo $row2['nom']; ?> <?php echo $row2['tag']; if($row2['nb'] != '1') {
          echo ' ('.$row2['nb'].')';
        }
        ?></small> <span style="float:right"><button type="button" data-idelementaffectation="<?php echo $row2['unique_id']; ?>" data-idelement="<?php echo $row2['id']; ?>" class="remove_element btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button> <button type="button" data-idelementaffectation="<?php echo $row2['unique_id']; ?>" data-idelement="<?php echo $row2['id']; ?>" data-type="Téléphonie Fixe" class="update_element btn btn-info btn-sm"><i class="fas fa-edit"></i></button></span></h1>
        <ul class="mt-3 mb-4 detail_element" id="element_<?php echo $numero_de_carte; ?>">
          <?php
          $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$row2['unique_id']."'";
          $result3=mysqli_query($db,$sql3);
          $tab_specifications_deja_affecte = [];
          while($row3 = mysqli_fetch_array($result3))   {
            $tab_specifications_deja_affecte[] = $row3['id_specification'];
            $tab_val = ["TFOpe", "TFTech", "TFNB", "TFFF", "TFTarif"];
            $tab_nom = ["Opérateur", "Techno", "Nb Postes", "Forfait", "Tarif"];
            $key = array_search($row3['nom'], $tab_val);
            $nom = $tab_nom[$key];
            ?>
            <li><b><?php echo $nom; ?></b> <span style="float:right"><?php if($row3['valeur'] != '') echo $row3['valeur']; else echo 'N.C.' ?> <i data-element="<?php echo $numero_de_carte; ?>" data-id="<?php echo $row3['vrai_id']; ?>" class="edit_spe fas fa-edit"></i> <i data-id="<?php echo $row3['vrai_id']; ?>" data-element="<?php echo $numero_de_carte; ?>" class="remove_spe fas fa-trash" style="color:red"></i></span></li>
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
        $sql2 = "SELECT audits2018_affectation_element.id as unique_id, audits2018_affectation_element.tag, audits2018_affectation_element.nb, audits2018_affectation_element.ordre, audits2018_liste_elements.id, audits2018_liste_elements.nom, audits2018_liste_elements.categorie  from audits2018_affectation_element INNER JOIN audits2018_liste_elements ON audits2018_affectation_element.id_element = audits2018_liste_elements.id WHERE audits2018_affectation_element.categorie = 'Téléphonie Mobile' AND audits2018_affectation_element.id_audit = '".$_GET['id_audit']."' ORDER BY audits2018_affectation_element.id";
        $result2=mysqli_query($db,$sql2);
        $nb = mysqli_num_rows($result2);
        ?>
        <h4 class="my-0 font-weight-normal">Téléphonie Mobile <?php if($nb != 0) echo ': '.$nb.' <i class="fas fa-list"></i>'; ?> <span style="float:right"><button type="button" data-type="Téléphonie Mobile" class="button_affectation_element btn btn-info btn-sm"><i class="fas fa-plus-square"></i> Affecter</button></span></h4>
      </div>
      <div class="card-body">
        <?php
        while($row2 = mysqli_fetch_array($result2))  {
        ?>
        <h4 data-element="<?php echo $numero_de_carte; ?>" data-state="invisible" class="nom_element card-title pricing-card-title"><small class="text-muted"><i class="fas fa-mobile"></i> <?php echo $row2['nom']; ?> <?php echo $row2['tag']; if($row2['nb'] != '1') {
          echo ' ('.$row2['nb'].')';
        }
        ?></small> <span style="float:right"><button type="button" data-idelementaffectation="<?php echo $row2['unique_id']; ?>" data-idelement="<?php echo $row2['id']; ?>" class="remove_element btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button> <button type="button" data-idelementaffectation="<?php echo $row2['unique_id']; ?>" data-idelement="<?php echo $row2['id']; ?>" data-type="Téléphonie Mobile" class="update_element btn btn-info btn-sm"><i class="fas fa-edit"></i></button></span></h1>
        <ul class="mt-3 mb-4 detail_element" id="element_<?php echo $numero_de_carte; ?>">
          <?php
          $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$row2['unique_id']."'";
          $result3=mysqli_query($db,$sql3);
          $tab_specifications_deja_affecte = [];
          while($row3 = mysqli_fetch_array($result3))   {
            $tab_specifications_deja_affecte[] = $row3['id_specification'];
            $tab_val = ["TMOpe", "TMTerminal", "TMFF", "TMTarif"];
            $tab_nom = ["Opérateur", "Mobiles", "Forfait", "Tarif"];
            $key = array_search($row3['nom'], $tab_val);
            $nom = $tab_nom[$key];
            ?>
            <li><b><?php echo $nom; ?></b> <span style="float:right"><?php if($row3['valeur'] != '') echo $row3['valeur']; else echo 'N.C.' ?> <i data-element="<?php echo $numero_de_carte; ?>" data-id="<?php echo $row3['vrai_id']; ?>" class="edit_spe fas fa-edit"></i> <i data-id="<?php echo $row3['vrai_id']; ?>" data-element="<?php echo $numero_de_carte; ?>" class="remove_spe fas fa-trash" style="color:red"></i></span></li>
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
        $sql2 = "SELECT audits2018_affectation_element.id as unique_id, audits2018_affectation_element.tag, audits2018_affectation_element.nb, audits2018_affectation_element.ordre, audits2018_liste_elements.id, audits2018_liste_elements.nom, audits2018_liste_elements.categorie  from audits2018_affectation_element INNER JOIN audits2018_liste_elements ON audits2018_affectation_element.id_element = audits2018_liste_elements.id WHERE audits2018_affectation_element.categorie = 'Réseau' AND audits2018_affectation_element.id_audit = '".$_GET['id_audit']."' ORDER BY audits2018_affectation_element.id";
        $result2=mysqli_query($db,$sql2);
        $nb = mysqli_num_rows($result2);
        ?>
        <h4 class="my-0 font-weight-normal">Réseau <?php if($nb != 0) echo ': '.$nb.' <i class="fas fa-list"></i>'; ?> <span style="float:right"><button type="button" data-type="Réseau" class="button_affectation_element btn btn-info btn-sm"><i class="fas fa-plus-square"></i> Affecter</button></span></h4>
      </div>
      <div class="card-body">
        <?php
        while($row2 = mysqli_fetch_array($result2))  {
        ?>
        <h4 data-element="<?php echo $numero_de_carte; ?>" data-state="invisible" class="nom_element card-title pricing-card-title"><small class="text-muted"><i class="fas fa-bezier-curve"></i> <?php echo $row2['nom']; ?> <?php echo $row2['tag']; if($row2['nb'] != '1') {
          echo ' ('.$row2['nb'].')';
        }
        ?></small> <span style="float:right"><button type="button" data-idelementaffectation="<?php echo $row2['unique_id']; ?>" data-idelement="<?php echo $row2['id']; ?>" class="remove_element btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button> <button type="button" data-idelementaffectation="<?php echo $row2['unique_id']; ?>" data-idelement="<?php echo $row2['id']; ?>" data-type="Réseau" class="update_element btn btn-info btn-sm"><i class="fas fa-edit"></i></button></span></h1>
        <ul class="mt-3 mb-4 detail_element" id="element_<?php echo $numero_de_carte; ?>">
          <?php
          $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$row2['unique_id']."'";
          $result3=mysqli_query($db,$sql3);
          $tab_specifications_deja_affecte = [];
          while($row3 = mysqli_fetch_array($result3))   {
            $tab_specifications_deja_affecte[] = $row3['id_specification'];
            $tab_val = ["RMarque", "RType", "RDebit", "RNB", "RNBCo"];
            $tab_nom = ["Marque", "Type", "Débits Supportés", "Nb", "Nb connexions"];
            $key = array_search($row3['nom'], $tab_val);
            $nom = $tab_nom[$key];
            ?>
            <li><b><?php echo $nom; ?></b> <span style="float:right"><?php if($row3['valeur'] != '') echo $row3['valeur']; else echo 'N.C.' ?> <i data-element="<?php echo $numero_de_carte; ?>" data-id="<?php echo $row3['vrai_id']; ?>" class="edit_spe fas fa-edit"></i> <i data-id="<?php echo $row3['vrai_id']; ?>" data-element="<?php echo $numero_de_carte; ?>" class="remove_spe fas fa-trash" style="color:red"></i></span></li>
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
        <h4 class="my-0 font-weight-normal">Messagerie <?php if($nb != 0) echo ': '.$nb.' <i class="fas fa-list"></i>'; ?> <span style="float:right"><button type="button" data-type="Messagerie" class="button_affectation_element btn btn-info btn-sm"><i class="fas fa-plus-square"></i> Affecter</button></span></h4>
      </div>
      <div class="card-body">
        <?php
        while($row2 = mysqli_fetch_array($result2))  {
        ?>
        <h4 data-element="<?php echo $numero_de_carte; ?>" data-state="invisible" class="nom_element card-title pricing-card-title"><small class="text-muted"><i class="fas fa-comment-alt"></i> <?php echo $row2['nom']; ?> <?php echo $row2['tag']; if($row2['nb'] != '1') {
          echo ' ('.$row2['nb'].')';
        }
        ?></small> <span style="float:right"><button type="button" data-idelementaffectation="<?php echo $row2['unique_id']; ?>" data-idelement="<?php echo $row2['id']; ?>" class="remove_element btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button> <button type="button" data-idelementaffectation="<?php echo $row2['unique_id']; ?>" data-idelement="<?php echo $row2['id']; ?>" data-type="Messagerie" class="update_element btn btn-info btn-sm"><i class="fas fa-edit"></i></button></span></h1>
        <ul class="mt-3 mb-4 detail_element" id="element_<?php echo $numero_de_carte; ?>">
          <?php
          $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$row2['unique_id']."'";
          $result3=mysqli_query($db,$sql3);
          $tab_specifications_deja_affecte = [];
          while($row3 = mysqli_fetch_array($result3))   {
            $tab_specifications_deja_affecte[] = $row3['id_specification'];
            $tab_val = ["MF", "MMA", "MC", "MU", "MA"];
            $tab_nom = ["Fournisseur", "Mode accès", "Capacité", "Utilisé", "Archive"];
            $key = array_search($row3['nom'], $tab_val);
            $nom = $tab_nom[$key];
            ?>
            <li><b><?php echo $nom; ?></b> <span style="float:right"><?php if($row3['valeur'] != '') echo $row3['valeur']; else echo 'N.C.' ?> <i data-element="<?php echo $numero_de_carte; ?>" data-id="<?php echo $row3['vrai_id']; ?>" class="edit_spe fas fa-edit"></i> <i data-id="<?php echo $row3['vrai_id']; ?>" data-element="<?php echo $numero_de_carte; ?>" class="remove_spe fas fa-trash" style="color:red"></i></span></li>
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
        <h4 class="my-0 font-weight-normal">Partage documentaire <?php if($nb != 0) echo ': '.$nb.' <i class="fas fa-list"></i>'; ?> <span style="float:right"><button type="button" data-type="Partage documentaire" class="button_affectation_element btn btn-info btn-sm"><i class="fas fa-plus-square"></i> Affecter</button></span></h4>
      </div>
      <div class="card-body">
        <?php
        while($row2 = mysqli_fetch_array($result2))  {
        ?>
        <h4 data-element="<?php echo $numero_de_carte; ?>" data-state="invisible" class="nom_element card-title pricing-card-title"><small class="text-muted"><i class="fas fa-file"></i> <?php echo $row2['nom']; ?> <?php echo $row2['tag']; if($row2['nb'] != '1') {
          echo ' ('.$row2['nb'].')';
        }
        ?></small> <span style="float:right"><button type="button" data-idelementaffectation="<?php echo $row2['unique_id']; ?>" data-idelement="<?php echo $row2['id']; ?>" class="remove_element btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button> <button type="button" data-idelementaffectation="<?php echo $row2['unique_id']; ?>" data-idelement="<?php echo $row2['id']; ?>" data-type="Partage documentaire" class="update_element btn btn-info btn-sm"><i class="fas fa-edit"></i></button></span></h1>
        <ul class="mt-3 mb-4 detail_element" id="element_<?php echo $numero_de_carte; ?>">
          <?php
          $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$row2['unique_id']."'";
          $result3=mysqli_query($db,$sql3);
          $tab_specifications_deja_affecte = [];
          while($row3 = mysqli_fetch_array($result3))   {
            $tab_specifications_deja_affecte[] = $row3['id_specification'];
            $tab_val = ["PDType", "PDFC", "PDC", "PDU", "PDGD"];
            $tab_nom = ["Type", "Fournisseur", "Capacité", "Utilisé", "Gestion droits"];
            $key = array_search($row3['nom'], $tab_val);
            $nom = $tab_nom[$key];
            ?>
            <li><b><?php echo $nom; ?></b> <span style="float:right"><?php if($row3['valeur'] != '') echo $row3['valeur']; else echo 'N.C.' ?> <i data-element="<?php echo $numero_de_carte; ?>" data-id="<?php echo $row3['vrai_id']; ?>" class="edit_spe fas fa-edit"></i> <i data-id="<?php echo $row3['vrai_id']; ?>" data-element="<?php echo $numero_de_carte; ?>" class="remove_spe fas fa-trash" style="color:red"></i></span></li>
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
        <h4 class="my-0 font-weight-normal">Logiciel <?php if($nb != 0) echo ': '.$nb.' <i class="fas fa-list"></i>'; ?> <span style="float:right"><button type="button" data-type="Logiciel" class="button_affectation_element btn btn-info btn-sm"><i class="fas fa-plus-square"></i> Affecter</button></span></h4>
      </div>
      <div class="card-body">
        <?php
        while($row2 = mysqli_fetch_array($result2))  {
        ?>
        <h4 data-element="<?php echo $numero_de_carte; ?>" data-state="invisible" class="nom_element card-title pricing-card-title"><small class="text-muted"><i class="fab fa-microsoft"></i> <?php echo $row2['nom']; ?> <?php echo $row2['tag']; if($row2['nb'] != '1') {
          echo ' ('.$row2['nb'].')';
        }
        ?></small> <span style="float:right"><button type="button" data-idelementaffectation="<?php echo $row2['unique_id']; ?>" data-idelement="<?php echo $row2['id']; ?>" class="remove_element btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button> <button type="button" data-idelementaffectation="<?php echo $row2['unique_id']; ?>" data-idelement="<?php echo $row2['id']; ?>" data-type="Logiciel" class="update_element btn btn-info btn-sm"><i class="fas fa-edit"></i></button></span></h1>
        <ul class="mt-3 mb-4 detail_element" id="element_<?php echo $numero_de_carte; ?>">
          <?php
          $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$row2['unique_id']."'";
          $result3=mysqli_query($db,$sql3);
          $tab_specifications_deja_affecte = [];
          while($row3 = mysqli_fetch_array($result3))   {
            $tab_specifications_deja_affecte[] = $row3['id_specification'];
            $tab_val = ["LE", "LM", "LNBC", "LTH", "LSO"];
            $tab_nom = ["Editeur", "Maintenance ?", "Nb Clients", "Type hébergement", "SAAS / OP"];
            $key = array_search($row3['nom'], $tab_val);
            $nom = $tab_nom[$key];
            ?>
            <li><b><?php echo $nom; ?></b> <span style="float:right"><?php if($row3['valeur'] != '') echo $row3['valeur']; else echo 'N.C.' ?> <i data-element="<?php echo $numero_de_carte; ?>" data-id="<?php echo $row3['vrai_id']; ?>" class="edit_spe fas fa-edit"></i> <i data-id="<?php echo $row3['vrai_id']; ?>" data-element="<?php echo $numero_de_carte; ?>" class="remove_spe fas fa-trash" style="color:red"></i></span></li>
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
        $sql2 = "SELECT audits2018_affectation_element.id as unique_id, audits2018_affectation_element.tag, audits2018_affectation_element.nb, audits2018_affectation_element.ordre, audits2018_liste_elements.id, audits2018_liste_elements.nom, audits2018_liste_elements.categorie  from audits2018_affectation_element INNER JOIN audits2018_liste_elements ON audits2018_affectation_element.id_element = audits2018_liste_elements.id WHERE audits2018_affectation_element.categorie = 'Antivirus' AND audits2018_affectation_element.id_audit = '".$_GET['id_audit']."' ORDER BY audits2018_affectation_element.id";
        $result2=mysqli_query($db,$sql2);
        $nb = mysqli_num_rows($result2);
        ?>
        <h4 class="my-0 font-weight-normal">Antivirus <?php if($nb != 0) echo ': '.$nb.' <i class="fas fa-list"></i>'; ?> <span style="float:right"><button type="button" data-type="Antivirus" class="button_affectation_element btn btn-info btn-sm"><i class="fas fa-plus-square"></i> Affecter</button></span></h4>
      </div>
      <div class="card-body">
        <?php
        while($row2 = mysqli_fetch_array($result2))  {
        ?>
        <h4 data-element="<?php echo $numero_de_carte; ?>" data-state="invisible" class="nom_element card-title pricing-card-title"><small class="text-muted"><i class="fas fa-file-medical"></i> <?php echo $row2['nom']; ?> <?php echo $row2['tag']; if($row2['nb'] != '1') {
          echo ' ('.$row2['nb'].')';
        }
        ?></small> <span style="float:right"><button type="button" data-idelementaffectation="<?php echo $row2['unique_id']; ?>" data-idelement="<?php echo $row2['id']; ?>" class="remove_element btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button> <button type="button" data-idelementaffectation="<?php echo $row2['unique_id']; ?>" data-idelement="<?php echo $row2['id']; ?>" data-type="Antivirus" class="update_element btn btn-info btn-sm"><i class="fas fa-edit"></i></button></span></h1>
        <ul class="mt-3 mb-4 detail_element" id="element_<?php echo $numero_de_carte; ?>">
          <?php
          $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$row2['unique_id']."'";
          $result3=mysqli_query($db,$sql3);
          $tab_specifications_deja_affecte = [];
          while($row3 = mysqli_fetch_array($result3))   {
            $tab_specifications_deja_affecte[] = $row3['id_specification'];
            $tab_val = ["AType", "ANBL", "ATarif", "AMan"];
            $tab_nom = ["Type", "Nb Licenses", "Tarif", "Managé ?"];
            $key = array_search($row3['nom'], $tab_val);
            $nom = $tab_nom[$key];
            ?>
            <li><b><?php echo $nom; ?></b> <span style="float:right"><?php if($row3['valeur'] != '') echo $row3['valeur']; else echo 'N.C.' ?> <i data-element="<?php echo $numero_de_carte; ?>" data-id="<?php echo $row3['vrai_id']; ?>" class="edit_spe fas fa-edit"></i> <i data-id="<?php echo $row3['vrai_id']; ?>" data-element="<?php echo $numero_de_carte; ?>" class="remove_spe fas fa-trash" style="color:red"></i></span></li>
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
        $sql2 = "SELECT audits2018_affectation_element.id as unique_id, audits2018_affectation_element.tag, audits2018_affectation_element.nb, audits2018_affectation_element.ordre, audits2018_liste_elements.id, audits2018_liste_elements.nom, audits2018_liste_elements.categorie  from audits2018_affectation_element INNER JOIN audits2018_liste_elements ON audits2018_affectation_element.id_element = audits2018_liste_elements.id WHERE audits2018_affectation_element.categorie = 'Sauvegarde' AND audits2018_affectation_element.id_audit = '".$_GET['id_audit']."' ORDER BY audits2018_affectation_element.id";
        $result2=mysqli_query($db,$sql2);
        $nb = mysqli_num_rows($result2);
        ?>
        <h4 class="my-0 font-weight-normal">Sauvegarde <?php if($nb != 0) echo ': '.$nb.' <i class="fas fa-list"></i>'; ?> <span style="float:right"><button type="button" data-type="Sauvegarde" class="button_affectation_element btn btn-info btn-sm"><i class="fas fa-plus-square"></i> Affecter</button></span></h4>
      </div>
      <div class="card-body">
        <?php
        while($row2 = mysqli_fetch_array($result2))  {
        ?>
        <h4 data-element="<?php echo $numero_de_carte; ?>" data-state="invisible" class="nom_element card-title pricing-card-title"><small class="text-muted"><i class="fas fa-save"></i> <?php echo $row2['nom']; ?> <?php echo $row2['tag']; if($row2['nb'] != '1') {
          echo ' ('.$row2['nb'].')';
        }
        ?></small> <span style="float:right"><button type="button" data-idelementaffectation="<?php echo $row2['unique_id']; ?>" data-idelement="<?php echo $row2['id']; ?>" class="remove_element btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button> <button type="button" data-idelementaffectation="<?php echo $row2['unique_id']; ?>" data-idelement="<?php echo $row2['id']; ?>" data-type="Sauvegarde" class="update_element btn btn-info btn-sm"><i class="fas fa-edit"></i></button></span></h1>
        <ul class="mt-3 mb-4 detail_element" id="element_<?php echo $numero_de_carte; ?>">
          <?php
          $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$row2['unique_id']."'";
          $result3=mysqli_query($db,$sql3);
          $tab_specifications_deja_affecte = [];
          while($row3 = mysqli_fetch_array($result3))   {
            $tab_specifications_deja_affecte[] = $row3['id_specification'];
            $tab_val = ["SSupport", "SLog", "SMon", "SAuto", "SPer"];
            $tab_nom = ["Support", "Logiciel", "Monitorée ?", "Automatisée ?", "Periodicité"];
            $key = array_search($row3['nom'], $tab_val);
            $nom = $tab_nom[$key];
            ?>
            <li><b><?php echo $nom; ?></b> <span style="float:right"><?php if($row3['valeur'] != '') echo $row3['valeur']; else echo 'N.C.' ?> <i data-element="<?php echo $numero_de_carte; ?>" data-type="Sauvegarde" data-id="<?php echo $row3['vrai_id']; ?>" class="edit_spe fas fa-edit"></i> <i data-id="<?php echo $row3['vrai_id']; ?>" data-element="<?php echo $numero_de_carte; ?>" class="remove_spe fas fa-trash" style="color:red"></i></span></li>
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
  <!-- Modales -->

  <!-- // MODALE AJOUT ELEMENT -->
  <div class="modal" id="modale_add_element" role="dialog" tabindex="-1">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gérer les éléments</h5><button aria-label="Close" class="close" data-dismiss="modal" type=
          "button"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body" id="body_add_element">
          <div class="form-group">
            <button type="button" class="add_element_button btn btn-primary btn-lg btn-block">+ Ajouter Element</button><br />
            <?php
             $sql = "SELECT * from liste_elements ORDER BY categorie";
             $result=mysqli_query($db,$sql);
             ?>
             <select class="custom-select" id="elements" name="elements">
               <option selected value="">Modifier un élément</option>
              <?php
                 while($row = mysqli_fetch_array($result)) {
                    ?>
                     <option value="<?php echo $row['id']; ?>"><?php echo $row['categorie']; ?> - <?php echo $row['nom']; ?></option>
                     <?php
                 }
                 ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button class="refresh btn btn-info" type="button">Recommencer</button>
          <button class="btn btn-primary" data-dismiss="modal" id="valider_add_element" type="submit">Valider</button>
          <button class="btn btn-secondary" data-dismiss="modal" type="button">Fermer</button>
        </div>
      </div>
    </div>
  </div>
  <!-- // FIN MODALE AJOUT ELEMENT -->

  <!-- // MODALE modale_affectation_element AUDIT -->
  <div class="modal" id="modale_affectation_element" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><span id="titre_affectation_element">Affecter un élement "<span id="affectation_type"></span>"</span></h5>
          <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body body_affectation_element">
        </div>
        <div class="modal-footer">
          <button class="refresh btn btn-info" type="button">Recommencer</button>
          <button class="btn btn-primary" data-dismiss="modal" id="valider_affectation_element" type="submit">Valider</button>
          <button class="btn btn-secondary" data-dismiss="modal" type="button">Fermer</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal" id="modale_affectation_element_update" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modifier l'élément</h5>
          <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body body_affectation_element_update">
        </div>
        <div class="modal-footer">
          <button class="refresh btn btn-info" type="button">Recommencer</button>
          <button class="btn btn-primary" data-dismiss="modal" id="valider_affectation_element_update" type="submit">Valider</button>
          <button class="btn btn-secondary" data-dismiss="modal" type="button">Fermer</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal" id="modale_add_spe_restantes" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ajouter spécifications restantes</h5>
          <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body body_add_spe_restantes">
        </div>
        <div class="modal-footer">
          <button class="refresh btn btn-info" type="button">Recommencer</button>
          <button class="btn btn-primary" data-dismiss="modal" id="valider_add_spe_restantes" type="submit">Valider</button>
          <button class="btn btn-secondary" data-dismiss="modal" type="button">Fermer</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal" id="modale_edit_spe" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editer spécification</h5>
          <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body body_edit_spe">
        </div>
        <div class="modal-footer">
          <button class="refresh btn btn-info" type="button">Recommencer</button>
          <button class="btn btn-primary" data-dismiss="modal" id="valider_edit_spe" type="submit">Valider</button>
          <button class="btn btn-secondary" data-dismiss="modal" type="button">Fermer</button>
        </div>
      </div>
    </div>
  </div>
  <!-- // FIN MODALE AJOUT AUDIT -->
  <?php
  if( ($numero_de_carte) == 1 && ($row['etat'] == 'Initialisé')) {
    $sql      = "UPDATE `audits2018_audits` SET `etat` = 'En cours Inventaire' WHERE `audits2018_audits`.`id` = '" . $_GET['id_audit'] . "' ";
    $result   = mysqli_query($db, $sql);
  }
  ?>
  <!-- Fin des Modales -->
  <script src="https://unpkg.com/popper.js@1.14.3/dist/umd/popper.min.js">
   </script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js">
  </script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js">
  </script>
  <script src="js/jquery.easy-autocomplete.min.js"></script>
  <script src="js/simple-lightbox.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.24.4/dist/sweetalert2.all.min.js">
  </script>
  <script>
  $(function()  {
    // modale ajouter_element
    $(".button_affectation_element").click(function() {
      var type = $(this).data("type");
      $("#affectation_type").text(type);
      $("#categorie_element").val(type);
      var id_audit = $("#id_audit_audit").val();
      $('.body_affectation_element').load('php/template/step1/affecter_element.php?id_audit='+id_audit+'&type='+encodeURI(type),function(contenu){
        $('#modale_affectation_element').modal({show:true});
        $('.body_affectation_element').html(contenu);
      });
    });
    $(".update_element").click(function() {
      var id_element = $(this).data("idelement");
      var type = $(this).data("type");
      var id_element_affectation = $(this).data("idelementaffectation");
      var id_audit = $("#id_audit_audit").val();
      $('.body_affectation_element_update').load(encodeURI('php/template/step1/update_affecter_element.php?id_audit='+id_audit+'&id_element='+id_element+'&id_element_affectation='+id_element_affectation+'&type='+type),function(contenu){
        $('#modale_affectation_element_update').modal({show:true});
        $('.body_affectation_element_update').html(contenu);
      });
    })
    $(".add_spe_restantes").click(function() {
      var id_restantes = $(this).data("idrestantes");
      var id_element_affectation = $(this).data("idelementaffectation");
      var id_audit = $("#id_audit_audit").val();
      $('.body_add_spe_restantes').load('php/template/step1/add_spe_restantes.php?id_audit='+id_audit+'&id_restantes='+id_restantes+'&id_element_affectation='+id_element_affectation,function(contenu){
        $('#modale_add_spe_restantes').modal({show:true});
        $('.body_add_spe_restantes').html(contenu);
      });
    })
    $("#valider_add_spe_restantes").click(function()  {
      var serial = $("#mon_affectation_spe_restantes").serialize();
      console.log(serial);
      $.ajax({
        url: "php/template/step1/traitement_add_spe_restantes.php",
        type: 'GET',
        data: serial,
        success: function(data) {
          console.log(data);
          window.location.reload();
        }
      });
    });

    $(".remove_element").click(function() {
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
          var id_element_affectation = $(this).data("idelementaffectation");
          $.ajax({
            url: "php/template/step1/delete_element_affectation.php?id_element_affectation="+id_element_affectation,
            type: 'GET',
            success: function(data) {
              console.log(data);
              window.location.reload();
            }
          });
        }
      })
    })
    $(".edit_spe").click(function() {
      var id = $(this).data("id");
      var derniere_carte = $(this).data("element");
      localStorage.setItem("derniere_carte", derniere_carte);
      $('.body_edit_spe').load('php/template/step1/edit_spe.php?id='+id,function(contenu){
        $('#modale_edit_spe').modal({show:true});
        $('.body_edit_spe').html(contenu);
      });
    });
    $(".remove_spe").click(function() {
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
          var derniere_carte = $(this).data("element");
          localStorage.setItem("derniere_carte", derniere_carte);
          $.ajax({
            url: "php/template/step1/delete_spe.php?id="+id,
            type: 'GET',
            success: function(data) {
              console.log(data);
              window.location.reload();
            }
          });
        }
      })
    })
    $("#valider_affectation_element_update").click(function()  {
      var serial = $("#mon_affectation_update").serialize();
      console.log(serial);
      $.ajax({
        url: "php/template/step1/traitement_affecter_element_update.php",
        type: 'GET',
        data: serial,
        success: function(data) {
          console.log(data);
          window.location.reload();
        }
      });
    });
    $("#valider_affectation_element").click(function() {
        var serial = $("#mon_affectation").serialize();
        console.log(serial);
        $.ajax({
          url: "php/template/step1/traitement_affecter_element.php",
          type: 'GET',
          data: serial,
          success: function(data) {
            console.log(data);
            window.location.reload();
          }
        });
    });
    $("#valider_edit_spe").click(function() {
        var serial = $("#mon_affectation_edit_spe").serialize();
        console.log(serial);
        $.ajax({
          url: "php/template/step1/traitement_edit_spe.php",
          type: 'GET',
          data: serial,
          success: function(data) {
            console.log(data);
            window.location.reload();
          }
        });
    });

    $('.small-demo a').simpleLightbox();
    $('#more').hide();
    $('.detail_element').hide();
    var derniere_carte = localStorage.getItem("derniere_carte");
    if(derniere_carte != null) {
      $("#element_" + derniere_carte).show(1000);
      localStorage.clear();
    }
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
    $("#date").datepicker({
      dateFormat: 'dd/mm/yy'
    });
    $('.fa-plus-square').css( 'cursor', 'pointer' );
    $('.fa-edit').css( 'cursor', 'pointer' );
    $('.fa-trash').css( 'cursor', 'pointer' );

    $("#goto_step2").click(function() {
      var id = $("#id_audit_audit").val();
      window.location = "step2.php?id_audit="+id;
    });
    $('.nom_element').css( 'cursor', 'pointer' );
    $("#commentaires").blur(function() {
      var commentaires = $("#commentaires").val();
      console.log(commentaires);
      var id_audit = $('#id_audit_audit').val();
      $.ajax({
        url: "php/modifier_audit.php", //this is the submit URL
        type: 'GET', //or POST
        data: {
          id_audit: id_audit,
          commentaires: commentaires
        },
        success: function(data) {
          console.log(data);
          window.location.reload();
        }
      });
    })
    $("#date").change(function() {
      var date_ajout = $(this).val()
      var id_audit = $('#id_audit_audit').val();
      $.ajax({
        url: "php/modifier_audit.php", //this is the submit URL
        type: 'GET', //or POST
        data: {
          id_audit: id_audit,
          date_ajout: date_ajout
        },
        success: function(data) {
          console.log(data);
          window.location.reload();
        }
      });
    });
    $("#etat").change(function() {
      var etat = $(this).val()
      var id_audit = $('#id_audit_audit').val();
      $.ajax({
        url: "php/modifier_audit.php", //this is the submit URL
        type: 'GET', //or POST
        data: {
          id_audit: id_audit,
          etat: etat
        },
        success: function(data) {
          console.log(data);
          window.location.reload();
        }
      });
    })
    $('#nom').blur(function() {
      var nom = $("#nom").val();
      var id_audit = $('#id_audit_audit').val();
      $.ajax({
        url: "php/modifier_audit.php", //this is the submit URL
        type: 'GET', //or POST
        data: {
          id_audit: id_audit,
          nom: nom
        },
        success: function(data) {
          console.log(data);
          window.location.reload();
        }
      });
    })
    $('.show_more').click(function() {
      var val =  $('#hide_show').val();
      if(val == 'hide') {
        $("#signe").html('<i class="fas fa-minus">');
        $('#more').show(1000);
        $('#hide_show').val("show");
      }else {
        $("#signe").html('<i class="fas fa-plus">');
        $('#more').hide(1000);
        $('#hide_show').val("hide");
      }
    });
    $("#goto_index").click(function() {
      var id = $("#id_audit_audit").val();
      window.location = "index.php";
    });
    $('.remove_fichier').click(function() {
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
          var id_fichier =  $(this).data("idfichier");
          console.log(id_fichier);
          $.ajax({
            url: "php/delete_fichier.php?id_fichier="+id_fichier,
            type: 'GET',
            success: function(data) {
              console.log(data);
              window.location.reload();
            }
          });
        }
      })
    });
    $('#telecharger').attr('disabled',true);
    $('input[type=file]').change(function(){
    if($('input[type=file]').val()==''){
          $('#telecharger').attr('disabled',true)
        }
        else{
          $('#telecharger').attr('disabled',false);
        }
    })
    $('.refresh').click(function() {
      window.location.reload();
    });

    // autocomplete
    var options_manager = {
      url: function(phrase) {
        return "php/recherche_collab_users.php?type=manager";
      },
      getValue: function(element) {
        console.log(element);
        return element.visuel;
      },
      ajaxSettings: {
        dataType: "json",
        method: "POST",
        data: {
          dataType: "json"
        }
      },
      preparePostData: function(data) {
        data.phrase = $("#manager").val();
        return data;
      },
      list: {
        maxNumberOfElements: 6,
        match: {
          enabled: true
        },
        onChooseEvent: function(item) {
          var visuel = $("#manager").getSelectedItemData().visuel;
          var nom_prenom = $("#manager").getSelectedItemData().nom_prenom;
          var id_manager = $("#manager").getSelectedItemData().id;
          var email = $("#manager").getSelectedItemData().email;
          var company = $("#manager").getSelectedItemData().company;
          var id_projet = $('#id_projet').val();
          $('#manager').val(nom_prenom);
          var id_audit = $('#id_audit_audit').val();
          $('#id_manager').val(id_manager);
          $.ajax({
            url: "php/modifier_audit.php", //this is the submit URL
            type: 'GET', //or POST
            data: {
              id_audit: id_audit,
              manager: nom_prenom,
              id_manager: id_manager
            },
            success: function(data) {
              console.log(data);
              window.location.reload();
            }
          });
        }
      },
      requestDelay: 400,
      adjustWidth: false
    };
    var options_client = {
      url: function(phrase) {
        return "php/recherche_collab_users.php?type=client";
      },
      getValue: function(element) {
        //  console.log(element);
        return element.visuel;
      },
      ajaxSettings: {
        dataType: "json",
        method: "POST",
        data: {
          dataType: "json"
        }
      },
      preparePostData: function(data) {
        data.phrase = $("#client").val();
        return data;
      },
      list: {
        maxNumberOfElements: 6,
        match: {
          enabled: true
        },
        onChooseEvent: function(item) {
          var visuel = $("#client").getSelectedItemData().visuel;
          var nom_prenom = $("#client").getSelectedItemData().nom_prenom;
          var id_client = $("#client").getSelectedItemData().id;
          var email = $("#client").getSelectedItemData().email;
          var company = $("#client").getSelectedItemData().company;
          var id_audit = $('#id_audit_audit').val();
          $('#client').val(company);
          $('#id_client').val(id_client);
          $('#entreprise').val(company);
          $.ajax({
            url: "php/modifier_audit.php", //this is the submit URL
            type: 'GET', //or POST
            data: {
              id_audit: id_audit,
              client: company,
              id_client: id_client
            },
            success: function(data) {
              console.log(data);
              window.location.reload();
            }
          });
        }
      },
      requestDelay: 400,
      adjustWidth: false
    };
    $("#manager").easyAutocomplete(options_manager);
    $("#client").easyAutocomplete(options_client);

    // modale add_element
    $('#add_element').click(function() {
      $("#modale_add_element").modal("show");
    });
    $(".add_element_button").click(function() {
      $('#body_add_element').load('php/template/elements/add_element.php',function(){});
    });
    $("#elements").change(function() {
      var id_element = $(this).val();
      $('#body_add_element').load('php/template/elements/update_add_element.php?id_element='+id_element,function(){
          console.log('id tache simple : '+valeur);
          $('#valider').prop('disabled', false);
      });
    });
    $('#valider_add_element').click(function() {
      var que_faire = $("#goto_template_add_element").val();
      if(que_faire == 'add') {
        var serial = $("#template_add_element").serialize();
        $.ajax({
          url: "php/template/elements/traitement_add_element.php",
          type: 'GET',
          data: serial,
          success: function(data) {
            console.log(data);
            window.location.reload();
          }
        });
      }else {
        var serial = $("#template_update_element").serialize();
        $.ajax({
          url: "php/template/elements/traitement_update_element.php",
          type: 'GET',
          data: serial,
          success: function(data) {
            console.log(data);
            window.location.reload();
          }
        });
      }
    });
  })
  </script>
</body>
</html>
