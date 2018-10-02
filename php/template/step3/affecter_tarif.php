<form id="mon_tarif" name="mon_tarif">
  <input type="hidden" name="type" id="type" value="<?php echo $_GET['type']; ?>"/>
  <input type="hidden" name="id_audit" id="id_audit" value="<?php echo $_GET['id_audit']; ?>"/>
  <input type="hidden" name="id_reco" id="id_reco" value=""/>

  <div class="row">
    <div class="col-6">
      <div class="form-group">
        <label for="pt_fort"><i class="fas fa-edit"></i> Recommandation</label>
        <input type="text" class="form-control" name="recommandation" id="recommandation" value=""/>
      </div>
      <div class="form-group" id="div_faible">
        <label for="pt_fort"><i class="fas fa-money-bill-alt"></i> Tarif</label>
        <input type="text" class="form-control" name="tarif" id="tarif" value=""/>
      </div>
    </div>
    <div class="col-6" style="border-left:solid 1px">
      <div class="form-group">
        <label for="type"><i class="fas fa-comments"></i> Commentaires :</label>
          <textarea class="form-control" id="commentaires" name="commentaires"></textarea>
      </div>
    </div>
  </div>
</form>
<?php
if($_GET['type'] == 'OBLIGATOIRE') {
  ?><script>
  $(function()  {
    var options_recommandation = {
      url: function(phrase) {
        return "php/recherche_reco.php?type=OBLIGATOIRE";
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
        console.log($("#recommandation").val());
        data.phrase = $("#recommandation").val();
        return data;
      },
      list: {
        maxNumberOfElements: 6,
        match: {
          enabled: true
        },
        onChooseEvent: function(item) {
          var id_reco = $("#recommandation").getSelectedItemData().id;
          $("#id_reco").val(id_reco);
        }
      },
      requestDelay: 400,
      adjustWidth: false
    };
    $("#recommandation").easyAutocomplete(options_recommandation);

  });
  </script><?php
}else if($_GET['type'] == 'RECOMMANDE') {
  ?><script>
  $(function()  {
    var options_recommandation = {
      url: function(phrase) {
        return "php/recherche_reco.php?type=RECOMMANDE";
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
        console.log($("#recommandation").val());
        data.phrase = $("#recommandation").val();
        return data;
      },
      list: {
        maxNumberOfElements: 6,
        match: {
          enabled: true
        },
        onChooseEvent: function(item) {
          var id_reco = $("#recommandation").getSelectedItemData().id;
          $("#id_reco").val(id_reco);
        }
      },
      requestDelay: 400,
      adjustWidth: false
    };
    $("#recommandation").easyAutocomplete(options_recommandation);

  });
  </script><?php
}else if($_GET['type'] == 'CONFORT') {
  ?><script>
  $(function()  {
    var options_recommandation = {
      url: function(phrase) {
        return "php/recherche_reco.php?type=CONFORT";
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
        console.log($("#recommandation").val());
        data.phrase = $("#recommandation").val();
        return data;
      },
      list: {
        maxNumberOfElements: 6,
        match: {
          enabled: true
        },
        onChooseEvent: function(item) {
          var id_reco = $("#recommandation").getSelectedItemData().id;
          $("#id_reco").val(id_reco);
        }
      },
      requestDelay: 400,
      adjustWidth: false
    };
    $("#recommandation").easyAutocomplete(options_recommandation);

  });
  </script><?php
}
?>
