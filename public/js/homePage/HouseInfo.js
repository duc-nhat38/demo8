var house = house || {};
house.user = function () {
    $.ajax({
        type: "GET",
        url: "http://127.0.0.1:8000/api/show-user",
        data: {
            id: $('#userHouse').attr('data-id'),
        },
        dataType: "json",
        success: function (data) {
            let phone = (data.phone != null) ? data.phone : 'Chưa cập nhật';
            let role = (data.role != 0) ? 'text-success' : 'text-dark';
            $('#userHouse').append(`
                    <div class="d-flex row ">
                    <div class="col-2 d-flex align-items-center">
                        <img src="http://127.0.0.1:8000/uploads/images/users/user-${data.id}/${data.avatar}" alt="avatar" class="rounded-circle image-center">
                    </div>
                    <div class="p-2 col-9">
                        <p><a href="/user/${data.id}">${data.name}</a>  <i class="fas fa-check-circle ${role}"></i></p>
                        <div class="d-flex justify-content-between">
                            <span class="border rounded border-warning p-2 text-decoration-none"><a href="mailto:${data.email}"><i class="far fa-envelope"></i> ${data.email}</a></span>
                            <span class="border rounded border-warning p-2 text-decoration-none"><a href="tel:+84${phone}"><i class="fas fa-mobile-alt"></i> ${phone}</a></span>
                        </div>
                    </div>
                </div>
                    `);
        }
    });
}

var comment = comment || {};
comment.getCmtHouse = function () {
    $.ajax({
        type: "GET",
        url: "http://127.0.0.1:8000/api/get-house-comments",
        data: {
            id: $('#commentHouse').attr('data-id'),
        },
        dataType: "json",
        success: function (data) {
            $('#listComment').empty();
            $.each(data, function (i, value) {
                let id = $('#btnComment').data('id');
                let action = '<div></div>';
                if (id == value.user_id) {
                    action = `
                            <div class="d-flex">
                                <a href="javascript:;" onclick="comment.edit(this)" class="mr-2"><i class="far fa-edit text-success"></i></a>
                                <a href="javascript:;" data-id="${value.id}" onclick="comment.delete(this)"><i class="far fa-trash-alt text-danger"></i></a>
                            </div>
                            `
                }

                $('#listComment').append(`
                            <div class="d-flex p-2 my-2 border rounded position-relative">
                                <div class="col-1 p-0 d-flex align-items-center">
                                    <img src="http://127.0.0.1:8000/uploads/images/users/user-${value.user_id}/${value.avatar}" alt="" class="rounded-circle">
                                </div>
                                <div class="col-11 ml-1 pl-4 content-comment" data-id="${value.id}">
                                    <div class="d-flex justify-content-between">
                                        <span><a href="/user/${value.id}">${value.name}</a></span>
                                        ${action}
                                    </div>
                                    <span class="valueContent">${value.content}</span><br>
                                    <small>${value.day_create}</small>
                                </div>

                            </div>
                        `);
            });
        }
    });
}

comment.create = function (data) {
    if ($('#btnComment').data('id') != 0) {
        let content = $('#myComment').val();
        if (content) {
            let id = $(data).data('id');
            $.ajax({
                type: "POST",
                url: "http://127.0.0.1:8000/api/comment-house",
                data: {
                    user_id: id,
                    house_id: $('#commentHouse').attr('data-id'),
                    content: content,
                },
                dataType: "json",
                success: function (response) {
                    $('#myComment').val('');
                    comment.getCmtHouse();
                    toastr["success"]("Đã đăng bình luận!")
                }
            });
        } else {
            toastr["warning"]("Chưa nhập bình luận.");
        }
    } else {
        toastr["warning"]("Chưa đăng nhập .");
    }
}
comment.edit = function (data) {
    let text = $(data).closest('.content-comment').children('.valueContent').text();
    let a = $(data).closest('.content-comment');
    let id = $('#voteHouse').data('id');
    a.empty();
    a.append(`
                <textarea class="form-control" rows="2" id="editComment"
                    placeholder="Thêm bình luận ..."></textarea>
                    <div class="d-flex justify-content-between w-100">
                        <button class="btn btn-secondary" onclick="comment.getCmtHouse()">Đóng</button>
                        <button class="btn btn-warning mt-1" data-id="${id}" onclick="comment.editComment(this)">Bình luận</button>
                    </div>                
           `);
    $('#editComment').val(text);
}

comment.editComment = function (data) {
    let content = $('#editComment').val();
    if (content) {
        $.ajax({
            type: "PUT",
            url: "http://127.0.0.1:8000/api/comment-house-edit",
            data: {
                id: $('.content-comment').data('id'),
                content: content,
            },
            dataType: "json",
            success: function (response) {
                $('#editComment').val('');
                comment.getCmtHouse();
                toastr["success"]("Đã đăng bình luận!")
            }
        });
    } else {
        toastr["warning"]("Chưa nhập bình luận.");
    }
}

