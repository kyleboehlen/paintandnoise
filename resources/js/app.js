require('./bootstrap');

$(document).ready(function(){
    // Checkbox span toggle input
    $('.checkbox-span').click(function(){
        $(this).toggleClass('checked');
    });
});