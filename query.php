<!Doctype html>
<html>
    <head>
        <title>

        </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="style/stylesheet.css"/>
    </head>
<body>

<?php
require './templates/menu.php';
?>
<script src='scripts/index.js'></script>
<?php

//get the query that the user provided

$qry = $_GET['query'];
$qry = strtolower($qry);
//declare gamemaster
class gamemaster extends SQLite3
{
    public function __construct()
    {
        $this->open('database/gamemaster.db3');
    }
}
//declare textmaster
class textmaster extends SQLite3
{
    public function __construct()
    {
        $this->open('database/textmaster.db3');
    }
}

//
$db_t = new textmaster();
if (!$db_t) {
    echo $db_t->lastErrorMsg();
}

//
$db = new gamemaster();
if (!$db) {
    echo $db->lastErrorMsg();
}

//prepare query for extractiing id from MTextMasters
//from the textmaster database
$q1 = <<<EOF
      SELECT * from MTextMasters where LOWER(data) like '_$qry%' or LOWER(data) like '$qry%';
EOF;

//fetch id
$run_q1 = $db_t->query($q1);
$qry_details = array();
while ($row = $run_q1->fetchArray(SQLITE3_ASSOC)) {
    array_push($qry_details, $row);
}

//sort of broken behavior, NTS: fix if i feel like it later.
echo $skill_id = $qry_details[0]['id'];
//some variables
$name = $qry_details[0]['data'];
$tmpid = $qry_details[0]['id'] + 1;
//run same query on +1 id
$tempQry = <<<EOF
    SELECT * from MTextMasters where id = '$tmpid';
EOF;

$run_tempQry = $db_t->query($tempQry);
$type_details = array();
while ($row = $run_tempQry->fetchArray(SQLITE3_ASSOC)) {
    array_push($type_details, $row);
}

//more variables
$equipment_type = $type_details[0]['data'];
$equipment_type_dep = substr($equipment_type, 0, strpos($equipment_type, ":"));
$equipment_type_final = substr($equipment_type, 0, strpos($equipment_type, "-"));
$skill_type = substr($equipment_type_dep, strpos($equipment_type_dep, "-"), strlen($equipment_type_dep));
$skill_type = trim($skill_type, '-');
echo $skill_type;
//stores all the details for the queried skill record.
$card_detail = array();

//query to get the card data from MCardMasters
//database is gamemaster
$q2 = <<<EOF
    SELECT * from MCardMasters where text_name_id = '$skill_id';
EOF;
//run query
$run_q2 = $db->query($q2);
while ($row = $run_q2->fetchArray(SQLITE3_ASSOC)) {
    array_push($card_detail, $row);
}

//import card template
require './templates/card.php';

$cost = $card_detail[0]['cost'];

$imgPath = $card_detail[0]['image_path'];
$imgPath = trim($imgPath, 'sr_');
$imgPath[1] = '1';
$imgPath = 'https://raw.githubusercontent.com/Nayuta-Kani/SAOIF-Skill-Records-Database/master/srimages/sr_icon_l_' . $imgPath . '.png';
//test
echo "<br> card master id : " . $card_detail[0]['card_masterid'];
echo $imgPath;

echo "<br> Evolution card master id : " . $card_detail[0]['evolution_card_masterid'];
echo "<br> Text Comment id : " . $card_detail[0]['text_comment_id'];
echo "<br> Convert master id : " . $card_detail[0]['convert_item_masterid'];
//get skill data
$skill_master_id = $card_detail[0]['skill_masterid'];
echo "skill id: " . $skill_master_id;
$skill_data = array();
$skillMasterQry = <<<EOF
    SELECT * from MSkillMasters where skill_masterid = '$skill_master_id';
