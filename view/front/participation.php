<h1 xmlns="http://www.w3.org/1999/html"> Bienvenue sur la page participation </h1>

<div id="participer">

    <?php
    if(isset($myPhoto)){
        ?>
        <h3>Je participe au concours avec cette photo </h3>
        <ul align="center" class="gallery">
                <img src='<?php echo $myPhoto; ?>' border='0' /><br><br>
                <a class="btn btn-default" href="<?php echo ADRESSE_SITE; ?>participationPhoto/deleteParticipation/">Annuler ma participation</a>
        </ul>

        <h2>Mais vous pouvez à tous moment changer de photo (Attention, les votes à votre attention seront remis à 0).</h2>
        <?php
    }else{
        ?>
        <h2>Ajoutez une photo ou selectionner un album afin de choisir une photo de Facebook.</h2>
    <?php
    }
    ?>
	
    <ul align="center" class="gallery">
        <form method="post" name="form" action="<?php echo ADRESSE_SITE; ?>participationPhoto/importPhoto" enctype="multipart/form-data">
            <input type="hidden" name="MAX_FILE_SIZE" value="2097152"></br>
				<input id="uploadFile" placeholder="Choisissez un fichier" disabled="disabled" />
				<div class="fileUpload btn btn-primary">
					<span>Choisir un fichier</span>
					<input id="uploadBtn" type="file" class="upload" name="fichier"/>
				</div><br /><br />
            <input class="btn btn-success" type="submit" value="Envoyer">&nbsp;
            <a class="btn btn-default" href="<?php echo ADRESSE_SITE; ?>">Retour</a>
        </form>
    </ul>
    </br>
</div>
<div>
    <pre>
        <table>
            <tr>
<?php
$i =0;
foreach($userNode['data'] as $album):
    if($i < 5 ) :
        if (isset($album['photos'])):
			?>
            <td>
            <img src='<?php echo $album['photos']['data'][0]['picture']; ?>' border='0' />
            <br>
            <?php echo $album['name']; ?>
            <br>
            <a class="btn btn-default" href="<?php echo ADRESSE_SITE; ?>participationPhoto/photo/<?php echo $album['id']; ?>">Selectionner cet album</a>
            <br>
            </td>
			<?php
            $i++;
        endif;
    else:
        $i =0;
        echo "</tr><tr>";
    endif;
endforeach;
?>
            </tr>
        </table>
    </pre>
</div>
<script type="text/javascript">
document.getElementById("uploadBtn").onchange = function () {
    document.getElementById("uploadFile").value = this.value;
};

</script>