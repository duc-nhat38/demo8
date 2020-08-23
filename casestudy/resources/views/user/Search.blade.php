<div class="search bg-dark p-2 mb-3">
    <form action="{{ route('search') }}" method="GET" class="d-flex w-100">
        <select class="custom-select col js-example-placeholder-single" name="selectBusiness" id="selectBusiness">
        </select>
        <select class="custom-select col js-example-placeholder-single" name="selectAddress" id="selectAddress"
            onchange="address.select(this)">
        </select>
        <select class="custom-select col" name="selectDistrict" id="selectDistrict">
            <option selected disabled>Quận / Huyện</option>
        </select>
        <select class="custom-select col" name="selectArea" id="selectArea">
            <option selected disabled>Diện tích</option>
            <option value="1">Dưới 20 m2</option>
            <option value="2">20 m2 - 30 m2</option>
            <option value="3">30 m2 - 40 m2</option>
            <option value="4">40 m2 - 50 m2</option>
            <option value="5">50 m2 - 100 m2</option>
            <option value="6">Lớn hơn 100 m2</option>
        </select>
        <button type="submit" class="btn btn-warning" onclick="return business.validate()"><i
                class="fas fa-search"></i></button>
    </form>
</div>

@push('search')

<script>
    var business = business || {};
    business.validate = function(){
        if(  $('#selectBusiness').val()==null || $('#selectAddress').val()==null){
            toastr.options = {
                     "positionClass": "toast-top-center",
                }
            if($('#selectBusiness').val()==null) {
                
                toastr["warning"]("Vui lòng chọn thể loại!")
            }else{
                if($('#selectAddress').val()==null){
                
                toastr["warning"]("Vui lòng chọn địa điểm!")
            }
            }
            
            return false;
        }
    }
    business.searchBusiness = function(){
        $.ajax({
            type: "GET",
            url: "{{ route('get.business') }}",
            dataType: "json",
            success: function (data) {
                $('#selectBusiness').empty();
                $('#selectBusiness').append(`
                    <option selected disabled>Thể loại</option>
                `);
                $.each(data, function (i, value) { 
                    $('#selectBusiness').append(`
                        <option value="${value.id}">${value.typeName}</option>
                    `);
                    
                });
             
            }
        });
    }

    // 
    var address = address || {};
    address.searchAddress = function(){
        $.ajax({
            type: "GET",
            url: "{{ route('get.address') }}",
            dataType: "json",
            success: function (data) {
                $('#selectAddress').empty();
                $('#selectAddress').append(`
                <option selected disabled>Tỉnh / Thành</option>
                `);
                $.each(data, function (i, value) { 
                    $('#selectAddress').append(`
                        <option value="${value.id}">${value.address}</option>
                `);
                
                });
                
            }
        });
    }

    address.select = function(data){
        let id = data.value;
        $.ajax({
            type: "GET",
            url: "{{ route('address.detail') }}",
            data: {
                id: id,
            },
            dataType: "json",
            success: function (data) {
                $('#selectDistrict').empty();
                $('#selectDistrict').append(`
                    <option selected disabled >Quận / Huyện</option>
                `);
                $.each(data.address_details, function (i, value) { 
                    $('#selectDistrict').append(`
                        <option value="${value.id}"> ${value.district}</option>
                    `);
                });
            }
        });

    }

    $(document).ready(function () {
        business.searchBusiness();
        address.searchAddress();
        $('#selectArea').select2();
        $('#selectBusiness').select2();
        $('#selectAddress').select2();
        $('#selectDistrict').select2();
        
    });
</script>
@endpush