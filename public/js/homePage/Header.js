// ckediter
CKEDITOR.replace('editor2'); 
  var business = business || {};
        business.get = function(){
            $.ajax({
                type: "GET",
                url: "http://127.0.0.1:8000/api/get-business",
                dataType: "json",
                success: function (data) {
                    $('#businessType').empty();
                    $('#businessType').append(`
                        
                        <li class="nav-item active">
                            <a class="nav-link" href="/">TRANG CHỦ <span class="sr-only">(current)</span></a>
                        </li>
                    `);
                    $.each(data, function (i, value) { 
                        $('#businessType').append(`
                        <li class="nav-item active">
                            <a class="nav-link" href="/business/${value.id}">${(value.typeName).toUpperCase()}</a>
                        </li>
                        `);
                        $('.inputBusiness').append(`
                        <option value="${value.id}">${value.typeName}</option>
                    `);
                    });
                    $('#businessType').append(`
                        <li class="nav-item active">
                            <a class="nav-link" href="/posts">TIN TỨC</a>
                        </li>
                    `);                   
                }
            });
        }

        business.inputBusiness = function(){
          $.ajax({
                type: "GET",
                url: "http://127.0.0.1:8000/api/get-business",
                dataType: "json",
                success: function (data) {
                  $('#inputBusiness').empty();
                  $.each(data, function (i, value) { 
                    $('#inputBusiness').append(`
                        <option value="${value.id}">${value.typeName}</option>
                    `);
                  });
                }
          });
        }
  var district = district || {};
  district.inputDistrict = function(){
    $.ajax({
      type: "GET",
      url: "http://127.0.0.1:8000/api/get-district",
      dataType: "json",
      success: function (data) {
        $('#inputDistrict').empty();
        $.each(data, function (i, value) { 
          $('.inputDistrict').append(`
            <option value="${value.id}"> ${value.district}</option>
          `);
        });
        district.addressDetail();
      }

    });
  }

  district.addressDetail = function(){
    $.ajax({
      type: "GET",
      url: "http://127.0.0.1:8000/api/get-district-detail",
      data: {
        id: $('#inputDistrict').val(),
      },
      dataType: "json",
      success: function (data) {
        $('.inputAddress').val(data.address.address);
      }
    });
  }
        function createHouse(){
            if (checkValueInputFile() && $('#formInputHouse').valid()){
              $('#formInputHouse').submit();
              formPostHouseOff();
            }
        }

        function formPostHouseOn() {
          if($('#cardDrop').data('id') != null){
            $('#formPostHouse').modal('show');
          }else{
            $('#alertLogin').modal('show');
          }
          
        }
        function formPostHouseOff(){
          $('#inputTitle').val('');
          $('#inputArea').val('');
          $('#inputPrice').val('');
          $('#inputFile').val('');
          district.inputDistrict();
          business.inputBusiness();
          CKEDITOR.instances.editor2.setData('');
          $('#formPostHouse').modal('hide');
          $('label.error').hide();
        }
       function checkValueInputFile(data){
         let inputFile = $("#inputFile").prop('files');
          if(inputFile.length > 6){
            $('#inputFileError').text('* Số lượng ảnh vượt quá số lượng cho phép .')
            $('#inputFileError').show();
            return false;
          }else{
            $('#inputFileError').hide();
          }
          
          return true;
          
       }
       
    $(document).ready( function () {   
        business.get();
        district.inputDistrict();
        business.inputBusiness();
        $('#inputBusiness').select2();
        $('#inputDistrict').select2();
    });