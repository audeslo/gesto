/*var client_type=document.getElementById('client_type');
//var enseigner_filiere=document.getElementById('enseigner_filiere');


if (!(client_type !== null)) {
} else {
    $(document).on('change','#client_type',function(){
        let $field=$(this)
        let $form=$field.closest('form')
        let data={}
        data[$field.attr('name')]=$field.val()
        $.post($form.attr('action'),data).then(function(data) {


            if (client_type.val() === 'Personne Physique') {
                $('#dynamic').document.getElementById('client_nom').show()//or remove disabled/hidden
            } else {//some_other_specific_value
                $('#dynamic').document.getElementById('client_raisonsociale').show()//or remove disabled/hidden
            }

            //let  $input = $(data).find('#apprenant_classe')
            //language=JQuery-CSS
            //$('#apprenant_classe').replaceWith($input)

        })
    })
}*/


/*

$(document).ready(function () {
    var $type = $('#client_type');

    $type.change(function () {
        if ($type.val() === 'Personne Physique') {
            $('#dynamic').find('client_nom').show()//or remove disabled/hidden
        } else {//some_other_specific_value
            $('#dynamic').find('client_raisonsociale').show()//or remove disabled/hidden
        }
    });
});
*/