comment.delete = function (data) {
    bootbox.confirm({
        size: "small",
        message: "Bạn muốn xóa?",
        callback: function (result) {
            if (result) {
                let id = $(data).data('id');
                $.ajax({
                    type: "DELETE",
                    url: "http://127.0.0.1:8000/api/comment-delete'",
                    data: {
                        id: id,
                    },
                    dataType: "json",
                    success: function (data) {
                        comment.getCmtHouse();
                        if (data == true) {
                            toastr["warning"]("Đã xóa bình luận!")
                        }

                    }
                });
            }
        }
    });
}


var vote = vote || {};

vote.getRateHouse = function () {
    $.ajax({
        type: "GET",
        url: "http://127.0.0.1:8000/api/get-house-votes",
        data: {
            house_id: $('#commentHouse').data('id'),
        },
        dataType: "json",
        success: function (data) {
            if (data['total'] != null) {

                let point = (data.total / data.count).toFixed(1);
                let result = point;
                let calculatePoint = point.split('.');
                if (calculatePoint[1] == 5) {
                    for (let k = 0; k < result; k++) {
                        $(`.point i[data-point="${k+1}"]`).removeClass('far');
                        $(`.point i[data-point="${k+1}"]`).addClass('fas');
                    }
                    result = Math.round(point);
                    $(`.point i[data-point="${result}"]`).removeClass('far fa-star');
                    $(`.point i[data-point="${result}"]`).addClass('fas fa-star-half-alt');

                } else {
                    if (calculatePoint[1] > 5) {
                        result = Math.round(point);
                        for (let k = 1; k <= result; k++) {
                            $(`.point i[data-point="${k}"]`).removeClass('far');
                            $(`.point i[data-point="${k}"]`).addClass('fas');
                        }
                    } else {
                        result = Math.floor(point);
                        for (let k = 1; k <= result; k++) {
                            $(`.point i[data-point="${k}"]`).removeClass('far');
                            $(`.point i[data-point="${k}"]`).addClass('fas');
                        }

                    }
                }
                if (result < 5) {
                    for (let i = result + 1; i <= 5; i++) {
                        $(`.point i[data-point="${i}"]`).removeClass('fas');
                        $(`.point i[data-point="${i}"]`).addClass('far');
                    }
                }
                $('.point i .fas').css('color', '#ffc107');
                $('#total').text(`${data.count} lượt đánh giá .`)
            }
        }
    });
}

vote.getMyVote = function () {
    if ($('#voteHouse').data('id') != 0) {
        $.ajax({
            type: 'GET',
            url: "http://127.0.0.1:8000/api/get-house-votes",
            data: {
                user_id: $('#voteHouse').data('id'),
                house_id: $('#commentHouse').data('id'),
            },
            dataType: "json",
            success: function (data) {
                if (data != false) {
                    let point = data.point;
                    for (let k = 1; k <= point; k++) {
                        $(`.stars i[data-id='${k}']`).removeClass('far');
                        $(`.stars i[data-id='${k}']`).addClass('fas');
                        $(`.stars i[data-id='${k}']`).css('color', '#ffc107');
                    }
                    if (point < 5) {
                        for (let i = point + 1; i <= 5; i++) {
                            $(`.stars i[data-id='${i}']`).removeClass('fas');
                            $(`.stars i[data-id='${i}']`).addClass('far');
                            $(`.stars i[data-id='${i}']`).css('color', 'black');
                        }
                    }
                    $('#vote-desc').text('Cảm ơn đã đánh giá !');
                    $('#cate-rating .star i').hover(function () {
                            let number = $(this).data('id');
                            for (let k = 1; k <= number; k++) {
                                $(`.star i[data-id='${k}']`).css('color', '#ffc107');
                            }
                        },
                        function () {
                            $('.star i.fas').css('color', '#ffc107');
                            $('.star i.far').css('color', 'black');
                        }

                    );
                }
            }
        });
    }

}

vote.rating = function (data) {
    if ($('#voteHouse').data('id') != 0) {
        let rate = $(data).children('i:first').data('id');
        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/api/vote-house",
            data: {
                rate: rate,
                user_id: $('#voteHouse').data('id'),
                house_id: $('#commentHouse').data('id'),
            },
            dataType: "json",
            success: function (data) {
                vote.getMyVote();
                vote.getRateHouse();
                toastr["success"]("Thank you!");
            }
        });
    } else {
        toastr["warning"]("Bạn chưa đăng nhập.");
    }

}

$(document).ready(function () {
    house.user();
    comment.getCmtHouse();
    vote.getRateHouse();
    vote.getMyVote();
    $('.star i').hover(function () {
            let number = $(this).data('id');
            for (let k = 1; k <= number; k++) {
                $(`.star i[data-id='${k}']`).css('color', '#ffc107');
            }
        },
        function () {
            $('.star i').css('color', 'black');
        }
    );
});
