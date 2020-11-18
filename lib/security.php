<?php
print PHP_EOL . '<!-- BEGIN include security -->' . PHP_EOL;
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// prefroms a simple security check to see if our page has submitted the form to itself
function securityCheck($myFormURL = ""){
    $debugThis = false; // you have to specifically want to test this
    
    $status = true; // start off thinking everything is ok
    
    // when it is a form page check to make sure everything is good until a test fails
    if ($myFormURL != "") {
        $fromPage = htmlentities($_SERVER['HTTP_REFERER'], ENT_QUOTES, 'UTF-8');
        
        // remove http or https
        $fromPage = preg_replace('#^https?:#', '', $fromPage);
        
        if ($debugThis)
            print '<p>From: ' . $fromPage . ' should match your Url: ' . $myFormURL;
        
        if ($fromPage != $myFormURL) {
            $status = false;
        }
    }

return $status;
}
print PHP_EOL . '<!-- End include security -->' . PHP_EOL;
?>


