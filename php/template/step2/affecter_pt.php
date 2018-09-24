<form id="mon_pt" name="mon_pt">
  <input type="hidden" name="type" id="type" value="<?php echo $_GET['type']; ?>"/>
  <input type="hidden" name="id_audit" id="id_audit" value="<?php echo $_GET['id_audit']; ?>"/>
  <input type="hidden" name="id_pt" id="id_pt" value=""/>

  <div class="row">
    <div class="col-6">
      <div class="form-group" id="div_fort">
        <label for="pt_fort"><i class="fas fa-edit"></i> Ajouter un Point</label>
        <input type="text" class="form-control" name="pt_fort_input" id="pt_fort_input" value=""/>
      </div>
      <div class="form-group" id="div_faible">
        <label for="pt_fort"><i class="fas fa-edit"></i> Ajouter un Point</label>
        <input type="text" class="form-control" name="pt_faible_input" id="pt_faible_input" value=""/>
      </div>
    </div>
    <div class="col-6" style="border-left:solid 1px">
      <div class="form-group">
        <label for="type"><i class="fas fa-plus-square"></i> Commentaires :</label>
          <textarea class="form-control" id="commentaires" name="commentaires"></textarea>
      </div>
    </div>
  </div>

</form>
<script>
$(function()  {
  var type = $("#type").val();
  if(type == 'fort') {
    $("#div_faible").hide();
  }else {
    $("#div_fort").hide();
  }

  var options_pt_fort_input = {
    url: function(phrase) {
      return "php/recherche_pts.php?type=fort";
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
      console.log($("#pt_fort_input").val());
      data.phrase = $("#pt_fort_input").val();
      return data;
    },
    list: {
      maxNumberOfElements: 6,
      match: {
        enabled: true
      },
      onChooseEvent: function(item) {
        var id_pt = $("#pt_fort_input").getSelectedItemData().id;
        $("#id_pt").val(id_pt);
      }
    },
    requestDelay: 400,
    adjustWidth: false
  };
  $("#pt_fort_input").easyAutocomplete(options_pt_fort_input);


  var options_pt_faible_input = {
    url: function(phrase) {
      return "php/recherche_pts.php?type=faible";
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
      data.phrase = $("#pt_faible_input").val();
      return data;
    },
    list: {
      maxNumberOfElements: 6,
      match: {
        enabled: true
      },
      onChooseEvent: function(item) {
          var id_pt = $("#pt_faible_input").getSelectedItemData().id;
          $("#id_pt").val(id_pt);
      }
    },
    requestDelay: 400,
    adjustWidth: false
  };
  $("#pt_faible_input").easyAutocomplete(options_pt_faible_input);
});
</script>
