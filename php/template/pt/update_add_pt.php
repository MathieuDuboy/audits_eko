<?php
include('../../config.php');
$id_pt = $_GET['id_pt'];
$sql    = "SELECT * FROM audits2018_pts_forts_faibles WHERE id = '" . $id_pt . "' ";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_array($result);
?>
<div class="row">
  <div class="col" style="border-left:solid 1px">
    <div class="form-group">
      <label for="type"><i class="fas fa-plus-square"></i> Modifier un Point</label>
      <span class="delete_pt_fort_faible" data-idpt="<?php echo $id_pt; ?>" style="color:red;text-align-right;float:right"><i class="fas fa-trash-alt"></i></span>
        <select class="custom-select" id="type_update" name="type_update">
           <option <?php if($row['type'] == 'fort') echo 'selected'; ?> value="fort">Point Fort</option>
           <option <?php if($row['type'] == 'faible') echo 'selected'; ?> value="faible">Point Faible</option>
        </select>
    </div>
    <div class="form-group">
      <input class="form-control" id="nom_update" name="nom_update"  type="text" value="<?php echo htmlentities($row["nom"]); ?>" autocomplete="off">
      <input type="hidden" name="modification" id="modification" value="true" />
      <input type="hidden" name="id_pt" id="id_pt" value="<?php echo $id_pt; ?>" />

    </div>
  </div>
</div>
<script>

$(".delete_pt_fort_faible").click(function() {
  swal({
    title: 'Etes-vous certain ?',
    text: "Cette action est irréversible !",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Oui, Supprimer !',
    cancelButtonText: 'Annuler'
  }).then((result) => {
    if (result.value) {
      var id_pt = $(this).data("idpt");
      console.log(id_pt)
      $.ajax({
        url: "php/template/pt/delete_pt.php?id_pt="+id_pt,
        type: 'GET',
        success: function(data) {
          console.log(data);
          window.location.reload();
        }
      });
    }
  })
});

</script>
