<?php

namespace Main;


class Language{
    private $pathName           =   "lang/";
    private $langName           =   "tr";
    private $defaultLangFile    =   "default.json";

    function __construct()
    {
        if (!file_exists($this->pathName.$this->defaultLangFile)){
            $fp = fopen($this->pathName.$this->defaultLangFile, 'w');
            $array =['defaultLang'=>$this->langName];
            fwrite($fp, json_encode($array));
            fclose($fp);
        }else{
            $default        = json_decode(file_get_contents($this->pathName.$this->defaultLangFile), true);
            $this->langName = $default['defaultLang'];
        }
    }

    function createNewLanguage($langName,$pathName=null){
        if(!$pathName) $pathName = $this->pathName;
        if (!file_exists($pathName)) mkdir($pathName, 0777);
        $langName = str_replace('.json','',$langName).'.json';
        if (!file_exists($pathName.$langName)){
         fopen($pathName.$langName, 'w');
            return true;
        }else{
            return false;
        }
    }

    function addItem($array,$langName,$pathName=null){
        if(!$pathName) $pathName = $this->pathName;
        $langName = str_replace('.json','',$langName).'.json';
        $fp = fopen($pathName.$langName, 'w');
        fwrite($fp, json_encode($array));
        fclose($fp);
        return true;
    }

    function getAllTranslates($langName=null,$pathName=null){
        if (!file_exists($pathName.$langName)) $pathName = $this->pathName;
        if (!$langName) $langName = str_replace('.json','',$this->langName).'.json';
        else $langName = str_replace('.json','',$langName).'.json';
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

    function getLanguage(){
        return $this->langName;
    }
}