var business = business || {};
business.bar = function () {
    $.ajax({
        type: "GET",
        url: "http://127.0.0.1:8000/api/get-business",
        dataType: "json",
        success: function (data) {
            $('#barBusiness').empty();
            $.each(data, function (i, value) {
                $('#barBusiness').append(`
                    <a href="/business/${value.id}"><li class="list-group-item">${value.typeName}</li></a>
                 `);
            });
        }
    });
}
$(document).ready(function () {
    business.bar();
});
