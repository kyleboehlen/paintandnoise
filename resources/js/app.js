require('./bootstrap');

$(document).ready(function(){
    // Checkbox span toggle input
    $('.checkbox-span').click(function(){
        $(this).toggleClass('checked');
    });

    // Profile picture toggle input
    $('.account-profile-picture').click(function(){
        $('#profile-picture-input').click();
    });

    // Profile picture submits form
    $('#profile-picture-input').change(function(){
        $('#profile-picture-form').submit();
    });
});