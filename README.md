# Multi-Language-Packages JSON & PHP
# How to use in PHP

use Main\Language;
require_once "Language.php";
$lang = new Language();

# Example default.json in Packages
{"defaultLang":"en","languages":["tr","en","de"]}
The constructor will create default.json for default language and all languages tags will storage in this JSON.

$lang->createNewLanguage("en");
$lang->createNewLanguage("tr");
$lang->createNewLanguage("de");
It will create en.json file in lang directory. Also it will add an information inside of default.json.

$lang->addOrChangeItem(["hello"=>Hello],"en");
$lang->addOrChangeItem(["hello"=>"Selam"],"tr");
$lang->addOrChangeItem(["hello"=>"Hallo"],"de");
This function adds a mean to the JSON file that you would like to add by an array.
You can use this function without language name if you set the language before. If you don't use and if you didn't set it before it will show the default language.

$lang->addOrChangeItem(["hello"=>Hello,"thank_you"=>Thank you,"good_bye"=>Good Bye],"en");
Also you can use the add too many values in same time.

$lang->setLanguage("en");
{"defaultLang":"en","languages":["tr","en","de"]}
You can set the language for one time and you can use it in everywhere without setting again.

$lang->getCurrentLanguage();
That function will return the current language that you set before or default ones.

$lang->getAllLanguages();
["tr","en","de"]
You will get the all of the language tags that added to system before.

$lang->getMean("hello","en");
Hello
You can get the means one by one with this funtion.
You can use this function without language name if you set the language before. If you don't use and if you didn't set it before it will show the default language.
If you didn't add values for all languages it will show you the error that is "Not Found in the JSON".


# How to use in Javascript

$.getJSON("lang/default.json").done(function( data ) {
\\You will learn the default language in Javascript.
	$.getJSON("lang/"+data.defaultLang+".json").done(function( lang ) {
	\\That will show you every translates from default JSON file in Javascript.
		console.log(lang.hello);
	});
});

MrMacsi
