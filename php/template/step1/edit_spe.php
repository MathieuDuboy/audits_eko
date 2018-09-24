<form id="mon_affectation_edit_spe" name="mon_affectation_edit_spe">
  <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>"/>

  <div class="form-row">
    <div class="col">
      <label>Valeur :</label>
      <?php
       include('../../config.php');
         $sql = "SELECT * from audits2018_affectation_specification WHERE id = '".$_GET['id']."'";
         $result=mysqli_query($db,$sql);
         $row = mysqli_fetch_array($result);
      ?>
      <input type="text" class="form-control" name="valeur" id="valeur" value="<?php echo $row['valeur']; ?>"/>
    </div>
  </div>
</form>
