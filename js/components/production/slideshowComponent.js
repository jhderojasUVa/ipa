'use strict';var _createClass=function(){function a(b,c){for(var e,d=0;d<c.length;d++)e=c[d],e.enumerable=e.enumerable||!1,e.configurable=!0,'value'in e&&(e.writable=!0),Object.defineProperty(b,e.key,e)}return function(b,c,d){return c&&a(b.prototype,c),d&&a(b,d),b}}();function _classCallCheck(a,b){if(!(a instanceof b))throw new TypeError('Cannot call a class as a function')}function _possibleConstructorReturn(a,b){if(!a)throw new ReferenceError('this hasn\'t been initialised - super() hasn\'t been called');return b&&('object'==typeof b||'function'==typeof b)?b:a}function _inherits(a,b){if('function'!=typeof b&&null!==b)throw new TypeError('Super expression must either be null or a function, not '+typeof b);a.prototype=Object.create(b&&b.prototype,{constructor:{value:a,enumerable:!1,writable:!0,configurable:!0}}),b&&(Object.setPrototypeOf?Object.setPrototypeOf(a,b):a.__proto__=b)}var SlideshowComponent=function(a){function b(c){_classCallCheck(this,b);var d=_possibleConstructorReturn(this,(b.__proto__||Object.getPrototypeOf(b)).call(this,c));return d.state={slideshowdata:[],isloading:!0},d}return _inherits(b,a),_createClass(b,[{key:'componentWillMount',value:function componentWillMount(){var c=this;return fetch('/index.php/components/portada/slideshow').then(function(d){return d.json()}).then(function(d){c.setState({isloading:!1,slideshowdata:d.slideshow}),$('.slideshow').slick({autoplay:!0,autoplayspeed:3e3,dots:!0,arrows:!0,speed:800,infinite:!0,slidesToShow:1,variableWidth:!0,centerMode:!0})}).catch(function(d){throw alert('Oh!\n\rHa habido un error al pintar el slideshow'),new Error('Ha habido un error al crear el componente del slideshow:\n\r'+d)})}},{key:'componentDidMount',value:function componentDidMount(){}},{key:'render',value:function render(){var c=window.location.hostname;if(!1===this.state.isloading)var d=this.state.slideshowdata.map(function(e,f){var g='http://'+c+'/index.php/pisos/producto_piso?id='+e.id_piso,h='http://'+c+'/img_pisos/'+e.id_piso+'/'+e.imagen;return React.createElement('div',{className:'caja',key:f},React.createElement('a',{href:g,role:'link'},React.createElement('img',{src:h,alt:e.descripcion})))});return React.createElement('div',{className:'grid-x'},React.createElement('div',{className:'cell'},React.createElement('div',{className:'slideshow'},d)))}}]),b}(React.Component);ReactDOM.render(React.createElement(SlideshowComponent,null),document.getElementById('slideshowcomponent'));
