<!DOCTYPE html>
<html>
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script>
        //toggle the filter menus
        $(document).ready(function(){
        $('.drop').click(function(){
            $(this).siblings().toggle();
        })
});
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/stylesheet.css"/>
        <title>Skill Records</title>
    </head>
    <body>

        <?php
require './templates/menu.php';
require './templates/filter.php';
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
$q1 = <<<EOF
      SELECT * from MCardMasters where card_masterid like '6000%' and card_masterid > 6000000;
EOF;
$run_q1 = $db->query($q1);
$qry_details = array();
while ($row = $run_q1->fetchArray(SQLITE3_ASSOC)) {
    array_push($qry_details, $row);
}
function generateTwenty($start_at, $qry_details, $db_t, $db)
{
    $org_start = $start_at;
    $cond = $start_at + 20;
    for ($start_at; $start_at < $cond; $start_at++) {
        $text_name_id = $qry_details[$start_at]['text_name_id']; //done
        $rarity = $qry_details[$start_at]['rarity']; //done
        $maxRarity = $qry_details[$start_at]['max_rarity']; //done
        $text_comment_id = $qry_details[$start_at]['text_comment_id'];
        $cost = $qry_details[$start_at]['cost'];
        $imgPath = $qry_details[$start_at]['image_path'];
        $imgPath = trim($imgPath, 'sr_');
        $imgPath[1] = '1';
        $imgPath = 'https://raw.githubusercontent.com/Nayuta-Kani/SAOIF-Skill-Records-Database/master/srimages/sr_icon_l_' . $imgPath . '.png';
        $qry_for_text = <<<EOF
                SELECT data from MTextMasters where id = '$text_name_id' or id = '$text_comment_id';
EOF;
        $run_qry_for_text = $db_t->query($qry_for_text);
        $qry_details_2 = array();
        while ($row = $run_qry_for_text->fetchArray(SQLITE3_ASSOC)) {
            array_push($qry_details_2, $row);
        }
        $nameRecord = $qry_details_2[0]['data'];
        $nameRecord = str_replace("'", "", $nameRecord);
        $commentRecord = $qry_details_2[1]['data'];
        $star_class = '"fa fa-star"';
        require './templates/smolcard.php';
        echo "
                <script>
                $('.s_name').last().text('$nameRecord');
                switch($maxRarity){
                    case 1:
                    $('.s_rarity').last().append(':star:');
                    $('.containersmol').last().addClass('one');
                    break;
                    case 2:
                    $('.s_rarity').last().append('<i class=$star_class></i><i class=$star_class></i>');
                    $('.containersmol').last().addClass('one');
                    break;
                    case 3:
                    $('.s_rarity').last().append('<i class=$star_class></i><i class=$star_class></i><i class=$star_class></i>');
                    $('.containersmol').last().addClass('two');
                    break;
                    case 4:
                    $('.s_rarity').last().append('<i class=$star_class></i><i class=$star_class></i><i class=$star_class></i><i class=$star_class></i>');
                    $('.containersmol').last().addClass('three');
                    break;
                    case 5:
                    $('.s_rarity').last().append('<i class=$star_class></i><i class=$star_class></i><i class=$star_class></i><i class=$star_class></i><i class=$star_class></i>');
                    $('.containersmol').last().addClass('four');
                    break;
                    default:
                    $('.s_rarity').last().append('<i class=$star_class></i>');
                }
                $('.smolimage').last().append('<img src=$imgPath></img>');
                $('.s_name').last().text('$commentRecord');
                $('.s_name').last().text(function () {
                    return $(this).text().replace('-', '/n');
                })
                $('.s_name').last().text(function () {
                    return $(this).text().replace(':', '/n');
                })
                $('.s_name').last().html(function () {
                    return $(this).html().replace('/n', '<br />');
                })
                $('.s_name').last().html(function () {
                    return $(this).html().replace('/n', '<br />');
                })
                </script>
                ";
    }
    $total = sizeof($qry_details);
    require_once './templates/nav.php';
}
generateTwenty($_GET['page'] * 20, $qry_details, $db_t, $db);
$thisPageId = $_GET['page'];
$nextPage = $thisPageId + 1;
$prevPage = $thisPageId - 1;
if ($prevPage < 0) {
    $prevPage = 0;
}
if ($nextPage > 18) {
    $nextPage = 18;
}
if ($nextPage >= 7 && $nextPage < 13) {
    echo "
        <script>
        $('.pagination2').css({'display':'inline-block'});
        $('.pagination').css({'display':'none'});
        $('.pagination3').css({'display':'none'});
        $('.previous').attr('href','skillRecords.php?page=$prevPage');
        $('.imNext').attr('href','skillRecords.php?page=$nextPage');
        $('.$nextPage').addClass('active');

        </script>
        ";
} else {
    if ($nextPage >= 13) {
        echo "
                <script>
                $('.pagination3').css({'display':'inline-block'});
                $('.pagination').css({'display':'none'});
                $('.pagination2').css({'display':'none'});
                $('.previous').attr('href','skillRecords.php?page=$prevPage');
                $('.imNext').attr('href','skillRecords.php?page=$nextPage');
                $('.$nextPage').addClass('active');
                </script>
                ";
    } else {
        echo "
        <script>
        $('.previous').attr('href','skillRecords.php?page=$prevPage');
        $('.imNext').attr('href','skillRecords.php?page=$nextPage');
        $('.$nextPage').addClass('active');
        </script>
        ";
    }
}
?>
            <script type='text/javascript' src='scripts/index.js'></script>
    </body>