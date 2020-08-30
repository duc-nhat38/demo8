var banner = banner || {};
banner.getSlideBanner = function () {
    $.ajax({
        type: "GET",
        url: "https://timnha.herokuapp.com/api/get-banners-slide",
        dataType: "json",
        success: function (data) {
            $('.carousel-indicators').empty();
            $('.carousel-inner').empty();
            $('.carousel-indicators').append(`
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            `);
            $('.carousel-inner').append(`
                <div class="carousel-item active" data-interval="3000">
                    <img src="https://timnha.herokuapp.com/uploads/images/banners/${data[0].imageAddress}" class="d-block w-100" alt="${data[0].title}">
                </div>
            `);
            for (let k = 1; k < data.length; k++) {
                $('.carousel-indicators').append(`
                    <li data-target="#carouselExampleCaptions" data-slide-to="${k}"></li>
                `);
                $('.carousel-inner').append(`
                 <div class="carousel-item" data-interval="3000">
                    <img src="https://timnha.herokuapp.com/uploads/images/banners/${data[k].imageAddress}" class="d-block w-100" alt="${data[k].title}">
                </div>
                 `);
            }

        }
    });
}
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    banner.getSlideBanner();
});
