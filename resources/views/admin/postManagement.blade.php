@extends('layouts.Admin')

@section('title', 'Dashboard - Quản lý tin tức')
@section('content')
<div id="post">
    <h4 class="display-4 mb-2 text-center">Quản lí tin tức</h4>
    <table class="table  table-hover text-md-center" id="tablePost">
        <thead class="thead-dark">
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên bài viết</th>
                <th scope="col">Ngày đăng</th>
                <th scope="col">Ngày cập nhật</th>
                <th scope="col">Lượt xem</th>
                <th scope="col">Người đăng</th>
                <th scope="col">Sửa / Xóa</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    <div class="w-100 text-center">

    </div>
    <div class="w-100 text-center click-post" onclick="post.dropDown()">
        <span>Đăng bài ngay</span>
        <i class="far fa-edit ml-2"></i>
    </div>
    {{-- modal xl --}}

    <div class="modal fade" id="editPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Chỉnh sửa bài viết</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body modal-post">
                    <form id="formDataPost" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="form-group form-row">
                                <div class="col">
                                    <label for="titlePost">Tiêu đề bài viết :</label>
                                    <textarea class="form-control" id="titlePost" rows="6" name="titlePost"
                                    data-rule-required='true' data-msg-required="Tiêu đề không được để trống"
                                    data-rule-maxlength='200' data-msg-maxlength="Tiêu đề không dài hơn 200 ký tự"></textarea>
                                </div>
                                <div class="col">
                                    <label for="">Ảnh bìa : </label>
                                    <div id="divImage">
                                        <img src="" class="img-thumbnail" alt="" id="coverImage"><br>
                                    </div>
                                    <input class="mt-3 ml-2" type="file" accept="image/*" class="form-control-file"
                                        name="imageUpload" id="imageUpload" onchange="post.showCoverImage(this)" data-rule-required='true'
                                        data-msg-required="Ảnh không được để trống" data-rule-accept='image/*'
                                        data-msg-accept="File tải lên không phải ảnh">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="texarea">Nội dung bài viết : </label>
                                <textarea class="form-control editor1" id="editor1" rows="10" data-rule-required='true' data-msg-required="Nội dung không được để trống"></textarea>
                            </div>
                            <input type="hidden" name="id" id="postId">
                            <input type="hidden" name="user_id" id="userId" value="{{ Auth::user()->id }}">
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="post.save()">Lưu</button>
                </div>

            </div>
        </div>
    </div>
    @endsection

    @push('postManagerment-js')
    {{-- ck editor --}}
    <script src="/ckeditor/ckeditor.js"></script>
    <script src="/js/dashboard/postManagement.js"></script>
    @endpush