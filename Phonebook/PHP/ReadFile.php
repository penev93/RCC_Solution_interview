<?php
 class stringChecker{
    private $filename;

    public function __construct($filePath) {
        $this->filename = $filePath;
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

        return $striped_content;
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

session_start();
$name=$_POST["file"];
$type=$_POST["ftype"];

	if($type == "txt" )
	{
		$myfile = fopen("../Dir/".$name.".".$type, "r") or die("Unable to open file!");
		$_SESSION["da"]= fread($myfile,filesize("../Dir/".$name.".txt"));	
	}
	else
	{
		$obj = new stringChecker("../Dir/".$name.".".$type);
		$docText= $obj->convertToText();
		$_SESSION["da"]=$docText;	
	}

?>