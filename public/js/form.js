$(document).ready(function(){

});

function issueChanged(ref){
    var selected = $(ref).find('option:selected');
    var severity = selected.data('severity');
    var issue_txt = selected.data('txt');
    var issue_desc = selected.data('desc');
    var issue_recomm = selected.data('recomm');
    $('select#severity').val(severity);
    $('input#name').val(issue_txt);
    $('textarea#description').val(issue_desc);
    $('textarea#recommendation').val(issue_recomm);
    return true;
}