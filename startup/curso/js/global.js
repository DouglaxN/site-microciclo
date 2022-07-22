(function ($) {
    'use strict';
    /*==================================================================
        [ Daterangepicker ]*/
    try {
        $('.js-datepicker').daterangepicker({
            "singleDatePicker": true,
            "showDropdowns": true,
            "autoUpdateInput": false,
            locale: {
                format: 'DD/MM/YYYY'
            },
        });

        var myCalendar = $('.js-datepicker');
        var isClick = 0;

        $(window).on('click', function () {
            isClick = 0;
        });

        $(myCalendar).on('apply.daterangepicker', function (ev, picker) {
            isClick = 0;
            $(this).val(picker.startDate.format('DD/MM/YYYY'));

        });

        $('.js-btn-calendar').on('click', function (e) {
            e.stopPropagation();

            if (isClick === 1) isClick = 0;
            else if (isClick === 0) isClick = 1;

            if (isClick === 1) {
                myCalendar.focus();
            }
        });

        $(myCalendar).on('click', function (e) {
            e.stopPropagation();
            isClick = 1;
        });

        $('.daterangepicker').on('click', function (e) {
            e.stopPropagation();
        });


    } catch (er) { console.log(er); }
    /*[ Select 2 Config ]
        ===========================================================*/

    try {
        var selectSimple = $('.js-select-simple');

        selectSimple.each(function () {
            var that = $(this);
            var selectBox = that.find('select');
            var selectDropdown = that.find('.select-dropdown');
            selectBox.select2({
                dropdownParent: selectDropdown
            });
        });

    } catch (err) {
        console.log(err);
    }


})(jQuery);

const inputEle = document.getElementById('cep_');
inputEle.addEventListener('keyup', function(e){
  var cep = e.target.value;
  var cepReplace = cep.replace(/[^0-9]/g, '');
    if(cepReplace.length == 8){
        //showEndereco(cepReplace);
    }
});

function showEndereco(cep) {   
        
        var ajax = new XMLHttpRequest();

        // Seta tipo de requisição e URL com os parâmetros
        ajax.open("GET", "//viacep.com.br/ws/" + cep + "/json/?callback=?", true);

        // Envia a requisição
        ajax.send();

        // Cria um evento para receber o retorno.
        ajax.onreadystatechange = function () {

            // Caso o state seja 4 e o http.status for 200, é porque a requisiçõe deu certo.
            if (ajax.readyState == 4 && ajax.status == 200) {

                var dados = ajax.responseText;
                if (!("erro" in dados)) {
                   
                    document.getElementById("ruaa").value = dados.logradouro;
                    document.getElementById("bairroo").value = dados.bairro;
                    document.getElementById("cidadee").value = dados.localidade;
                    document.getElementById("estadoo").value = dados.uf;
                } //end if.
                else {
                    //CEP pesquisado não foi encontrado.
                    console.log("CEP não encontrado.");
                }

            } else {
                console.log("erro")
            }
        }

}

function inscrever() {

    var input_nome = document.getElementById("nome");
    var nome = input_nome.value;

    var input_crachae = document.getElementById("cracha");
    var cracha = input_crachae.value;

    var input_cpf = document.getElementById("cpf");
    var cpf = input_cpf.value;

    var input_nascimento = document.getElementById("nascimento");
    var nascimento = input_nascimento.value;

    var input_email = document.getElementById("email");
    var email = input_email.value;

    var input_cel = document.getElementById("cel");
    var cel = input_cel.value;

    var input_senha = document.getElementById("senha");
    var senha = input_senha.value;

    var input_cep = document.getElementById("cep");
    var cep = input_cep.value;

    var input_rua = document.getElementById("rua");
    var rua = input_rua.value;

    var input_bairro = document.getElementById("bairro");
    var bairro = input_bairro.value;
    
    var input_cidade = document.getElementById("cidade");
    var cidade = input_cidade.value;
    
    var input_uf = document.getElementById("uf");
    var uf = input_uf.value;

    var input_formacao  = document.getElementById("formacao");
    var formacao = input_formacao.value;

    var select = document.getElementById("titulo");
    var titulo = select.options[select.selectedIndex].value;

    select = document.getElementById("tipo");
    var tipo = select.options[select.selectedIndex].value;

    var inputcomoSoube = document.getElementById("comoSoube");
    var comoSoube = inputcomoSoube.value;
    

}


  document.addEventListener('keydown', function(event) { 
    if(event.keyCode != 46 && event.keyCode != 8){
    var i = document.getElementById("cpf").value.length;
    if (i === 3 || i === 7)
      document.getElementById("cpf").value = document.getElementById("cpf").value + ".";
    else if (i === 11) 
      document.getElementById("cpf").value = document.getElementById("cpf").value + "-";
    }
  });