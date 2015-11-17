
	<div class="moduleCenter"> 
	<div class="grid grid-pad">
          <div class="col-2-3">
	<div id="itemMenu">
	<form id="0" action="/admin/menu/edit" method="POST">
<?php echo fonctions::menuEdit(); ?>
   <!-- <li class="item" id="1">
		<h3 class="block-title">TestIndex</h3>
        <div class="block block-title">
		<label>Nom du Menu</label><input type="text" name="lien1"><br>
		<label>Lien du Menu</label><input type="text" name="nom1"><br>
		<button onDblClick="supprimerElement('#1');">Supprimer l'item</button>
		</div>
        <ul class="sortable list-unstyled"></ul>
    </li>
	
    <li>
	<h3>TestIndex</h3>
        <div class="block block-title">About Us</div>
        <ul class="sortable list-unstyled"></ul>
    </li>
    <li>
        <div class="block block-title">Portfolion</div>
        <ul class="sortable list-unstyled"></ul>
    </li>
    <li>
        <div class="block block-title">Services</div>
        <ul class="sortable list-unstyled">
            <li>
                <div class="block block-title">Design</div>
                <ul class="sortable list-unstyled"></ul>
            </li>
            <li>
                <div class="block block-title">Develope</div>
                <ul class="sortable list-unstyled"></ul>
            </li>
            <li>
                <div class="block block-title">SEO</div>
                <ul class="sortable list-unstyled"></ul>
            </li>
            <li>
                <div class="block block-title">Support</div>
                <ul class="sortable list-unstyled"></ul>
            </li>
        </ul>
    </li>
    <li>
        <div class="block block-title">Contact</div>
        <ul class="sortable list-unstyled"></ul>
    </li>-->
	<input type="submit" value="Enregistrer">
</form>
 </div>
 </div>
           <div class="col-1-3">
		   <label for="nomNouveauElement">Nom du nouvel element</label>
		   <input type="text" id="nomNouveauElement" size="50"><br>
		   <label for="lienNouveauElement">Lien du nouvel element</label>
		   <input type="text" id="lienNouveauElement" size="50"><br>
		   <button onDblClick="ajouterElement();">Ajouter l'item</button>

</div>
 </div>
	
	
	
	</div>
