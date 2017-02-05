$(document).ready(function(){

    $('#tb_atendimento_atRg').mask('99-999-999-X',{'translation':{
        X: {pattern: /[x0-9]/}
    }});

    var SPMaskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        spOptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };

    $('#tb_atendimento_atTeletone').mask(SPMaskBehavior,spOptions);

    $('#tb_atendimento_atCpf').mask('999.999.999-99')

});
