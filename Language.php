<?php

namespace Main;


class Language{
    private $pathName           =   "lang/";
    private $langName           =   "tr";
    private $defaultLangFile    =   "default.json";
    private $fileType           =   ".json";
    private $languages          =   [];

    function __construct(){
        if (!file_exists($this->pathName.$this->defaultLangFile)){
            $fp = fopen($this->pathName.$this->defaultLangFile, 'w');
            $array =['defaultLang'=>$this->langName];
            fwrite($fp, json_encode($array));
            fclose($fp);
        }else{
            $default        =   json_decode(file_get_contents($this->pathName.$this->defaultLangFile), true);
            $this->langName =   $default['defaultLang'];
            $this->languages=   $default['languages'];
        }
    }

    function createNewLanguage($langName,$pathName=null){
        if(!$pathName) $pathName = $this->pathName;
        if (!file_exists($pathName)) mkdir($pathName, 0777);
        if (!file_exists($pathName.$langName.$this->fileType)){
            $default = json_decode(file_get_contents($this->pathName.$this->defaultLangFile), true);
            if($default['languages']){
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
    }

    function addItem($array,$langName,$pathName=null){
        if(!$pathName) $pathName = $this->pathName;
        $allTranslates =  $this->getAllTranslates($langName);
        foreach($array as $per=>$key) $allTranslates[$per] =  $key;
        $fp = fopen($pathName.$langName.$this->fileType, 'w');
        fwrite($fp, json_encode($allTranslates));
        fclose($fp);
        return true;
    }

    function getAllTranslates($langName=null,$pathName=null){
        if (!file_exists($pathName.$langName.$this->fileType)) $pathName = $this->pathName;
        if (!$langName) $langName = $this->langName.$this->fileType;
        else $langName = $langName.$this->fileType;
        return json_decode(file_get_contents($pathName.$langName), true);
    }

    function setLanguage($langName){
        $fp = fopen($this->pathName.$this->defaultLangFile, 'w');
        $this->langName=$langName;
        $array =['defaultLang'=>$this->langName];
        fwrite($fp, json_encode($array));
        fclose($fp);
        return true;
    }

    function getCurrentLanguage(){
        return $this->langName;
    }

    function getAllLanguages(){
        return $this->langName;
    }
}