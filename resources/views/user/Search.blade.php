<div class="search bg-dark ">
    <form action="{{ route('search') }}" method="GET" class="d-flex justify-content-around w-100 p-2 mb-3">
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
        <button type="submit" class="btn btn-warning ml-1" onclick="return business.validate()"><i
                class="fas fa-search"></i></button>
    </form>
</div>

@push('search')
<script src="{{ asset('js/homePage/Search.js') }}"></script>
@endpush