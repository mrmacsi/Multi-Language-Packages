<?php

namespace Main;


class Language{
    private $pathName           =   "lang/";
    private $langName           =   "tr";
    private $defaultLangFile    =   "default.json";
    private $fileType           =   ".json";
    private $languages          =   [];

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

    function addOrChangeItem($item,$langName=null){
        if (!$langName) $langName = $this->langName;
        $allTranslates =  $this->getAllTranslates($langName);
        foreach($item as $per=>$key) $allTranslates[str_replace(' ','_',strtolower($per))] =  $key;
        $fp = fopen($this->pathName.$langName.$this->fileType, 'w');
        fwrite($fp, json_encode($allTranslates));
        fclose($fp);
        return true;
    }

    function getAllTranslates($langName=null){
        if (!$langName) $langName = $this->langName;
        return json_decode(file_get_contents($this->pathName.$langName.$this->fileType), true);
    }

    function setLanguage($langName){
        $this->langName =   $langName;
        $default        =   json_decode(file_get_contents($this->pathName.$this->defaultLangFile), true);
        $default['defaultLang'] = $this->langName;
        $fp             =   fopen($this->pathName.$this->defaultLangFile, 'w');
        fwrite($fp, json_encode($default));
        fclose($fp);
        return true;
    }

    function getCurrentLanguage(){
        return $this->langName;
    }

    function getAllLanguages(){
        return $this->languages;
    }

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