<?php include("view/inc/head.php"); ?>
<div class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <div class="navbar-collapse">
      <ul class="nav navbar-nav">
	  <!-- class="active" -->
        <li><a href="<?php echo ADRESSE_SITE; ?>">Accueil de l'application</a></li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" title="connexion">Concours <b class="caret"></b></a>
          <div class="dropdown-menu" style="padding: 15px; padding-bottom: 10px; -moz-border-radius: 10px 0px 10px 10px;
    -webkit-border-radius: 10px 0px 10px 10px;
    border-radius: 10px 0px 10px 10px;">
            
            <br />
            <a href="<?php echo ADRESSE_SITE; ?>admin/add" >Ajouter</a>
			<br />
            <a href="<?php echo ADRESSE_SITE; ?>admin/list_concours">Liste des concours</a></div>
        </li>
		
        <li><a href="<?php echo ADRESSE_SITE; ?>admin/list_users">Utilisateurs</a></li>
		
		
		
		
		
      </ul>
    </div>
    <!--/.nav-collapse --> 
  </div>
  <!--/.container-fluid --> 
</div>
<?php include "view/".$controller."/".$action.".php";?>
<script type="text/javascript" src="<?php echo ADRESSE_SITE; ?>view/ckeditor/ckeditor.js"></script> 

<?php include("view/inc/foot.php"); ?>


