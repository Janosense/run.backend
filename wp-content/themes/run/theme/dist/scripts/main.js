!(function () {
  "use strict";

  function W(t) {
    return (W = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (t) {
      return typeof t;
    } : function (t) {
      return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t;
    })(t);
  }

  var t = "function" == typeof Symbol && "symbol" === W(Symbol.iterator) ? function (t) {
    return W(t);
  } : function (t) {
    return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : W(t);
  }, e = window.device, i = {}, n = [];
  window.device = i;
  var s = window.document.documentElement, o = window.navigator.userAgent.toLowerCase(),
    l = ["googletv", "viera", "smarttv", "internet.tv", "netcast", "nettv", "appletv", "boxee", "kylo", "roku", "dlnadoc", "pov_tv", "hbbtv", "ce-html"];

  function r(t, e) {
    return -1 !== t.indexOf(e);
  }

  function a(t) {
    return r(o, t);
  }

  function c(t) {
    return s.className.match(new RegExp(t, "i"));
  }

  function h(t) {
    var e = null;
    c(t) || (e = s.className.replace(/^\s+|\s+$/g, ""), s.className = e + " " + t);
  }

  function d(t) {
    c(t) && (s.className = s.className.replace(" " + t, ""));
  }

  function u() {
    i.landscape() ? (d("portrait"), h("landscape"), p("landscape")) : (d("landscape"), h("portrait"), p("portrait")), v();
  }

  function p(t) {
    for (var e in n) n[e](t);
  }

  i.macos = function () {
    return a("mac");
  }, i.ios = function () {
    return i.iphone() || i.ipod() || i.ipad();
  }, i.iphone = function () {
    return !i.windows() && a("iphone");
  }, i.ipod = function () {
    return a("ipod");
  }, i.ipad = function () {
    return a("ipad");
  }, i.android = function () {
    return !i.windows() && a("android");
  }, i.androidPhone = function () {
    return i.android() && a("mobile");
  }, i.androidTablet = function () {
    return i.android() && !a("mobile");
  }, i.blackberry = function () {
    return a("blackberry") || a("bb10") || a("rim");
  }, i.blackberryPhone = function () {
    return i.blackberry() && !a("tablet");
  }, i.blackberryTablet = function () {
    return i.blackberry() && a("tablet");
  }, i.windows = function () {
    return a("windows");
  }, i.windowsPhone = function () {
    return i.windows() && a("phone");
  }, i.windowsTablet = function () {
    return i.windows() && a("touch") && !i.windowsPhone();
  }, i.fxos = function () {
    return (a("(mobile") || a("(tablet")) && a(" rv:");
  }, i.fxosPhone = function () {
    return i.fxos() && a("mobile");
  }, i.fxosTablet = function () {
    return i.fxos() && a("tablet");
  }, i.meego = function () {
    return a("meego");
  }, i.cordova = function () {
    return window.cordova && "file:" === location.protocol;
  }, i.nodeWebkit = function () {
    return "object" === t(window.process);
  }, i.mobile = function () {
    return i.androidPhone() || i.iphone() || i.ipod() || i.windowsPhone() || i.blackberryPhone() || i.fxosPhone() || i.meego();
  }, i.tablet = function () {
    return i.ipad() || i.androidTablet() || i.blackberryTablet() || i.windowsTablet() || i.fxosTablet();
  }, i.desktop = function () {
    return !i.tablet() && !i.mobile();
  }, i.television = function () {
    for (var t = 0; t < l.length;) {
      if (a(l[t])) return !0;
      t++;
    }
    return !1;
  }, i.portrait = function () {
    return screen.orientation && Object.prototype.hasOwnProperty.call(window, "onorientationchange") ? r(screen.orientation.type, "portrait") : i.ios() && Object.prototype.hasOwnProperty.call(window, "orientation") ? 90 !== Math.abs(window.orientation) : 1 < window.innerHeight / window.innerWidth;
  }, i.landscape = function () {
    return screen.orientation && Object.prototype.hasOwnProperty.call(window, "onorientationchange") ? r(screen.orientation.type, "landscape") : i.ios() && Object.prototype.hasOwnProperty.call(window, "orientation") ? 90 === Math.abs(window.orientation) : window.innerHeight / window.innerWidth < 1;
  }, i.noConflict = function () {
    return window.device = e, this;
  }, i.ios() ? i.ipad() ? h("ios ipad tablet") : i.iphone() ? h("ios iphone mobile") : i.ipod() && h("ios ipod mobile") : i.macos() ? h("macos desktop") : i.android() ? i.androidTablet() ? h("android tablet") : h("android mobile") : i.blackberry() ? i.blackberryTablet() ? h("blackberry tablet") : h("blackberry mobile") : i.windows() ? i.windowsTablet() ? h("windows tablet") : i.windowsPhone() ? h("windows mobile") : h("windows desktop") : i.fxos() ? i.fxosTablet() ? h("fxos tablet") : h("fxos mobile") : i.meego() ? h("meego mobile") : i.nodeWebkit() ? h("node-webkit") : i.television() ? h("television") : i.desktop() && h("desktop"), i.cordova() && h("cordova"), i.onChangeOrientation = function (t) {
    "function" == typeof t && n.push(t);
  };
  var g = "resize";

  function f(t) {
    for (var e = 0; e < t.length; e++) if (i[t[e]]()) return t[e];
    return "unknown";
  }

  function v() {
    i.orientation = f(["portrait", "landscape"]);
  }

  Object.prototype.hasOwnProperty.call(window, "onorientationchange") && (g = "orientationchange"), window.addEventListener ? window.addEventListener(g, u, !1) : window.attachEvent ? window.attachEvent(g, u) : window[g] = u, u(), i.type = f(["mobile", "tablet", "desktop"]), i.os = f(["ios", "iphone", "ipad", "ipod", "android", "blackberry", "macos", "windows", "fxos", "meego", "television"]), v();
  var m = {is_fixed: !1};
  "undefined" != typeof globalThis ? globalThis : "undefined" != typeof window ? window : "undefined" != typeof global ? global : "undefined" != typeof self && self;
  var y, b, w, x, S, T, k, E = (function (t, e) {
    t.exports = (function () {
      function e(t) {
        return (e = "function" == typeof Symbol && "symbol" == W(Symbol.iterator) ? function (t) {
          return W(t);
        } : function (t) {
          return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : W(t);
        })(t);
      }

      function o(t, e) {
        if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function");
      }

      function n(t, e) {
        for (var i = 0; i < e.length; i++) {
          var n = e[i];
          n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(t, n.key, n);
        }
      }

      function t(t, e, i) {
        return e && n(t.prototype, e), i && n(t, i), t;
      }

      function f(t) {
        return Math.sqrt(t.x * t.x + t.y * t.y);
      }

      var s = (function () {
        function e(t) {
          o(this, e), this.handlers = [], this.el = t;
        }

        return t(e, [{
          key: "add", value: function (t) {
            this.handlers.push(t);
          }
        }, {
          key: "del", value: function (t) {
            t || (this.handlers = []);
            for (var e = this.handlers.length; 0 <= e; e--) this.handlers[e] === t && this.handlers.splice(e, 1);
          }
        }, {
          key: "dispatch", value: function () {
            for (var t = 0, e = this.handlers.length; t < e; t++) {
              var i = this.handlers[t];
              "function" == typeof i && i.apply(this.el, arguments);
            }
          }
        }]), e;
      })();

      function l(t, e) {
        var i = new s(t);
        return i.add(e), i;
      }

      var q = (function () {
          function n(t, e) {
            o(this, n), this.element = "string" == typeof t ? document.querySelector(t) : t, this.start = this.start.bind(this), this.move = this.move.bind(this), this.end = this.end.bind(this), this.cancel = this.cancel.bind(this), this.element.addEventListener("touchstart", this.start, !1), this.element.addEventListener("touchmove", this.move, !1), this.element.addEventListener("touchend", this.end, !1), this.element.addEventListener("touchcancel", this.cancel, !1), this.preV = {
              x: null,
              y: null
            }, this.pinchStartLen = null, this.zoom = 1, this.isDoubleTap = !1;
            var i = function () {
            };
            this.rotate = l(this.element, e.rotate || i), this.touchStart = l(this.element, e.touchStart || i), this.multipointStart = l(this.element, e.multipointStart || i), this.multipointEnd = l(this.element, e.multipointEnd || i), this.pinch = l(this.element, e.pinch || i), this.swipe = l(this.element, e.swipe || i), this.tap = l(this.element, e.tap || i), this.doubleTap = l(this.element, e.doubleTap || i), this.longTap = l(this.element, e.longTap || i), this.singleTap = l(this.element, e.singleTap || i), this.pressMove = l(this.element, e.pressMove || i), this.twoFingerPressMove = l(this.element, e.twoFingerPressMove || i), this.touchMove = l(this.element, e.touchMove || i), this.touchEnd = l(this.element, e.touchEnd || i), this.touchCancel = l(this.element, e.touchCancel || i), this._cancelAllHandler = this.cancelAll.bind(this), window.addEventListener("scroll", this._cancelAllHandler), this.delta = null, this.last = null, this.now = null, this.tapTimeout = null, this.singleTapTimeout = null, this.longTapTimeout = null, this.swipeTimeout = null, this.x1 = this.x2 = this.y1 = this.y2 = null, this.preTapPosition = {
              x: null,
              y: null
            };
          }

          return t(n, [{
            key: "start", value: function (t) {
              if (t.touches) {
                this.now = Date.now(), this.x1 = t.touches[0].pageX, this.y1 = t.touches[0].pageY, this.delta = this.now - (this.last || this.now), this.touchStart.dispatch(t, this.element), null !== this.preTapPosition.x && (this.isDoubleTap = 0 < this.delta && this.delta <= 250 && Math.abs(this.preTapPosition.x - this.x1) < 30 && Math.abs(this.preTapPosition.y - this.y1) < 30, this.isDoubleTap && clearTimeout(this.singleTapTimeout)), this.preTapPosition.x = this.x1, this.preTapPosition.y = this.y1, this.last = this.now;
                var e = this.preV;
                if (1 < t.touches.length) {
                  this._cancelLongTap(), this._cancelSingleTap();
                  var i = {x: t.touches[1].pageX - this.x1, y: t.touches[1].pageY - this.y1};
                  e.x = i.x, e.y = i.y, this.pinchStartLen = f(e), this.multipointStart.dispatch(t, this.element);
                }
                this._preventTap = !1, this.longTapTimeout = setTimeout(function () {
                  this.longTap.dispatch(t, this.element), this._preventTap = !0;
                }.bind(this), 750);
              }
            }
          }, {
            key: "move", value: function (t) {
              if (t.touches) {
                var e = this.preV, i = t.touches.length, n = t.touches[0].pageX, s = t.touches[0].pageY;
                if (this.isDoubleTap = !1, 1 < i) {
                  var o = t.touches[1].pageX, l = t.touches[1].pageY,
                    r = {x: t.touches[1].pageX - n, y: t.touches[1].pageY - s};
                  null !== e.x && (0 < this.pinchStartLen && (t.zoom = f(r) / this.pinchStartLen, this.pinch.dispatch(t, this.element)), t.angle = (u = (function (t, e) {
                    var i = f(t) * f(e);
                    if (0 === i) return 0;
                    var n, s, o = (s = e, ((n = t).x * s.x + n.y * s.y) / i);
                    return 1 < o && (o = 1), Math.acos(o);
                  })(h = r, d = e), g = d, 0 < (p = h).x * g.y - g.x * p.y && (u *= -1), 180 * u / Math.PI), this.rotate.dispatch(t, this.element)), e.x = r.x, e.y = r.y, null !== this.x2 && null !== this.sx2 ? (t.deltaX = (n - this.x2 + o - this.sx2) / 2, t.deltaY = (s - this.y2 + l - this.sy2) / 2) : (t.deltaX = 0, t.deltaY = 0), this.twoFingerPressMove.dispatch(t, this.element), this.sx2 = o, this.sy2 = l;
                } else {
                  if (null !== this.x2) {
                    t.deltaX = n - this.x2, t.deltaY = s - this.y2;
                    var a = Math.abs(this.x1 - this.x2), c = Math.abs(this.y1 - this.y2);
                    (10 < a || 10 < c) && (this._preventTap = !0);
                  } else t.deltaX = 0, t.deltaY = 0;
                  this.pressMove.dispatch(t, this.element);
                }
                this.touchMove.dispatch(t, this.element), this._cancelLongTap(), this.x2 = n, this.y2 = s, 1 < i && t.preventDefault();
              }
              var h, d, u, p, g;
            }
          }, {
            key: "end", value: function (t) {
              if (t.changedTouches) {
                this._cancelLongTap();
                var e = this;
                t.touches.length < 2 && (this.multipointEnd.dispatch(t, this.element), this.sx2 = this.sy2 = null), this.x2 && 30 < Math.abs(this.x1 - this.x2) || this.y2 && 30 < Math.abs(this.y1 - this.y2) ? (t.direction = this._swipeDirection(this.x1, this.x2, this.y1, this.y2), this.swipeTimeout = setTimeout((function () {
                  e.swipe.dispatch(t, e.element);
                }), 0)) : (this.tapTimeout = setTimeout((function () {
                  e._preventTap || e.tap.dispatch(t, e.element), e.isDoubleTap && (e.doubleTap.dispatch(t, e.element), e.isDoubleTap = !1);
                }), 0), e.isDoubleTap || (e.singleTapTimeout = setTimeout((function () {
                  e.singleTap.dispatch(t, e.element);
                }), 250))), this.touchEnd.dispatch(t, this.element), this.preV.x = 0, this.preV.y = 0, this.zoom = 1, this.pinchStartLen = null, this.x1 = this.x2 = this.y1 = this.y2 = null;
              }
            }
          }, {
            key: "cancelAll", value: function () {
              this._preventTap = !0, clearTimeout(this.singleTapTimeout), clearTimeout(this.tapTimeout), clearTimeout(this.longTapTimeout), clearTimeout(this.swipeTimeout);
            }
          }, {
            key: "cancel", value: function (t) {
              this.cancelAll(), this.touchCancel.dispatch(t, this.element);
            }
          }, {
            key: "_cancelLongTap", value: function () {
              clearTimeout(this.longTapTimeout);
            }
          }, {
            key: "_cancelSingleTap", value: function () {
              clearTimeout(this.singleTapTimeout);
            }
          }, {
            key: "_swipeDirection", value: function (t, e, i, n) {
              return Math.abs(t - e) >= Math.abs(i - n) ? 0 < t - e ? "Left" : "Right" : 0 < i - n ? "Up" : "Down";
            }
          }, {
            key: "on", value: function (t, e) {
              this[t] && this[t].add(e);
            }
          }, {
            key: "off", value: function (t, e) {
              this[t] && this[t].del(e);
            }
          }, {
            key: "destroy", value: function () {
              return this.singleTapTimeout && clearTimeout(this.singleTapTimeout), this.tapTimeout && clearTimeout(this.tapTimeout), this.longTapTimeout && clearTimeout(this.longTapTimeout), this.swipeTimeout && clearTimeout(this.swipeTimeout), this.element.removeEventListener("touchstart", this.start), this.element.removeEventListener("touchmove", this.move), this.element.removeEventListener("touchend", this.end), this.element.removeEventListener("touchcancel", this.cancel), this.rotate.del(), this.touchStart.del(), this.multipointStart.del(), this.multipointEnd.del(), this.pinch.del(), this.swipe.del(), this.tap.del(), this.doubleTap.del(), this.longTap.del(), this.singleTap.del(), this.pressMove.del(), this.twoFingerPressMove.del(), this.touchMove.del(), this.touchEnd.del(), this.touchCancel.del(), this.preV = this.pinchStartLen = this.zoom = this.isDoubleTap = this.delta = this.last = this.now = this.tapTimeout = this.singleTapTimeout = this.longTapTimeout = this.swipeTimeout = this.x1 = this.x2 = this.y1 = this.y2 = this.preTapPosition = this.rotate = this.touchStart = this.multipointStart = this.multipointEnd = this.pinch = this.swipe = this.tap = this.doubleTap = this.longTap = this.singleTap = this.pressMove = this.touchMove = this.touchEnd = this.touchCancel = this.twoFingerPressMove = null, window.removeEventListener("scroll", this._cancelAllHandler), null;
            }
          }]), n;
        })(), b = (function () {
          function s(t, e) {
            var i = this, n = 2 < arguments.length && void 0 !== arguments[2] ? arguments[2] : null;
            if (o(this, s), this.img = t, this.slide = e, this.onclose = n, this.img.setZoomEvents) return !1;
            this.active = !1, this.zoomedIn = !1, this.dragging = !1, this.currentX = null, this.currentY = null, this.initialX = null, this.initialY = null, this.xOffset = 0, this.yOffset = 0, this.img.addEventListener("mousedown", (function (t) {
              return i.dragStart(t);
            }), !1), this.img.addEventListener("mouseup", (function (t) {
              return i.dragEnd(t);
            }), !1), this.img.addEventListener("mousemove", (function (t) {
              return i.drag(t);
            }), !1), this.img.addEventListener("click", (function (t) {
              if (!i.zoomedIn) return i.zoomIn();
              i.zoomedIn && !i.dragging && i.zoomOut();
            }), !1), this.img.setZoomEvents = !0;
          }

          return t(s, [{
            key: "zoomIn", value: function () {
              var t = this.widowWidth();
              if (!(this.zoomedIn || t <= 768)) {
                var e = this.img;
                if (e.setAttribute("data-style", e.getAttribute("style")), e.style.maxWidth = e.naturalWidth + "px", e.style.maxHeight = e.naturalHeight + "px", e.naturalWidth > t) {
                  var i = t / 2 - e.naturalWidth / 2;
                  this.setTranslate(this.img.parentNode, i, 0);
                }
                this.slide.classList.add("zoomed"), this.zoomedIn = !0;
              }
            }
          }, {
            key: "zoomOut", value: function () {
              this.img.parentNode.setAttribute("style", ""), this.img.setAttribute("style", this.img.getAttribute("data-style")), this.slide.classList.remove("zoomed"), this.zoomedIn = !1, this.currentX = null, this.currentY = null, this.initialX = null, this.initialY = null, this.xOffset = 0, this.yOffset = 0, this.onclose && "function" == typeof this.onclose && this.onclose();
            }
          }, {
            key: "dragStart", value: function (t) {
              t.preventDefault(), this.zoomedIn ? ("touchstart" === t.type ? (this.initialX = t.touches[0].clientX - this.xOffset, this.initialY = t.touches[0].clientY - this.yOffset) : (this.initialX = t.clientX - this.xOffset, this.initialY = t.clientY - this.yOffset), t.target === this.img && (this.active = !0, this.img.classList.add("dragging"))) : this.active = !1;
            }
          }, {
            key: "dragEnd", value: function (t) {
              var e = this;
              t.preventDefault(), this.initialX = this.currentX, this.initialY = this.currentY, this.active = !1, setTimeout((function () {
                e.dragging = !1, e.img.isDragging = !1, e.img.classList.remove("dragging");
              }), 100);
            }
          }, {
            key: "drag", value: function (t) {
              this.active && (t.preventDefault(), "touchmove" === t.type ? (this.currentX = t.touches[0].clientX - this.initialX, this.currentY = t.touches[0].clientY - this.initialY) : (this.currentX = t.clientX - this.initialX, this.currentY = t.clientY - this.initialY), this.xOffset = this.currentX, this.yOffset = this.currentY, this.img.isDragging = !0, this.dragging = !0, this.setTranslate(this.img, this.currentX, this.currentY));
            }
          }, {
            key: "onMove", value: function (t) {
              if (this.zoomedIn) {
                var e = t.clientX - this.img.naturalWidth / 2, i = t.clientY - this.img.naturalHeight / 2;
                this.setTranslate(this.img, e, i);
              }
            }
          }, {
            key: "setTranslate", value: function (t, e, i) {
              t.style.transform = "translate3d(" + e + "px, " + i + "px, 0)";
            }
          }, {
            key: "widowWidth", value: function () {
              return window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
            }
          }]), s;
        })(),
        w = navigator.userAgent.match(/(iPad)|(iPhone)|(iPod)|(Android)|(PlayBook)|(BB10)|(BlackBerry)|(Opera Mini)|(IEMobile)|(webOS)|(MeeGo)/i),
        r = null !== w || void 0 !== document.createTouch || "ontouchstart" in window || "onmsgesturechange" in window || navigator.msMaxTouchPoints,
        a = document.getElementsByTagName("html")[0], c = (function () {
          var t, e = document.createElement("fakeelement"), i = {
            transition: "transitionend",
            OTransition: "oTransitionEnd",
            MozTransition: "transitionend",
            WebkitTransition: "webkitTransitionEnd"
          };
          for (t in i) if (void 0 !== e.style[t]) return i[t];
        })(), h = (function () {
          var t, e = document.createElement("fakeelement"), i = {
            animation: "animationend",
            OAnimation: "oAnimationEnd",
            MozAnimation: "animationend",
            WebkitAnimation: "webkitAnimationEnd"
          };
          for (t in i) if (void 0 !== e.style[t]) return i[t];
        })(), d = Date.now(), x = {}, i = {
          selector: ".glightbox",
          elements: null,
          skin: "clean",
          closeButton: !0,
          startAt: null,
          autoplayVideos: !0,
          descPosition: "bottom",
          width: "900px",
          height: "506px",
          videosWidth: "960px",
          beforeSlideChange: null,
          afterSlideChange: null,
          beforeSlideLoad: null,
          afterSlideLoad: null,
          onOpen: null,
          onClose: null,
          loop: !1,
          touchNavigation: !0,
          touchFollowAxis: !0,
          keyboardNavigation: !0,
          closeOnOutsideClick: !0,
          plyr: {
            css: "https://cdn.plyr.io/3.5.6/plyr.css",
            js: "https://cdn.plyr.io/3.5.6/plyr.js",
            config: {
              ratio: "16:9",
              youtube: {noCookie: !0, rel: 0, showinfo: 0, iv_load_policy: 3},
              vimeo: {byline: !1, portrait: !1, title: !1, transparent: !1}
            }
          },
          openEffect: "zoomIn",
          closeEffect: "zoomOut",
          slideEffect: "slide",
          moreText: "See more",
          moreLength: 60,
          lightboxHtml: "",
          cssEfects: {
            fade: {in: "fadeIn", out: "fadeOut"},
            zoom: {in: "zoomIn", out: "zoomOut"},
            slide: {in: "slideInRight", out: "slideOutLeft"},
            slide_back: {in: "slideInLeft", out: "slideOutRight"}
          },
          svg: {
            close: '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><g><g><path d="M505.943,6.058c-8.077-8.077-21.172-8.077-29.249,0L6.058,476.693c-8.077,8.077-8.077,21.172,0,29.249C10.096,509.982,15.39,512,20.683,512c5.293,0,10.586-2.019,14.625-6.059L505.943,35.306C514.019,27.23,514.019,14.135,505.943,6.058z"/></g></g><g><g><path d="M505.942,476.694L35.306,6.059c-8.076-8.077-21.172-8.077-29.248,0c-8.077,8.076-8.077,21.171,0,29.248l470.636,470.636c4.038,4.039,9.332,6.058,14.625,6.058c5.293,0,10.587-2.019,14.624-6.057C514.018,497.866,514.018,484.771,505.942,476.694z"/></g></g></svg>',
            next: '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.175 477.175" xml:space="preserve"> <g><path d="M360.731,229.075l-225.1-225.1c-5.3-5.3-13.8-5.3-19.1,0s-5.3,13.8,0,19.1l215.5,215.5l-215.5,215.5c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-4l225.1-225.1C365.931,242.875,365.931,234.275,360.731,229.075z"/></g></svg>',
            prev: '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.175 477.175" xml:space="preserve"><g><path d="M145.188,238.575l215.5-215.5c5.3-5.3,5.3-13.8,0-19.1s-13.8-5.3-19.1,0l-225.1,225.1c-5.3,5.3-5.3,13.8,0,19.1l225.1,225c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4c5.3-5.3,5.3-13.8,0-19.1L145.188,238.575z"/></g></svg>'
          }
        };

      function u() {
        var i = {}, n = !0, t = 0, e = arguments.length;
        "[object Boolean]" === Object.prototype.toString.call(arguments[0]) && (n = arguments[0], t++);
        for (var s = function (t) {
          for (var e in t) Object.prototype.hasOwnProperty.call(t, e) && (n && "[object Object]" === Object.prototype.toString.call(t[e]) ? i[e] = u(!0, i[e], t[e]) : i[e] = t[e]);
        }; t < e; t++) s(arguments[t]);
        return i;
      }

      i.slideHtml = '<div class="gslide">\n    <div class="gslide-inner-content">\n        <div class="ginner-container">\n            <div class="gslide-media">\n            </div>\n            <div class="gslide-description">\n                <div class="gdesc-inner">\n                    <h4 class="gslide-title"></h4>\n                    <div class="gslide-desc"></div>\n                </div>\n            </div>\n        </div>\n    </div>\n</div>', i.lightboxHtml = '<div id="glightbox-body" class="glightbox-container">\n    <div class="gloader visible"></div>\n    <div class="goverlay"></div>\n    <div class="gcontainer">\n    <div id="glightbox-slider" class="gslider"></div>\n    <button class="gnext gbtn" tabindex="0">{nextSVG}</button>\n    <button class="gprev gbtn" tabindex="1">{prevSVG}</button>\n    <button class="gclose gbtn" tabindex="2">{closeSVG}</button>\n</div>\n</div>';
      var S = {
        isFunction: function (t) {
          return "function" == typeof t;
        }, isString: function (t) {
          return "string" == typeof t;
        }, isNode: function (t) {
          return !(!t || !t.nodeType || 1 != t.nodeType);
        }, isArray: function (t) {
          return Array.isArray(t);
        }, isArrayLike: function (t) {
          return t && t.length && isFinite(t.length);
        }, isObject: function (t) {
          return "object" === e(t) && null != t && !S.isFunction(t) && !S.isArray(t);
        }, isNil: function (t) {
          return null == t;
        }, has: function (t, e) {
          return null !== t && hasOwnProperty.call(t, e);
        }, size: function (t) {
          if (S.isObject(t)) {
            if (t.keys) return t.keys().length;
            var e = 0;
            for (var i in t) S.has(t, i) && e++;
            return e;
          }
          return t.length;
        }, isNumber: function (t) {
          return !isNaN(parseFloat(t)) && isFinite(t);
        }
      };

      function p(t, e) {
        if ((S.isNode(t) || t === window || t === document) && (t = [t]), S.isArrayLike(t) || S.isObject(t) || (t = [t]), 0 != S.size(t)) if (S.isArrayLike(t) && !S.isObject(t)) for (var i = t.length, n = 0; n < i && !1 !== e.call(t[n], t[n], n, t); n++) ; else if (S.isObject(t)) for (var s in t) if (S.has(t, s) && !1 === e.call(t[s], t[s], s, t)) break;
      }

      function g(t) {
        var i = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : null,
          n = 2 < arguments.length && void 0 !== arguments[2] ? arguments[2] : null, e = t[d] = t[d] || [],
          s = {all: e, evt: null, found: null};
        return i && n && 0 < S.size(e) && p(e, (function (t, e) {
          if (t.eventName == i && t.fn.toString() == n.toString()) return s.found = !0, s.evt = e, !1;
        })), s;
      }

      function T(i) {
        var t = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : {}, e = t.onElement,
          n = t.withCallback, s = t.avoidDuplicate, o = void 0 === s || s, l = t.once, r = void 0 !== l && l,
          a = t.useCapture, c = void 0 !== a && a, h = 2 < arguments.length ? arguments[2] : void 0, d = e || [];

        function u(t) {
          S.isFunction(n) && n.call(h, t, this), r && u.destroy();
        }

        return S.isString(d) && (d = document.querySelectorAll(d)), u.destroy = function () {
          p(d, (function (t) {
            var e = g(t, i, u);
            e.found && e.all.splice(e.evt, 1), t.removeEventListener && t.removeEventListener(i, u, c);
          }));
        }, p(d, (function (t) {
          var e = g(t, i, u);
          (t.addEventListener && o && !e.found || !o) && (t.addEventListener(i, u, c), e.all.push({
            eventName: i,
            fn: u
          }));
        })), u;
      }

      function z(e, t) {
        p(t.split(" "), (function (t) {
          return e.classList.add(t);
        }));
      }

      function P(e, t) {
        p(t.split(" "), (function (t) {
          return e.classList.remove(t);
        }));
      }

      function I(t, e) {
        return t.classList.contains(e);
      }

      function v(e) {
        var t = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : "",
          i = 2 < arguments.length && void 0 !== arguments[2] && arguments[2];
        if (!e || "" === t) return !1;
        if ("none" == t) return S.isFunction(i) && i(), !1;
        var n = t.split(" ");
        p(n, (function (t) {
          z(e, "g" + t);
        })), T(h, {
          onElement: e, avoidDuplicate: !1, once: !0, withCallback: function (t, e) {
            p(n, (function (t) {
              P(e, "g" + t);
            })), S.isFunction(i) && i();
          }
        });
      }

      function k(t) {
        var e = document.createDocumentFragment(), i = document.createElement("div");
        for (i.innerHTML = t; i.firstChild;) e.appendChild(i.firstChild);
        return e;
      }

      function D(t, e) {
        for (; t !== document.body;) if ("function" == typeof (t = t.parentElement).matches ? t.matches(e) : t.msMatchesSelector(e)) return t;
      }

      function m(t) {
        t.style.display = "block";
      }

      function y(t) {
        t.style.display = "none";
      }

      function Y() {
        return {
          width: window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth,
          height: window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight
        };
      }

      function E(t) {
        if (I(t.target, "plyr--html5")) {
          var e = D(t.target, ".gslide-media");
          "enterfullscreen" == t.type && z(e, "fullscreen"), "exitfullscreen" == t.type && P(e, "fullscreen");
        }
      }

      function A(t) {
        return S.isNumber(t) ? "".concat(t, "px") : t;
      }

      function C(t, e) {
        var i = "video" == t.type ? A(e.videosWidth) : A(e.width), n = A(e.height);
        return t.width = S.has(t, "width") && "" !== t.width ? A(t.width) : i, t.height = S.has(t, "height") && "" !== t.height ? A(t.height) : n, t;
      }

      var L = function () {
        var n = 0 < arguments.length && void 0 !== arguments[0] ? arguments[0] : null,
          s = 1 < arguments.length ? arguments[1] : void 0, l = {
            href: "",
            title: "",
            type: "",
            description: "",
            descPosition: s.descPosition,
            effect: "",
            width: "",
            height: "",
            node: n,
            content: !1
          };
        if (S.isObject(n) && !S.isNode(n)) {
          S.has(n, "type") || (S.has(n, "content") && n.content ? n.type = "inline" : S.has(n, "href") && (n.type = _(n.href)));
          var t = u(l, n);
          return C(t, s), t;
        }
        var e = "", r = n.getAttribute("data-glightbox"), i = n.nodeName.toLowerCase();
        if ("a" === i && (e = n.href), "img" === i && (e = n.src), l.href = e, p(l, (function (t, e) {
          S.has(s, e) && "width" !== e && (l[e] = s[e]);
          var i = n.dataset[e];
          S.isNil(i) || (l[e] = i);
        })), l.content && (l.type = "inline"), !l.type && e && (l.type = _(e)), S.isNil(r)) {
          if ("a" == i) {
            var o = n.title;
            S.isNil(o) || "" === o || (l.title = o);
          }
          if ("img" == i) {
            var a = n.alt;
            S.isNil(a) || "" === a || (l.title = a);
          }
          var c = n.getAttribute("data-description");
          S.isNil(c) || "" === c || (l.description = c);
        } else {
          var h = [];
          p(l, (function (t, e) {
            h.push(";\\s?" + e);
          })), h = h.join("\\s?:|"), "" !== r.trim() && p(l, (function (t, e) {
            var i = r, n = new RegExp("s?" + e + "s?:s?(.*?)(" + h + "s?:|$)"), s = i.match(n);
            if (s && s.length && s[1]) {
              var o = s[1].trim().replace(/;\s*$/, "");
              l[e] = o;
            }
          }));
        }
        if (l.description && "." == l.description.substring(0, 1) && document.querySelector(l.description)) l.description = document.querySelector(l.description).innerHTML; else {
          var d = n.querySelector(".glightbox-desc");
          d && (l.description = d.innerHTML);
        }
        return C(l, s), l;
      }, O = function () {
        var t = this, e = 0 < arguments.length && void 0 !== arguments[0] ? arguments[0] : null,
          i = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : {},
          n = 2 < arguments.length && void 0 !== arguments[2] && arguments[2];
        if (I(e, "loaded")) return !1;
        S.isFunction(this.settings.beforeSlideLoad) && this.settings.beforeSlideLoad(e, i);
        var s, o, l, r, a, c, h = i.type, d = i.descPosition, u = e.querySelector(".gslide-media"),
          p = e.querySelector(".gslide-title"), g = e.querySelector(".gslide-desc"),
          f = e.querySelector(".gdesc-inner"), v = n;
        if (S.isFunction(this.settings.afterSlideLoad) && (v = function () {
          S.isFunction(n) && n(), t.settings.afterSlideLoad(e, i);
        }), "" == i.title && "" == i.description ? f && f.parentNode.parentNode.removeChild(f.parentNode) : (p && "" !== i.title ? p.innerHTML = i.title : p.parentNode.removeChild(p), g && "" !== i.description ? w && 0 < this.settings.moreLength ? (i.smallDescription = (function (t) {
          var e = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : 50,
            i = 2 < arguments.length && void 0 !== arguments[2] && arguments[2], n = i;
          if ((t = t.trim()).length <= e) return t;
          var s = t.substr(0, e - 1);
          return n ? s + '... <a href="#" class="desc-more">' + i + "</a>" : s;
        })(i.description, this.settings.moreLength, this.settings.moreText), g.innerHTML = i.smallDescription, function o(t, l) {
          var e = t.querySelector(".desc-more");
          if (!e) return !1;
          T("click", {
            onElement: e, withCallback: function (t, e) {
              t.preventDefault();
              var i = document.body, n = D(e, ".gslide-desc");
              if (!n) return !1;
              n.innerHTML = l.description, z(i, "gdesc-open");
              var s = T("click", {
                onElement: [i, D(n, ".gslide-description")], withCallback: function (t, e) {
                  "a" !== t.target.nodeName.toLowerCase() && (P(i, "gdesc-open"), z(i, "gdesc-closed"), n.innerHTML = l.smallDescription, o(n, l), setTimeout((function () {
                    P(i, "gdesc-closed");
                  }), 400), s.destroy());
                }
              });
            }
          });
        }.apply(this, [g, i])) : g.innerHTML = i.description : g.parentNode.removeChild(g), z(u.parentNode, "desc-".concat(d)), z(f.parentNode, "description-".concat(d))), z(u, "gslide-".concat(h)), z(e, "loaded"), "video" === h) return z(u.parentNode, "gvideo-container"), u.insertBefore(k('<div class="gvideo-wrapper"></div>'), u.firstChild), void function (t, d, u) {
          var p = this, g = "gvideo" + d.index, f = t.querySelector(".gvideo-wrapper");
          N(this.settings.plyr.css);
          var v = d.href, e = location.protocol.replace(":", ""), m = "", y = "", b = !1;
          "file" == e && (e = "http"), f.parentNode.style.maxWidth = d.width, N(this.settings.plyr.js, "Plyr", (function () {
            if (v.match(/vimeo\.com\/([0-9]*)/)) {
              var t = /vimeo.*\/(\d+)/i.exec(v);
              m = "vimeo", y = t[1];
            }
            if (v.match(/(youtube\.com|youtube-nocookie\.com)\/watch\?v=([a-zA-Z0-9\-_]+)/) || v.match(/youtu\.be\/([a-zA-Z0-9\-_]+)/) || v.match(/(youtube\.com|youtube-nocookie\.com)\/embed\/([a-zA-Z0-9\-_]+)/)) {
              var e = void 0 !== (i = (i = v).replace(/(>|<)/gi, "").split(/(vi\/|v=|\/v\/|youtu\.be\/|\/embed\/)/))[2] ? i[2].split(/[^0-9a-z_\-]/i)[0] : i;
              m = "youtube", y = e;
            }
            var i;
            if (null !== v.match(/\.(mp4|ogg|webm|mov)$/)) {
              m = "local";
              var n = '<video id="' + g + '" ';
              n += 'style="background:#000; max-width: '.concat(d.width, ';" '), n += 'preload="metadata" ', n += 'x-webkit-airplay="allow" ', n += 'webkit-playsinline="" ', n += "controls ", n += 'class="gvideo-local">';
              var s = v.toLowerCase().split(".").pop(), o = {mp4: "", ogg: "", webm: ""};
              for (var l in o[s = "mov" == s ? "mp4" : s] = v, o) if (o.hasOwnProperty(l)) {
                var r = o[l];
                d.hasOwnProperty(l) && (r = d[l]), "" !== r && (n += '<source src="'.concat(r, '" type="video/').concat(l, '">'));
              }
              b = k(n += "</video>");
            }
            var a = b || k('<div id="'.concat(g, '" data-plyr-provider="').concat(m, '" data-plyr-embed-id="').concat(y, '"></div>'));
            z(f, "".concat(m, "-video gvideo")), f.appendChild(a), f.setAttribute("data-id", g);
            var c = S.has(p.settings.plyr, "config") ? p.settings.plyr.config : {}, h = new Plyr("#" + g, c);
            h.on("ready", (function (t) {
              var e = t.detail.plyr;
              x[g] = e, S.isFunction(u) && u();
            })), h.on("enterfullscreen", E), h.on("exitfullscreen", E);
          }));
        }.apply(this, [e, i, v]);
        if ("external" === h) {
          var m = (s = {
            url: i.href,
            callback: v
          }, o = s.url, l = s.allow, r = s.callback, a = s.appendTo, (c = document.createElement("iframe")).className = "vimeo-video gvideo", c.src = o, c.style.width = "100%", c.style.height = "100%", l && c.setAttribute("allow", l), c.onload = function () {
            z(c, "node-ready"), S.isFunction(r) && r();
          }, a && a.appendChild(c), c);
          return u.parentNode.style.maxWidth = i.width, u.parentNode.style.height = i.height, void u.appendChild(m);
        }
        if ("inline" !== h) {
          if ("image" === h) {
            var y = new Image;
            return y.addEventListener("load", (function () {
              !w && y.naturalWidth > y.offsetWidth && (z(y, "zoomable"), new b(y, e, function () {
                t.resize(e);
              })), S.isFunction(v) && v();
            }), !1), y.src = i.href, void u.insertBefore(y, u.firstChild);
          }
          S.isFunction(v) && v();
        } else (function (t, e, i) {
          var n, s = this, o = t.querySelector(".gslide-media"),
            l = !(!S.has(e, "href") || !e.href) && e.href.split("#").pop().trim(),
            r = !(!S.has(e, "content") || !e.content) && e.content;
          if (r && (S.isString(r) && (n = k('<div class="ginlined-content">'.concat(r, "</div>"))), S.isNode(r))) {
            "none" == r.style.display && (r.style.display = "block");
            var a = document.createElement("div");
            a.className = "ginlined-content", a.appendChild(r), n = a;
          }
          if (l) {
            var c = document.getElementById(l);
            if (!c) return !1;
            var h = c.cloneNode(!0);
            h.style.height = e.height, h.style.maxWidth = e.width, z(h, "ginlined-content"), n = h;
          }
          if (!n) return !1;
          o.style.height = e.height, o.style.width = e.width, o.appendChild(n), this.events["inlineclose" + l] = T("click", {
            onElement: o.querySelectorAll(".gtrigger-close"),
            withCallback: function (t) {
              t.preventDefault(), s.close();
            }
          }), S.isFunction(i) && i();
        }).apply(this, [e, i, v]);
      };

      function N(t, e, i) {
        if (S.isNil(t)) ; else {
          var n;
          if (S.isFunction(e) && (i = e, e = !1), -1 !== t.indexOf(".css")) {
            if ((n = document.querySelectorAll('link[href="' + t + '"]')) && 0 < n.length) return void (S.isFunction(i) && i());
            var s = document.getElementsByTagName("head")[0], o = s.querySelectorAll('link[rel="stylesheet"]'),
              l = document.createElement("link");
            return l.rel = "stylesheet", l.type = "text/css", l.href = t, l.media = "all", o ? s.insertBefore(l, o[0]) : s.appendChild(l), void (S.isFunction(i) && i());
          }
          if ((n = document.querySelectorAll('script[src="' + t + '"]')) && 0 < n.length) {
            if (S.isFunction(i)) {
              if (S.isString(e)) return M((function () {
                return void 0 !== window[e];
              }), (function () {
                i();
              })), !1;
              i();
            }
          } else {
            var r = document.createElement("script");
            r.type = "text/javascript", r.src = t, r.onload = function () {
              if (S.isFunction(i)) {
                if (S.isString(e)) return M((function () {
                  return void 0 !== window[e];
                }), (function () {
                  i();
                })), !1;
                i();
              }
            }, document.body.appendChild(r);
          }
        }
      }

      function M(t, e, i, n) {
        if (t()) e(); else {
          var s;
          i || (i = 100);
          var o = setInterval((function () {
            t() && (clearInterval(o), s && clearTimeout(s), e());
          }), i);
          n && (s = setTimeout((function () {
            clearInterval(o);
          }), n));
        }
      }

      var _ = function (t) {
        var e = t;
        return null !== (t = t.toLowerCase()).match(/\.(jpeg|jpg|jpe|gif|png|apn|webp|svg)$/) ? "image" : t.match(/(youtube\.com|youtube-nocookie\.com)\/watch\?v=([a-zA-Z0-9\-_]+)/) || t.match(/youtu\.be\/([a-zA-Z0-9\-_]+)/) || t.match(/(youtube\.com|youtube-nocookie\.com)\/embed\/([a-zA-Z0-9\-_]+)/) ? "video" : t.match(/vimeo\.com\/([0-9]*)/) ? "video" : null !== t.match(/\.(mp4|ogg|webm|mov)$/) ? "video" : -1 < t.indexOf("#") && "" !== e.split("#").pop().trim() ? "inline" : t.includes("gajax=true") ? "ajax" : "external";
      };

      function X() {
        var d = this;
        if (this.events.hasOwnProperty("keyboard")) return !1;
        this.events.keyboard = T("keydown", {
          onElement: window, withCallback: function (t, e) {
            var i, n = (t = t || window.event).keyCode;
            if (9 == n) {
              var s = !(!document.activeElement || !document.activeElement.nodeName) && document.activeElement.nodeName.toLocaleLowerCase();
              if ("input" == s || "textarea" == s || "button" == s) return;
              t.preventDefault();
              var o = document.querySelectorAll(".gbtn");
              if (!o || o.length <= 0) return;
              var l = (i = o, (function (t) {
                if (Array.isArray(t)) {
                  for (var e = 0, i = new Array(t.length); e < t.length; e++) i[e] = t[e];
                  return i;
                }
              })(i) || (function (t) {
                if (Symbol.iterator in Object(t) || "[object Arguments]" === Object.prototype.toString.call(t)) return Array.from(t);
              })(i) || (function () {
                throw new TypeError("Invalid attempt to spread non-iterable instance");
              })()).filter((function (t) {
                return I(t, "focused");
              }));
              if (!l.length) {
                var r = document.querySelector('.gbtn[tabindex="0"]');
                return void (r && (r.focus(), z(r, "focused")));
              }
              o.forEach((function (t) {
                return P(t, "focused");
              }));
              var a = l[0].getAttribute("tabindex");
              a = a || "0";
              var c = parseInt(a) + 1;
              c > o.length - 1 && (c = "0");
              var h = document.querySelector('.gbtn[tabindex="'.concat(c, '"]'));
              h && (h.focus(), z(h, "focused"));
            }
            39 == n && d.nextSlide(), 37 == n && d.prevSlide(), 27 == n && d.close();
          }
        });
      }

      function B(t) {
        var e = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : "";
        if ("" == e) return t.style.webkitTransform = "", t.style.MozTransform = "", t.style.msTransform = "", t.style.OTransform = "", t.style.transform = "", !1;
        t.style.webkitTransform = e, t.style.MozTransform = e, t.style.msTransform = e, t.style.OTransform = e, t.style.transform = e;
      }

      function j(t) {
        var i = I(t, "gslide-media") ? t : t.querySelector(".gslide-media"), e = t.querySelector(".gslide-description");
        z(i, "greset"), B(i, "translate3d(0, 0, 0)"), T(c, {
          onElement: i, once: !0, withCallback: function (t, e) {
            P(i, "greset");
          }
        }), i.style.opacity = "", e && (e.style.opacity = "");
      }

      var F = (function () {
        function e() {
          var t = 0 < arguments.length && void 0 !== arguments[0] ? arguments[0] : {};
          o(this, e), this.settings = u(i, t), this.effectsClasses = this.getAnimationClasses(), this.slidesData = {};
        }

        return t(e, [{
          key: "init", value: function () {
            var i = this;
            this.baseEvents = T("click", {
              onElement: this.getSelector(), withCallback: function (t, e) {
                t.preventDefault(), i.open(e);
              }
            });
          }
        }, {
          key: "open", value: function () {
            var t = 0 < arguments.length && void 0 !== arguments[0] ? arguments[0] : null,
              e = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : null;
            if (this.elements = this.getElements(t), 0 == this.elements.length) return !1;
            this.activeSlide = null, this.prevActiveSlideIndex = null, this.prevActiveSlide = null;
            var i = e || this.settings.startAt;
            t && S.isNil(i) && (i = this.elements.indexOf(t)) < 0 && (i = 0), S.isNil(i) && (i = 0), this.build(), v(this.overlay, "none" == this.settings.openEffect ? "none" : this.settings.cssEfects.fade.in);
            var n = document.body, s = window.innerWidth - document.documentElement.clientWidth;
            if (0 < s) {
              var o = document.createElement("style");
              o.type = "text/css", o.className = "gcss-styles", o.innerText = ".gscrollbar-fixer {margin-right: ".concat(s, "px}"), document.head.appendChild(o), z(n, "gscrollbar-fixer");
            }
            if (z(n, "glightbox-open"), z(a, "glightbox-open"), w && (z(document.body, "glightbox-mobile"), this.settings.slideEffect = "slide"), this.showSlide(i, !0), 1 == this.elements.length ? (y(this.prevButton), y(this.nextButton)) : (m(this.prevButton), m(this.nextButton)), this.lightboxOpen = !0, S.isFunction(this.settings.onOpen) && this.settings.onOpen(), w && r && this.settings.touchNavigation) return function () {
              var r = this;
              if (this.events.hasOwnProperty("touch")) return !1;
              var a, c, h, t = Y(), d = t.width, u = t.height, p = !1, e = null, g = null, f = null, v = !1, i = 1,
                s = 1, m = !1, y = !1, o = null, l = null, b = null, w = null, x = 0, S = 0, T = !1, k = !1, E = {},
                A = {}, C = 0, L = 0, n = this, O = document.getElementById("glightbox-slider"),
                N = document.querySelector(".goverlay"), M = (this.loop(), new q(O, {
                  touchStart: function (t) {
                    if (I(t.targetTouches[0].target, "ginner-container") || D(t.targetTouches[0].target, ".gslide-desc")) return p = !1;
                    p = !0, A = t.targetTouches[0], E.pageX = t.targetTouches[0].pageX, E.pageY = t.targetTouches[0].pageY, C = t.targetTouches[0].clientX, L = t.targetTouches[0].clientY, e = n.activeSlide, g = e.querySelector(".gslide-media"), h = e.querySelector(".gslide-inline"), f = null, I(g, "gslide-image") && (f = g.querySelector("img")), P(N, "greset");
                  }, touchMove: function (t) {
                    if (p && (A = t.targetTouches[0], !m && !y)) {
                      if (h && h.offsetHeight > u) {
                        var e = E.pageX - A.pageX;
                        if (Math.abs(e) <= 13) return !1;
                      }
                      v = !0;
                      var i, n = t.targetTouches[0].clientX, s = t.targetTouches[0].clientY, o = C - n, l = L - s;
                      if (Math.abs(o) > Math.abs(l) ? k = !(T = !1) : T = !(k = !1), a = A.pageX - E.pageX, x = 100 * a / d, c = A.pageY - E.pageY, S = 100 * c / u, T && f && (i = 1 - Math.abs(c) / u, N.style.opacity = i, r.settings.touchFollowAxis && (x = 0)), k && (i = 1 - Math.abs(a) / d, g.style.opacity = i, r.settings.touchFollowAxis && (S = 0)), !f) return B(g, "translate3d(".concat(x, "%, 0, 0)"));
                      B(g, "translate3d(".concat(x, "%, ").concat(S, "%, 0)"));
                    }
                  }, touchEnd: function () {
                    if (p) {
                      if (v = !1, y || m) return b = o, void (w = l);
                      var t = Math.abs(parseInt(S)), e = Math.abs(parseInt(x));
                      if (!(29 < t && f)) return t < 29 && e < 25 ? (z(N, "greset"), N.style.opacity = 1, j(g)) : void 0;
                      r.close();
                    }
                  }, multipointEnd: function () {
                    setTimeout((function () {
                      m = !1;
                    }), 50);
                  }, multipointStart: function () {
                    m = !0, i = s || 1;
                  }, pinch: function (t) {
                    if (!f || v) return !1;
                    m = !0, f.scaleX = f.scaleY = i * t.zoom;
                    var e = i * t.zoom;
                    if (y = !0, e <= 1) return y = !1, e = 1, l = o = b = w = null, void f.setAttribute("style", "");
                    4.5 < e && (e = 4.5), f.style.transform = "scale3d(".concat(e, ", ").concat(e, ", 1)"), s = e;
                  }, pressMove: function (t) {
                    if (y && !m) {
                      var e = A.pageX - E.pageX, i = A.pageY - E.pageY;
                      b && (e += b), w && (i += w), l = i;
                      var n = "translate3d(".concat(o = e, "px, ").concat(i, "px, 0)");
                      s && (n += " scale3d(".concat(s, ", ").concat(s, ", 1)")), B(f, n);
                    }
                  }, swipe: function (t) {
                    if (!y) if (m) m = !1; else {
                      if ("Left" == t.direction) {
                        if (r.index == r.elements.length - 1) return j(g);
                        r.nextSlide();
                      }
                      if ("Right" == t.direction) {
                        if (0 == r.index) return j(g);
                        r.prevSlide();
                      }
                    }
                  }
                }));
              this.events.touch = M;
            }.apply(this), !1;
            this.settings.keyboardNavigation && X.apply(this);
          }
        }, {
          key: "openAt", value: function () {
            var t = 0 < arguments.length && void 0 !== arguments[0] ? arguments[0] : 0;
            this.open(null, t);
          }
        }, {
          key: "showSlide", value: function () {
            var t = this, e = 0 < arguments.length && void 0 !== arguments[0] ? arguments[0] : 0,
              i = 1 < arguments.length && void 0 !== arguments[1] && arguments[1];
            m(this.loader), this.index = parseInt(e);
            var n = this.slidesContainer.querySelector(".current");
            n && P(n, "current"), this.slideAnimateOut();
            var s = this.slidesContainer.querySelectorAll(".gslide")[e];
            if (I(s, "loaded")) this.slideAnimateIn(s, i), y(this.loader); else {
              m(this.loader);
              var o = L(this.elements[e], this.settings);
              o.index = e, this.slidesData[e] = o, O.apply(this, [s, o, function () {
                y(t.loader), t.resize(), t.slideAnimateIn(s, i);
              }]);
            }
            this.slideDescription = s.querySelector(".gslide-description"), this.slideDescriptionContained = this.slideDescription && I(this.slideDescription.parentNode, "gslide-media"), this.preloadSlide(e + 1), this.preloadSlide(e - 1);
            var l = this.loop();
            P(this.nextButton, "disabled"), P(this.prevButton, "disabled"), 0 !== e || l ? e !== this.elements.length - 1 || l || z(this.nextButton, "disabled") : z(this.prevButton, "disabled"), this.activeSlide = s;
          }
        }, {
          key: "preloadSlide", value: function (t) {
            var e = this;
            if (t < 0 || t > this.elements.length) return !1;
            if (S.isNil(this.elements[t])) return !1;
            var i = this.slidesContainer.querySelectorAll(".gslide")[t];
            if (I(i, "loaded")) return !1;
            var n = L(this.elements[t], this.settings);
            n.index = t;
            var s = (this.slidesData[t] = n).sourcetype;
            "video" == s || "external" == s ? setTimeout((function () {
              O.apply(e, [i, n]);
            }), 200) : O.apply(this, [i, n]);
          }
        }, {
          key: "prevSlide", value: function () {
            this.goToSlide(this.index - 1);
          }
        }, {
          key: "nextSlide", value: function () {
            this.goToSlide(this.index + 1);
          }
        }, {
          key: "goToSlide", value: function () {
            var t = 0 < arguments.length && void 0 !== arguments[0] && arguments[0];
            this.prevActiveSlide = this.activeSlide, this.prevActiveSlideIndex = this.index;
            var e = this.loop();
            if (!e && (t < 0 || t > this.elements.length - 1)) return !1;
            t < 0 ? t = this.elements.length - 1 : t >= this.elements.length && (t = 0), this.showSlide(t);
          }
        }, {
          key: "insertSlide", value: function () {
            var t = 0 < arguments.length && void 0 !== arguments[0] ? arguments[0] : {},
              e = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : -1;
            this.tmpAddSlides || (this.tmpAddSlides = []), t.atPosition = e, this.tmpAddSlides.push(t);
          }
        }, {
          key: "slideAnimateIn", value: function (t, e) {
            var i = this, n = t.querySelector(".gslide-media"), s = t.querySelector(".gslide-description"),
              o = {index: this.prevActiveSlideIndex, slide: this.prevActiveSlide},
              l = {index: this.index, slide: this.activeSlide};
            if (0 < n.offsetWidth && s && (y(s), s.style.display = ""), P(t, this.effectsClasses), e) v(t, this.settings.openEffect, (function () {
              !w && i.settings.autoplayVideos && i.playSlideVideo(t), S.isFunction(i.settings.afterSlideChange) && i.settings.afterSlideChange.apply(i, [o, l]);
            })); else {
              var r = this.settings.slideEffect, a = "none" !== r ? this.settings.cssEfects[r].in : r;
              this.prevActiveSlideIndex > this.index && "slide" == this.settings.slideEffect && (a = this.settings.cssEfects.slide_back.in), v(t, a, (function () {
                !w && i.settings.autoplayVideos && i.playSlideVideo(t), S.isFunction(i.settings.afterSlideChange) && i.settings.afterSlideChange.apply(i, [o, l]);
              }));
            }
            setTimeout((function () {
              i.resize(t);
            }), 100), z(t, "current");
          }
        }, {
          key: "slideAnimateOut", value: function () {
            if (!this.prevActiveSlide) return !1;
            var i = this.prevActiveSlide;
            P(i, this.effectsClasses), z(i, "prev");
            var t = this.settings.slideEffect, e = "none" !== t ? this.settings.cssEfects[t].out : t;
            this.stopSlideVideo(i), S.isFunction(this.settings.beforeSlideChange) && this.settings.beforeSlideChange.apply(this, [{
              index: this.prevActiveSlideIndex,
              slide: this.prevActiveSlide
            }, {
              index: this.index,
              slide: this.activeSlide
            }]), this.prevActiveSlideIndex > this.index && "slide" == this.settings.slideEffect && (e = this.settings.cssEfects.slide_back.out), v(i, e, (function () {
              var t = i.querySelector(".gslide-media"), e = i.querySelector(".gslide-description");
              t.style.transform = "", P(t, "greset"), t.style.opacity = "", e && (e.style.opacity = ""), P(i, "prev");
            }));
          }
        }, {
          key: "stopSlideVideo", value: function (t) {
            S.isNumber(t) && (t = this.slidesContainer.querySelectorAll(".gslide")[t]);
            var e = t ? t.querySelector(".gvideo") : null;
            if (!e) return !1;
            var i = e.getAttribute("data-id");
            if (x && S.has(x, i)) {
              var n = x[i];
              n && n.play && n.pause();
            }
          }
        }, {
          key: "playSlideVideo", value: function (t) {
            S.isNumber(t) && (t = this.slidesContainer.querySelectorAll(".gslide")[t]);
            var e = t.querySelector(".gvideo");
            if (!e) return !1;
            var i = e.getAttribute("data-id");
            if (x && S.has(x, i)) {
              var n = x[i];
              n && n.play && n.play();
            }
          }
        }, {
          key: "setElements", value: function (t) {
            this.settings.elements = t;
          }
        }, {
          key: "getElements", value: function () {
            var t = 0 < arguments.length && void 0 !== arguments[0] ? arguments[0] : null, i = [];
            this.elements = this.elements ? this.elements : [], !S.isNil(this.settings.elements) && S.isArray(this.settings.elements) && (i = this.settings.elements);
            var e = !1, n = this.getSelector();
            if (null !== t) {
              var s = t.getAttribute("data-gallery");
              s && "" !== s && (e = document.querySelectorAll('[data-gallery="'.concat(s, '"]')));
            }
            return 0 == e && n && (e = document.querySelectorAll(this.getSelector())), e = Array.prototype.slice.call(e), i = i.concat(e), this.tmpAddSlides && this.tmpAddSlides.length && (p(this.tmpAddSlides, (function (t) {
              var e = t.atPosition < 0 ? i.length + 1 : t.atPosition;
              i.splice(e, 0, u({}, t));
            })), this.tmpAddSlides.length = 0), i;
          }
        }, {
          key: "getSelector", value: function () {
            return "data-" == this.settings.selector.substring(0, 5) ? "*[".concat(this.settings.selector, "]") : this.settings.selector;
          }
        }, {
          key: "getActiveSlide", value: function () {
            return this.slidesContainer.querySelectorAll(".gslide")[this.index];
          }
        }, {
          key: "getActiveSlideIndex", value: function () {
            return this.index;
          }
        }, {
          key: "getAnimationClasses", value: function () {
            var t = [];
            for (var e in this.settings.cssEfects) if (this.settings.cssEfects.hasOwnProperty(e)) {
              var i = this.settings.cssEfects[e];
              t.push("g".concat(i.in)), t.push("g".concat(i.out));
            }
            return t.join(" ");
          }
        }, {
          key: "build", value: function () {
            var i = this;
            if (this.built) return !1;
            var t = S.has(this.settings.svg, "next") ? this.settings.svg.next : "",
              e = S.has(this.settings.svg, "prev") ? this.settings.svg.prev : "",
              n = S.has(this.settings.svg, "close") ? this.settings.svg.close : "", s = this.settings.lightboxHtml;
            s = k(s = (s = (s = s.replace(/{nextSVG}/g, t)).replace(/{prevSVG}/g, e)).replace(/{closeSVG}/g, n)), document.body.appendChild(s);
            var o = document.getElementById("glightbox-body"), l = (this.modal = o).querySelector(".gclose");
            this.prevButton = o.querySelector(".gprev"), this.nextButton = o.querySelector(".gnext"), this.overlay = o.querySelector(".goverlay"), this.loader = o.querySelector(".gloader"), this.slidesContainer = document.getElementById("glightbox-slider"), this.events = {}, z(this.modal, "glightbox-" + this.settings.skin), this.settings.closeButton && l && (this.events.close = T("click", {
              onElement: l,
              withCallback: function (t, e) {
                t.preventDefault(), i.close();
              }
            })), l && !this.settings.closeButton && l.parentNode.removeChild(l), this.nextButton && (this.events.next = T("click", {
              onElement: this.nextButton,
              withCallback: function (t, e) {
                t.preventDefault(), i.nextSlide();
              }
            })), this.prevButton && (this.events.prev = T("click", {
              onElement: this.prevButton,
              withCallback: function (t, e) {
                t.preventDefault(), i.prevSlide();
              }
            })), this.settings.closeOnOutsideClick && (this.events.outClose = T("click", {
              onElement: o,
              withCallback: function (t, e) {
                I(document.body, "glightbox-mobile") || D(t.target, ".ginner-container") || D(t.target, ".gbtn") || I(t.target, "gnext") || I(t.target, "gprev") || i.close();
              }
            })), p(this.elements, (function () {
              var t = k(i.settings.slideHtml);
              i.slidesContainer.appendChild(t);
            })), r && z(document.body, "glightbox-touch"), this.events.resize = T("resize", {
              onElement: window,
              withCallback: function () {
                i.resize();
              }
            }), this.built = !0;
          }
        }, {
          key: "resize", value: function () {
            var t = 0 < arguments.length && void 0 !== arguments[0] ? arguments[0] : null;
            if ((t = t || this.activeSlide) && !I(t, "zoomed")) {
              var e = Y(), i = t.querySelector(".gvideo-wrapper"), n = t.querySelector(".gslide-image"),
                s = this.slideDescription, o = e.width, l = e.height;
              if (o <= 768 ? z(document.body, "glightbox-mobile") : P(document.body, "glightbox-mobile"), i || n) {
                var r = !1;
                if (s && (I(s, "description-bottom") || I(s, "description-top")) && !I(s, "gabsolute") && (r = !0), n) if (o <= 768) {
                  var a = n.querySelector("img");
                  a.setAttribute("style", "");
                } else if (r) {
                  var c = s.offsetHeight, h = this.slidesData[this.index].width;
                  h = h <= o ? h + "px" : "100%";
                  var d = n.querySelector("img");
                  d.setAttribute("style", "max-height: calc(100vh - ".concat(c, "px)")), s.setAttribute("style", "max-width: ".concat(d.offsetWidth, "px;"));
                }
                if (i) {
                  var u = S.has(this.settings.plyr.config, "ratio") ? this.settings.plyr.config.ratio : "16:9",
                    p = u.split(":"), g = this.slidesData[this.index].width, f = g / (parseInt(p[0]) / parseInt(p[1]));
                  if (f = Math.floor(f), r && (l -= s.offsetHeight), l < f && g < o) {
                    var v = i.offsetWidth, m = i.offsetHeight, y = l / m, b = {width: v * y, height: m * y};
                    i.parentNode.setAttribute("style", "max-width: ".concat(b.width, "px")), r && s.setAttribute("style", "max-width: ".concat(b.width, "px;"));
                  } else i.parentNode.style.maxWidth = "".concat(g, "px"), r && s.setAttribute("style", "max-width: ".concat(g, "px;"));
                }
              }
            }
          }
        }, {
          key: "reload", value: function () {
            this.init();
          }
        }, {
          key: "loop", value: function () {
            var t = S.has(this.settings, "loopAtEnd") ? this.settings.loopAtEnd : null;
            return t = S.has(this.settings, "loop") ? this.settings.loop : t;
          }
        }, {
          key: "close", value: function () {
            var n = this;
            if (this.closing) return !1;
            this.closing = !0, this.stopSlideVideo(this.activeSlide), z(this.modal, "glightbox-closing"), v(this.overlay, "none" == this.settings.openEffect ? "none" : this.settings.cssEfects.fade.out), v(this.activeSlide, this.settings.closeEffect, (function () {
              if (n.activeSlide = null, n.prevActiveSlideIndex = null, n.prevActiveSlide = null, n.built = !1, n.events) {
                for (var t in n.events) n.events.hasOwnProperty(t) && n.events[t].destroy();
                n.events = null;
              }
              var e = document.body;
              P(a, "glightbox-open"), P(e, "glightbox-open touching gdesc-open glightbox-touch glightbox-mobile gscrollbar-fixer"), n.modal.parentNode.removeChild(n.modal), S.isFunction(n.settings.onClose) && n.settings.onClose();
              var i = document.querySelector(".gcss-styles");
              i && i.parentNode.removeChild(i), n.closing = null;
            }));
          }
        }, {
          key: "destroy", value: function () {
            this.close(), this.baseEvents.destroy();
          }
        }]), e;
      })();
      return function () {
        var t = 0 < arguments.length && void 0 !== arguments[0] ? arguments[0] : {}, e = new F(t);
        return e.init(), e;
      };
    })();
  }(y = {exports: {}}, y.exports), y.exports);
  b = document.querySelector(".header"), (w = document.querySelector(".main-nav")) && 767 < document.documentElement.clientWidth && window.addEventListener("scroll", (function (t) {
    !m.is_fixed && window.scrollY >= w.getBoundingClientRect().top + window.scrollY ? (w.classList.add("main-nav--fixed"), m.is_fixed = !0) : m.is_fixed && window.scrollY <= b.getBoundingClientRect().bottom + window.scrollY && (w.classList.remove("main-nav--fixed"), m.is_fixed = !1);
  })), x = document.querySelector(".main-nav-toggle"), S = document.querySelector(".main-nav"), x && S && x.addEventListener("click", (function (t) {
    t.currentTarget.classList.toggle("main-nav-toggle--active"), S.classList.toggle("main-nav--active");
  })), E(), T = document.querySelector(".aside__sneakers-toggle"), k = document.querySelector(".sneakers--not-used"), T && k && T.addEventListener("click", (function () {
    k.classList.toggle("sneakers--active"), k.classList.contains("sneakers--active") ? T.textContent = "Скрыть" : T.textContent = "Неиспользуемые";
  })), fetch("https://teamfeed.feedingamerica.org/api/1.3/participants/10072?_=1664203236941").then((function (t) {
    return t.json();
  })).then((function (t) {
  }));
})();

fetch('https://teamfeed.feedingamerica.org/api/1.3/participants/10072?_=1664203236941')
  .then((response) => {
    return response.json();
  })
  .then((data) => {
    console.log(data);
  });
