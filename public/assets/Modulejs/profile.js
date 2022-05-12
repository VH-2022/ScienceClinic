/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

    "use strict";
    /* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return Pagination; });
    var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

    function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }


    /***/ }),
    /* 1 */,
    /* 2 */,
    /* 3 */
    /***/ (function(module, exports, __webpack_require__) {

    module.exports = __webpack_require__(4);


    /***/ }),
    /* 4 */
    /***/ (function(module, __webpack_exports__, __webpack_require__) {

    "use strict";
    Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
    /* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__helpers_pagination_v2__ = __webpack_require__(0);
    /* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__js_helpers_validate_form__ = __webpack_require__(5);
    var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

    function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }




    $(document).ready(function () {
        $('input').attr('autocomplete', 'off');
        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return _typeof(sParameterName[1]) === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
            return false;
        };

        // Modal Static
        // ==========================================================

        $(".modal").modal({
            show: false,
            backdrop: 'static'
        });

        // Toastr configuration
        // ==========================
        toastr.options.closeButton = true;
        toastr.options.tapToDismiss = false;
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": 0,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "tapToDismiss": false
        };

        // Tippy
        // ============================================================


        // select2 initialize
        // ============================================================

        $(".select2").select2();

        // Task List
        // =========================================================

        var objectName = $.trim($('#object').val());
        var objectId = $.trim($('#objectId').val());
        var appendTable = $.trim($('#appendTable').val());

        $('body').on('keyup', '#username', function () {
            Object(__WEBPACK_IMPORTED_MODULE_1__js_helpers_validate_form__["a" /* inputEmptyCheck */])('username', 'Email');
        });
        $('body').on('keyup', '#password', function () {
            Object(__WEBPACK_IMPORTED_MODULE_1__js_helpers_validate_form__["a" /* inputEmptyCheck */])('password', 'Password');
        });

        $('body').on('click', '.hideshow', function (e) {
            $('#cpersonal_id').removeClass('active');
            $('#personal_id').removeClass('active');
            $('#cpassword_id').attr('style','display:none');
            $('#personam_id').attr('style','display:none');
            if($(this).attr('data-ids') =='changepassword'){
                $('#cpersonal_id').addClass('active');
                $('#cpassword_id').attr('style','');
            }else{
                $('#personal_id').addClass('active');
                $('#personam_id').attr('style','');
            }

        })
        $('body').on('click', '#update_id', function (e) {
            e.preventDefault();
            var _self = this;
            var validation_status = 0;
            var validation_filed_array = ['full_name','last_name','email_id','mobile_id'];
            for (var i = 0; i < validation_filed_array.length; i++) {
                validation_status += parseInt(validatField($('#' + validation_filed_array[i] + '.validate_field')));
            }
            $('.phone-number-validate').each(function () {
                validation_status += parseInt(handlePhoneNumber($(this)));
            });
            $('.email-validate').each(function () {

                validation_status += parseInt(handleEmail($(this)));
            });
            var  profile_avatar = $('input[name="profile_avatar"]').prop('files');
            if(profile_avatar.length ==1){
                var  FileUploadPath = profile_avatar[0].name;
                var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
                if(Extension =='jpg' || Extension =='png' || Extension =='gif' || Extension =='jpeg'){

                }else{
                    $('.image_error').html("Photo only allows image types of PNG, JPG, JPEG");
                    validation_status =1;

                }
            }
            if(validation_status ==0){
               var formData = new FormData($('#submitid')[0]);
                $.ajax({
                    type:'POST',
                    url:_PROFILE_UPDATE,
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                }).done(function (r) {
                    if(r.status ==1){
                        $('#auth_fname').html(r.data[0].first_name+' '+r.data[0].last_name);
                        $('#header_auth_name').html(r.data[0].first_name+' '+r.data[0].last_name);
                        $('#sidebar_auth_name').html(r.data[0].first_name+' '+r.data[0].last_name);
                        var headers = r.data[0].first_name.charAt(0);
                        $('#fchar_id').html(headers);
                        $('#auth_email').html(r.data[0].email);
                        $('#auth_email_sidebar').html(r.data[0].email);
                        $('#auth_mobile').html(r.data[0].mobile_id);
                        $('#auth_image_new').attr('src', r.data[0].profile_photo);
                        $('#auth_image_header').attr('src', r.data[0].profile_photo);
                        $('#sidebar_image_header').css({"background-image": "url("+r.data[0].profile_photo+")"});  
                        toastr.success(r.error_msg);
                    }else{
                        toastr.error(r.error_msg);
                    }
                });
            }

        });
        $('body').on('click', '#update_password', function (e) {
            e.preventDefault();
            var _self = this;
            var validation_status = 0;
           var current_password = $('#current_password').val();
           var new_password = $('#new_password').val();
           var confirmation_password = $('#confirmation_password').val();
           $('.current_password_error').html("");
           $('.new_password_error').html("");
           $('.confirmation_password_error').html("");
            if(current_password.trim() ==''){
                $('.current_password_error').html("Current Password is required.");
                validation_status=1;
            }

            if(new_password.trim() ==''){
                $('.new_password_error').html("New Password is required.");
                validation_status=1;
            }

            if(new_password.trim() !=''){
                if(new_password.length <6){
                    $('.new_password_error').html("New Password atleast six character allowed.");
                    validation_status=1;
                }
            }
            if(confirmation_password.trim() ==''){
                $('.confirmation_password_error').html("Confirm Password is required.");
                validation_status=1;
            }
			if(confirmation_password.trim() !='' && new_password.trim() !=''){
				if(new_password.trim() != confirmation_password.trim()){
					 $('.confirmation_password_error').html("New password and Confirm password does not match.");
					 validation_status=1;
				}

			}

			if(validation_status ==1){
				return false;
			}

            if(validation_status ==0){
                var forms = $('#change_password_id')[0];
               var formData = new FormData(forms);
               formData.append('_token',CSRF_TOKEN);
                $.ajax({
                    type:'POST',
                    url:_PASSWORD_UPDATE,
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                }).done(function (r) {
                    $('#change_password_id')[0].reset();
                    if(r.status ==1){

                        toastr.success(r.error_msg);
                    }else{
                        toastr.error(r.error_msg);
                    }
                });
            }

        });

    });


    function validatField(elem) {
        var $this = elem;


        var elem_type = $this.get(0).tagName;
        var cur_elm_val = $this.val();
        var cur_err_msg = $this.attr('data-msg');
        var cur_elem_id = $this.attr('id');

        var cur_elem_name = $this.attr('name');
        var validation_status = 0;
        var cur_elem_data_type = "";
        if ($this.attr('data-type')) {
            cur_elem_data_type = $this.attr('data-type');
        }
        var time_valid = $this.hasClass('time-picker') ? true : false;
        var range_valid = $this.hasClass('training_datepicker') ? true : false;

        if (elem_type == 'SELECT') {
            $('.' + cur_elem_id + '_error').html('');
            if (cur_elm_val == '') {
                $('#' + cur_elem_id).next('.select2-container').find('.select2-selection').addClass('is-invalid').removeClass('is-valid');
                $('.' + cur_elem_id + '_error').html(cur_err_msg + ' is required.');
                validation_status = 1;
            } else {
                $('#' + cur_elem_id).next('.select2-container').find('.select2-selection').addClass('is-valid').removeClass('is-invalid');
            }
        }

        if (elem_type == 'INPUT') {
            var cur_elem_type = $this.attr('type');
            if (cur_elem_type == 'text') {

                $('.' + cur_elem_id + '_error').html('');
                if (cur_elm_val.trim() == '' && !range_valid) {
                    console.log(cur_elem_id);
                    $('#' + cur_elem_id).addClass('is-invalid').removeClass('is-valid');
                    $('.' + cur_elem_id + '_error').html(cur_err_msg + ' is required.');
                    validation_status = 1;
                } else if (cur_elem_data_type != "") {
                    $('.' + cur_elem_id + '_error').html('');
                    if (isNaN(cur_elm_val)) {
                        $('#' + cur_elem_id).addClass('is-invalid').removeClass('is-valid');
                        $('.' + cur_elem_id + '_error').html(cur_err_msg + ' must be a number.');
                        validation_status = 1;
                    } else {
                        $('#' + cur_elem_id).addClass('is-valid').removeClass('is-invalid');
                    }
                } else if (time_valid) {
                    validation_status = calculateTime($this);
                } else if (range_valid) {
                    validation_status = dateValidation($this);
                } else if (!range_valid) {
                    $('#' + cur_elem_id).addClass('is-valid').removeClass('is-invalid');
                }
            } else if (cur_elem_type == 'radio') {
                var cur_checked = $('input[name="' + cur_elem_name + '"]:checked').val();
                $('.' + cur_elem_name + '_error').html('');
                if (cur_checked == undefined) {
                    $('.' + cur_elem_name + '_error').html(cur_err_msg + ' is required.');
                    validation_status = 1;
                }
            }
        }
        return validation_status;
    }
    function handlePhoneNumber(elem, type) {
        var $this = elem;
        var cur_elem_id = $this.attr('id');
        var cur_elm_val = $this.val();
        var cur_err_msg = $this.attr('data-msg');
        var string_replace = cur_elm_val.replace(/[^0-9]/g, '');

        if (string_replace.trim() == '') {
            $('#' + cur_elem_id).addClass('is-invalid').removeClass('is-valid');
            $('.' + cur_elem_id + '_error').html(cur_err_msg + ' is required.');
            return 1;
        } else if (string_replace.length < 10) {
            if (type == 'keyup') {
                $('#' + cur_elem_id).removeClass('is-valid is-invalid');
                $('.' + cur_elem_id + '_error').html('');
            } else {
                $('#' + cur_elem_id).addClass('is-invalid').removeClass('is-valid');
                $('.' + cur_elem_id + '_error').html(cur_err_msg + ' is invalid.');
            }
            return 1;
        } else {
            $('#' + cur_elem_id).addClass('is-valid').removeClass('is-invalid');
            $('.' + cur_elem_id + '_error').html('');
            return 0;
        }
    }
    function handleEmail(elem, type) {
        var $this = elem;
        var cur_elem_id = $this.attr('id');
        var cur_elm_val = $this.val();
        var cur_err_msg = $this.attr('data-msg');
        var string_replace = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

        if(cur_elm_val.trim() ==''){
            $('#' + cur_elem_id).addClass('is-invalid').removeClass('is-valid');
            $('.' + cur_elem_id + '_error').html(cur_err_msg + ' is required.');
            return 1;
        }
      else if (string_replace.test(cur_elm_val)) {
            $('#' + cur_elem_id).removeClass('is-valid is-invalid');
            $('.' + cur_elem_id + '_error').html('');
            return 0;

        } else {
            $('#' + cur_elem_id).addClass('is-invalid').removeClass('is-valid');
            $('.' + cur_elem_id + '_error').html(cur_err_msg + ' is invalid.');
            return 1;

        }
    }
    /***/ }),
    /* 5 */
    /***/ (function(module, __webpack_exports__, __webpack_require__) {

    "use strict";
    /* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "b", function() { return selectEmptyCheck; });
    /* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return inputEmptyCheck; });
    // <-- Start: Check Input Field Empty function -->
    // ==================================================
    function selectEmptyCheck(id, errorMgs) {
        var error = 0;
        if ($.trim($('#' + id).val()).length == 0) {
            $('#' + id).closest('.form-group').find('.error').text(errorMgs + ' is required.');
            $('#' + id).closest('.form-group').find('.select2-selection--multiple').attr('style', 'border:0 !important');
            $('#' + id).closest('.form-group').find('.select2-container').css('background', '#fff');
            $('#' + id).closest('.form-group').find('.select2-container').removeClass('is-valid').addClass('is-invalid');
            $('#' + id).closest('.form-group').find('.select2-container .select2-selection__arrow').addClass('d-none');
            $('#' + id).closest('.form-group').find('.select2-container--default .select2-selection--single').css('border', '0');
            error++;
        } else {
            $('#' + id).closest('.form-group').find('.error').text('');
            $('#' + id).closest('.form-group').find('.select2-selection--multiple').attr('style', 'border:0 !important');
            $('#' + id).closest('.form-group').find('.select2-container').css('background', '#fff');
            $('#' + id).closest('.form-group').find('.select2-container').removeClass('is-invalid').addClass('is-valid');
            $('#' + id).closest('.form-group').find('.select2-container .select2-selection__arrow').addClass('d-none');
            $('#' + id).closest('.form-group').find('.select2-container--default .select2-selection--single').css('border', '0');
        }
        return error;
    }
    function inputEmptyCheck(id, errorMgs) {

        var error = 0;
        if ($.trim($('#' + id).val()).length == 0) {
            $('#' + id).closest('.form-group').find('.error').text(errorMgs + ' is required.');
            $('#' + id).removeClass('is-valid').addClass('is-invalid');
            error++;
        } else {
            $('#' + id).closest('.form-group').find('.error').text('');
            $('#' + id).removeClass('is-invalid').addClass('is-valid');
        }
        return error;
    }




    /***/ })
]);
