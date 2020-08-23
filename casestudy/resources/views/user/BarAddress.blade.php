<div class="text-center bg-warning p-2 rounded">
    <h5>Theo khu vực</h5>
</div>
<div class="card">
    <ul class="list-group list-group-flush text-center" id="barAddress">
    </ul>
</div>
@push('index')
    <script>
        var address = address || {};
        address.bar = function(){
            $.ajax({
                type: "GET",
                url: "{{ route('get.address') }}",
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
    </script>
@endpush