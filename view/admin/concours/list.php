
    <div class="moduleCenter">
    	<h1>Administration du concours photos</h1>
     <?php 
	  foreach($concours as $key => $values): ?>
	  <?php if ($values['status'] == 1): ?>
	  	<a href="<?php echo ADRESSE_SITE; ?>admin/deactivate/<?php echo $values['id']; ?>"><i class="glyphicon glyphicon-ok"></i> </a>
		<?php else: ?>
	  	<a href="<?php echo ADRESSE_SITE; ?>admin/activate/<?php echo $values['id']; ?>"><i class="glyphicon glyphicon-remove"></i></a>
		<?php endif; ?> 
	  	<a href="<?php echo ADRESSE_SITE; ?>admin/edit/<?php echo $values['id']; ?>"><i class="glyphicon glyphicon-edit"></i><?php echo $values["name"]; ?></a><br>
          	  <?php endforeach; ?>
    </div>

