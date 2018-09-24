<form id="mon_pt_edit" name="mon_pt_edit">
  <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>"/>
  <div class="row">
    <?php
    include('../../config.php');
    $id = $_GET['id'];
    $sql2 = "SELECT * from audits2018_affectation_pts_forts_faibles WHERE id = '".$id."'";

    $result2 = mysqli_query($db,$sql2);
    $row2 = mysqli_fetch_array($result2);
    ?>
    <div class="col" style="border-left:solid 1px">
      <div class="form-group">
        <label for="type"><i class="fas fa-comments"></i> Commentaires :</label>
          <textarea class="form-control" id="commentaires" name="commentaires"><?php echo $row2['commentaires']; ?></textarea>
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


});
</script>
