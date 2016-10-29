<?php
use Main\Language;
require_once "Language.php";
$lang = new Language();
/*use Main\Language;
require_once "Language.php";
$lang = new Language();
$lang->createNewLanguage('de');
$lang->addItem(['hello'=>"Hello",'how_are_you'=>"How are you?",'good'=>"Good"],'de');
$lang->changeMean('en',['hello'=>"Hi"]);
var_dump($lang->getAllTranslates('en'));
echo $lang->getMean('hello');
$translates = $lang->getAllTranslates();
print_r($translates);*/
if(isset($_POST)){
    if(isset($_POST['setLang'])){
        if($lang->setLanguage(strtolower($_POST['setLang']))){
            echo "Set Successfully";
        }else{
            echo "Unsuccessfull";
        }
    }elseif(isset($_POST['newLang'])){
        if($lang->createNewLanguage(strtolower($_POST['newLang']))){
            echo "Created Successfully";
        }else{
            echo "Unsuccessfull";
        }
    }elseif(isset($_POST['addItemName'])){

    }elseif(isset($_POST['newLang'])){

    }
}
?>
<html>
<head>
    <title>PHP&JSON Language Pack Test Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="jquery.min.js"></script>
    <script src="bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
    <h1>Multi Language Test Page</h1>
    <div class="row">
        <div class="col-lg-6 col-sm-6">
            <label >default.json</label>
            <div id="examples"></div>
        </div>
        <div class="col-lg-3 col-sm-3">
            <label >Inside of Language Json</label>
            <div id="examples2"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-sm-3">
            <form action="test.php" method="POST">
                <div class="form-group">
                    <label for="languages">Set Language</label>
                    <select class="form-control" name="setLang" id="languages">
                    </select>
                </div>
                <input type="submit" value="Submit" class="btn btn-primary">
            </form>
        </div>
        <div class="col-lg-3 col-sm-3">
            <form action="test.php" method="POST">
                <div class="form-group">
                    <label for="newlang">Create New Language</label>
                    <input type="text" class="form-control" id="newlang" name="newLang" placeholder="Enter New Language Tag Example : en">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <input type="submit" value="Submit" class="btn btn-primary">
            </form>
        </div>
        <div class="col-lg-3 col-sm-3">
            <form action="test.php" method="POST">
                <div class="form-group">
                    <label for="newlang">Add New Item</label>
                    <select class="form-control" name="lang" id="languages2"></select>
                    <input type="text" class="form-control" name="itemName" placeholder="Enter New item Name">
                    <input type="text" class="form-control" name="mean" placeholder="Enter New Mean">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <input type="submit" value="Submit" name="addItemName" class="btn btn-primary">
            </form>
        </div>
        <div class="col-lg-3 col-sm-3">
            <form action="test.php" method="POST">
                <div class="form-group">
                    <label for="newlang">Change Mean</label>
                    <select class="form-control" id="languages3"></select>
                    <select class="form-control" id="items"></select>
                    <input type="text" class="form-control" id="newlang" placeholder="Choose Language and word to change">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <input type="submit" name="changeItemName" value="Submit" class="btn btn-primary">
            </form>
        </div>
    </div>

</div>

<script>
    $(function(){
        var translates;
        $.getJSON("lang/default.json").done(function( data ) {
            $("#examples").append(JSON.stringify(data,null,'<br>')+"<br>");
            $(data.languages).each(function(key,val){
                $("#languages,#languages2,#languages3").append('<option value="'+val+'">'+val+'</option>');
            });
            $.getJSON("lang/"+data.defaultLang+".json").done(function( lang ) {
                $("#examples2").append(JSON.stringify(lang,null,'<br>'));
            });
        });
    });
</script>
</body>
</html>
