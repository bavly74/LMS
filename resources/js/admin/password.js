import $ from 'jquery'

$('.password-toggle').on('click',function (){
    let passwordField = $('.password') ;
    if ( passwordField.attr('type') == 'password' ){
        passwordField.attr('type','text')
    }else{
        passwordField.attr('type','password')
    }
});
