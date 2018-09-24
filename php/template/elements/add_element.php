<form id="template_add_element" name="template_add_element">
  <input type="hidden" id="goto_template_add_element" name="goto_template_add_element" value="add"/>
  <div class="form-group">
    <label for="sous_tache">Nom de l'élément</label>
    <input class="form-control" id="element" name="element" placeholder="Exemple : iPads" type="text">
  </div>
  <div class="form-group">
    <label for="categorie">Catégorie</label>
    <select class="custom-select" id="categorie" name="categorie">
      <option selected value="Postes de travail">Postes de travail</option>
      <option  value="Partage documentaire">Partage documentaire</option>
      <option  value="Messagerie">Messagerie</option>
      <option  value="Réseau">Réseau</option>
      <option  value="Logiciel">Logiciel</option>
      <option  value="Connexions Internet">Connexions Internet</option>
      <option  value="Téléphonie Fixe">Téléphonie Fixe</option>
      <option  value="Téléphonie Mobile">Téléphonie Mobile</option>
      <option  value="Antivirus">Antivirus</option>
      <option  value="Sauvegarde">Sauvegarde</option>
    </select>
  </div>
  <div id="liste_specifications">
    <label for="add_specifications">Liste des spécifications</label>
    <span style="float:right;text-align:right">
      <button class="add_field_button btn btn-primary btn-sm" id="add_specifications" type="button">
        <span style="float:right;text-align:right">+ Ajouter une spécification</span>
      </button>
    </span>
  </div>
</form>
<script>
$(function() {
  $('#add_specifications').hover(function() {
    $(this).css('cursor', 'pointer');
  });
  $('#refresh').click(function() {
    window.location.reload();
  });

  // des l'affichage, en fonction de ce qu'il y a dans le select
  // recupêrer le select


  $("#liste_specifications").sortable();
  var x = 1;
  var max_fields = 50;
  var wrapper = $("#liste_specifications");
  var add_button = $(".add_field_button");

  $("#categorie").change(function() {
    $(wrapper).html('');
    $(wrapper).append('<label for="add_specifications">Liste des spécifications</label><span style="float:right;text-align:right"><button class="add_field_button btn btn-primary btn-sm" id="add_specifications" type="button"><span style="float:right;text-align:right">+ Ajouter une spécification</span>  </button></span>');
    $('.add_field_button').click(function(e) {
      e.preventDefault();
      add_input();
    });
    var val = $("#categorie").val();
    afficher_champs_defaut(val);
  })


  $(add_button).click(function(e) {
    e.preventDefault();
    add_input();
  });
  var val = $("#categorie").val();
  function afficher_champs_defaut(val) {

    if(val == 'Postes de travail') {
    var tab = ["PTBrand", "PTFactor", "PTProc", "PTRAM", "PTDDType", "PTDDCapa", "PTDDOccup", "PTScreen"];
    }
    else if(val == 'Partage documentaire') {
    var  tab = ["PDType", "PDFC", "PDC", "PDU", "PDGD"];
    }
    else if(val == 'Messagerie') {
    var  tab = ["MF", "MMA", "MC", "MU", "MA"];
    }
    else if(val == 'Réseau') {
    var  tab = ["RMarque", "RType", "RDebit", "RNB", "RNBCo"];
    }
    else if(val == 'Logiciel') {
    var  tab = ["LE", "LM", "LNBC", "LTH", "LSO"];
    }
    else if(val == 'Connexions Internet') {
    var  tab = ["CIOpe", "CITech", "CIDebit", "CIFF", "CITarif"];
    }
    else if(val == 'Téléphonie Fixe') {
    var  tab = ["TFOpe", "TFTech", "TFNB", "TFFF", "TFTarif"];
    }
    else if(val == 'Téléphonie Mobile') {
    var  tab = ["TMOpe", "TMTerminal", "TMFF", "TMTarif"];
    }
    else if(val == 'Antivirus') {
    var  tab = ["AType", "ANBL", "ATarif", "AMan"];
    }
    else if(val == 'Sauvegarde') {
    var  tab = ["SSupport", "SLog", "SMon", "SAuto", "SPer"];
    }
    tab.forEach(function(element) {
      $(wrapper).append('<div id="' + x + '" class="form-group"><label><i class="fas fa-arrows-alt-v"></i> - A déplacer</label><div class="row"><div class="col"><input class="form-control" type="text" name="nom_specification[]" placeholder="Nom" value="'+element+'" /></div><div class="col-2"><button type="button" data-id="' +
        x + '" class="remove_field btn btn-info"><i class="fas fa-trash"></i></button></div></div></div></div>'); //add input box
      x++;
    })

  }
  afficher_champs_defaut(val);

  function add_input() {
    console.log("je suis dans add_input 1: " + x);
    if (x < max_fields) {
      console.log("ajout du truc: " + x);
      $(wrapper).append('<div id="' + x + '" class="form-group"><label><i class="fas fa-arrows-alt-v"></i> - A déplacer</label><div class="row"><div class="col"><input class="form-control" type="text" name="nom_specification[]" placeholder="Nom"/></div><div class="col-2"><button type="button" data-id="' +
        x + '" class="remove_field btn btn-info"><i class="fas fa-trash"></i></button></div></div></div></div>'); //add input box
      x++;
    }
  }

  $(wrapper).on("click", ".remove_field", function(e) {
    var id = $(this).data("id");
    console.log("actuellement dans le " + x);
    e.preventDefault();
    var ancien = x;
    console.log("doit enlever le " + id);
    $("#" + id).remove();
    console.log("effectué");
  })
})

</script>
