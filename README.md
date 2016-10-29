# Multi-Language-Packages JSON & PHP
# How to use in PHP
<pre>
use Main\Language;
require_once "Language.php";
$lang = new Language();</pre>

<strong>Example default.json in Packages</strong>
<pre>{"defaultLang":"en","languages":["tr","en","de"]}</pre>

<strong>The constructor will create default.json for default language and all languages tags will storage in this JSON.</strong>


<pre>
$lang->createNewLanguage("en");

$lang->createNewLanguage("tr");

$lang->createNewLanguage("de");
</pre>

<strong>It will create en.json file in lang directory. Also it will add an information inside of default.json.</strong>


<pre>
$lang->addOrChangeItem(["hello"=>Hello],"en");

$lang->addOrChangeItem(["hello"=>"Selam"],"tr");

$lang->addOrChangeItem(["hello"=>"Hallo"],"de");
</pre>
<strong>This function adds a mean to the JSON file that you would like to add by an array.
You can use this function without language name if you set the language before. If you don't use and if you didn't set it before it will show the default language.</strong>


<pre>
$lang->addOrChangeItem(["hello"=>Hello,"thank_you"=>Thank you,"good_bye"=>Good Bye],"en");
</pre>
<strong>Also you can use the add too many values in same time.</strong>


<pre>
$lang->setLanguage("en");

{"defaultLang":"en","languages":["tr","en","de"]}
</pre>

<strong>You can set the language for one time and you can use it in everywhere without setting again.</strong>


<pre>
$allOfTranslates = getAllTranslates("en");

echo $allOfTranslates['how_are_you'];

How are you
</pre>

<strong>You can use this function instead of $lang->getMean("hello","en");
That is easy way to access to translations from a variable.</strong>


<pre>
$lang->getCurrentLanguage();

["en"]
</pre>
<strong>This function will return the current language that you set before or default ones.</strong>


<pre>
$lang->getAllLanguages();

["tr","en","de"]
</pre>

<strong>You will get the all of the language tags that added to system before.</strong>


<pre>
$lang->getMean("hello","en");

Hello
</pre>

<strong>You can get the means one by one with this funtion.
You can use this function without language name if you set the language before. If you don't use and if you didn't set it before it will show the default language.
If you didn't add values for all languages it will show you the error that is "Not Found in the JSON".</strong>


# How to use in Javascript

<pre>
$.getJSON("lang/default.json").done(function( data ) {

<strong>You will learn the default language in Javascript.</strong>

$.getJSON("lang/"+data.defaultLang+".json").done(function( lang ) {

<strong>That will show you every translates from default JSON file in Javascript.</strong>

console.log(lang.hello);
//Hello

});

});
</pre>

MrMacsi
