/*! For license information please see 309.7af12c5f.js.LICENSE.txt */
"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[309],{7309:(t,r,e)=>{var n=e(2697),o=function(){if(typeof window<"u"){if(window.devicePixelRatio)return window.devicePixelRatio;var t=window.screen;if(t)return(t.deviceXDPI||1)/(t.logicalXDPI||1)}return 1}(),i=function(t){var r,e=[];for(t=[].concat(t);t.length;)"string"==typeof(r=t.pop())?e.unshift.apply(e,r.split("\n")):Array.isArray(r)?t.push.apply(t,r):(0,n.i)(t)||e.unshift(""+r);return e},a=function(t,r,e){var n,o=[].concat(r),i=o.length,a=t.font,l=0;for(t.font=e.string,n=0;n<i;++n)l=Math.max(t.measureText(o[n]).width,l);return t.font=a,{height:i*e.lineHeight,width:l}},l=function(t,r,e){return Math.max(t,Math.min(r,e))};function c(t,r){var e=r.x,n=r.y;if(null===e)return{x:0,y:-1};if(null===n)return{x:1,y:0};var o=t.x-e,i=t.y-n,a=Math.sqrt(o*o+i*i);return{x:a?o/a:0,y:a?i/a:-1}}var h=0,x=1,u=2,s=4,y=8;function d(t,r,e){var n=h;return t<e.left?n|=x:t>e.right&&(n|=u),r<e.top?n|=y:r>e.bottom&&(n|=s),n}function f(t,r){var e,n,o=r.anchor,i=t;return r.clamp&&(i=function(t,r){for(var e,n,o,i=t.x0,a=t.y0,l=t.x1,c=t.y1,h=d(i,a,r),f=d(l,c,r);h|f&&!(h&f);)(e=h||f)&y?(n=i+(l-i)*(r.top-a)/(c-a),o=r.top):e&s?(n=i+(l-i)*(r.bottom-a)/(c-a),o=r.bottom):e&u?(o=a+(c-a)*(r.right-i)/(l-i),n=r.right):e&x&&(o=a+(c-a)*(r.left-i)/(l-i),n=r.left),e===h?h=d(i=n,a=o,r):f=d(l=n,c=o,r);return{x0:i,x1:l,y0:a,y1:c}}(i,r.area)),"start"===o?(e=i.x0,n=i.y0):"end"===o?(e=i.x1,n=i.y1):(e=(i.x0+i.x1)/2,n=(i.y0+i.y1)/2),function(t,r,e,n,o){switch(o){case"center":e=n=0;break;case"bottom":e=0,n=1;break;case"right":e=1,n=0;break;case"left":e=-1,n=0;break;case"top":e=0,n=-1;break;case"start":e=-e,n=-n;break;case"end":break;default:o*=Math.PI/180,e=Math.cos(o),n=Math.sin(o)}return{x:t,y:r,vx:e,vy:n}}(e,n,t.vx,t.vy,r.align)}var v={arc:function(t,r){var e=(t.startAngle+t.endAngle)/2,n=Math.cos(e),o=Math.sin(e),i=t.innerRadius,a=t.outerRadius;return f({x0:t.x+n*i,y0:t.y+o*i,x1:t.x+n*a,y1:t.y+o*a,vx:n,vy:o},r)},point:function(t,r){var e=c(t,r.origin),n=e.x*t.options.radius,o=e.y*t.options.radius;return f({x0:t.x-n,y0:t.y-o,x1:t.x+n,y1:t.y+o,vx:e.x,vy:e.y},r)},bar:function(t,r){var e=c(t,r.origin),n=t.x,o=t.y,i=0,a=0;return t.horizontal?(n=Math.min(t.x,t.base),i=Math.abs(t.base-t.x)):(o=Math.min(t.y,t.base),a=Math.abs(t.base-t.y)),f({x0:n,y0:o+a,x1:n+i,y1:o,vx:e.x,vy:e.y},r)},fallback:function(t,r){var e=c(t,r.origin);return f({x0:t.x,y0:t.y,x1:t.x+(t.width||0),y1:t.y+(t.height||0),vx:e.x,vy:e.y},r)}},g=function(t){return Math.round(t*o)/o};function p(t,r){var e=r.chart.getDatasetMeta(r.datasetIndex).vScale;if(!e)return null;if(void 0!==e.xCenter&&void 0!==e.yCenter)return{x:e.xCenter,y:e.yCenter};var n=e.getBasePixel();return t.horizontal?{x:n,y:null}:{x:null,y:n}}function m(t){return t instanceof n.A?v.arc:t instanceof n.P?v.point:t instanceof n.B?v.bar:v.fallback}function b(t,r,e){var n=e.backgroundColor,o=e.borderColor,i=e.borderWidth;!n&&(!o||!i)||(t.beginPath(),function(t,r,e,n,o,i){var a=Math.PI/2;if(i){var l=Math.min(i,o/2,n/2),c=r+l,h=e+l,x=r+n-l,u=e+o-l;t.moveTo(r,h),c<x&&h<u?(t.arc(c,h,l,-Math.PI,-a),t.arc(x,h,l,-a,0),t.arc(x,u,l,0,a),t.arc(c,u,l,a,Math.PI)):c<x?(t.moveTo(c,e),t.arc(x,h,l,-a,a),t.arc(c,h,l,a,Math.PI+a)):h<u?(t.arc(c,h,l,-Math.PI,0),t.arc(c,u,l,0,Math.PI)):t.arc(c,h,l,-Math.PI,Math.PI),t.closePath(),t.moveTo(r,e)}else t.rect(r,e,n,o)}(t,g(r.x)+i/2,g(r.y)+i/2,g(r.w)-i,g(r.h)-i,e.borderRadius),t.closePath(),n&&(t.fillStyle=n,t.fill()),o&&i&&(t.strokeStyle=o,t.lineWidth=i,t.lineJoin="miter",t.stroke()))}function w(t,r,e){var n=t.shadowBlur,o=e.stroked,i=g(e.x),a=g(e.y),l=g(e.w);o&&t.strokeText(r,i,a,l),e.filled&&(n&&o&&(t.shadowBlur=0),t.fillText(r,i,a,l),n&&o&&(t.shadowBlur=n))}var _=function(t,r,e,n){var o=this;o._config=t,o._index=n,o._model=null,o._rects=null,o._ctx=r,o._el=e};(0,n.m)(_.prototype,{_modelize:function(t,r,e,o){var i=this,l=i._index,c=(0,n.t)((0,n.r)([e.font,{}],o,l)),h=(0,n.r)([e.color,n.d.color],o,l);return{align:(0,n.r)([e.align,"center"],o,l),anchor:(0,n.r)([e.anchor,"center"],o,l),area:o.chart.chartArea,backgroundColor:(0,n.r)([e.backgroundColor,null],o,l),borderColor:(0,n.r)([e.borderColor,null],o,l),borderRadius:(0,n.r)([e.borderRadius,0],o,l),borderWidth:(0,n.r)([e.borderWidth,0],o,l),clamp:(0,n.r)([e.clamp,!1],o,l),clip:(0,n.r)([e.clip,!1],o,l),color:h,display:t,font:c,lines:r,offset:(0,n.r)([e.offset,4],o,l),opacity:(0,n.r)([e.opacity,1],o,l),origin:p(i._el,o),padding:(0,n.a)((0,n.r)([e.padding,4],o,l)),positioner:m(i._el),rotation:(0,n.r)([e.rotation,0],o,l)*(Math.PI/180),size:a(i._ctx,r,c),textAlign:(0,n.r)([e.textAlign,"start"],o,l),textShadowBlur:(0,n.r)([e.textShadowBlur,0],o,l),textShadowColor:(0,n.r)([e.textShadowColor,h],o,l),textStrokeColor:(0,n.r)([e.textStrokeColor,h],o,l),textStrokeWidth:(0,n.r)([e.textStrokeWidth,0],o,l)}},update:function(t){var r,e,o,a=this,l=null,c=null,h=a._index,x=a._config,u=(0,n.r)([x.display,!0],t,h);u&&(r=t.dataset.data[h],e=(0,n.v)((0,n.c)(x.formatter,[r,t]),r),(o=(0,n.i)(e)?[]:i(e)).length&&(c=function(t){var r=t.borderWidth||0,e=t.padding,n=t.size.height,o=t.size.width,i=-o/2,a=-n/2;return{frame:{x:i-e.left-r,y:a-e.top-r,w:o+e.width+2*r,h:n+e.height+2*r},text:{x:i,y:a,w:o,h:n}}}(l=a._modelize(u,o,x,t)))),a._model=l,a._rects=c},geometry:function(){return this._rects?this._rects.frame:{}},rotation:function(){return this._model?this._model.rotation:0},visible:function(){return this._model&&this._model.opacity},model:function(){return this._model},draw:function(t,r){var e,n=t.ctx,o=this._model,i=this._rects;this.visible()&&(n.save(),o.clip&&(e=o.area,n.beginPath(),n.rect(e.left,e.top,e.right-e.left,e.bottom-e.top),n.clip()),n.globalAlpha=l(0,o.opacity,1),n.translate(g(r.x),g(r.y)),n.rotate(o.rotation),b(n,i.frame,o),function(t,r,e,n){var o,i=n.textAlign,a=n.color,l=!!a,c=n.font,h=r.length,x=n.textStrokeColor,u=n.textStrokeWidth,s=x&&u;if(h&&(l||s))for(e=function(t,r,e){var n=e.lineHeight,o=t.w,i=t.x;return"center"===r?i+=o/2:("end"===r||"right"===r)&&(i+=o),{h:n,w:o,x:i,y:t.y+n/2}}(e,i,c),t.font=c.string,t.textAlign=i,t.textBaseline="middle",t.shadowBlur=n.textShadowBlur,t.shadowColor=n.textShadowColor,l&&(t.fillStyle=a),s&&(t.lineJoin="round",t.lineWidth=u,t.strokeStyle=x),o=0,h=r.length;o<h;++o)w(t,r[o],{stroked:s,filled:l,w:e.w,x:e.x,y:e.y+e.h*o})}(n,o.lines,i.text,o),n.restore())}});var M=Number.MIN_SAFE_INTEGER||-9007199254740991,k=Number.MAX_SAFE_INTEGER||9007199254740991;function P(t,r,e){var n=Math.cos(e),o=Math.sin(e),i=r.x,a=r.y;return{x:i+n*(t.x-i)-o*(t.y-a),y:a+o*(t.x-i)+n*(t.y-a)}}function C(t,r){var e,n,o,i,a,l=k,c=M,h=r.origin;for(e=0;e<t.length;++e)o=(n=t[e]).x-h.x,i=n.y-h.y,a=r.vx*o+r.vy*i,l=Math.min(l,a),c=Math.max(c,a);return{min:l,max:c}}function S(t,r){var e=r.x-t.x,n=r.y-t.y,o=Math.sqrt(e*e+n*n);return{vx:(r.x-t.x)/o,vy:(r.y-t.y)/o,origin:t,ln:o}}var I=function(){this._rotation=0,this._rect={x:0,y:0,w:0,h:0}};(0,n.m)(I.prototype,{center:function(){var t=this._rect;return{x:t.x+t.w/2,y:t.y+t.h/2}},update:function(t,r,e){this._rotation=e,this._rect={x:r.x+t.x,y:r.y+t.y,w:r.w,h:r.h}},contains:function(t){var r=this,e=r._rect;return!((t=P(t,r.center(),-r._rotation)).x<e.x-1||t.y<e.y-1||t.x>e.x+e.w+2||t.y>e.y+e.h+2)},intersects:function(t){var r,e,n,o=this._points(),i=t._points(),a=[S(o[0],o[1]),S(o[0],o[3])];for(this._rotation!==t._rotation&&a.push(S(i[0],i[1]),S(i[0],i[3])),r=0;r<a.length;++r)if(e=C(o,a[r]),n=C(i,a[r]),e.max<n.min||n.max<e.min)return!1;return!0},_points:function(){var t=this,r=t._rect,e=t._rotation,n=t.center();return[P({x:r.x,y:r.y},n,e),P({x:r.x+r.w,y:r.y},n,e),P({x:r.x+r.w,y:r.y+r.h},n,e),P({x:r.x,y:r.y+r.h},n,e)]}})}}]);