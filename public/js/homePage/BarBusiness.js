var business = business || {};
business.bar = function () {
    $.ajax({
        type: "GET",
        url: "/api/get-business",
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