EOF;
$run_skillMasterQry = $db->query($skillMasterQry);
while ($row = $run_skillMasterQry->fetchArray(SQLITE3_ASSOC)) {
    array_push($skill_data, $row);
}
if ($skill_data[0]['lAtkRate'] == 0) {
    $skill_damage = $skill_data[0]['bAtkRate'] / 1;
} else {
    $skill_damage = $skill_data[0]['bAtkRate'] / $skill_data[0]['lAtkRate'];
}
$getbuffdata = <<<EOF
    SELECT * from MSkillBuffMasters where skill_masterid='$skill_master_id';
EOF;
$run_getbuffdata = $db->query($getbuffdata);
$buff_data = array();
while ($row = $run_getbuffdata->fetchArray(SQLITE3_ASSOC)) {
    array_push($buff_data, $row);
}
if (!empty($buff_data)) {

    $buff_masterid = $buff_data[0]['buff_masterid'];

    $getbuffdata2 = <<<EOF
    SELECT * from MBuffPowerUpMasters where buff_masterid='$buff_masterid';
EOF;
    $run_getbuffdata2 = $db->query($getbuffdata2);
    $buff_data2 = array();
    while ($row = $run_getbuffdata2->fetchArray(SQLITE3_ASSOC)) {
        array_push($buff_data2, $row);
    }

    $buff_time = $buff_data[0]['buff_time'];
    //end of if clause
}
//even more variables

//switch case for element image
$ele_img_path = '';
$element = $skill_data[0]['element'];
switch ($element) {
    case 0:$ele_img_path = 'none';
        break;
    case 1:$ele_img_path = 'fire';
        break;
    case 2:$ele_img_path = 'water';
        break;
    case 3:
        break;
    case 4:$ele_img_path = 'earth';
        break;
    case 5:
        break;
    case 6:$ele_img_path = 'dark';
        break;
    default:
        $ele_img_path = 'Error!';
}
$equipment_img = 'res/' . $equipment_type_final . '.png';
$equipment_img = str_replace(' ', '', $equipment_img);
$sp_cost = $skill_data[0]['sp'];
$ele_img_path_final = 'res/' . $ele_img_path . '.png';
$skill_text_id = $skill_data[0]['text_name_id'];
$skill_comment_id = $skill_data[0]['text_comment_id'];
echo "<br>" . $skill_comment_id . "<br>";
//get text and comment
$getTextComment = <<<EOF
    SELECT data from MTextMasters where id = '$skill_text_id' OR id = '$skill_comment_id';
EOF;
$run_getTextComment = $db_t->query($getTextComment);
$text_comment = array();
while ($row = $run_getTextComment->fetchArray(SQLITE3_ASSOC)) {
    array_push($text_comment, $row);
}
$skill_text = $text_comment[0]['data'];
$skill_comment = $text_comment[1]['data'];
//load image from record.html
//into the image div
$strippedQry = str_replace(' ', '', $qry);
echo "
<script>
    $('.image').append('<img src=$imgPath>');
    $('.name').text('$name');
    $('.starRat').load('record.html ." . $strippedQry . " .rarity');
    $('.type').text('$skill_type');
    $('.cost').append('       $cost');
    $('.skillname').text('$skill_text');
    $('.skillcomment').text('$skill_comment');
    $('.skillcomment').text(function () {
        return $(this).text().replace('%SkillDamage%', '$skill_damage%');
    })
    $('.skillcomment').text(function () {
        return $(this).text().replace('[Bonus]', '/n[Bonus]');
    })
    $('.skillcomment').text(function () {
        return $(this).text().replace('%BuffTime%', '$buff_time');
    })
    $('.skillcomment').html(function () {
        return $(this).html().replace('/n', '<br />');
    })

    $('.contenttext').text('$equipment_type_final');
    $('.name').append('<img src=$equipment_img>');
    $('.sp').append('$sp_cost');
    $('.element').append('<img src=$ele_img_path_final>');
</script>"
?>
<script>
    $(document).ready(function(){
    $('.rarity').append('<i class="fa fa-star"></i>');
});
</script>
</body>
</html>