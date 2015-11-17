
    <div class="moduleCenter">
      <?php 
	  foreach($allArticles as $key => $values): ?>
	  <?php if ($values['statut'] == "published"): ?>
	  	<a href="<?php echo ADRESSE_SITE; ?>/admin/unpublished/<?php echo $values['id']; ?>"><i class="fa fa-toggle-on fa-2x NoDecoration green"></i></a>
		<?php else: ?>
	  	<a href="<?php echo ADRESSE_SITE; ?>/admin/published/<?php echo $values['id']; ?>"><i class="fa fa-toggle-off fa-2x NoDecoration red"></i></a>
		<?php endif; ?>
	  	<a href="<?php echo ADRESSE_SITE; ?>/admin/article/edit/<?php echo $values['id']; ?>"><i class="fa fa-pencil-square-o fa-2x NoDecoration black"></i></a><a href="<?php echo ADRESSE_SITE; ?>/<?php echo $values['article_url']; ?>"><i class="fa fa-eye fa-2x NoDecoration black"></i></a>
		  <a href="<?php echo ADRESSE_SITE; ?>/admin/article/edit/<?php echo $values['id']; ?>" title="<?php echo $values["titre"]; ?>"><?php echo $values["titre"]; ?></a><br>
          	  <?php endforeach; ?>
    </div>

