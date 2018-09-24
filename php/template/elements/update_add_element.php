<?php
include('../../config.php');
$id_element = $_GET['id_element'];
$sql    = "SELECT * FROM audits2018_liste_elements WHERE id = '" . $id_element . "' ";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_array($result);
?>
<form id="template_update_element" name="template_update_element">
  <input type="hidden" id="id_element" name="id_element" value="<?php echo $_GET['id_element']; ?>"/>
  <input type="hidden" id="goto_template_add_element" name="goto_template_add_element" value="modifier"/>
  <div class="form-group">
    <label for="sous_tache">Nom de l'élément</label>
    <span class="delete_tache_and_sous_taches" data-idtache="<?php echo $_GET['id_element']; ?>" style="color:red;text-align-right;float:right"><i class="fas fa-trash-alt"></i></span>
    <input class="form-control" id="element" name="element" value="<?php echo htmlentities($row['nom']); ?>"  type="text">
  </div>
  <div class="form-group">
    <label for="categorie">Catégorie</label>
    <select class="custom-select" id="categorie" name="categorie">
      <option  selected value="<?php echo $row['categorie']; ?>"><?php echo $row['categorie']; ?></option>
      <option  value="Poste de travail">Poste de travail</option>
      <option  value="Partage documentaire">Partage documentaire</option>
      <option  value="Messagerie">Messagerie</option>
      <option  value="Réseau">Réseau</option>
      <option  value="Télécom">Télécom</option>
      <option  value="Divers">Divers</option>
    </select>
  </div>
  <div id="liste_specifications">
    <label for="add_specifications">Liste des spéciications</label>
    <span style="float:right;text-align:right">
      <button class="add_field_button btn btn-primary btn-sm" id="add_specifications" type="button">
        <span style="float:right;text-align:right">+
          Ajouter une spécification</span>
      </button>
    </span>
    <?php
    $sql    = "SELECT * FROM audits2018_liste_specifications WHERE id_element = '" . $id_element . "' ORDER BY ordre ";
    $result = mysqli_query($db, $sql);
    $nb =  mysqli_num_rows($result);
    $a = 1;
    ?>
    <input type="hidden" value="<?php echo $nb+1; ?>" id="valeur_de_x" name="valeur_de_x"/>
    <?php
    while ($row = mysqli_fetch_array($result)) {
    ?>
     <div id="<?php echo $a; ?>" class="form-group">
       <label><i class="fas fa-arrows-alt-v"></i> - A déplacer</label>
       <div class="row">
         <input type="hidden" name="id_spe[]" value="<?php echo $row["id"]; ?>"/>
         <div class="col">
           <input class="form-control" type="text" name="nom_spe[]" placeholder="Titre" value="<?php echo htmlentities($row["nom"]);?>"/>
         </div>
         <div class="col-2">
          <button type="button" data-id="<?php echo $a; ?>" data-idstache="<?php echo $row["id"]; ?>" class="remove_field btn btn-info"><i class="fas fa-trash"></i></button>
        </div>
      </div>
    </div>
    <?php
    $a++;
    }
    ?>
  </div>
</form>
<script>
$(function() {
  $(".delete_tache_and_sous_taches").click(function() {
    var id_tache = $(this).data("idtache");
    console.log(id_tache);
    swal({
      title: 'Etes-vous certain ?',
      text: "Cette action est irréversible",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Oui, supprimer',
      cancelButtonText: 'Annuler'
    }).then((result) => {
      if (result.value) {
        console.log("delete ok");
        $.ajax({
          url: "php/template/elements/delete_elements_spec.php?id_element="+id_tache, //this is the submit URL
          type: 'GET',
          success: function(data) {
            console.log(data);
            $("#modale_taches").modal("hide");
            window.location.reload();
          }
        });
      }
    })
  })
  $('#add_specifications').hover(function() {
    $(this).css('cursor', 'pointer');
  });
  $('#refresh').click(function() {
    window.location.reload();
  });
  $("#liste_specifications").sortable();

  var x = $('#valeur_de_x').val();
  var max_fields = 50;
  var wrapper = $("#liste_specifications");
  var add_button = $(".add_field_button");

  $(add_button).click(function(e) {
    e.preventDefault();
    console.log("ajout d'un truc car cliuc sur boutton");
    add_input();
  });

  function add_input() {
    console.log("je suis dans add_input 1: " + x);
    if (x < max_fields) {
      console.log("ajout du truc: " + x);
      $(wrapper).append('<div id="' + x + '" class="form-group"><label><i class="fas fa-arrows-alt-v"></i> - A déplacer</label><div class="row"><div class="col"><input class="form-control" type="text" name="nom_spe[]" placeholder="Titre"/></div><div class="col-2"><button type="button" data-id="' +
        x + '" data-idstache="" class="remove_field btn btn-info"><i class="fas fa-trash"></i></button></div></div></div></div>'); //add input box
      x++;
    }
  }

  $(wrapper).on("click", ".remove_field", function(e) {
    var idstache = $(this).data("idstache");
    var id = $(this).data("id");
    // Si c'est une tache de la bdd, je la delete directement dans la bdd
    if(idstache != '') {
      swal({
        title: 'Etes-vous certain ?',
        text: "Cette action est irréversible",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, supprimer',
        cancelButtonText: 'Annuler'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: "php/template/elements/delete_specification.php?id_stache=" + idstache, //this is the submit URL
            type: 'GET', //or POST
            success: function(data) {
              console.log("actuellement dans le " + x);
              e.preventDefault();
              var ancien = x;
              console.log("doit enlever le " + idstache);
              $("#" + id).remove();
              console.log("effectué");
            }
          });
        }
      })
    }else {
      console.log("actuellement dans le " + x);
      e.preventDefault();
      var ancien = x;
      console.log("doit enlever le " + idstache);
      $("#" + id).remove();
      console.log("effectué");
    }
  })
})

</script>
