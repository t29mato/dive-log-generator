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
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/cropper.js":
/*!*********************************!*\
  !*** ./resources/js/cropper.js ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * Ref: https://github.com/fengyuanchen/cropperjs/blob/master/examples/upload-cropped-image-to-server.html
 */
window.addEventListener('DOMContentLoaded', function () {
  var path = '/upload';
  var avatar = document.getElementById('avatar');
  var image = document.getElementById('image');
  var input = document.getElementById('input');
  var $progress = $('.progress');
  var $progressBar = $('.progress-bar');
  var $alert = $('.alert');
  var $modal = $('#modal');
  var cropper;
  $('[data-toggle="tooltip"]').tooltip();
  input.addEventListener('change', function (e) {
    var files = e.target.files;

    var done = function done(url) {
      input.value = '';
      image.src = url;
      $alert.hide();
      $modal.modal('show');
    };

    var reader;
    var file;

    if (files && files.length > 0) {
      file = files[0];

      if (URL) {
        done(URL.createObjectURL(file));
      } else if (FileReader) {
        reader = new FileReader();

        reader.onload = function (e) {
          done(reader.result);
        };

        reader.readAsDataURL(file);
      }
    }
  });
  $modal.on('shown.bs.modal', function () {
    cropper = new Cropper(image, {
      aspectRatio: 1,
      viewMode: 3
    });
  }).on('hidden.bs.modal', function () {
    cropper.destroy();
    cropper = null;
  });
  document.getElementById('crop').addEventListener('click', function () {
    var initialAvatarURL;
    var canvas;
    $modal.modal('hide');

    if (cropper) {
      canvas = cropper.getCroppedCanvas({
        width: 1200,
        height: 1200
      });
      initialAvatarURL = avatar.src; // avatar.src = canvas.toDataURL();

      $progress.show();
      $alert.removeClass('alert-success alert-warning');
      canvas.toBlob(function (blob) {
        var formData = new FormData();
        formData.append('croppedImage', blob);
        $.ajax(path, {
          method: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          xhr: function xhr() {
            var xhr = new XMLHttpRequest();

            xhr.upload.onprogress = function (e) {
              var percent = '0';
              var percentage = '0%';

              if (e.lengthComputable) {
                percent = Math.round(e.loaded / e.total * 100);
                percentage = percent + '%';
                $progressBar.width(percentage).attr('aria-valuenow', percent).text(percentage);
              }
            };

            return xhr;
          },
          success: function success(response) {
            avatar.src = response;
            $('#photo').val(response);
            $alert.show().addClass('alert-success').text('写真アップロード成功');
          },
          error: function error() {
            avatar.src = initialAvatarURL;
            $alert.show().addClass('alert-warning').text('写真アップロード失敗');
          },
          complete: function complete() {
            $progress.hide();
          }
        });
      });
    }
  });
});

/***/ }),

/***/ 1:
/*!***************************************!*\
  !*** multi ./resources/js/cropper.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/tomoyamatou/dev/sea-log-generator/resources/js/cropper.js */"./resources/js/cropper.js");


/***/ })

/******/ });