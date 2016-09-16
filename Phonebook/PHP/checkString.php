<?php
class Document{
    private $filename;
	private $searchWords;
	
    public function __construct($filePath, $words) {
        $this->filename = $filePath;
		$this->searchWords= $words;
		
    }

	private function Existence($content){
		$isTrue=false;
		foreach($this->searchWords as $item)
		{
			
			if( strpos($content,$item) !== false) 	
			{
				$isTrue=true;
			}
			else
			{
				$isTrue=false;
				break;
			}
		}
		if($isTrue==true)
		{
			
				$fNamaExt=explode("/",$this->filename)[2];
				$fName=explode(".",$fNamaExt)[0];
				return $fName;
		}
		else
		{
			return false;
		}
	}
	
	
   
	  private function read_docx(){

        $striped_content = '';
        $content = '';

        $zip = zip_open($this->filename);

        if (!$zip || is_numeric($zip)) return false;

        while ($zip_entry = zip_read($zip)) {

            if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

            if (zip_entry_name($zip_entry) != "word/document.xml") continue;

            $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

            zip_entry_close($zip_entry);
        }

        zip_close($zip);

        $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
        $content = str_replace('</w:r></w:p>', "\r\n", $content);
        $striped_content = strip_tags($content);
		
		$result=$this->Existence($striped_content);
		return $result;
		  
    }

    public function convertToText() {

        if(isset($this->filename) && !file_exists($this->filename)) {
            return "File Not exists";
        }

        $fileArray = pathinfo($this->filename);
        $file_ext  = $fileArray['extension'];
        if($file_ext == "docx")
        {
          if($file_ext == "docx") {
                return $this->read_docx();
            }
        } else {
            return "Invalid File Type";
        }
    }

}
 
	$words=$_POST["string"];
	$isTrue=false;
	$dir="../Dir/";
	$splitStr=explode(" ",$words);
	$filesContaintWord=array();
	$files=array_diff(scandir($dir), array('..', '.'));
	
		foreach($files as $value)
		{
				$getExt=explode('.',$value)[1];

				if("txt"==$getExt)
				{
						foreach($splitStr as $item){
							if( strpos(file_get_contents("../Dir/".$value),$item) !== false) 
							{
								$isTrue=true;
							}
							else
							{
								$isTrue=false;
								break;
							}
						}
				
						if($isTrue==true)
						{
							$fName=explode(".",$value)[0];
							array_push($filesContaintWord,$fName);
							
						}
					
				}
				
				else if("docx"==$getExt)
				{
					$doc = new Document("../Dir/".$value,$splitStr);
					$result=$doc->convertToText();
					if($result!=false)
					{
							array_push($filesContaintWord,$result);
					}
					
				}
			
		}
	
		echo json_encode($filesContaintWord);	
		
?>