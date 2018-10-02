<!DOCTYPE html>
<html lang="fr">
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
  <input type="hidden" name="id_audit_audit" id="id_audit_audit" value="<?php echo $_GET['id_audit']; ?>" />
  <div class="row">
    <div class="col">
      <div class="card-deck mb-3" style="margin-top:10px;margin-left:5px">
        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <?php
            include('php/config.php');
            $sql = "SELECT * from audits2018_audits  WHERE id = '".$_GET['id_audit']."'";
            $result=mysqli_query($db,$sql);
            $row = mysqli_fetch_array($result);
            $etat = $row['etat'];
            ?>
            <h4 class="my-0 font-weight-normal">A Noter <span style="float:right">
              <button type="button" class="button_add_note btn btn-info btn-sm"><i class="fas fa-sticky-note"></i> Ajouter/modifier une note</button>
            </span></h4>
          </div>
          <div class="card-body">
            <?php
            echo $row['note'];
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-4">
      <div class="card-deck mb-3" style="margin-top:10px;margin-left:5px">
        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">OBLIGATOIRE <span style="float:right"><button type="button" data-type="OBLIGATOIRE" class="button_add_tarif btn btn-info btn-sm"><i class="fas fa-plus-square"></i> Affecter</button></span></h4>
          </div>
          <div class="card-body">
            <?php
            $pts_nb_total = 0;
            $a = 0;
            $sql3a = "SELECT * FROM `audits2018_affectation_tarif` WHERE `id_audit` =  '".$_GET['id_audit']."' AND type = 'OBLIGATOIRE' ";
            $result3a=mysqli_query($db,$sql3a);
            while($row3a = mysqli_fetch_array($result3a))    {
              ?><h4 class=" card-title pricing-card-title"><small class="text-muted"><i class="fas fa-money-bill-alt"></i> <?php echo $row3a['tarif']; ?> - <?php echo $row3a['nom']; ?><span style="float:right"><i data-id="<?php echo $row3a['id']; ?>" class="edit_tarif fas fa-edit" style="cursor: pointer;"></i> <i data-id="<?php echo $row3a['id']; ?>" class="remove_tarif fas fa-trash" style="color: red; cursor: pointer;"></i></span></small></h1>
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
    </div>
    <div class="col-4">
      <div class="card-deck mb-3" style="margin-top:10px">
        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">RECOMMANDE <span style="float:right"><button type="button" data-type="RECOMMANDE" class="button_add_tarif btn btn-info btn-sm"><i class="fas fa-plus-square"></i> Affecter</button></span></h4>
          </div>
          <div class="card-body">
            <?php
            $sql3a = "SELECT * FROM `audits2018_affectation_tarif` WHERE `id_audit` =  '".$_GET['id_audit']."' AND type = 'RECOMMANDE' ";
            $result3a=mysqli_query($db,$sql3a);
            while($row3a = mysqli_fetch_array($result3a))    {
              ?><h4 class=" card-title pricing-card-title"><small class="text-muted"><i class="fas fa-money-bill-alt"></i> <?php echo $row3a['tarif']; ?> - <?php echo $row3a['nom']; ?><span style="float:right"><i data-id="<?php echo $row3a['id']; ?>" class="edit_tarif fas fa-edit" style="cursor: pointer;"></i> <i data-id="<?php echo $row3a['id']; ?>" class="remove_tarif fas fa-trash" style="color: red; cursor: pointer;"></i></span></small></h1>
                <ul class="" id="pt_fort_<?php echo $a; ?>" style="list-style: none;">
                  <li><?php echo $row3a['commentaires']; ?></li>
                </ul>
                <?php
            $a++;
            $pts_nb_total++;
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    <div class="col-4">
      <div class="card-deck mb-3" style="margin-top:10px;margin-right:5px">
        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">CONFORT <span style="float:right"><button type="button" data-type="CONFORT" class="button_add_tarif btn btn-info btn-sm"><i class="fas fa-plus-square"></i> Affecter</button></span></h4>
          </div>
          <div class="card-body">
            <?php

            $sql3a = "SELECT * FROM `audits2018_affectation_tarif` WHERE `id_audit` =  '".$_GET['id_audit']."' AND type = 'CONFORT' ";
            $result3a=mysqli_query($db,$sql3a);
            while($row3a = mysqli_fetch_array($result3a))    {
              ?><h4 class=" card-title pricing-card-title"><small class="text-muted"><i class="fas fa-money-bill-alt"></i> <?php echo $row3a['tarif']; ?> - <?php echo $row3a['nom']; ?><span style="float:right"><i data-id="<?php echo $row3a['id']; ?>" class="edit_tarif fas fa-edit" style="cursor: pointer;"></i> <i data-id="<?php echo $row3a['id']; ?>" class="remove_tarif fas fa-trash" style="color: red; cursor: pointer;"></i></span></small></h1>
                <ul class="" id="pt_fort_<?php echo $a; ?>" style="list-style: none;">
                  <li><?php echo $row3a['commentaires']; ?></li>
                </ul>
                <?php
            $a++;
            $pts_nb_total++;
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  $sql3a = "SELECT * FROM `audits2018_audits` WHERE `id` =  '".$_GET['id_audit']."' ";
  $result3a=mysqli_query($db,$sql3a);
  $row3a = mysqli_fetch_array($result3a);
  ?>
  <div class="row" style="float:right;margin:10px">    <span style="float:right;margin:10px"><button type="button" data-already="<?php if($row3a['url_pdf'] != '') echo "true"; ?>" id="generer_pdf" class="btn btn-outline-primary btn-sm"><i class="fas fa-file-pdf"></i> Générer PDF</button> <button type="button" id="goto_step1" class="btn btn-info btn-sm"><i class="fas fa-backward"></i> Go to Step 1</button> <button type="button" id="goto_step2" class="btn btn-info btn-sm"><i class="fas fa-backward"></i> Go to Step 2</button></span>
</div>

  <div class="modal" id="modale_add_tarif" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ajouter un élement <span id="le_type_delement"></span></h5><button aria-label="Close" class="close" data-dismiss="modal" type=
          "button"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body" id="body_add_tarif">

        </div>
        <div class="modal-footer">
          <button class="refresh btn btn-info" type="button">Recommencer</button>
          <button class="btn btn-primary" data-dismiss="modal" id="valider_add_tarif" type="submit">Valider</button>
          <button class="btn btn-secondary" data-dismiss="modal" type="button">Fermer</button>
        </div>
      </div>
    </div>
  </div>
  <?php
  if( ($pts_nb_total == 0) && ($etat == 'En cours Points')) {
    $sql      = "UPDATE `audits2018_audits` SET `etat` = 'En cours Plan Action' WHERE `audits2018_audits`.`id` = '" . $_GET['id_audit'] . "' ";
    $result   = mysqli_query($db, $sql);

  /*  // OBLIGATOIRE
    $tab_obligatoire[0]["titre"] = "Titre 1 de base";
    $tab_obligatoire[0]["desc"] = "Description 1 à modifier par Mathieu";
    $tab_obligatoire[0]["tarif"] = "10";
    $tab_obligatoire[1]["titre"] = "Titre 2";
    $tab_obligatoire[1]["desc"] = "DEscription 2";
    $tab_obligatoire[1]["tarif"] = "20";
    foreach($tab_obligatoire as $value) {
      $sql      = "INSERT INTO `audits2018_affectation_tarif` (`id`, `id_audit`, `nom`, `tarif`, `type`, `commentaires`)
      VALUES (NULL, '".$_GET['id_audit']."', '".$value["titre"]."', '".$value["tarif"]."', 'OBLIGATOIRE', '".$value["desc"]."');";
      $result   = mysqli_query($db, $sql);
    }
    // RECOMMANDE
    $tab_recommande[0]["titre"] = "Titre 1";
    $tab_recommande[0]["desc"] = "Description 1 à modifier par Mathieu";
    $tab_recommande[0]["tarif"] = "10";
    foreach($tab_recommande as $value) {
      $sql      = "INSERT INTO `audits2018_affectation_tarif` (`id`, `id_audit`, `nom`, `tarif`, `type`, `commentaires`)
      VALUES (NULL, '".$_GET['id_audit']."', '".$value["titre"]."', '".$value["tarif"]."', 'RECOMMANDE', '".$value["desc"]."');";
      $result   = mysqli_query($db, $sql);
    }
    // CONFORT
    $tab_confort[0]["titre"] = "Titre 1";
    $tab_confort[0]["desc"] = "Description 1 à modifier par Mathieu";
    $tab_confort[0]["tarif"] = "10";
    foreach($tab_confort as $value) {
      $sql      = "INSERT INTO `audits2018_affectation_tarif` (`id`, `id_audit`, `nom`, `tarif`, `type`, `commentaires`)
      VALUES (NULL, '".$_GET['id_audit']."', '".$value["titre"]."', '".$value["tarif"]."', 'CONFORT', '".$value["desc"]."');";
      $result   = mysqli_query($db, $sql);
    }
    echo '<META http-equiv="refresh" content="1; URL=step3.php?id_audit='.$_GET['id_audit'].'">';*/
  }
  ?>

  <div class="modal" id="modale_add_note" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ajouter une note </h5><button aria-label="Close" class="close" data-dismiss="modal" type=
          "button"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body" id="body_add_note">

        </div>
        <div class="modal-footer">
          <button class="refresh btn btn-info" type="button">Recommencer</button>
          <button class="btn btn-primary" data-dismiss="modal" id="valider_add_note" type="submit">Valider</button>
          <button class="btn btn-secondary" data-dismiss="modal" type="button">Fermer</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="modale_edit_tarif" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editer un élement</h5><button aria-label="Close" class="close" data-dismiss="modal" type=
          "button"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body" id="body_edit_tarif">

        </div>
        <div class="modal-footer">
          <button class="refresh btn btn-info" type="button">Recommencer</button>
          <button class="btn btn-primary" data-dismiss="modal" id="valider_edit_tarif" type="submit">Valider</button>
          <button class="btn btn-secondary" data-dismiss="modal" type="button">Fermer</button>
        </div>
      </div>
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
  <script >
  $(function()  {
    $('.fa-plus-square').css( 'cursor', 'pointer' );
    $('.fa-edit').css( 'cursor', 'pointer' );
    $('.fa-trash').css( 'cursor', 'pointer' );
    $('.nom_element').css( 'cursor', 'pointer' );

    $(".button_add_tarif").click(function() {
      var type = $(this).data("type");
      $("#le_type_delement").text(type);
      var id_audit = $("#id_audit_audit").val();
      $('#body_add_tarif').load('php/template/step3/affecter_tarif.php?id_audit='+id_audit+'&type='+type,function(contenu){
        $('#modale_add_tarif').modal({show:true});
        $('#body_add_tarif').html(contenu);
      });
    })
    $(".button_add_note").click(function() {
      var id_audit = $("#id_audit_audit").val();
      $('#body_add_note').load('php/template/step3/affecter_note.php?id_audit='+id_audit,function(contenu){
        $('#modale_add_note').modal({show:true});
        $('#body_add_note').html(contenu);
      });
    })
    $("#valider_add_tarif").click(function()  {
      var serial = $("#mon_tarif").serialize();
      console.log(serial);
      $.ajax({
        url: "php/template/step3/traitement_add_tarif.php",
        type: 'GET',
        data: serial,
        success: function(data) {
          console.log(data);
          window.location.reload();
        }
      });
    });
    $("#valider_add_note").click(function()  {
      var serial = $("#mon_note").serialize();
      console.log(serial);
      $.ajax({
        url: "php/template/step3/traitement_add_note.php",
        type: 'GET',
        data: serial,
        success: function(data) {
          console.log(data);
          window.location.reload();
        }
      });
    });
    $(".edit_tarif").click(function() {
      var id = $(this).data("id");
      $('#body_edit_tarif').load('php/template/step3/edit_tarif.php?id='+id,function(contenu){
        $('#modale_edit_tarif').modal({show:true});
        $('#body_edit_tarif').html(contenu);
      });
    })
    $(".remove_tarif").click(function() {
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
            url: "php/template/step3/delete_tarif.php?id="+id,
            type: 'GET',
            success: function(data) {
              console.log(data);
              window.location.reload();
            }
          });
        }
      })
    })
    $("#valider_edit_tarif").click(function()  {
      var serial = $("#mon_tarif_edit").serialize();
      console.log(serial);
      $.ajax({
        url: "php/template/step3/traitement_edit_tarif.php",
        type: 'GET',
        data: serial,
        success: function(data) {
          console.log(data);
          window.location.reload();
        }
      });
    });

  })

  $("#goto_step1").click(function() {
    var id = $("#id_audit_audit").val();
    window.location = "step1.php?id_audit="+id;
  });
  $("#goto_step2").click(function() {
    var id = $("#id_audit_audit").val();
    window.location = "step2.php?id_audit="+id;
  });
  $("#goto_index").click(function() {
    var id = $("#id_audit_audit").val();
    window.location = "index.php";
  });
  $("#generer_pdf").click(function() {
    var already_exist = $(this).data("already");
    if(already_exist == true) {
      swal({
        title: 'Un document .pdf existe déja !',
        text: "Voulez-vous écraser l'ancienne version ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, Ecraser !',
        cancelButtonText: 'Annuler'
      }).then((result) => {
        if (result.value) {
          var id = $("#id_audit_audit").val();
          window.location = "generer.php?id_audit="+id;
        }
      })
    }else {
      var id = $("#id_audit_audit").val();
      window.location = "generer.php?id_audit="+id;
    }

  });

  </script>
</body>
</html>
