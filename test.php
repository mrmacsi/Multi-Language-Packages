<?php
use Main\Language;
require_once "Language.php";
$lang = new Language();
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
        $array =[$_POST['itemName']=>$_POST['mean']];
        if($lang->addOrChangeItem($array,strtolower($_POST['lang']))){
            echo strtolower($_POST['lang']). " mean added Successfully";
        }else{
            echo "Unsuccessfull";
        }
    }elseif(isset($_POST['changeName'])){
        $array =[$_POST['items']=>$_POST['changeName']];
        if($lang->addOrChangeItem($array,strtolower($_POST['lang']))){
            echo strtolower($_POST['lang']). " mean changed Successfully";
        }else{
            echo "Unsuccessfull";
        }
    }
}
?>
<html>
<head>
    <title>PHP&JSON Language Pack Test Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="css/bootstrap.min.js"></script>
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
                    <small id="emailHelp" class="form-text text-muted">Choose a language that you would like to set.(if it didn't refresh, clear your cache.)</small>
                </div>
                <input type="submit" value="Submit" class="btn btn-primary">
            </form>
        </div>
        <div class="col-lg-3 col-sm-3">
            <form action="test.php" method="POST">
                <div class="form-group">
                    <label for="newlang">Create New Language</label>
                    <input type="text" class="form-control" id="newlang" name="newLang" placeholder="Enter New Language Tag Example : en">
                    <small id="emailHelp" class="form-text text-muted">Enter a new Language by 2 Character.</small>
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
                    <small id="emailHelp" class="form-text text-muted">Choose Language and enter Name and Mean.</small>
                </div>
                <input type="submit" value="Submit" name="addItemName" class="btn btn-primary">
            </form>
        </div>
        <div class="col-lg-3 col-sm-3">
            <form action="test.php" method="POST">
                <div class="form-group">
                    <label for="newlang">Change Mean</label>
                    <select class="form-control" name="lang" id="languages3" onchange="getTranslates(this.value)"></select>
                    <select class="form-control" name="items" id="items"></select>
                    <input type="text" class="form-control" name="changeName" id="newlang" placeholder="Choose Language and word to change">
                    <small id="emailHelp" class="form-text text-muted">Choose the language that you would like to change and choose the item after enter a new mean</small>
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
                getTranslates($("#languages3").val());
            });
        });
    });
    function getTranslates(language){
        $("#items").html("");
        $.getJSON("lang/"+language+".json").done(function( lang ) {
            $.each(lang, function(key, val) {
                $("#items").append('<option value="'+key+'">'+val+'</option>');
            });
        });
    }
</script>
</body>
</html>
