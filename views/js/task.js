$(document).ready(function(){
    $('.ajax-table').dataTable({
        'processing':true,
        'serverSide':true, 
        'iDisplayLength':5,
        'bLengthChange':false,
        'bFilter':false,
        'ajax':{
            'url':mp_ajax + '?action=ptable'
        },
        "columns":[
            {"data" : "id_product"},
            {"data" : "name"},
            {"data" : "price"}
        ]
    });

});