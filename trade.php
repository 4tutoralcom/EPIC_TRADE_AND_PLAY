<?php
require 'includes\part\header.php';
require_once('includes/template.php');

$id = isset($_GET['id']) ? (string) $_GET['id'] : -1;

$GameTitle = "";
$Platform  = "";
$image     = "";

$uid = 0;

if ($id !== -1) {
    $file         = file_get_contents("http://localhost/includes/temp/consoles.php?id=" . $id);
    $jsonIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator(json_decode($file, TRUE)), RecursiveIteratorIterator::SELF_FIRST);
    foreach ($jsonIterator as $key => $value) {
        if ($key == "product-name")
            $GameTitle = $value;
        elseif ($key == "console-name")
            $Platform = $value;
        elseif ($key == "image") {
            $image = $value;
        } elseif ($key == "error")
            if ($value == "id") {
                echo ("error");
            }
    }
} else {
    $file         = file_get_contents('includes/temp/consoles.json');
    $jsonIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator(json_decode($file, TRUE)), RecursiveIteratorIterator::SELF_FIRST);
    
    $tempShop      = new Template('includes/temp/SearchItem.tpl');
    $typeTempplate = '<option data-toggle="loadGamesFromJson" frame-target="#Second" group-target="[name]">[name]</option>';
    $tempType      = new Template($typeTempplate);
    
    $groupTemplate       = '
<div class="group" id="[Type]">
    <select class="selectpicker">
        <option data-toggle="setSearch" data-target="#products" data-value="[Type]">All</option>
        [optionGroup]
    </select>
</div>';
    $optionGroupTempalte = '<optgroup label="[companyName]" data-subtext="" data-icon="icon-ok">[items]</optgroup>';
    $optionTemplate      = '<option data-toggle="setSearch" data-target="#products" data-value="[name]">[name]</option>';
}
?>
  <div class="container bg-white main-content">
        <?php
if ($id !== -1):
?>
      <div class="coverArtContainer  col-sm-5 col-md-5">
                <img class="nentendo" src="<?php
    echo $image;
?>"></img>
            
            <div class="nentendo" id="title"><?php
    echo $GameTitle;
?></div>
            <div class="nentendo" id="platform"><?php
    echo $Platform;
?></div>
            
        </div>
        <div class="Pricing col-xs-12 col-md-6">

        </div>
        <?php
else:
?>
      <div class="frame" id="Shop">
            <div class="group current" id="Search">
                <h1 id="tittle">Select Game</h1>
                <div class="row">
                <div class="col-xs-12">
                    <label for="first_sortBY">Search By : </label>
                </div>
                    <div class="col-md-6 col-xs-6 frame">
                        <div class="group current">
                            <select class="selectpicker">
                                <option selected data-toggle="fade setSearch" data-target="#products" data-value="" frame-target="#Second" group-target="">None</option>
                                <optgroup label="Type" data-subtext="" data-icon="icon-ok">
                                    <?php
    $tempSet      = false;
    $values       = array();
    $types        = array();
    $producttitle = "";
    $company      = "Games";
    foreach ($jsonIterator as $key => $val) {
        if (!is_array($val)) {
            if ($key == "name") {
                $tempType->setTag($key, $val);
                $tempSet = true;
            }
        } elseif ($tempSet) {
            echo $tempType->output();
            $tempType = new Template($typeTempplate);
            $tempSet  = false;
        }
        
    }
    if ($tempSet)
        echo $tempType->output();
?>
                              </optgroup>
                                <optgroup label="Attributes" data-subtext="" data-icon="icon-ok">
                                    <option data-toggle="fade" frame-target="#Second" group-target="#Text">Text</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6 frame" id="Second">
                        <?php
    foreach ($values as $type => $TypeArray) {
        $tempGroup = new Template($groupTemplate);
        $tempGroup->setTag("Type", $type);
        $optionGroup = "";
        foreach ($TypeArray as $companyName => $itemsArray) {
            $tempOptionGroup = new Template($optionGroupTempalte);
            $tempOptionGroup->setTag("companyName", $companyName);
            $items = "";
            foreach ($itemsArray as &$name) {
                $tempOption = new Template($optionTemplate);
                $tempOption->setTag("name", $name);
                
                $items .= $tempOption->output();
            }
            $tempOptionGroup->setTag("items", $items);
            $optionGroup .= $tempOptionGroup->output();
        }
        
        $tempGroup->setTag("optionGroup", $optionGroup);
        echo $tempGroup->output();
    }
?>
                      <div id="Text">
                                <div class="bs-float-label">
                                    <label for="search" class="float-label">Search Name</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-search" id="search button"></i></span>
                                        <input type="text" class="form-control float-input" name="SearchName" id="SearchName" placeholder="Search Name" autocomplete="off">
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <ul class="pagination">

                </ul>
                <div class="gamesList" id="products" class="row list-group">

                </div>
                <ul class="pagination">

                </ul>
            </div>
        </div>
        <?php
endif;
?>
  </div>
    
<?php
require 'includes\part\footer.php';
?>