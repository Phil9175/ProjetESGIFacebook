<h1> Selection photo </h1>

<div>
    <pre>
        <?php if(!isset($album)): ?>
            <?php header('location:/notFound'); ?>
        <?php else : ?>
            <?php if(!isset($album['photos'])): ?>
        <div>
            Aucune photo dans cet album
            <br>
            <a class="btn btn-default" href="/participationPhoto/index">Retour</a>
        </div>

            <?php else: ?>
        <table>
                    <tr>
                <?php
                $photos = $album['photos']['data'];
                for($i = 0; $i < sizeof($photos); $i++) {
                    if ($i%5 == 0) {
                        echo "<br>";
                        echo "</tr><tr>";
                    }
                        echo "<td>";
                        $photo = $photos[$i];
                        $idPhoto = $photo['id'];
                        $picture = $photo['picture'];
                        echo "<img src='$picture' border='0' />";
                        echo "</br>";
                        echo "<a class=\"btn btn-default\" href=\"/participationPhoto/sendPhoto/$idPhoto/\">Selectionnez cette photo</a>";
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
