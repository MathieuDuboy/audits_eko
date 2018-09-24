<form id="mon_note" name="mon_note">
  <input type="hidden" name="id_audit" id="id_audit" value="<?php echo $_GET['id_audit']; ?>"/>
  <?php
  include('../../config.php');
  $id_audit = $_GET['id_audit'];
  $sql2 = "SELECT * from audits2018_audits WHERE id = '".$id_audit."'";
  $result2 = mysqli_query($db,$sql2);
  $row2 = mysqli_fetch_array($result2);
  ?>
  <div class="row">
    <div class="col" style="border-left:solid 1px">
      <div class="form-group">
        <label for="type"><i class="fas fa-comments"></i> A noter :</label>
          <textarea class="form-control" id="note" name="note"><?php echo $row2['note'];?></textarea>
      </div>
    </div>
  </div>
</form>
<script>
$(function()  {

});
</script>
