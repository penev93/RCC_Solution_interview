<?php 
//Objects
class fileObj
	{
		public $name;
		public $fType;
		public $size;
		
		public function __construct($name, $fType, $size)
		{
			$this->name=$name;
			$this->fType=$fType;
			$this->size=$size;
		}
		
		  public function jsonSerialize()
    {
        return get_object_vars($this);
    }
	}
?>