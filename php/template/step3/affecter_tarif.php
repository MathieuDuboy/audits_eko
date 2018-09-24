<form id="mon_tarif" name="mon_tarif">
  <input type="hidden" name="type" id="type" value="<?php echo $_GET['type']; ?>"/>
  <input type="hidden" name="id_audit" id="id_audit" value="<?php echo $_GET['id_audit']; ?>"/>

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
<script>
$(function()  {

});
</script>
