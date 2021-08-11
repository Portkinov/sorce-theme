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
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./theme/src/js/footer.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./theme/src/js/footer.js":
/*!********************************!*\
  !*** ./theme/src/js/footer.js ***!
  \********************************/
/*! exports provided: doPlay */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "doPlay", function() { return doPlay; });
function _createForOfIteratorHelper(o, allowArrayLike) { var it; if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = o[Symbol.iterator](); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

/* for resize throttling */
var resizeID; //end sticky header

var scrolling_element = document.querySelector('#content');
scrolling_element.addEventListener('scroll', function () {
  var navbar = document.querySelector('.siteheader'); //let topspace = navbar.offsetTop ;

  var stickpoint = 20;

  if (scrolling_element.scrollTop >= stickpoint) {
    navbar.classList.add("sticky");
  } else {
    navbar.classList.remove("sticky");
  }
});
document.addEventListener('DOMContentLoaded', function () {
  window.played = [];

  window.playOnce = function (caller) {
    if (!window.played.includes(caller)) {
      caller.play();
      window.played.push(caller);
    }
  };

  addMobileClick();
  addVidClick();
  addLearnMoreClick();

  if (window.innerWidth <= 768) {
    mobilenavToggler();
  }
});

function addLearnMoreClick() {
  var buttons = document.querySelectorAll('.button.learnmore');

  var _iterator = _createForOfIteratorHelper(buttons),
      _step;

  try {
    for (_iterator.s(); !(_step = _iterator.n()).done;) {
      var button = _step.value;
      button.addEventListener('click', function (event) {
        var card = event.target.closest('.card');
        var button = event.target.classList.contains('button') ? event.target : event.target.closest('.button');
        var text = card ? card.querySelector('.card-text') : false;
        var bg = card ? card.querySelector('.card-background') : false;
        var buttonwrap = card ? card.querySelector('.buttonwrap') : false;
        card.classList.toggle('open');

        if (card && bg && !card.classList.contains('open')) {
          button.innerText = 'Learn More';
        } else {
          button.innerText = 'Coming Soon';
        }
      });
    }
  } catch (err) {
    _iterator.e(err);
  } finally {
    _iterator.f();
  }
}

function doPlay(e) {
  if (e.target.paused === true) {
    e.target.play();
  }
}

function addVidClick() {
  var videos = document.getElementsByClassName('chromevid');

  if (videos) {
    var _iterator2 = _createForOfIteratorHelper(videos),
        _step2;

    try {
      for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
        var video = _step2.value;
        video.addEventListener('click', function (e) {
          console.log(window);
          console.log(window.playOnce);
          window.playOnce(e.target);
        });
      }
    } catch (err) {
      _iterator2.e(err);
    } finally {
      _iterator2.f();
    }
  }
}

function addMobileClick() {
  var hamburger = document.getElementById('mobilenav_button');

  if (hamburger) {
    hamburger.addEventListener('click', function (e) {
      var target = e.target.id == "mobilenav_button" ? e.target : e.target.closest('#mobilenav_button');
      target.classList.toggle('active');
      var hamburger = target.querySelector('.burger.burger-squeeze');
      if (hamburger) hamburger.classList.toggle('open');
      var body = document.querySelector('BODY');

      if (target.classList.contains('active')) {
        body.setAttribute('style', 'overflow:hidden;overflow-y: hidden;overflow-x: hidden');
      } else {
        body.removeAttribute('style');
      }
    });
  }
}

function mobilenavToggler() {
  var mobileToggler = document.querySelectorAll(".footer-nav h5");

  if (mobileToggler.length) {
    mobileToggler.forEach(function (button) {
      button.addEventListener('click', function (event) {
        var targetElement = event.target || event.srcElement;
        var footerNav = targetElement.closest(".footer-nav");

        if (footerNav.classList.contains("open")) {
          footerNav.classList.remove("open");
        } else {
          footerNav.classList.add("open");
        }
      });
    });
  }
}

