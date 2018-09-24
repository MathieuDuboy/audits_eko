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
        <button type="button" class="btn btn-primary" id="add_audit">Créer Audit</button>
        <button type="button" class="btn btn-primary" id="add_element">Ajouter/modifier Elément</button>
        <button type="button" class="btn btn-primary" id="add_pt_fort_faible">Ajouter/modifier Point Fort/Faible</button>
    </div>
  </div>
  <div class="row" style="padding:30px">
    <div class="col" >
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Client</th>
            <th scope="col">Date ajout</th>
            <th scope="col">Etabli par</th>
            <th scope="col">Inventaire</th>
            <th scope="col">Pts Forts/Faibles</th>
            <th scope="col">Plan d'action</th>
            <th scope="col">PDF</th>
            <th scope="col"><i class="fas fa-trash"></i></th>
          </tr>
        </thead>
        <tbody>
          <?php
          include('php/config.php');
          $query = "SELECT * from audits2018_audits ORDER BY id";
          $result = $db->query($query) or die($db->error);
          while($row = $result->fetch_array()) {
            extract($row);
            ?>
            <tr>
              <th scope="row"><?php echo $id; ?></th>
              <td><?php echo $nom; ?></td>
              <td><?php echo $nom_client; ?></td>
              <td><?php echo $date_ajout; ?></td>
              <td><?php echo $nom_manager; ?></td>
              <td><button data-id="<?php echo $id; ?>" type="button" class="step1 btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i> Editer</button></td>
              <td><button data-id="<?php echo $id; ?>" type="button" class="step2 btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i> Editer</button></td>
              <td><button data-id="<?php echo $id; ?>" type="button" class="step3 btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i> Editer</button></td>
              <td>
                <?php
                if($url_pdf == '') {
                ?>
                  <button type="button" class="btn btn-outline-primary btn-sm"><i class="fas fa-file-pdf"></i> Générer</button>
                <?php
                }else {
                  ?>
                    <button type="button" class="btn btn-outline-info btn-sm"><i class="fas fa-file-pdf"></i> Download</button>
                  <?php
                }
                ?>
              </td>
              <td><i data-idaudit="<?php echo $id; ?>" class="delete_audit fas fa-trash"></i><td>
            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- Modales -->

  <!-- // MODALE AJOUT AUDIT -->
  <div class="modal" id="modale_add_audit" role="dialog" tabindex="-1">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Créer un audit</h5>
          <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body" id="body_add_audit">
          <form id="mon_audit" name="mon_audit">
            <div class="form-group">
              <label for="nom">Nom de l'audit :</label>
              <input class="form-control" autocomplete="off" id="nom" name="nom" placeholder="Exemple : Démarrage" type="text">
            </div>
            <div class="form-group">
              <label for="nom">Etabli par :</label>
              <input class="form-control" id="manager" name="manager"  type="text" autocomplete="off" value="">
              <input id="id_manager" name="id_manager"  type="hidden">
            </div>
            <div class="form-row" style="margin-bottom:10px">
              <div class="col-md-6">
                <label for="client">Client :</label>
                <input class="form-control" id="client" name="client"  type="text" autocomplete="off">
                <input id="id_client" name="id_client"  type="hidden">
                <input id="entreprise" name="entreprise"  type="hidden">
              </div>
              <div class="col-md-6">
                <label for="tech">Etat :</label>
                <select class="custom-select" id="etat" name="etat">
                  <option selected value="Initialisé">Initialisé</option>
                  <option  value="En cours Inventaire">En cours Inventaire</option>
                  <option  value="En cours Points">En cours Points</option>
                  <option  value="En cours Plan Action">En cours Plan Action</option>
                  <option  value="Terminé">Terminé</option>
                  <option  value="Terminé - Soumis client">Terminé - Soumis client</option>
                </select>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="refresh btn btn-info" type="button">Recommencer</button>
          <button class="btn btn-primary" data-dismiss="modal" id="valider_add_audit" type="submit">Valider</button>
          <button class="btn btn-secondary" data-dismiss="modal" type="button">Fermer</button>
        </div>
      </div>
    </div>
  </div>
  <!-- // FIN MODALE AJOUT AUDIT -->

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
             $sql = "SELECT * from audits2018_liste_elements ORDER BY categorie";
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

  <!-- // MODALE AJOUT PTS FORTS / FAIBLES -->
  <div class="modal" id="modale_add_pt_fort_faible" role="dialog" tabindex="-1">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gérer les Pts Forts / Faibles</h5><button aria-label="Close" class="close" data-dismiss="modal" type=
          "button"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body" id="body_add_pt_fort_faible">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="pt_fort"><i class="fas fa-edit"></i> Modifier un Point</label>
                <?php
                 $sql = "SELECT * from audits2018_pts_forts_faibles WHERE type = 'fort' ORDER BY id";
                 $result=mysqli_query($db,$sql);
                 ?>
                 <select class="custom-select" id="pt_fort" name="pt_fort">
                   <option selected value="">Modifier un Point Fort</option>
                  <?php
                     while($row = mysqli_fetch_array($result)) {
                        ?>
                         <option value="<?php echo $row['id']; ?>"><?php echo $row['nom']; ?></option>
                         <?php
                     }
                     ?>
                </select>
              </div>
              <div class="form-group">
                <?php
                 $sql = "SELECT * from audits2018_pts_forts_faibles WHERE type = 'faible' ORDER BY id";
                 $result=mysqli_query($db,$sql);
                 ?>
                 <select class="custom-select" id="pt_faible" name="pt_faible">
                   <option selected value="">Modifier un Point Faible</option>
                  <?php
                     while($row = mysqli_fetch_array($result)) {
                        ?>
                         <option value="<?php echo $row['id']; ?>"><?php echo $row['nom']; ?></option>
                         <?php
                     }
                     ?>
                </select>
              </div>
            </div>
            <div class="col-6" style="border-left:solid 1px">
              <div class="form-group">
                <label for="type"><i class="fas fa-plus-square"></i> Ajouter un Point</label>
                  <select class="custom-select" id="type" name="type">
                     <option selected value="fort">Point Fort</option>
                     <option value="faible">Point Faible</option>
                  </select>
              </div>
              <div class="form-group">
                <input class="form-control" id="nom" name="nom"  type="text" placeholder="Intitulé du point" autocomplete="off">
                <input type="hidden" name="modification" id="modification" value="false" />
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="refresh btn btn-info" type="button">Recommencer</button>
          <button class="btn btn-primary" data-dismiss="modal" id="valider_add_pt_fort_faible" type="submit">Valider</button>
          <button class="btn btn-secondary" data-dismiss="modal" type="button">Fermer</button>
        </div>
      </div>
    </div>
  </div>
  <!-- // FIN MODALE AJOUT PTS FORTS / FAIBLES -->

  <!-- Fin des Modales -->
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
  <script src="js/index.js">
  </script>
  <script>
  $(function()  {
    $('.refresh').click(function() {
      window.location.reload();
    });
    $('.step1').click(function() {
      var id = $(this).data("id");
      window.location = "step1.php?id_audit="+id;
    });
    $('.step2').click(function() {
      var id = $(this).data("id");
      window.location = "step2.php?id_audit="+id;
    });
    $('.step3').click(function() {
      var id = $(this).data("id");
      window.location = "step3.php?id_audit="+id;
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
          $('#id_manager').val(id_manager);
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
          var id_projet = $('#id_projet').val();
          $('#client').val(company);
          $('#id_client').val(id_client);
          $('#entreprise').val(company);
        }
      },
      requestDelay: 400,
      adjustWidth: false
    };
    $("#manager").easyAutocomplete(options_manager);
    $("#client").easyAutocomplete(options_client);
    $('.delete_audit').click(function() {
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
          var id_audit = $(this).data("idaudit");
          $.ajax({
            url: "php/delete_audit.php?id_audit="+id_audit,
            type: 'GET',
            success: function(data) {
              console.log(data);
              window.location.reload();
            }
          });
        }
      })
    });

    // modale add_audit
    $('#add_audit').click(function() {
      $("#modale_add_audit").modal("show");
    });
    $('#valider_add_audit').click(function() {
      var serial = $("#mon_audit").serialize();
      console.log(serial);
      $.ajax({
        url: "php/add_audit.php",
        type: 'GET',
        data: serial,
        success: function(data) {
          console.log(data);
          window.location.reload();
        }
      });
    });

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

    // modale add_pt_fort_faible
    $('#add_pt_fort_faible').click(function() {
      $("#modale_add_pt_fort_faible").modal("show");
    });
    $('#pt_fort').change(function() {
      var id_pt = $(this).val();
      $('#body_add_pt_fort_faible').load('php/template/pt/update_add_pt.php?id_pt='+id_pt,function(){});
    });
    $('#pt_faible').change(function() {
      var id_pt = $(this).val();
      $('#body_add_pt_fort_faible').load('php/template/pt/update_add_pt.php?id_pt='+id_pt,function(){});
    });

    $('#valider_add_pt_fort_faible').click(function() {
      var modification = $("#body_add_pt_fort_faible").find("#modification").val();
      console.log(modification);
      if(modification == "false") {
        var pt_a_ajouter = $("#body_add_pt_fort_faible").find("#nom").val();
          if(pt_a_ajouter != '')  {
            var type = $("#type").val();
            $.ajax({
              url: "php/template/pt/traitement_add_pt.php?pt="+pt_a_ajouter+"&type="+type,
              type: 'GET',
              success: function(data) {
                console.log(data);
                window.location.reload();
              }
            });
          }else {
            swal({
              type: 'error',
              title: 'Oops...',
              text: 'Veuillez remplir au minimum un intitulé !'
            }).then((result) => {
              if (result.value)  {
                $("#modale_add_pt_fort_faible").modal("show");
              }
            });
          }
      }else {
        console.log('modification');
        var pt_a_ajouter = $("#body_add_pt_fort_faible").find("#nom_update").val();
        var type = $("#body_add_pt_fort_faible").find("#type_update").val();
        var id_pt = $("#body_add_pt_fort_faible").find("#id_pt").val();
        $.ajax({
          url: "php/template/pt/traitement_update_add_pt.php?pt="+pt_a_ajouter+"&type="+type+'&id_pt='+id_pt,
          type: 'GET',
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
