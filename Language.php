<?php

namespace Main;


class Language{
    private $pathName           =   "lang/";
    private $langName           =   "tr";
    private $defaultLangFile    =   "default.json";
    private $fileType           =   ".json";
    private $languages          =   [];


    //The constructor will create default.json for default language and all languages tags will storage in this JSON.
    function __construct(){
        try{
            if (!file_exists($this->pathName.$this->defaultLangFile)){
                $fp = fopen($this->pathName.$this->defaultLangFile, 'w');
                $array =['defaultLang'=>$this->langName];
                fwrite($fp, json_encode($array));
                fclose($fp);
            }else{
                $default        =   json_decode(file_get_contents($this->pathName.$this->defaultLangFile), true);
                $this->langName =   $default['defaultLang'];
                if(isset($default['languages'])) $this->languages=   $default['languages'];
            }
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }


    //It will create en.json file in lang directory. Also it will add an information inside of default.json.
    function createNewLanguage($langName){
        if($langName!=""){
            if (!file_exists($this->pathName)) mkdir($this->pathName, 0777);
            if (!file_exists($this->pathName.$langName.$this->fileType)){
                $default = json_decode(file_get_contents($this->pathName.$this->defaultLangFile), true);
                if(!empty($default['languages'])){
                    foreach($default['languages'] as $per) $languages[] =  $per;
                }
                $languages[] =  $langName;
                $default['languages'] =  array_unique($languages);
                fopen($this->pathName.$langName.$this->fileType, 'w');
                $fp = fopen($this->pathName.$this->defaultLangFile, 'w');
                fwrite($fp, json_encode($default));
                fclose($fp);
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }


    //This function adds a mean to the JSON file that you would like to add by an array.
    //You can use this function without language name if you set the language before.
    //If you don't use and if you didn't set it before it will show the default language.
    //Also you can use the add too many values in same time.
    //$item have to be a type of array and the values must be like this ['example_key2','Example Value2']
    //$item have to be a type of array and the values must be like this ['example_key','Example Value','example_key2','Example Value2']
    function addOrChangeItem($item,$langName=null){
        if (!$langName) $langName = $this->langName;
        $allTranslates =  $this->getAllTranslates($langName);
        foreach($item as $per=>$key) $allTranslates[str_replace(' ','_',strtolower($per))] =  $key;
        $fp = fopen($this->pathName.$langName.$this->fileType, 'w');
        fwrite($fp, json_encode($allTranslates));
        fclose($fp);
        return true;
    }

    //You can use this function instead of $lang->getMean("hello","en");
    //That is easy way to access to translations from a variable.
    //Example Uses
    //$allOfTranslates = getAllTranslates("en");
    //echo $allOfTranslates['how_are_you'];
    //-How are you
    function getAllTranslates($langName=null){
        if (!$langName) $langName = $this->langName;
        return json_decode(file_get_contents($this->pathName.$langName.$this->fileType), true);
    }

    //You can set the language for one time and you can use it in everywhere without setting again.
    function setLanguage($langName){
        $this->langName =   $langName;
        $default        =   json_decode(file_get_contents($this->pathName.$this->defaultLangFile), true);
        $default['defaultLang'] = $this->langName;
        $fp             =   fopen($this->pathName.$this->defaultLangFile, 'w');
        fwrite($fp, json_encode($default));
        fclose($fp);
        return true;
    }

    //That function will return the current language that you set before or default ones.
    function getCurrentLanguage(){
        return $this->langName;
    }

    //You will get the all of the language tags that added to system before.
    function getAllLanguages(){
        return $this->languages;
    }

    //You can get the means one by one with this funtion.
    //You can use this function without language name if you set the language before. If you don't use and if you didn't set it before it will show the default language.
    //If you didn't add values for all languages it will show you the error that is "Not Found in the JSON".
    function getMean($item,$langName=null){
        try{
            if (!$langName) $langName = $this->langName;
            $allTranslates =  $this->getAllTranslates($langName);
            if(isset($allTranslates[$item])){
                return $allTranslates[$item];
            }else{
                return $item." Not Found in ".$this->pathName.$langName.$this->fileType;
            }
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
