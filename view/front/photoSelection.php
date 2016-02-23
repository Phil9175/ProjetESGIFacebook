

<div>
    <div id="participer">
        <h1>Selection photo concours </h1>
        <h3>Merci de sélectionner la photo avec laquelle vous voulez participer</h3>
        <a class="btn btn-default" href="<?php echo ADRESSE_SITE; ?>participationPhoto/index">Retour</a>
    </div>

    <div class="container form-group">
        <pre>
            <?php if(!isset($album)): ?>
                <?php header('location: '.ADRESSE_SITE.'notFound'); ?>
            <?php else : ?>
                <?php if(!isset($album['photos'])): ?>
            <div>
                Aucune photo dans cet album
                <br>
            </div>

                <?php else: ?>
            <table>
                <tr>
                    <?php
                    $photos = $album['photos']['data'];
                    for($i = 0; $i < sizeof($photos); $i++) {
                        if ($i%3 == 0) {
                            echo "</tr><tr>";
                        }
                            echo "<td id='album' class='col-md-6'>";
                            $photo = $photos[$i];
                            $idPhoto = $photo['id'];
                            $picture = $photo['picture'];
                            echo "<img src='$picture' border='0' />";
                            echo "<br>";
                            echo "<br>";
                            echo "<a class=\"btn btn-default\" href=\"/participationPhoto/sendPhotoFB/$idPhoto/\">Selectionnez cette photo</a>";
                            echo "</br>";
                        echo "</br>";
                            echo "</td>";
                    }
                    ?>
                <?php endif; ?>
            <?php endif; ?>
                </tr>
            </table>
        </pre>
    </div>
    <div class="form-group col-">

    </div>

</div>
