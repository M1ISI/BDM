<?php
 
 
/**Function to extract text*/
function extracttext($filename) {
    //Check for extension
    $ext = end(explode('.', $filename));
 
    //if its docx file
    if($ext == 'docx')
    $dataFile = "word/document.xml";
    //else it must be odt file
    else
    $dataFile = "content.xml";     
       
    //Create a new ZIP archive object
    $zip = new ZipArchive;
 
    // Open the archive file
    if (true === $zip->open($filename)) {
        // If successful, search for the data file in the archive
        if (($index = $zip->locateName($dataFile)) !== false) {
            // Index found! Now read it to a string
            $text = $zip->getFromIndex($index);
            // Load XML from a string
            // Ignore errors and warnings
            $xml = DOMDocument::loadXML($text, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
            // Remove XML formatting tags and return the text
            return strip_tags($xml->saveXML());
        }
        //Close the archive file
        $zip->close();
    }
 
    // In case of failure return a message
    return "File not found";
}
 
?>
