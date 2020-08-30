var user = user || {};

user.getUsers = function () {
    
    $.ajax({
        method: "GET",
        dataType: "json",
        url: 'https://timnha.herokuapp.com/api/get-users',
        success: function (data) {
            if ($.fn.DataTable.isDataTable('#tableUser')) {
                $('#tableUser').DataTable().destroy();
            }

            $('#tableUser tbody').empty();
            $.each(data, function (i, item) {

                let power = (item.role != 0) ? 'text-success' : 'text-dark';
                let titleCheck = (item.role != 0) ? 'Đã xác thực' : 'Chưa xác thực';
                let lock = (item.locked != 0) ? '<i class="fas fa-lg fa-lock"></i>' : '<i class="fas fa-lg fa-lock-open"></i>';
                let titleLock = (item.locked != 0) ? 'Mở khóa tài khoản' : 'Khóa tài khoản';
                $('#tableUser tbody').append(`                       
            <tr>
                <td scope="row">${i+1}</td>
                <td><img src="https://timnha.herokuapp.com/uploads/images/users/user-${item.id}/${item.avatar}"></td>
                <td>${item.name}</td>                            
                <td>${item.email}</td>                            
                <td>
                    <a href="javascript:;" title="${titleCheck}" class ="text-decoration-none" onclick="user.power(${item.id}, ${item.role})"><i class="fas fa-user-check ${power} fa-lg"></i></a>
                </td>
                <td>
                    <a href="javascript:;" title='Xem chi tiết'  onclick="user.showInfoUser(${item.id})"><i class="fas fa-eye text-danger fa-lg"></i></a>
                    <a href="javascript:;"  title="${titleLock}" class="ml-3" onclick="user.lockUser(${item.id}, ${item.locked})">${lock}</a>
                    
                </td>
            </tr>                                            
            `);

            });

            $('#tableUser').DataTable();

        }
    });
}

user.lockUser = function (userId, locked) {

    $.ajax({
        method: "PATCH",
        dataType: "json",
        url: 'https://timnha.herokuapp.com/api/lock-user',
        data: {
            id: userId,
            locked: locked,
        },
        success: function (data) {
            user.getUsers();
            toastr["success"]("Thay đổi thành công !");
        }
    });
}

user.power = function (userId, role) {
    $.ajax({
        method: "PATCH",
        dataType: "json",
        url: 'https://timnha.herokuapp.com/api/power-user',
        data: {
            id: userId,
            role: role,
        },
        success: function (data) {
            user.getUsers();
            toastr["success"]("Thay đổi thành công !");
        }
    });
}

user.showInfoUser = function (userId) {
    $.ajax({
        method: "GET",
        dataType: "json",
        url: 'https://timnha.herokuapp.com/api/show-user',
        data: {
            id: userId,
        },
        success: function (data) {
            let power = (data.role == 1) ? 'text-success' : 'text-dark';
            $('.body-show').empty();
            $('.body-show').append(`
        <div class="card position-relative m-auto border-0" style="width: 29rem;">
            <img class="card-img-top m-auto" src="https://timnha.herokuapp.com/uploads/images/users/user-${data.id}/${data.avatar}" alt="Ảnh đại diện">
        
        <div class="card-body">
            <h5 class="card-title">Tên : ${(data.fullName != null)? data.fullName : 'Chưa có'}</h5>
            <p class="card-text">Tên đăng nhập : ${data.name}</p>
            <p class="card-text">Email : ${data.email}</p>
            <p class="card-text">Số điện thoại : ${(data.phone != null)?data.phone:'Chưa có'}</p>
            <p class="card-text">Địa chỉ : ${(data.address != null)?data.address:'Chưa có'}</p>
            <p class="card-text">Tài khoản : <i class="fas fa-user-check ${power} fa-lg"></i>
        </div>                                              
        </div>    
        `);
            $('#showInfoUser').modal('show');
        }
    });
}

$(document).ready(function () {
    
    user.getUsers();
    $(".myPopover").popover();
});
