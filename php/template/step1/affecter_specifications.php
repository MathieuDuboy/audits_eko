<div class="col">
  <?php
   include('../../config.php');
   $sql = "SELECT * from audits2018_liste_specifications WHERE id_element = '".$_GET['id_element']."' ORDER BY ordre";
   $result=mysqli_query($db,$sql);
   ?>
    <?php
       while($row = mysqli_fetch_array($result)) {
          ?>
          <input type="hidden"  name="specifications_modale[]" value="<?php echo $row['id']; ?>">
          <?php
       }
       ?>
</div>
