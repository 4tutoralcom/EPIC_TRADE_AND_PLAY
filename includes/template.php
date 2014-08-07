<html>
<?php
class Template{
	public $output;
	public $file;
	public $values = array();
	
	function __construct($file){
	$this->output="";
	$this->file="";
	if( file_exists($file)){
			$this->file = $file;
			$this->output = file_get_contents($this->file);
		}elseif($file!=""){
			$this->output=$file;
		}
	}	
	function setTag($key, $value,$overrideOrigonal=false){			
		if(!$overrideOrigonal && !isset($this->values[$key]))
			$this->values[$key] = $value;
		else if ($overrideOrigonal)
			$this->values[$key] = $value;
	}
	function getTag($key){
		return (isset($this->values[$key]))?$this->values[$key]:null;	
	}
	function setAttribute($key, $value){
		$this->values[$key] = $value;		
	}
	
	function output(){
			foreach ($this->values as $key => $value) {
				$tag = "[$key]";
				$this->output = str_replace($tag, $value, $this->output);
			}
		return $this->output;
	}
}
?>
</html>