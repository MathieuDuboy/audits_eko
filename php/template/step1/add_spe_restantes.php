<form id="mon_affectation_spe_restantes" name="mon_affectation_spe_restantes">
  <input type="hidden" name="id_restantes" id="id_restantes" value="<?php echo $_GET['id_restantes']; ?>"/>
  <input type="hidden" name="id_audit" id="id_audit" value="<?php echo $_GET['id_audit']; ?>"/>
  <input type="hidden" name="id_element_affectation" id="id_element_affectation" value="<?php echo $_GET['id_element_affectation']; ?>"/>

  <div class="form-row" id="liste_specifications">
    <div class="col">
      <select class="custom-select" multiple id="specifications_modale[]" name="specifications_modale[]">
      <?php
       include('../../config.php');
       $tab = explode(",",$_GET['id_restantes']);
       foreach($tab as $id_restant) {
         $sql = "SELECT * from audits2018_liste_specifications WHERE id = '".$id_restant."' ORDER BY ordre";
         echo $sql;
         $result=mysqli_query($db,$sql);
         $row = mysqli_fetch_array($result);
         ?>
          <option selected value="<?php echo $row['id']; ?>"><?php echo $row['ordre']; ?> - <?php echo $row['nom']; ?></option>
          <?php
       }
       ?>
      </select>
    </div>
  </div>
</form>