/***/ })

/******/ });
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vd2VicGFjay9ib290c3RyYXAiLCJ3ZWJwYWNrOi8vLy4vdGhlbWUvc3JjL2pzL2Zvb3Rlci5qcyJdLCJuYW1lcyI6WyJyZXNpemVJRCIsInNjcm9sbGluZ19lbGVtZW50IiwiZG9jdW1lbnQiLCJxdWVyeVNlbGVjdG9yIiwiYWRkRXZlbnRMaXN0ZW5lciIsIm5hdmJhciIsInN0aWNrcG9pbnQiLCJzY3JvbGxUb3AiLCJjbGFzc0xpc3QiLCJhZGQiLCJyZW1vdmUiLCJ3aW5kb3ciLCJwbGF5ZWQiLCJwbGF5T25jZSIsImNhbGxlciIsImluY2x1ZGVzIiwicGxheSIsInB1c2giLCJhZGRNb2JpbGVDbGljayIsImFkZFZpZENsaWNrIiwiYWRkTGVhcm5Nb3JlQ2xpY2siLCJpbm5lcldpZHRoIiwibW9iaWxlbmF2VG9nZ2xlciIsImJ1dHRvbnMiLCJxdWVyeVNlbGVjdG9yQWxsIiwiYnV0dG9uIiwiZXZlbnQiLCJjYXJkIiwidGFyZ2V0IiwiY2xvc2VzdCIsImNvbnRhaW5zIiwidGV4dCIsImJnIiwiYnV0dG9ud3JhcCIsInRvZ2dsZSIsImlubmVyVGV4dCIsImRvUGxheSIsImUiLCJwYXVzZWQiLCJ2aWRlb3MiLCJnZXRFbGVtZW50c0J5Q2xhc3NOYW1lIiwidmlkZW8iLCJjb25zb2xlIiwibG9nIiwiaGFtYnVyZ2VyIiwiZ2V0RWxlbWVudEJ5SWQiLCJpZCIsImJvZHkiLCJzZXRBdHRyaWJ1dGUiLCJyZW1vdmVBdHRyaWJ1dGUiLCJtb2JpbGVUb2dnbGVyIiwibGVuZ3RoIiwiZm9yRWFjaCIsInRhcmdldEVsZW1lbnQiLCJzcmNFbGVtZW50IiwiZm9vdGVyTmF2Il0sIm1hcHBpbmdzIjoiO1FBQUE7UUFDQTs7UUFFQTtRQUNBOztRQUVBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBOztRQUVBO1FBQ0E7O1FBRUE7UUFDQTs7UUFFQTtRQUNBO1FBQ0E7OztRQUdBO1FBQ0E7O1FBRUE7UUFDQTs7UUFFQTtR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RUFBVztBQUN4QyxZQUFJMkIsYUFBYSxHQUFHM0IsS0FBSyxDQUFDRSxNQUFOLElBQWdCRixLQUFLLENBQUM0QixVQUExQztBQUVBLFlBQUlDLFNBQVMsR0FBR0YsYUFBYSxDQUFDeEIsT0FBZCxDQUFzQixhQUF0QixDQUFoQjs7QUFDQSxZQUFHMEIsU0FBUyxDQUFDL0MsU0FBVixDQUFvQnNCLFFBQXBCLENBQTZCLE1BQTdCLENBQUgsRUFBd0M7QUFDcEN5QixtQkFBUyxDQUFDL0MsU0FBVixDQUFvQkUsTUFBcEIsQ0FBMkIsTUFBM0I7QUFDSCxTQUZELE1BRUs7QUFDRDZDLG1CQUFTLENBQUMvQyxTQUFWLENBQW9CQyxHQUFwQixDQUF3QixNQUF4QjtBQUNIO0FBQ0osT0FURDtBQVVILEtBWEQ7QUFZSDtBQUNKLEMiLCJmaWxlIjoianMvZnJpZW5kbHlyb2JvdF9mb290ZXIuanMiLCJzb3VyY2VzQ29udGVudCI6WyIgXHQvLyBUaGUgbW9kdWxlIGNhY2hlXG4gXHR2YXIgaW5zdGFsbGVkTW9kdWxlcyA9IHt9O1xuXG4gXHQvLyBUaGUgcmVxdWlyZSBmdW5jdGlvblxuIFx0ZnVuY3Rpb24gX193ZWJwYWNrX3JlcXVpcmVfXyhtb2R1bGVJZCkge1xuXG4gXHRcdC8vIENoZWNrIGlmIG1vZHVsZSBpcyBpbiBjYWNoZVxuIFx0XHRpZihpbnN0YWxsZWRNb2R1bGVzW21vZHVsZUlkXSkge1xuIFx0XHRcdHJldHVybiBpbnN0YWxsZWRNb2R1bGVzW21vZHVsZUlkXS5leHBvcnRzO1xuIFx0XHR9XG4gXHRcdC8vIENyZWF0ZSBhIG5ldyBtb2R1bGUgKGFuZCBwdXQgaXQgaW50byB0aGUgY2FjaGUpXG4gXHRcdHZhciBtb2R1bGUgPSBpbnN0YWxsZWRNb2R1bGVzW21vZHVsZUlkXSA9IHtcbiBcdFx0XHRpOiBtb2R1bGVJZCxcbiBcdFx0XHRsOiBmYWxzZSxcbiBcdFx0XHRleHBvcnRzOiB7fVxuIFx0XHR9O1xuXG4gXHRcdC8vIEV4ZWN1dGUgdGhlIG1vZHVsZSBmdW5jdGlvblxuIFx0XHRtb2R1bGVzW21vZHVsZUlkXS5jYWxsKG1vZHVsZS5leHBvcnRzLCBtb2R1bGUsIG1vZHVsZS5leHBvcnRzLCBfX3dlYnBhY2tfcmVxdWlyZV9fKTtcblxuIFx0XHQvLyBGbGFnIHRoZSBtb2R1bGUgYXMgbG9hZGVkXG4gXHRcdG1vZHVsZS5sID0gdHJ1ZTtcblxuIFx0XHQvLyBSZXR1cm4gdGhlIGV4cG9ydHMgb2YgdGhlIG1vZHVsZVxuIFx0XHRyZXR1cm4gbW9kdWxlLmV4cG9ydHM7XG4gXHR9XG5cblxuIFx0Ly8gZXhwb3NlIHRoZSBtb2R1bGVzIG9iamVjdCAoX193ZWJwYWNrX21vZHVsZXNfXylcbiBcdF9fd2VicGFja19yZXF1aXJlX18ubSA9IG1vZHVsZXM7XG5cbiBcdC8vIGV4cG9zZSB0aGUgbW9kdWxlIGNhY2hlXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLmMgPSBpbnN0YWxsZWRNb2R1bGVzO1xuXG4gXHQvLyBkZWZpbmUgZ2V0dGVyIGZ1bmN0aW9uIGZvciBoYXJtb255IGV4cG9ydHNcbiBcdF9fd2VicGFja19yZXF1aXJlX18uZCA9IGZ1bmN0aW9uKGV4cG9ydHMsIG5hbWUsIGdldHRlcikge1xuIFx0XHRpZighX193ZWJwYWNrX3JlcXVpcmVfXy5vKGV4cG9ydHMsIG5hbWUpKSB7XG4gXHRcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsIG5hbWUsIHsgZW51bWVyYWJsZTogdHJ1ZSwgZ2V0OiBnZXR0ZXIgfSk7XG4gXHRcdH1cbiBcdH07XG5cbiBcdC8vIGRlZmluZSBfX2VzTW9kdWxlIG9uIGV4cG9ydHNcbiBcdF9fd2VicGFja19yZXF1aXJlX18uciA9IGZ1bmN0aW9uKGV4cG9ydHMpIHtcbiBcdFx0aWYodHlwZW9mIFN5bWJvbCAhPT0gJ3VuZGVmaW5lZCcgJiYgU3ltYm9sLnRvU3RyaW5nVGFnKSB7XG4gXHRcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsIFN5bWJvbC50b1N0cmluZ1RhZywgeyB2YWx1ZTogJ01vZHVsZScgfSk7XG4gXHRcdH1cbiBcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsICdfX2VzTW9kdWxlJywgeyB2YWx1ZTogdHJ1ZSB9KTtcbiBcdH07XG5cbiBcdC8vIGNyZWF0ZSBhIGZha2UgbmFtZXNwYWNlIG9iamVjdFxuIFx0Ly8gbW9kZSAmIDE6IHZhbHVlIGlzIGEgbW9kdWxlIGlkLCByZXF1aXJlIGl0XG4gXHQvLyBtb2RlICYgMjogbWVyZ2UgYWxsIHByb3BlcnRpZXMgb2YgdmFsdWUgaW50byB0aGUgbnNcbiBcdC8vIG1vZGUgJiA0OiByZXR1cm4gdmFsdWUgd2hlbiBhbHJlYWR5IG5zIG9iamVjdFxuIFx0Ly8gbW9kZSAmIDh8MTogYmVoYXZlIGxpa2UgcmVxdWlyZVxuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy50ID0gZnVuY3Rpb24odmFsdWUsIG1vZGUpIHtcbiBcdFx0aWYobW9kZSAmIDEpIHZhbHVlID0gX193ZWJwYWNrX3JlcXVpcmVfXyh2YWx1ZSk7XG4gXHRcdGlmKG1vZGUgJiA4KSByZXR1cm4gdmFsdWU7XG4gXHRcdGlmKChtb2RlICYgNCkgJiYgdHlwZW9mIHZhbHVlID09PSAnb2JqZWN0JyAmJiB2YWx1ZSAmJiB2YWx1ZS5fX2VzTW9kdWxlKSByZXR1cm4gdmFsdWU7XG4gXHRcdHZhciBucyA9IE9iamVjdC5jcmVhdGUobnVsbCk7XG4gXHRcdF9fd2VicGFja19yZXF1aXJlX18ucihucyk7XG4gXHRcdE9iamVjdC5kZWZpbmVQcm9wZXJ0eShucywgJ2RlZmF1bHQnLCB7IGVudW1lcmFibGU6IHRydWUsIHZhbHVlOiB2YWx1ZSB9KTtcbiBcdFx0aWYobW9kZSAmIDIgJiYgdHlwZW9mIHZhbHVlICE9ICdzdHJpbmcnKSBmb3IodmFyIGtleSBpbiB2YWx1ZSkgX193ZWJwYWNrX3JlcXVpcmVfXy5kKG5zLCBrZXksIGZ1bmN0aW9uKGtleSkgeyByZXR1cm4gdmFsdWVba2V5XTsgfS5iaW5kKG51bGwsIGtleSkpO1xuIFx0XHRyZXR1cm4gbnM7XG4gXHR9O1xuXG4gXHQvLyBnZXREZWZhdWx0RXhwb3J0IGZ1bmN0aW9uIGZvciBjb21wYXRpYmlsaXR5IHdpdGggbm9uLWhhcm1vbnkgbW9kdWxlc1xuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5uID0gZnVuY3Rpb24obW9kdWxlKSB7XG4gXHRcdHZhciBnZXR0ZXIgPSBtb2R1bGUgJiYgbW9kdWxlLl9fZXNNb2R1bGUgP1xuIFx0XHRcdGZ1bmN0aW9uIGdldERlZmF1bHQoKSB7IHJldHVybiBtb2R1bGVbJ2RlZmF1bHQnXTsgfSA6XG4gXHRcdFx0ZnVuY3Rpb24gZ2V0TW9kdWxlRXhwb3J0cygpIHsgcmV0dXJuIG1vZHVsZTsgfTtcbiBcdFx0X193ZWJwYWNrX3JlcXVpcmVfXy5kKGdldHRlciwgJ2EnLCBnZXR0ZXIpO1xuIFx0XHRyZXR1cm4gZ2V0dGVyO1xuIFx0fTtcblxuIFx0Ly8gT2JqZWN0LnByb3RvdHlwZS5oYXNPd25Qcm9wZXJ0eS5jYWxsXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLm8gPSBmdW5jdGlvbihvYmplY3QsIHByb3BlcnR5KSB7IHJldHVybiBPYmplY3QucHJvdG90eXBlLmhhc093blByb3BlcnR5LmNhbGwob2JqZWN0LCBwcm9wZXJ0eSk7IH07XG5cbiBcdC8vIF9fd2VicGFja19wdWJsaWNfcGF0aF9fXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLnAgPSBcIlwiO1xuXG5cbiBcdC8vIExvYWQgZW50cnkgbW9kdWxlIGFuZCByZXR1cm4gZXhwb3J0c1xuIFx0cmV0dXJuIF9fd2VicGFja19yZXF1aXJlX18oX193ZWJwYWNrX3JlcXVpcmVfXy5zID0gXCIuL3RoZW1lL3NyYy9qcy9mb290ZXIuanNcIik7XG4iLCIvKiBmb3IgcmVzaXplIHRocm90dGxpbmcgKi8gXG52YXIgcmVzaXplSUQ7XG5cbi8vZW5kIHN0aWNreSBoZWFkZXJcblxudmFyIHNjcm9sbGluZ19lbGVtZW50ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI2NvbnRlbnQnKTtcbnNjcm9sbGluZ19lbGVtZW50LmFkZEV2ZW50TGlzdGVuZXIoJ3Njcm9sbCcsICgpID0+IHsgIFxuICAgIHZhciBuYXZiYXIgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcuc2l0ZWhlYWRlcicpOyAvL2xldCB0b3BzcGFjZSA9IG5hdmJhci5vZmZzZXRUb3AgO1xuICAgIHZhciBzdGlja3BvaW50ID0gMjA7XG4gICAgaWYgKHNjcm9sbGluZ19lbGVtZW50LnNjcm9sbFRvcCA+PSBzdGlja3BvaW50KSB7XG4gICAgICBuYXZiYXIuY2xhc3NMaXN0LmFkZChcInN0aWNreVwiKTtcbiAgICB9IGVsc2Uge1xuICAgICAgbmF2YmFyLmNsYXNzTGlzdC5yZW1vdmUoXCJzdGlja3lcIik7XG4gICAgfVxufSk7XG5cbmRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoJ0RPTUNvbnRlbnRMb2FkZWQnLCAoKSA9PiB7XG4gICAgd2luZG93LnBsYXllZCA9IFtdO1xuICAgIHdpbmRvdy5wbGF5T25jZSA9IGZ1bmN0aW9uKCBjYWxsZXIgKSB7XG4gICAgICAgIGlmKCEgd2luZG93LnBsYXllZC5pbmNsdWRlcyggY2FsbGVyICkgKXtcbiAgICAgICAgICAgIGNhbGxlci5wbGF5KCk7XG4gICAgICAgICAgICB3aW5kb3cucGxheWVkLnB1c2goIGNhbGxlciApO1xuICAgICAgICB9XG4gICAgfVxuXG4gICAgYWRkTW9iaWxlQ2xpY2soKTtcbiAgICBhZGRWaWRDbGljaygpO1xuICAgIGFkZExlYXJuTW9yZUNsaWNrKCk7XG4gICAgaWYod2luZG93LmlubmVyV2lkdGggPD0gNzY4KXtcbiAgICAgICAgbW9iaWxlbmF2VG9nZ2xlcigpO1xuICAgIH1cbn0pO1xuXG5mdW5jdGlvbiBhZGRMZWFybk1vcmVDbGljaygpe1xuICAgIGxldCBidXR0b25zID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnLmJ1dHRvbi5sZWFybm1vcmUnKTtcbiAgICBmb3IobGV0IGJ1dHRvbiBvZiBidXR0b25zKXtcbiAgICAgICAgYnV0dG9uLmFkZEV2ZW50TGlzdGVuZXIoICdjbGljaycsIChldmVudCkgPT4ge1xuICAgICAgICAgICAgbGV0IGNhcmQgPSBldmVudC50YXJnZXQuY2xvc2VzdCgnLmNhcmQnKTtcbiAgICAgICAgICAgIGxldCBidXR0b24gPSAoZXZlbnQudGFyZ2V0LmNsYXNzTGlzdC5jb250YWlucygnYnV0dG9uJykpID8gZXZlbnQudGFyZ2V0IDogZXZlbnQudGFyZ2V0LmNsb3Nlc3QoJy5idXR0b24nKTtcbiAgICAgICAgICAgIGxldCB0ZXh0ID0gY2FyZCA/IGNhcmQucXVlcnlTZWxlY3RvcignLmNhcmQtdGV4dCcpIDogZmFsc2U7XG4gICAgICAgICAgICBsZXQgYmcgPSBjYXJkID8gY2FyZC5xdWVyeVNlbGVjdG9yKCcuY2FyZC1iYWNrZ3JvdW5kJykgOiBmYWxzZTtcbiAgICAgICAgICAgIGxldCBidXR0b253cmFwID0gY2FyZCA/IGNhcmQucXVlcnlTZWxlY3RvcignLmJ1dHRvbndyYXAnKSA6IGZhbHNlO1xuICAgICAgICAgICAgY2FyZC5jbGFzc0xpc3QudG9nZ2xlKCdvcGVuJyk7XG4gICAgICAgICAgICBcbiAgICAgICAgICAgIGlmKGNhcmQgJiYgYmcgJiYgIWNhcmQuY2xhc3NMaXN0LmNvbnRhaW5zKCdvcGVuJykpIHtcbiAgICAgICAgICAgICAgYnV0dG9uLmlubmVyVGV4dCA9ICdMZWFybiBNb3JlJ1xuICAgICAgICAgICAgfSBlbHNlIHsgXG4gICAgICAgICAgICAgIGJ1dHRvbi5pbm5lclRleHQgPSAnQ29taW5nIFNvb24nXG4gICAgICAgICAgICB9XG4gICAgICAgIH0pXG4gICAgfVxuICAgIFxufVxuZXhwb3J0IGZ1bmN0aW9uIGRvUGxheShlKXtcbiAgICBpZihlLnRhcmdldC5wYXVzZWQgPT09IHRydWUpe1xuICAgICAgICBlLnRhcmdldC5wbGF5KCk7XG4gICAgfVxufVxuZnVuY3Rpb24gYWRkVmlkQ2xpY2soKXtcbiAgICBsZXQgdmlkZW9zPSBkb2N1bWVudC5nZXRFbGVtZW50c0J5Q2xhc3NOYW1lKCdjaHJvbWV2aWQnKTtcbiAgICBpZih2aWRlb3Mpe1xuICAgICAgICBmb3IobGV0IHZpZGVvIG9mIHZpZGVvcyl7XG4gICAgICAgICAgICB2aWRlby5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIChlKSA9PiB7XG4gICAgICAgICAgICAgICAgY29uc29sZS5sb2cod2luZG93KTtcbiAgICAgICAgICAgICAgICBjb25zb2xlLmxvZyh3aW5kb3cucGxheU9uY2UpO1xuICAgICAgICAgICAgICAgIHdpbmRvdy5wbGF5T25jZSggZS50YXJnZXQgKTtcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9XG4gICAgfVxufVxuXG5cbmZ1bmN0aW9uIGFkZE1vYmlsZUNsaWNrKCl7XG4gICAgbGV0IGhhbWJ1cmdlciA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdtb2JpbGVuYXZfYnV0dG9uJyk7XG4gICAgaWYoaGFtYnVyZ2VyKXtcbiAgICAgICAgaGFtYnVyZ2VyLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgKGUpPT57XG4gICAgICAgICAgICBsZXQgdGFyZ2V0ID0gZS50YXJnZXQuaWQgPT0gXCJtb2JpbGVuYXZfYnV0dG9uXCIgPyBlLnRhcmdldCA6IGUudGFyZ2V0LmNsb3Nlc3QoJyNtb2JpbGVuYXZfYnV0dG9uJyk7XG4gICAgICAgICAgICB0YXJnZXQuY2xhc3NMaXN0LnRvZ2dsZSgnYWN0aXZlJyk7XG4gICAgICAgICAgICBsZXQgaGFtYnVyZ2VyID0gdGFyZ2V0LnF1ZXJ5U2VsZWN0b3IoJy5idXJnZXIuYnVyZ2VyLXNxdWVlemUnKTtcbiAgICAgICAgICAgIGlmKGhhbWJ1cmdlcikgaGFtYnVyZ2VyLmNsYXNzTGlzdC50b2dnbGUoJ29wZW4nKTtcbiAgICAgICAgICAgIGxldCBib2R5ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignQk9EWScpO1xuICAgICAgICAgICAgaWYodGFyZ2V0LmNsYXNzTGlzdC5jb250YWlucygnYWN0aXZlJykpe1xuICAgICAgICAgICAgICAgIGJvZHkuc2V0QXR0cmlidXRlKCdzdHlsZScsICdvdmVyZmxvdzpoaWRkZW47b3ZlcmZsb3cteTogaGlkZGVuO292ZXJmbG93LXg6IGhpZGRlbicpO1xuICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICBib2R5LnJlbW92ZUF0dHJpYnV0ZSgnc3R5bGUnKTtcbiAgICAgICAgICAgIH1cbiAgICAgXG4gICAgICAgIH0pXG4gICAgfVxufVxuXG5cbmZ1bmN0aW9uIG1vYmlsZW5hdlRvZ2dsZXIoKXtcbiAgICBsZXQgbW9iaWxlVG9nZ2xlciA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoXCIuZm9vdGVyLW5hdiBoNVwiKTtcbiAgICBpZihtb2JpbGVUb2dnbGVyLmxlbmd0aCl7XG4gICAgICAgIG1vYmlsZVRvZ2dsZXIuZm9yRWFjaCgoYnV0dG9uKSA9PiB7XG4gICAgICAgICAgICBidXR0b24uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCAoZXZlbnQpID0+IHtcbiAgICAgICAgICAgICAgICB2YXIgdGFyZ2V0RWxlbWVudCA9IGV2ZW50LnRhcmdldCB8fCBldmVudC5zcmNFbGVtZW50O1xuICAgIFxuICAgICAgICAgICAgICAgIGxldCBmb290ZXJOYXYgPSB0YXJnZXRFbGVtZW50LmNsb3Nlc3QoXCIuZm9vdGVyLW5hdlwiKVxuICAgICAgICAgICAgICAgIGlmKGZvb3Rlck5hdi5jbGFzc0xpc3QuY29udGFpbnMoXCJvcGVuXCIpKXtcbiAgICAgICAgICAgICAgICAgICAgZm9vdGVyTmF2LmNsYXNzTGlzdC5yZW1vdmUoXCJvcGVuXCIpO1xuICAgICAgICAgICAgICAgIH1lbHNle1xuICAgICAgICAgICAgICAgICAgICBmb290ZXJOYXYuY2xhc3NMaXN0LmFkZChcIm9wZW5cIik7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH0pO1xuICAgIH1cbn1cblxuIl0sInNvdXJjZVJvb3QiOiIifQ==