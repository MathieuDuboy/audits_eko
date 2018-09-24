<form id="mon_affectation_update" name="mon_affectation_update">
  <input type="hidden" name="categorie_element" id="categorie_element" value="<?php echo $_GET['type']; ?>"/>
  <input type="hidden" name="id_audit" id="id_audit" value="<?php echo $_GET['id_audit']; ?>"/>
  <input type="hidden" name="id_element" id="id_element" value="<?php echo $_GET['id_element']; ?>"/>
  <input type="hidden" name="id_element_affectation" id="id_element_affectation" value="<?php echo $_GET['id_element_affectation']; ?>"/>

  <div class="form-row" style="margin-bottom:10px">
    <div class="col">
      <div class="form-group">
        <?php
        include('../../config.php');
        $sql = "SELECT * from audits2018_affectation_element WHERE id = '".$_GET['id_element_affectation']."'";
        $result=mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result);
        ?>
        <label for="nom">Nb d'exemplaires :</label>
        <input class="form-control" autocomplete="off" id="nb" name="nb" value="<?php echo $row['nb']; ?>" type="text">
      </div>
      <div class="form-group">
        <label for="nom">Tag à affecter à l'élément :</label>
        <input class="form-control" autocomplete="off" id="tag" name="tag" placeholder="Exemple : de l'accueil" type="text" value="<?php echo $row['tag']; ?>">
      </div>
      <div class="form-group">
        <label for="nom">Commentaires :</label>
        <textarea id="commentaires" name="commentaires" class="form-control" rows="2"><?php echo $row['commentaires']; ?></textarea>
      </div>
    </div>
  </div>
</form>
