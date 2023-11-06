/**
 * cbpFWTabs.js v1.0.0
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2014, Codrops
 * http://www.codrops.com
 */
!function(t){"use strict";function i(t,i){for(var s in i)i.hasOwnProperty(s)&&(t[s]=i[s]);return t}function s(t,s){this.el=t,this.options=i({},this.options),i(this.options,s),this._init()}s.prototype.options={start:0},s.prototype._init=function(){this.tabs=[].slice.call(this.el.querySelectorAll("nav > ul > li")),this.items=[].slice.call(this.el.querySelectorAll(".content-wrap > section")),this.current=-1,this._show(),this._initEvents()},s.prototype._initEvents=function(){var t=this;this.tabs.forEach(function(i,s){i.addEventListener("click",function(i){t._show(s)})})},s.prototype._show=function(t){this.current>=0&&(this.tabs[this.current].className=this.items[this.current].className=""),this.current=void 0!=t?t:this.options.start>=0&&this.options.start<this.items.length?this.options.start:0},t.CBPFWTabs=s}(window);