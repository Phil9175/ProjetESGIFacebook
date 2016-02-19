<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="fr">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Administration du concours Photos</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
<link href="<?php echo ADRESSE_SITE; ?>view/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo ADRESSE_SITE; ?>view/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo ADRESSE_SITE; ?>view/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo ADRESSE_SITE; ?>view/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
<link href="<?php echo ADRESSE_SITE; ?>view/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo ADRESSE_SITE; ?>view/assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo ADRESSE_SITE; ?>view/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo ADRESSE_SITE; ?>view/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo ADRESSE_SITE; ?>view/assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo ADRESSE_SITE; ?>view/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ADRESSE_SITE; ?>view/assets/admin/layout4/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="<?php echo ADRESSE_SITE; ?>view/assets/admin/layout4/css/themes/light.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ADRESSE_SITE; ?>view/assets/admin/layout4/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
<script src="<?php echo ADRESSE_SITE; ?>view/assets/global/plugins/jquery.min.js" type="text/javascript"></script> 
<link rel="stylesheet" type="text/css" href="<?php echo ADRESSE_SITE; ?>view/css/jquery-ui.theme.css">
<link rel="stylesheet" type="text/css" href="<?php echo ADRESSE_SITE; ?>view/css/jquery.datetimepicker.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo ADRESSE_SITE; ?>view/css/colorpicker.css" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-header-fixed page-sidebar-closed-hide-logo ">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top"> 
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner"> 
		<!-- BEGIN LOGO -->
		<div class="page-logo"> <a href="index.html"> <img src="<?php echo ADRESSE_SITE.LOGO; ?>" alt="logo" class="logo-default" height="57px"/> </a>
			<div class="menu-toggler sidebar-toggler"> 
				<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header --> 
			</div>
		</div>
		<!-- END LOGO --> 
		<!-- BEGIN RESPONSIVE MENU TOGGLER --> 
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a> 
		<!-- END RESPONSIVE MENU TOGGLER --> 
		
		<!-- BEGIN PAGE TOP -->
		<div class="page-top"> 
			<!-- BEGIN HEADER SEARCH BOX --> 
			<!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
			<form class="search-form" action="extra_search.html" method="GET">
				<div class="input-group">
					<input type="text" class="form-control input-sm" placeholder="Search..." name="query">
					<span class="input-group-btn"> <a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a> </span> </div>
			</form>
			<!-- END HEADER SEARCH BOX --> 
			
		</div>
		<!-- END PAGE TOP --> 
	</div>
	<!-- END HEADER INNER --> 
</div>
<!-- END HEADER -->
<div class="clearfix"> </div>
<!-- BEGIN CONTAINER -->
<div class="page-container"> 
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper"> 
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing --> 
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse"> 
			<!-- BEGIN SIDEBAR MENU --> 
			<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) --> 
			<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode --> 
			<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode --> 
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing --> 
			<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded --> 
			<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<li class="start "> <a href="<?php echo ADRESSE_SITE; ?>"> <i class="icon-home"></i> <span class="title">Accueil</span> </a> </li>
				<li> <a href="javascript:;"> <i class="icon-basket"></i> <span class="title">Concours</span> <span class="arrow "></span> </a>
					<ul class="sub-menu">
						<li> <a href="<?php echo ADRESSE_SITE; ?>admin/utilisateurs/utilisateurs"> Liste par concours</a> </li>
						<li> <a href="<?php echo ADRESSE_SITE; ?>admin/add"> <i class="icon-basket"></i> Ajouter un concours</a> </li>
					</ul>
				</li>
				
				<li class="last "> <a href="javascript:;"> <i class="icon-pointer"></i> <span class="title">Utilisateurs</span> <span class="arrow "></span> </a>
					<ul class="sub-menu">
						<li> <a href="<?php echo ADRESSE_SITE; ?>admin/utilisateurs/"> Liste par concours</a> </li>
						<li> <a href="<?php echo ADRESSE_SITE; ?>admin/utilisateurs/list_users"> Liste de tous les utilisateurs</a> </li>
					</ul>
				</li>
			</ul>
			<!-- END SIDEBAR MENU --> 
		</div>
	</div>
	<!-- END SIDEBAR --> 
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content"> 
			
			<!-- BEGIN PAGE HEADER--> 
			<!-- BEGIN PAGE HEAD -->
			<div class="page-head"> 
				<!-- BEGIN PAGE TITLE -->
				<div class="page-title">
					<h1>Parametres <small></small></h1>
				</div>
				<!-- END PAGE TITLE --> 
			</div>
			<!-- END PAGE HEAD --> 
			<!-- BEGIN PAGE BREADCRUMB -->
			<ul class="page-breadcrumb breadcrumb">
				<li> <a href="<?php echo ADRESSE_SITE; ?>">Accueil</a> <i class="fa fa-circle"></i> </li>
				<li> <a href="<?php echo ADRESSE_SITE; ?>admin">Administration</a> <i class="fa fa-circle"></i> </li>
				<li> <a href="<?php echo ADRESSE_SITE; ?>admin/settings">Parametres</a> </li>
			</ul>
			<!-- END PAGE BREADCRUMB --> 
			<!-- END PAGE HEADER--> 
			
		<?php include "view/".$controller."/".$action.".php";?>			
			
		</div>
	</div>
	<!-- END CONTENT --> 
</div>
<!-- END CONTAINER --> 
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner"> 2016 &copy;</div>
	<div class="scroll-to-top"> <i class="icon-arrow-up"></i> </div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo ADRESSE_SITE; ?>view/assets/global/plugins/respond.min.js"></script>
<script src="<?php echo ADRESSE_SITE; ?>view/assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo ADRESSE_SITE; ?>view/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo ADRESSE_SITE; ?>view/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo ADRESSE_SITE; ?>view/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo ADRESSE_SITE; ?>view/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo ADRESSE_SITE; ?>view/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo ADRESSE_SITE; ?>view/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo ADRESSE_SITE; ?>view/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo ADRESSE_SITE; ?>view/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo ADRESSE_SITE; ?>view/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo ADRESSE_SITE; ?>view/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo ADRESSE_SITE; ?>view/assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo ADRESSE_SITE; ?>view/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo ADRESSE_SITE; ?>view/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="<?php echo ADRESSE_SITE; ?>view/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo ADRESSE_SITE; ?>view/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo ADRESSE_SITE; ?>view/assets/admin/layout4/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo ADRESSE_SITE; ?>view/assets/admin/layout4/scripts/demo.js" type="text/javascript"></script>
<script src="<?php echo ADRESSE_SITE; ?>view/assets/global/scripts/datatable.js"></script>
<script src="<?php echo ADRESSE_SITE; ?>view/assets/admin/pages/scripts/table-ajax.js" class="concours/<?php echo $id; ?>" id="id"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
        jQuery(document).ready(function() {    
           Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Demo.init(); // init demo features
           TableAjax.init();
        });
    </script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>