<?php

namespace Main;


class Language{
    function createNewLanguage($langName,$pathName=null){
        if(!$pathName) $pathName = "/lang";
        if (!file_exists($pathName)) mkdir($pathName."/".$langName, 0777);
        return $langName;
    }
}