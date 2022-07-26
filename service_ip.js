//******************************IP
$(document).ready(function() {
    //кнопка мой ip,выводит текущий ip
    $('#my_ip').on('click', function () {
        var eee = $('#address').html();
        $('#input_ip').val(eee);
    })

    $('.enterIP').on('click', function () {
        var ip = $('.enterIP').data('ip');
        $('.inpServer').val(ip);
    })

    $('#verify_ip').on('click', function () {
        var testIp = ($('#input_ip').val());

        $.ajax({
            type: "POST",
            url: '/?url=requests_ip', //'requests_ip.php',
            data: $("#form_ip").serialize(),
            cache: false,
            dataType: "json",
            beforeSend: function () {
                $("#output").html('<img src="./img/load.gif" style="width:80px;">');
            },
            success: function (result) {
                if (result.status == 'ok') {
                    $("#address").html(result.servIP);
                    $("#output").html(result.servIP);
                    $("#country").html(result.country);
                    $("#imag").html(result.flagContr);
                    $("#city").html(result.town);
                    $("#imag").html(result.imag);
                    $("#region").html(result.region);
                    $("#lat").html(result.latitude);
                    $("#lon").html(result.longitude);
                    // 50.7.142.181

                    myMap.setCenter([result.latitude, result.longitude], 10, {
                        checkZoomRange: true
                    });

                } else if (result.status == 'no') {
                    $("#output").html('IP: ' + result.servIP);
                }
            }
        })
    });
// *******************************port

    $('#checkPort').on('click', function (e) {
        e.preventDefault();

        if(checkPortTab()){

            $.ajax({
                type: "POST",
                url: '/?url=requests_port',
                data: $("#PortCeck").serialize(),
                cache: false,
                dataType: "json",

                beforeSend: function () {
                    $("#outputPort").html('<img src="./img/load.gif" style="width:80px;">');
                },

                success: function (result) {
                    if (result.status == 'ok') {
                        $("#outputPort").html('Порт: ' + result.port + 'открыт на сервере: ' + result.server);

                    } else if (result.status == 'no') {
                        $("#outputPort").html('Порт: ' + result.port + ' закрыт на сервере: ' + result.server);
                    }
                }
            })

        }

        return false;

    });


// **************************** проверка первого инпута- выводит заголовки  (код, метод, адресс)  ***************************

    $('#checkMonitoringInp').on('dblclick', function (e) {
        e.preventDefault();
        $('.pin').addClass('d-none');
    })
    $('#checkMonitoringInp').on('click', function (e) {
        e.preventDefault();
        var inpMon = $('#checkMonitoring').val();

        if(inpMon.length > 3){
            $('.pin').removeClass('d-none');
            $URL = $('#checkMonitoring').val();

        $.ajax({
            type: "POST",
            url: '/?url=requests_monitoring',
            data: $("#form_monitoring").serialize(),
            cache: false,
            dataType: "json",
            beforeSend: function () {
                $("#resultMonitoring").html('<img src="./img/load.gif" style="width:80px;">');
            },

            success: function (result) {
                if (result.status == 'ok') {
                    $("#resultMonitoring").html('Сайт: ' + result.siteName + ' работает');
                    $("#answer").html("<br>" + result.answer);

                } else if (result.status == 'no') {
                    $("#resultMonitoring").html('Сайт: ' + result.resPin + ' не работает');
                }
            }
        })

        }else{
            $("#resultMonitoring").html('Введите адрес сайта');
         }
    });

// *********************постановка на мониторинг*******************************

    $('#mail').on('click', function () {
        if ($(this).is(':checked')) {
            $('.hiddenDivMail').removeClass('d-none');
        } else {
            $('.hiddenDivMail').addClass('d-none');
        }
    });

    $('#telega').on('click', function () {
        if ($(this).is(':checked')) {
            $('.hiddenDivTelega').removeClass('d-none');
        } else {
            $('.hiddenDivTelega').addClass('d-none');
        }
    });

    $('#checkPingBtn').on('click', function(e){
        e.preventDefault();

         $("#outputResPing").html('');

        if( !(validateIp() &&
            validateProtocol()&&
            validateTime()&&
            validateTelegaCheckPatern()&&
            validateMailCheckPatern()&&
            validateMailCheckBox()) ){
        }else{
// ********************************
            $.ajax({
                type: "POST",
                url: '/?url=requests_monitoring',
               
                data: $("#form_ping").serialize(),
                // cache: true,
                dataType: "json",

                beforeSend: function(){//анимация загрузки
                    $("#outputResPing").append('<img src="./img/load.gif" style="width:80px;">');
                },

                success: function(result) {
                    if(result.status == 'ok') {
                        $("#outputResPing").html('данные отправлены').css('color','green');
                    } else {
                        $("#outputResPing").html('данные не отправлены');
                    }
                }
            })
        }
    });

});//ready

// function isEmpty(str) {
//             if (str.trim() == '') {
//                 return true;
//           }
//                 return false;
//         };

function validateIp(){

    let resultIpInputPat = $('#checkPing').val().match(/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/g);

    if (!resultIpInputPat) {
        $('#outputResPing').html('Введите корректный адрес ip <br>').css('color','red');
        return false;
    }
        return true;
};

function validateProtocol(){
    let valProt = $('#protocol').val();
    if (!valProt) {
        $('#outputResPing').html('Введите корректный протокол <br>').css('color','red');
        return false;
    }
        return true;
};


function validateTime(){
    let valTime = $('#time_request').val();

    if (!valTime) {
        $('#outputResPing').html('Выберите интервал проверки <br>').css('color','red');
        return false;
    }
        return true;
};


function validateMailCheckBox(){// mail and telega
    if (!($('#mail').is(':checked')) && (!($('#telega').is(':checked')))) {
        $('#outputResPing').html('Выберите способ отправки <br>').css('color','red');
        return false;
    }

        return true;
};


function validateMailCheckPatern(){
    let patternCheckMail = $('#mailIHiddenInp').val().match(/^[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}$/i);

    if ($('#mail').is(':checked') && (patternCheckMail == null) ){

        $('#outputResPing').html('Введите корректный mail <br>').css('color','red');
        return false;
    }
        return true;
};


function validateTelegaCheckPatern(){
    let resultBotTelegaKey = $('#telegaIHiddenKey').val().match(/[0-9]{9}:[a-zA-Z0-9_-]{35}/g);
    let resultBotTelegaIp = $('#telegaIHiddenIp').val().match(/[0-9]{8,45}/g);

    if($('#telega').is(':checked') && resultBotTelegaKey == null && resultBotTelegaIp == null){
        $('#outputResPing').html('Введите корректный key и IP <br>').css('color','red');
        return false;
    }
        return true;
};

