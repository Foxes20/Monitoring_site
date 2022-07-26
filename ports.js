//
$('.25565').on('click', function() {
    $('.inpPort').val('25565');
});
$('.27015').on('click', function() {
    $('.inpPort').val('27015');
});
$('.8621').on('click', function() {
    $('.inpPort').val('8621');
});
$('.80').on('click', function() {
    $('.inpPort').val('80');
});
$('.7777').on('click', function() {
    $('.inpPort').val('7777');
});
$('.27016').on('click', function() {
    $('.inpPort').val('27016');
});
$('.8080').on('click', function() {
    $('.inpPort').val('8080');
});



// function checkPortTab(){
//     let port = $('#checkPort');


// }




























// function checkPortTab(){



//     var exp = /(^[0-9]{1,50000})/i;
//     ipv4 = $.trim(ipv4);
//     ipv4 = ipv4.search(exp);

//     if(ipv4 == -1){
//         $('#inpPort') .val('Введите корректный порт'+result.port);
//         return false;
//     }
//     return true;
// };

function checkPortTab(){

    let ipv4 = $('.inpPort').val();
        console.log( ipv4);
    // ipv4 = $.trim(ipv4);
    //     console.log(typeof(ipv4));
    const exp = (/[0-9]{2,10000}/g);

    ipv4 =  Number(ipv4.search(exp));

    if(ipv4 == -1){
console.log('~~~~~~~~~');

        $('#outputPort').html('Введите корректный порт');
        return false;

    }else{
   return true;

    }

};

