<?php

  function strip_zeros_from_date($marked_string = "") {
      // first remove the marked zeros
      $no_zeros = str_replace('*0', '', $marked_string);
      // then remove any remaining marks
      $cleaned_string = str_replace('*', '', $no_zeros);
      return $cleaned_string;
  }

  function redirect_to($location = NULL) {
      if ($location != NULL) {
          header("Location: {$location}");
          exit;
      }
  }

  function output_message($message = "") {
    if (!empty($message)) {
        return "<p class=\"message\">{$message}</p>";
    } else {
        return "";
    }
}

function __autoload($className){
    $className = strtolower($className);
    $path = LIB_PATH.DS.'{$className}.php';
    if(file_exists($path)){
        require_once($path);
    }else{
        die("The file {$className}.php could not be found.");
    }

}

function includeLayoutTemplate($template = ""){
    include(SITE_ROOT.DS.'public'.DS.'layouts'.DS.$template);
}

function logAction($action , $messag = ""){
    $logFile = SITE_ROOT.DS. 'logs'.DS.'log.txt' ;
    $new = file_exists($logFile) ? false : true;
    if($handle = fopen($logFile , 'a')){
        $timestamp = strftime("%Y-%m-%d %H:%M:%S" , time());
        $content = "{$timestamp} | {$action}: {$messag} \n";
        fwrite($handle, $content);
        fclose($handle);
    }else{
        echo "Could not open log file or wrtitin on this.";
    }  
}
function datetimeToText($datetime = ""){
    $unixdatetime = strtotime($datetime);
    return strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
    }