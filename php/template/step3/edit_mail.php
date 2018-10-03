<form id="mon_mail_edit" name="mon_mail_edit">
  <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>"/>
  <?php
  include('../../config.php');
  $id = $_GET['id'];
  $sql2 = "SELECT * from audits2018_audits WHERE id = '".$id."'";
  $result2 = mysqli_query($db,$sql2);
  $row2 = mysqli_fetch_array($result2);

  $user_id = $row2['user_id'];
  $url_pdf = $row2['url_pdf'];
  $sql2a = "SELECT * FROM `users` WHERE `user_id` = '".$user_id."' ";
  $result2a = mysqli_query($db,$sql2a);
  $row2a = mysqli_fetch_array($result2a);

  $sql2ab = "SELECT * FROM `collab` WHERE `collab_a` = '1' AND `collab_clientid` = '".$user_id."' ";
  $result2ab = mysqli_query($db,$sql2ab);
  $row2ab = mysqli_fetch_array($result2ab);
  $email = $row2ab['collab_mail'];
 // rcherche collabid + collab_a =1
  ?>
  <div class="row">
    <div class="col">
      <div class="form-group">
        <label for="pt_fort"><i class="fas fa-edit"></i> Destinataire (Collab Admin Société)</label>
        <input type="text" class="form-control" name="destinataire" id="destinataire" value="<?php echo $email; ?>"/>
      </div>
      <div class="form-group">
        <label for="pt_fort"><i class="fas fa-edit"></i> Objet du Mail</label>
        <input type="text" class="form-control" name="objet" id="objet" value="Valeur de l'objet fixe à modifier en dur"/>
      </div>
      <div class="form-group">
        <label for="type"><i class="fas fa-comments"></i> Corps du mail :</label>
          <textarea class="form-control" id="commentaires" name="commentaires">Valeur du corps du mail fixe à modifier en dur</textarea>
      </div>
      <div class="form-group">
        <label for="type"><i class="fas fa-edit"></i> Pièce-jointe :</label>
        <p><a href="<?php echo $url_pdf; ?>" target="_blank"><?php echo $url_pdf; ?></a></p>
        <input type="hidden" name="pdf" id="pdf" value="<?php echo $url_pdf; ?>" />
      </div>
    </div>

  </div>
</form>
<script>
$(function()  {

});
</script>
