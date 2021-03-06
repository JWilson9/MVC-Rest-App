<?php
class xmlView {
	private $model, $controller, $slimApp;
	public function __construct($controller, $model, $slimApp) {
		$this->controller = $controller;
		$this->model = $model;
		$this->slimApp = $slimApp;
	}
	public function output() {

		$xml = new SimpleXMLElement('<root/>');
		$this->xml_encode($xml, $this->model->apiResponse);
		$data = $xml->asXML();
		$this->slimApp->response->write ( $data );
	}
	
	private function xml_encode($obj, $array)
	{
	    foreach ($array as $key => $value)
	    {
	        if(is_numeric($key))
	            $key = 'item' . $key;
	
	        if (is_array($value))
	        {
	            $node = $obj->addChild($key);
	            $this->xml_encode($node, $value);
	        }
	        else
	        {
	            $obj->addChild($key, htmlspecialchars($value));
	        }
	    }
	}
	
}
?>