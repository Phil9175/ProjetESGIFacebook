<h1> Bienvenue sur la page participation </h1>

<div id="participer">
    <a class="btn btn-default" href="">Ajoutez une photo dans l'album de votre choix</a>
</div>
<div>
    <pre>
        <table>
            <tr>
<?php
$i =0;
foreach($userNode['data'] as $album){
    if($i < 5 ) {
        if (isset($album['photos'])) {
            echo "<td>";
            $id = $album['id'];
            $name =$album['name'];
            $photos = $album['photos']['data'];
            $photo = $photos[0];
            $picture = $photo['picture'];
            echo "<img src='$picture' border='0' />";
            echo "<br>";
            echo "$name";
            echo "<br>";
            echo "<a class=\"btn btn-default\" href=\"/participationPhoto/sendPhoto/$id\">Selectionnez cet album</a>";
            echo "<br>";
            echo "</td>";
            $i++;
        }
    }else{
        $i =0;
        echo "</tr><tr>";
    }
}
?>
            </tr>
        </table>
    </pre>
</div>
