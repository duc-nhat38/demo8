@extends('layouts.Admin')

@section('content')
<table class="table  table-hover" id="tableUser">
    <thead class="thead-dark">
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Ảnh</th>
            <th scope="col">Họ & Tên</th>
            <th scope="col">Tên đăng nhập</th>
            <th scope="col">Email</th>
            <th scope="col">Số điện thoại</th>
            <th scope="col">Quyền</th>
            <th scope="col">Action</th>
        </tr>
    </thead>

    <tbody>
    </tbody>
</table>
@endsection

@push('dataTables-js')
<script>
    function getAddress(){
            $.ajax({
                dataType: "json",
                url: "{{ route('get.users') }}",
                success: function (data){
                    
                    $.each(data, function (i, item) {
                        let power = (item.role == 2) ? "VIP": "Thường";

                        $('table tbody').append(`                       
                        <tr>
                            <td scope="row">${i+1}</td>
                            <td><img src="${item.avatar}"></td>
                            <td>${item.fullName}</td>
                            <td>${item.name}</td>                            
                            <td>${item.email}</td>
                            <td>${item.phone}</td>
                            <td>${power}</td>
                            <td>
                                <a href="javascript:;" class="btn btn-link"><i class="far fa-edit"></i></a>
                                <a href="javascript:;" class="btn btn-link"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>                       
                        `);
                    });
                    $('#tableUser').DataTable();
                }
            });
        
        }


        $(document).ready( function () {
            getAddress();
            
            
        } );
</script>
@endpush