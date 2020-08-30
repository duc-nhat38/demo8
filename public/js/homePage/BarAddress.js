var address = address || {};
address.bar = function(){
    $.ajax({
        type: "GET",
        url: "http://127.0.0.1:8000/api/get-address",
        dataType: "json",
        success: function (data) {
            $('#barAddress').empty();
            $.each(data, function (i, value) { 
                 $('#barAddress').append(`
                 <a href="/address-house/${value.id}"><li class="list-group-item">${value.address}</li></a>
                 `);
            });
        }
    });
}

$(document).ready(function () {
    address.bar();
});