<div class="search">
    <nav class="navbar navbar-dark bg-dark row" id="search">
        <select class="custom-select col">
            <option selected>Thể loại</option>
            @if (!empty($businessType))
            @foreach ($businessType as $item)

            <option value="{{ $item['id'] }}">{{ $item['typeName'] }}</option>

            @endforeach
            @endif
        </select>
        <select class="custom-select col" id="address">
            <option selected>Tỉnh / Thành</option>
            {{-- @if (!empty($listAddress))
                onchange="selectAddress()"
            @foreach ($listAddress as $item)
            <option value="{{ $item['id'] }}" >{{ $item['address'] }}</option>
            @endforeach
            @endif --}}
        </select>
        <select class="custom-select col" id="district" onchange="selectDistrict()">
            <option selected>Quận / Huyện</option>
            @if (!empty($listAddressDetails))
            @foreach ($listAddressDetails as $item)
            <option value="{{ $item['id'] }}">{{ $item['address'] }}</option>
            @endforeach
            @endif
        </select>
        <select class="custom-select col">
            <option selected>Diện tích</option>
            <option value="1">Dưới 20 m2</option>
            <option value="2">20 m2 - 30 m2</option>
            <option value="3">30 m2 - 40 m2</option>
            <option value="4">40 m2 - 50 m2</option>
            <option value="5">50 m2 - 100 m2</option>
            <option value="6">Lớn hơn 100 m2</option>
        </select>
        <button class="btn btn-warning"><i class="fas fa-search"></i></button>
    </nav>
</div>

@push('header')
<script>
    // function selectAddress(){
        //     let id = $('#address').val();

        // //     return id;
        // //     // $.ajax({
        // //     //     dataType: "json",
        // //     //     url: "http://127.0.0.1:8000/api/getaddressdetails/" + id,
        // //     //     success: function (data){
        // //     //         $('#district').empty();
        // //     //         $.each(data, function (i, item) {
        // //     //             $('#district').append($('<option>', { 
        // //     //                 value: item.id,
        // //     //                 text : item.address 
        // //     //             }));
        // //     //         });
        // //     //     }
        // //     // });
        // return id;
        // }
        
        function getAddress(){
            $.ajax({
                dataType: "json",
                url: "http://127.0.0.1:8000/api/listadress",
                success: function (data){
                    // console.log(data);
                    $.each(data, function (i, item) {
                        $('#address').append($('<option>', { 
                            value: item.id,
                            text : item.address 
                        }));
                    });

                return data;
                }
            });
        
        }
        
        
        function getAddressDetails(){
            $.ajax({
                dataType: "json",
                url: "http://127.0.0.1:8000/api/listaddressdetails",
                success: function (data){
                    // console.log(data);
                    $.each(data, function (i, item) {
                        $('#district').append($('<option>', { 
                            value: item.id,
                            text : item.address 
                        }));
                    });

                }
            });
        }

    $(document).ready(function() {
        getAddress();
        getAddressDetails();
       
    });




</script>
@endpush

