<div class="text-center bg-warning p-2 rounded">
    <h5>Loại bất động sản</h5>
</div>
<div class="card">
    <ul class="list-group list-group-flush text-center" id="barBusiness">
    </ul>
</div>

@push('index')
    <script>
        var business = business || {};
        business.bar = function(){
            $.ajax({
                type: "GET",
                url: "{{ route('get.business') }}",
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
    </script>
@endpush