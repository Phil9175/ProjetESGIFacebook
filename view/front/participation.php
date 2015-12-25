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
foreach($userNode['data'] as $album):
    if($i < 5 ) :
        if (isset($album['photos'])):
			?>
            <td>
            <img src='<?php echo $album['photos']['data'][0]['picture']; ?>' border='0' />
            <br>
            <?php echo $album['name']; ?>
            <br>
            <a class="btn btn-default" href="/participationPhoto/sendPhoto/<?php echo $album['id']; ?>">Selectionner cet album</a>
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
