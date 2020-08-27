
<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">

    </ol>
    <div class="carousel-inner">
      
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
@push('index')
<script>
    var banner = banner || {};
        banner.getSlideBanner = function(){
            $.ajax({
                type: "GET",
                url: "{{ route('banners.slide') }}",
                dataType: "json",
                success: function (data) {
                    $('.carousel-indicators').empty();
                    $('.carousel-inner').empty();
                    $('.carousel-indicators').append(`
                    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                    `);
                    $('.carousel-inner').append(`
                        <div class="carousel-item active" data-interval="3000">
                            <img src="{{ asset('uploads/images/banners/${data[0].imageAddress}') }}" class="d-block w-100" alt="${data[0].title}">
                        </div>
                    `);
                    for(let k = 1; k < data.length;k++ ){
                        $('.carousel-indicators').append(`
                            <li data-target="#carouselExampleCaptions" data-slide-to="${k}"></li>
                        `);
                        $('.carousel-inner').append(`
                         <div class="carousel-item" data-interval="3000">
                            <img src="{{ asset('uploads/images/banners/${data[k].imageAddress}') }}" class="d-block w-100" alt="${data[k].title}">
                        </div>
                         `);
                    }
                    
                }
            });
        }
        $(document).ready(function () {
            banner.getSlideBanner();
        });
</script>
@endpush