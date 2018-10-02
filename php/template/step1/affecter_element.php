<form id="mon_affectation" name="mon_affectation">
  <input type="hidden" name="categorie_element" id="categorie_element" value="<?php echo $_GET['type']; ?>"/>
  <input type="hidden" name="id_audit" id="id_audit" value="<?php echo $_GET['id_audit']; ?>"/>

  <div class="form-row" style="margin-bottom:10px">
    <div class="col">
      <?php
       include('../../config.php');
       $sql = "SELECT * from audits2018_liste_elements WHERE categorie = '".$_GET['type']."' ORDER BY nom";
       $result=mysqli_query($db,$sql);
       ?>
       <select class="custom-select" id="elements_modale" name="elements_modale">
         <option selected value="">Affecter un élément</option>
        <?php
           while($row = mysqli_fetch_array($result)) {
              ?>
               <option value="<?php echo $row['id']; ?>"><?php echo $row['nom']; ?></option>
               <?php
           }
           ?>
      </select>
    </div>
  </div>
  <div class="form-row" style="margin-bottom:10px">
    <div class="col">
      <div class="form-group">
        <label for="nom">Nb d'exemplaires :</label>
        <input class="form-control" autocomplete="off" id="nb" name="nb" placeholder="Exemple : 1" type="text" value="1">
      </div>
    </div>
  </div>
  <div class="form-row" style="margin-bottom:10px">
    <div class="col">
      <div class="form-group">
        <label for="nom">Identification de l’élément :</label>
        <input class="form-control" autocomplete="off" id="tag" name="tag" placeholder="Exemple : de l'accueil" type="text">
      </div>
    </div>
  </div>
  <div class="form-row" style="margin-bottom:10px">
    <div class="col">
      <div class="form-group">
        <label for="nom">Commentaires :</label>
        <textarea id="commentaires" name="commentaires" class="form-control" rows="2"></textarea>
      </div>
    </div>
  </div>
  <div class="form-row" id="liste_specifications">
  </div>
</form>
<script>
$(function()  {
  $("#elements_modale").change(function() {
    var id_element = $(this).val();
    $.ajax({
      url: "php/template/step1/affecter_specifications.php?id_element="+id_element,
      type: 'GET',
      success: function(data) {
        $("#liste_specifications").html(data);
      }
    });
  });

});
</script>
