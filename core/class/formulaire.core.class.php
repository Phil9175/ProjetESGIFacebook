<?php
class formulaire {
	
	public $idForm;
	public $cssClass;
	public $method;
	public $action;
	public $name;
	public $type;
	private $nbElements = 0;
	private $elementsFormulaire = array();
	private $elementsSessionFormulaire = array();
	private $nbElementsSessionFormulaire = 0;
	
	public function __construct($idForm, $cssClass, $method, $action, $name, $type="application/x-www-form-urlencoded"){
		$this->idForm = $idForm;
		$this->cssClass = $cssClass;
		$this->method = $method;
		$this->action = $action;
		$this->name = $name;
		$this->type = $type;
		$this->identifiantSecurite = sha1(uniqid().md5(microtime()));
		$this->elementsSessionFormulaire[$this->nbElementsSessionFormulaire] = ["identifiantSecurite" => $this->identifiantSecurite];
		$this->nbElementsSessionFormulaire++;
	}
	
	public function ajoutElement($title, $type, $id, $class, $name, $required = FALSE, $value = "", $label_class = "", $typeVerification, $rows, $cols){
		$label_class = ($label_class != "")?" class=\"".$label_class."\"":"";
		$value = ($value != "" && $type != "textarea")?" value=\"".$value."\"":$value;
		$rows = ($rows != "" && $type != "textarea")?" size=\"".$rows."\"":" rows=\"".$rows."\"";
		$requiredText = ($required == TRUE)?" required=\"required\"":"";

		switch ($type){
		case "submit":
			$label = "";
			break;
		case "reset":
			$label = "";
			break;
		case "image":
			$label = "";
			break;
		case "button":
			$label = "";
			break;
		default:
			$label = "<label for=\"".$id."\"".$label_class.">".$title."</label>";
			break;
		}
		
		if ($type == "textarea"){
		$this->elementsFormulaire[$this->nbElements] = $label."<textarea id=\"".$id."\" class=\"".$class."\" name=\"".$name."\"".$requiredText." cols=\"".$cols."\" ".$rows.">".$value."</textarea>";
		}else{
		$this->elementsFormulaire[$this->nbElements] = $label."<input type=\"".$type."\" id=\"".$id."\" class=\"".$class."\" name=\"".$name."\"".$rows."".$value."".$requiredText.">";
		}
		++$this->nbElements;
		$this->elementsSessionFormulaire[$this->nbElementsSessionFormulaire] = ["title" => $title,"type" => $type, "name" => $name, "required" => $required, "typeVerification" => $typeVerification];
		$this->nbElementsSessionFormulaire++;
	}
	
	public function ajoutSelect($title, $id, $name, $class, $required = FALSE){
				$requiredText = ($required == TRUE)?" required=\"required\"":"";

		$this->elementsFormulaire[$this->nbElements] .= "<select id=\"".$id."\" class=\"".$class."\" name=\"".$name."\"".$requiredText.">\n";
		$this->elementsSessionFormulaire[$this->nbElementsSessionFormulaire] = ["title" => $title, "type" => "selected", "name" => $name, "required" => $required];
		++$this->nbElementsSessionFormulaire;
		return $this->nbElements++;

	}
	
	public function ajoutOptionSelect($id, $title, $value=""){
		$value = ($value == "")?$title:$value;
		$this->elementsFormulaire[$id] .= "<option value=\"".$value."\">".$title."</option>\n";
	}
	
	public function finSelect($id){
		$this->elementsFormulaire[$id] .= "</select>\n";
	}
	
	public function afficheForm(){
		$form = "<form id=\"".$this->idForm."\" name=\"".$this->name."\" action=\"".$this->action."\" method=\"".$this->method."\" type=\"".$this->type."\">\n";
		$form .= "<input type=\"hidden\" name=\"identifiantSecurite\" value=\"".$this->identifiantSecurite."\">\n";
		$form .= "<input type=\"hidden\" name=\"isSubmit\" value=\"yes\">\n";
		foreach($this->elementsFormulaire as $key => $value) {
			$form .= $value."<br>\n";
		}
		$form .= "</form>\n";
		$_SESSION['elementsSessionFormulaire'][$this->idForm] = $this->elementsSessionFormulaire;
		return $form;
	}
}
?>