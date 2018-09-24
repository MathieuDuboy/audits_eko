<div class="col">
  <?php
   include('../../config.php');
   $sql = "SELECT * from audits2018_liste_specifications WHERE id_element = '".$_GET['id_element']."' ORDER BY ordre";
   $result=mysqli_query($db,$sql);
   ?>
   <select class="custom-select" multiple id="specifications_modale[]" name="specifications_modale[]">
    <?php
       while($row = mysqli_fetch_array($result)) {
          ?>
           <option selected value="<?php echo $row['id']; ?>"><?php echo $row['ordre']; ?> - <?php echo $row['nom']; ?></option>
           <?php
       }
       ?>
  </select>
</div>
