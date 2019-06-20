jQuery(document).ready(function ($) {
    $('body.post-type-branch #title-prompt-text').html('Nhập tên đầy đủ...');
    $('body.post-type-branch.post-new-php #wpbody-content h1.wp-heading-inline').html('Thêm mới chi nhánh');
    $('body.post-type-branch.post-php #wpbody-content h1.wp-heading-inline').html('Cập nhật chi nhánh');

    $('body.post-type-branch #post').attr('form-validate', 'true');
    $('body.post-type-branch #post').attr('data-hide-alert', 'true');
    $('body.post-type-branch #post input#title').attr('required', 'true');

    function validate(_self) {
        _self.find(".form-group-valid").removeClass("form-group-error");
        _self.find(".form-group-valid .text-message-error").html("");
        var result = true;

        _self.find('.input-custom[input-validate="true"]').each(function () {
            let type_validate = $(this).attr('data-type');
            var check_type_file = $(this).attr('check-type-file');
            let text_message = '';
            let label_input = $(this).attr('data-label');
            let v = $(this).val();

            if (type_validate == 'file') {
                if ($(this).attr('check-required') == "true") {
                    if (v == '') {
                        text_message = 'No images selected.';
                    }
                }
                if (text_message == '') {
                    if (v != '') {
                        let file = $(this).prop('files')[0];
                        if (file.size > 3145728) {
                            text_message = 'File must not exceed 3M';
                        } else {
                            if (check_type_file == 'image') {
                                if (!file.type.match('image.*')) {
                                    text_message = 'Incorrect format';
                                }
                            } else if (check_type_file == 'document') {
                                var ext = v.split('.').pop();
                                if (ext != "pdf" && ext != "docx" && ext != "doc") {
                                    text_message = 'Incorrect format';
                                }
                            }
                        }
                    }
                }
            }

            if (type_validate == 'text') {
                if ($(this).attr('check-required') == "true") {
                    if (v == '' || v == null) {
                        text_message = 'Bạn chưa nhập dữ liệu cho trường này.';
                    }
                }
                if (text_message == '' && $(this).attr('check-max') != "" && $(this).attr('check-max') != undefined) {
                    if (v != "") {
                        let max = parseInt($(this).attr('check-max'));
                        if (v.length > max) {
                            text_message = 'Please enter no more than ' + max + ' characters.';
                        }
                    }
                }
                if (text_message == '' && $(this).attr('check-min') != "" && $(this).attr('check-min') != undefined) {
                    if (v != "") {
                        let min = parseInt($(this).attr('check-min'));
                        if (v.length < min) {
                            text_message = 'Please enter no less than ' + min + ' characters.';
                        }
                    }
                }
                if (text_message == '' && $(this).attr('check-number') == "true") {
                    if (v != "") {
                        if (isNaN(v)) {
                            text_message = 'Dữ liệu không phải dạng số.';
                        }

                        if (text_message == '' && $(this).attr('check-min-number') != "" && $(this).attr('check-min-number') != undefined) {
                            let min = parseInt($(this).attr('check-min-number'));
                            if (parseInt(v) < min) {
                                text_message = 'Please enter a value more than or equal to ' + min + '.';
                            }
                        }

                        if (text_message == '' && $(this).attr('check-max-number') != "" && $(this).attr('check-max-number') != undefined) {
                            let max = parseInt($(this).attr('check-max-number'));
                            if (parseInt(v) > max) {
                                text_message = 'Please enter a value less than or equal to ' + max + '.';
                            }
                        }
                    }
                }
                if (text_message == '' && $(this).attr('check-in') != "" && $(this).attr('check-in') != undefined) {
                    if (v != "") {
                        let dataIn = $(this).attr('check-in').split(',');
                        if (dataIn.indexOf(v) == -1) {
                            text_message = 'Incorrect format';
                        }
                    }
                }
                if (text_message == '' && $(this).attr('check-email') == "true") {
                    if (v != "") {
                        let re = /.+@.+\..+/;
                        if (!re.test(v)) {
                            text_message = 'Dữ liệu không phải email';
                        }
                    }
                }
                if (text_message == '' && $(this).attr('check-date') == "true") {
                    if (v != "") {
                        if (isDate(v) == false) {
                            text_message = 'Incorrect format (Y-m-d).';
                        }
                    }
                }
                if (text_message == '' && $(this).attr('check-time') == "true") {
                    if (v != "") {
                        if (isTime(v) == false) {
                            text_message = 'Incorrect format (H:m).';
                        }
                    }
                }
                if (text_message == '' && $(this).attr('check-confirm-passowrd') == "true") {
                    let divPassword = $(this).attr('data-id-password');
                    if (v != $(divPassword).val()) {
                        text_message = 'Password does not match.';
                    }
                }
                if (text_message == '' && $(this).attr('check-pasword') == "true") {
                    let dataCheck = {
                        current_password: v,
                        _token: $('#access_token').val()
                    };
                    let url = $(this).attr('data-url');
                    let _self = $(this);

                    $.ajax({
                        url: url,
                        data: dataCheck,
                        async: false,
                        method: 'POST',
                        success: function (data) {
                            data = $.parseJSON(data);
                            if (data.result == false) {
                                _self.parent().find('.text-message-error').html('Incorrect password');
                                _self.parent().addClass("form-group-error");
                                result = false;
                            }
                        }
                    });
                }
                if (text_message == '' && $(this).attr('check-email-exist') == "true") {
                    let dataCheck = {
                        email: v,
                        id: $(this).attr('data-id')
                    };
                    let url = $(this).attr('data-url');
                    let _self = $(this);

                    $.ajax({
                        url: url,
                        data: dataCheck,
                        async: false,
                        method: 'POST',
                        success: function (data) {
                            data = $.parseJSON(data);
                            if (data.result == true) {
                                _self.parent().find('.text-message-error').html('Email already exists.');
                                _self.parent().addClass("form-group-error");
                                result = false;
                            }
                        }
                    });
                }
            }

            $(this).parent().find('.text-message-error').html(text_message);
            if (text_message != '') {
                $(this).parent().addClass("form-group-error");
                result = false;
            }
        });

        _self.find(".form-group-valid").removeClass("form-group-checkbox-error");
        _self.find('.form-group[checkbox-validate="true"]').each(function () {
            let checkedCount = $(this).find('input[type="checkbox"]:checked').length;
            let labelCheckbox = $(this).attr('data-label');
            if (checkedCount == 0) {
                $(this).addClass("form-group-checkbox-error");
                $(this).find('.text-message-error').html('At least one ' + labelCheckbox + ' must be selected');
                result = false;
            }
        });

        _self.find(".form-group-valid").removeClass("form-group-radio-error");
        _self.find('.form-group[radio-validate="true"]').each(function () {
            let labelRadio = $(this).attr('data-label');
            if (!$(this).find('input[type="radio"]').is(':checked')) {
                $(this).addClass("form-group-radio-error");
                $(this).find('.text-message-error').html('Data not selected' + labelRadio);
                result = false;
            }
        });
        return result;
    }

    $(document).on('submit', 'form[form-validate="true"]', function () {
        $('.input-year').attr('style', 'width: 100px !important;');
        var _self = $(this);
        var check = validate(_self);
        if (check == false) {
            $('.input-year').each(function () {
                var v = $(this).val();
                if (v != null && v != '' && isNaN(v) == false) {
                    $(this).attr('style', 'border: 1px solid #e5e5e5 !important; width: 100px !important;');
                } else {
                    $(this).attr('style', 'border: 1px solid red !important; width: 100px !important;');
                }
            });
            console.log($('form[form-validate="true"]').attr('data-hide-alert'));
            if ($('form[form-validate="true"]').attr('data-hide-alert') != 'true') {
                alert('An error occurred. Please check and try again!');
            }
            $('html,body').animate({scrollTop: 0}, 'slow');

            if ($('#box-personal .form-group-error').length == 0) {
                $('.item-nav-account-surtion-2').click();
            }

            setTimeout(function () {
                $('.spinner').removeClass('is-active');
                $('#save-post').removeClass('disabled');
                $('#save-post').removeClass('button-disabled');
                $('#save-post').removeClass('button-primary-disabled');
                $('#publish').removeClass('disabled');
                $('#publish').removeClass('button-disabled');
                $('#publish').removeClass('button-primary-disabled');
                $('#post-preview').removeClass('disabled');
                $('#post-preview').removeClass('button-disabled');
                $('#post-preview').removeClass('button-primary-disabled');
            }, 500);
            return false;
        }
    });

    function isDate(txtDate) {
        var currVal = txtDate;
        if (currVal == '') {
            return false;
        }

        //Declare Regex
        var rxDatePattern = /^(\d{4})(\/|-)(\d{1,2})(\/|-)(\d{1,2})$/;
        var dtArray = currVal.match(rxDatePattern); // is format OK?

        if (dtArray == null)
            return false;

        //Checks for yyyy/mm/dd format.
        var dtMonth = dtArray[3];
        var dtDay = dtArray[5];
        var dtYear = dtArray[1];

        if (dtMonth < 1 || dtMonth > 12) {
            return false;
        } else if (dtDay < 1 || dtDay > 31) {
            return false;
        } else if ((dtMonth == 4 || dtMonth == 6 || dtMonth == 9 || dtMonth == 11) && dtDay == 31) {
            return false;
        } else if (dtMonth == 2) {
            var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
            if (dtDay > 29 || (dtDay == 29 && !isleap)) {
                return false;
            }
        }
        return true;
    }


    function isTime(time) {
        if (time.length == 0) {
            return true
        }
        if (time.length < 4) {
            return false
        }
        var x = time.indexOf(":");
        if (x < 0) {
            return false;
        }

        if ((time.substr(0, 2) >= 0) && (time.substr(0, 2) < 24) && (time.substr(3, 2) >= 0) && (time.substr(3, 2) <= 59) && ((time.substr(3, 2) % 10) == 0)) {
            return true;
        } else {
            return false;
        }
    }
});

function hasExtension(inputID, exts) {
    var fileName = document.getElementById(inputID).value;
    return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
}

function check_file_image(id_button) {
    var fileInput = document.getElementById(id_button);
    var fileSize = fileInput.files[0].size / 1024 / 1024;
    if (fileSize <= 3) {
        if (!hasExtension(id_button, ['.jpg', '.gif', '.png'])) {
            alert('This is not an image file! Only formats are allowed: jpg, gif, png.');
            document.getElementById(id_button).value = "";
        }
    } else {
        alert('File size too large! Please upload less than 3MB');
        document.getElementById(id_button).value = "";
    }
}

function check_file_document(id_button) {
    var fileInput = document.getElementById(id_button);
    var fileSize = fileInput.files[0].size / 1024 / 1024;
    if (fileSize <= 3) {
        if (!hasExtension(id_button, ['.pdf', '.docx', '.doc'])) {
            alert('This type of files are not allowed! Only formats are allowed: pdf, docx, doc.');
            document.getElementById(id_button).value = "";
        }
    } else {
        alert('File size too large! Please upload less than 3MB');
        document.getElementById(id_button).value = "";
    }
}