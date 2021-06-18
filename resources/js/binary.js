$('.binary-button').on('click', function(){
    var position = $(this).attr('position');
    var referrer = $(this).attr('referrer');
    $('.binary-referrer-id').attr('value', referrer);
    $('.binary-position').attr('value', position);
    console.log(position, referrer);
});

$('.view-user-button').on('click', function(){
    var fname = $(this).attr('fname');
    var lname = $(this).attr('lname');
    var uname = $(this).attr('uname');
    var gender = $(this).attr('gender');
    var email = $(this).attr('email');
    var phone = $(this).attr('phone');
    var datejoined = $(this).attr('datejoined');
    var imgpath = $(this).attr('imgpath');

    $('.name').html(fname+' '+lname);
    $('.uname').html(uname);
    $('.gender').html(gender);
    $('.email').html(email);
    $('.phone').html(phone);
    $('.datejoined').html('Date Joined: '+datejoined);
    $('.imgpath').html('<img class="rounded-circle img-fluid" src="'+imgpath+'" />');
});