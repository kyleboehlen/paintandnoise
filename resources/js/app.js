require('./bootstrap');

$(document).ready(function(){
    // Checkbox span toggle input
    $('.checkbox-span').click(function(){
        $(this).toggleClass('checked');
    });

    // Profile picture span toggle input
    $('.account-profile-picture').click(function(){
        $('#profile-picture-form').toggle();
        $('#name-form').toggle();
    });
});