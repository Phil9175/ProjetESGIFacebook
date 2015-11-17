<?php
class notFound {
	
	public function __construct() {
		$view = new view("404", "404", "404.layout");
		$article = new article;
		$articles = $article->getResults("","","article", " WHERE statut = 'published' and type_page = 'article.layout' ORDER BY id");
		$view->assign("allArticles", $articles);
	}
}