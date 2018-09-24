<form id="mon_tarif_edit" name="mon_tarif_edit">
  <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>"/>
  <?php
  include('../../config.php');
  $id = $_GET['id'];
  $sql2 = "SELECT * from audits2018_affectation_tarif WHERE id = '".$id."'";

  $result2 = mysqli_query($db,$sql2);
  $row2 = mysqli_fetch_array($result2);
  ?>
  <div class="row">
    <div class="col-6">
      <div class="form-group">
        <label for="pt_fort"><i class="fas fa-edit"></i> Recommandation</label>
        <input type="text" class="form-control" name="recommandation" id="recommandation" value="<?php echo $row2['nom']; ?>"/>
      </div>
      <div class="form-group" id="div_faible">
        <label for="pt_fort"><i class="fas fa-money-bill-alt"></i> Tarif</label>
        <input type="text" class="form-control" name="tarif" id="tarif" value="<?php echo $row2['tarif']; ?>"/>
      </div>
    </div>
    <div class="col-6" style="border-left:solid 1px">
      <div class="form-group">
        <label for="type"><i class="fas fa-comments"></i> Commentaires :</label>
          <textarea class="form-control" id="commentaires" name="commentaires"><?php echo $row2['commentaires']; ?></textarea>
      </div>
    </div>
  </div>
</form>
<script>
$(function()  {

});
</script>
