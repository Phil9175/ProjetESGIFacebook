<?php include("view/inc/head.php"); ?>
<div class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <div class="navbar-collapse">
      <ul class="nav navbar-nav">
	  <!-- class="active" -->
        <li><a href="https://www.concoursphotosesgi.com">Accueil de l'application</a></li>
        <li><a href="https://www.concoursphotosesgi.com/admin/list_concours">Gestion des concours</a></li>
        <li><a href="https://www.concoursphotosesgi.com/admin/list_users">Gestion des utilisateurs</a></li>
      </ul>
    </div>
    <!--/.nav-collapse --> 
  </div>
  <!--/.container-fluid --> 
</div>
<?php include "view/".$controller."/".$action.".php";?>
<?php include("view/inc/foot.php"); ?>


