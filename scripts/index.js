//script for hiding/displaying navbar

$(document).ready(function() {
    //make icons circular
    $('.ham').hover(function() {
        $('.hiddenMenu').removeClass('hidden');
    }, function() {
        $('.hiddenMenu').addClass('hidden');
    })
})

$(".clickthis").on('click', function() {
    console.log('Exec');
    $.ajax({
        url: 'skillRecords',
        dataType: 'json',
        success: function(data) {
            console.log('success');
            data.generateTwenty(20, $qry_details, $db_t, $db);
        }
    });
});