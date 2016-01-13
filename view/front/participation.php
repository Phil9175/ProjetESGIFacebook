<h1 xmlns="http://www.w3.org/1999/html"> Bienvenue sur la page participation </h1>

<div id="participer">
    <h2>Ajoutez une photo ou selectionner un album afin de choisir une photo de Facebook.</h2>

    <form method="post" name="form" action="/participationPhoto/importPhoto" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="2097152"></br>
        <input class="btn btn-default" type="file" name="fichier">
        <input class="btn btn-default" type="submit" value="Envoyer">&nbsp;
        <a class="btn btn-default" href="http://concoursphotosesgi.localhost/">Retour</a>
    </form>
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
            <a class="btn btn-default" href="/participationPhoto/photo/<?php echo $album['id']; ?>">Selectionner cet album</a>
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
