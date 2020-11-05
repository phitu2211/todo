require('./bootstrap');

$(document).ready(function () {
    $('.btn-delete').click(function (e){
        e.currentTarget.setAttribute('disabled','disabled');
        e.currentTarget.innerText = 'Deleting....';
    })
});
