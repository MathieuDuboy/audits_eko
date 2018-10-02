<form id="mon_affectation_update" name="mon_affectation_update">
  <input type="hidden" name="categorie_element" id="categorie_element" value="<?php echo $_GET['type']; ?>"/>
  <input type="hidden" name="id_audit" id="id_audit" value="<?php echo $_GET['id_audit']; ?>"/>
  <input type="hidden" name="id_element" id="id_element" value="<?php echo $_GET['id_element']; ?>"/>
  <input type="hidden" name="id_element_affectation" id="id_element_affectation" value="<?php echo $_GET['id_element_affectation']; ?>"/>
  <input type="hidden" name="type" id="type" value="<?php echo $_GET['type']; ?>"/>

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
        <label for="nom">Identification de l’élément :</label>
        <input class="form-control" autocomplete="off" id="tag" name="tag" placeholder="Exemple : de l'accueil" type="text" value="<?php echo $row['tag']; ?>">
      </div>
      <div class="form-group">
        <label for="nom">Commentaires :</label>
        <textarea id="commentaires" name="commentaires" class="form-control" rows="2"><?php echo $row['commentaires']; ?></textarea>
      </div>
      <div class="form-group">
        <?php
        $sql3 = "SELECT audits2018_affectation_specification.id as vrai_id, audits2018_affectation_specification.id_audit, audits2018_affectation_specification.id_affectation_element, audits2018_affectation_specification.id_specification, audits2018_affectation_specification.valeur, audits2018_liste_specifications.id, audits2018_liste_specifications.id_element, audits2018_liste_specifications.nom FROM `audits2018_affectation_specification` INNER JOIN audits2018_liste_specifications ON audits2018_affectation_specification.id_specification = audits2018_liste_specifications.id  WHERE `id_audit` = '".$_GET['id_audit']."' AND `id_affectation_element` = '".$_GET['id_element_affectation']."'";
        $result3=mysqli_query($db,$sql3);
        $tab_specifications_deja_affecte = [];
        while($row3 = mysqli_fetch_array($result3))   {
          $tab_specifications_deja_affecte[] = $row3['id_specification'];
          $type = $_GET['type'];
          switch ($type) {
              case "Sauvegarde":
              $tab_val = ["SSupport", "SLog", "SMon", "SAuto", "SPer"];
              $tab_nom = ["Support", "Logiciel", "Monitorée ?", "Automatisée ?", "Periodicité"];
              break;
              case "Antivirus":
              $tab_val = ["AType", "ANBL", "ATarif", "AMan"];
              $tab_nom = ["Type", "Nb Licenses", "Tarif", "Managé ?"];
              break;
              case "Logiciel":
              $tab_val = ["LE", "LM", "LNBC", "LTH", "LSO"];
              $tab_nom = ["Editeur", "Maintenance ?", "Nb Clients", "Type hébergement", "SAAS / OP"];
              break;
              case "Partage documentaire":
              $tab_val = ["PDType", "PDFC", "PDC", "PDU", "PDGD"];
              $tab_nom = ["Type", "Fournisseur", "Capacité", "Utilisé", "Gestion droits"];
              break;
              case "Messagerie":
              $tab_val = ["MF", "MMA", "MC", "MU", "MA"];
              $tab_nom = ["Fournisseur", "Mode accès", "Capacité", "Utilisé", "Archive"];
              break;
              case "Réseau":
              $tab_val = ["RMarque", "RType", "RDebit", "RNB", "RNBCo"];
              $tab_nom = ["Marque", "Type", "Débits Supportés", "Nb", "Nb connexions"];
              break;
              case "Téléphonie Mobile":
              $tab_val = ["TMOpe", "TMTerminal", "TMFF", "TMTarif"];
              $tab_nom = ["Opérateur", "Mobiles", "Forfait", "Tarif"];
              break;
              case "Téléphonie Fixe":
              $tab_val = ["TFOpe", "TFTech", "TFNB", "TFFF", "TFTarif"];
              $tab_nom = ["Opérateur", "Techno", "Nb Postes", "Forfait", "Tarif"];
              break;
              case "Connexions Internet":
              $tab_val = ["CIOpe", "CITech", "CIDebit", "CIFF", "CITarif"];
              $tab_nom = ["Opérateur", "Techno", "Débit", "Forfait", "Tarif"];
              break;
              case "Postes de travail":
              $tab_val = ["PTBrand", "PTFactor", "PTProc", "PTRAM", "PTDDType", "PTDDCapa", "PTDDOccup", "PTScreen"];
              $tab_nom = ["Marque", "Format", "Processeur", "RAM", "Type DD", "Capacité DD", "Tx Occup DD", "Ecran"];
              break;

          }
          $key = array_search($row3['nom'], $tab_val);
          $nom = $tab_nom[$key];
          ?>
          <label for="<?php echo $nom; ?>"><?php echo $nom; ?> :</label>
          <input class="form-control" autocomplete="off" id="<?php echo $row3['vrai_id']; ?>" name="spe_ids[<?php echo $row3['vrai_id']; ?>]" value="<?php if($row3['valeur'] != '') echo $row3['valeur']; else echo 'N.C.' ?>" type="text">
          <?php
        }

        ?>
      </div>

    </div>
  </div>
</form>
