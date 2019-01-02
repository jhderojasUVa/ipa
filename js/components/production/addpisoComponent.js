'use strict';function _classCallCheck(c,d){if(!(c instanceof d))throw new TypeError('Cannot call a class as a function')}function _possibleConstructorReturn(c,d){if(!c)throw new ReferenceError('this hasn\'t been initialised - super() hasn\'t been called');return d&&('object'==typeof d||'function'==typeof d)?d:c}function _inherits(c,d){if('function'!=typeof d&&null!==d)throw new TypeError('Super expression must either be null or a function, not '+typeof d);c.prototype=Object.create(d&&d.prototype,{constructor:{value:c,enumerable:!1,writable:!0,configurable:!0}}),d&&(Object.setPrototypeOf?Object.setPrototypeOf(c,d):c.__proto__=d)}var datos={inmueble:{descripcion:'[Datos del inmueble]\n\n[N\xFAmero habitaciones]\n\n[Plazas ofertadas]\n\n[Tipo de calefacci\xF3n]\n\n[Comunidad incluida]\n\n[Mobiliario]\n\n[Otros]\n\n[Preguntar por]\nNombre y Apellidos\n\n[Email]\n\n',calle:'',numero:'',piso:'',letra:'',codigoPostal:'',ciudad:0,tlfContacto:'',barrio:0,extras:[]},libre:0,precios:[],imagenes:[],id:0},Breadcrumb=function(c){function d(f){return _classCallCheck(this,d),_possibleConstructorReturn(this,c.call(this,f))}return _inherits(d,c),d.prototype.render=function render(){var f=React.Fragment;return 1==this.props.paso?React.createElement(f,null,React.createElement('ul',{className:'menu simple'},React.createElement('li',{className:'active'},'1. Descripci\xF3n'),React.createElement('li',null,'2. Precio'),React.createElement('li',null,'3. Im\xE1genes'))):2==this.props.paso?React.createElement(f,null,React.createElement('ul',{className:'menu simple'},React.createElement('li',null,'1. Descripci\xF3n'),React.createElement('li',{className:'active'},'2. Precio'),React.createElement('li',null,'3. Im\xE1genes'))):3==this.props.paso?React.createElement(f,null,React.createElement('ul',{className:'menu simple'},React.createElement('li',null,'1. Descripci\xF3n'),React.createElement('li',null,'2. Precio'),React.createElement('li',{className:'active'},'3. Im\xE1genes'))):React.createElement(f,null,React.createElement('ul',{className:'menu simple'},React.createElement('li',null,'1. Descripci\xF3n'),React.createElement('li',null,'2. Precio'),React.createElement('li',null,'3. Im\xE1genes')))},d}(React.Component),Paso1=function(c){function d(f){_classCallCheck(this,d);var g=_possibleConstructorReturn(this,c.call(this,f));return g.state={contenido:['Cocina','Frigo','Lavadora','Vajilla','Cama','Horno','Secadora','Bano','TV','Tlf','WIFI','Compartido'],barrios:[],ciudad:0,barrio:0,inmueble:{descripcion:'',calle:'',numero:0,piso:'',letra:'',cp:'',tlfContacto:''}},g.handleLibres=g.handleLibres.bind(g),g.changeSelectCiudades=g.changeSelectCiudades.bind(g),g.changeSelectBarrios=g.changeSelectBarrios.bind(g),g.handleDescripcion=g.handleDescripcion.bind(g),g.handleCalle=g.handleCalle.bind(g),g.handleNumero=g.handleNumero.bind(g),g.handlePiso=g.handlePiso.bind(g),g.handleLetra=g.handleLetra.bind(g),g.handleCp=g.handleCp.bind(g),g.handleTlfContacto=g.handleTlfContacto.bind(g),g.handleExtras=g.handleExtras.bind(g),g}return _inherits(d,c),d.prototype.handleLibres=function handleLibres(){datos.libre=1==datos.libre?0:1,this.forceUpdate()},d.prototype.handleDescripcion=function handleDescripcion(f){datos.inmueble.descripcion=f.target.value,this.setState({inmueble:{descripcion:f.target.value}})},d.prototype.handleCalle=function handleCalle(f){datos.inmueble.calle=f.target.value,this.setState({inmueble:{calle:f.target.value}})},d.prototype.handleNumero=function handleNumero(f){datos.inmueble.numero=f.target.value,this.setState({inmueble:{numero:f.target.value}})},d.prototype.handlePiso=function handlePiso(f){datos.inmueble.piso=f.target.value,this.setState({inmueble:{piso:f.target.value}})},d.prototype.handleLetra=function handleLetra(f){datos.inmueble.letra=f.target.value,this.setState({inmueble:{letra:f.target.value}})},d.prototype.handleCp=function handleCp(f){datos.inmueble.codigoPostal=f.target.value,this.setState({inmueble:{cp:f.target.value}})},d.prototype.handleTlfContacto=function handleTlfContacto(f){datos.inmueble.tlfContacto=f.target.value,this.setState({inmueble:{tlfContacto:f.target.value}})},d.prototype.handleExtras=function handleExtras(f){datos.inmueble.extras.includes(f.target.value)?datos.inmueble.extras=datos.inmueble.extras.filter(function(g){return g!==f.target.value}):datos.inmueble.extras.push(f.target.value)},d.prototype.changeSelectCiudades=function changeSelectCiudades(f){var g=this.props.datos.consulta.filter(function(h){if(h.idlocalizacion==f.target.value)return h});g.sort(function(h,j){return h.barrio>j.barrio?1:h.barrio<j.barrio?-1:0}),this.setState({barrios:g,ciudad:f.target.value}),datos.inmueble.ciudad=f.target.value},d.prototype.changeSelectBarrios=function changeSelectBarrios(f){datos.inmueble.barrio=f.target.value,this.setState({ciudad:f.target.value,barrio:f.target.value})},d.prototype.componentDidMount=function componentDidMount(){},d.prototype.componentWillMount=function componentWillMount(){},d.prototype.render=function render(){var o=this,l=React.Fragment;if(1===this.props.paso){var f,g;if(this.props.datos.ciudades&&0<this.props.datos.ciudades.length&&(f=this.props.datos.ciudades.map(function(q,r){return q.idlocalizacion==datos.inmueble.ciudad?React.createElement('option',{key:r,selected:'selected',value:q.idlocalizacion},q.localizacion):React.createElement('option',{key:r,value:q.idlocalizacion},q.localizacion)})),0<this.state.barrios.length)g=this.state.barrios.map(function(q,r){return q.idbarrio==datos.inmueble.barrio?React.createElement('option',{key:r,selected:'selected',value:q.idbarrio},q.barrio):React.createElement('option',{key:r,value:q.idbarrio},q.barrio)});else if(0!=datos.inmueble.barrio){var m=this.props.datos.consulta.filter(function(q){if(q.idlocalizacion==datos.inmueble.ciudad)return q});g=m.map(function(q,r){return q.idbarrio==datos.inmueble.barrio?React.createElement('option',{key:r,selected:'selected',value:q.idbarrio},q.barrio):React.createElement('option',{key:r,value:q.idbarrio},q.barrio)})}var p,n=this.state.contenido.map(function(q){var s=datos.inmueble.extras;return 0<s.length&&!0===s.includes(q)?React.createElement(l,null,React.createElement('input',{type:'checkbox',checked:'checked',name:'extras',onChange:o.handleExtras,value:q}),' ',q,React.createElement('br',null)):React.createElement(l,null,React.createElement('input',{type:'checkbox',name:'extras',onChange:o.handleExtras,value:q}),' ',q,React.createElement('br',null))});if(p=0!=datos.inmueble.ciudad&&0==datos.inmueble.barrio&&1==this.props.paso||!0==this.props.visible?React.createElement('button',{className:'button right',disabled:'disabled'},'Continuar en el Paso 2 (selecciona barrio)'):0!=datos.inmueble.ciudad&&0!=datos.inmueble.barrio&&1==this.props.paso?React.createElement('button',{className:'button right',onClick:this.props.change1a2},'Continuar en el Paso 2'):React.createElement('button',{className:'button right',disabled:'disabled'},'Continuar en el Paso 2 (selecciona ciudad y barrio)'),1===this.props.paso){var q,r,s,t,u;return React.createElement(l,null,React.createElement('div',{className:'small-12 medium-8 cell'},React.createElement('h2',{className:'headline'},'Descripci\xF3n'),React.createElement('textarea',{width:'100%',cols:'40',rows:'18',name:'descripcion',onChange:this.handleDescripcion,value:datos.inmueble.descripcion})),React.createElement('div',{className:'small-12 medium-4 cell'},React.createElement('h2',{className:'headline'},'Contenido'),n,React.createElement('div',{id:'libre',onClick:this.handleLibres,className:'plazasLibres'},React.createElement('button',{className:'button large alert'},1==datos.libre?'NO Existen plazas libres':'Existen plazas libres'))),React.createElement('div',{className:'small-12 cell'},React.createElement('form',null,React.createElement('legend',null,React.createElement('i',{className:'fi-home'}),' Direcci\xF3n'),React.createElement('label',{htmlFor:'calle'},'calle '),React.createElement('input',(q={id:'calle',name:'calle',type:'text',className:'form_boton','data-tooltip':!0,'aria-haspopup':'true'},q.className='has-tip-right',q['data-disable-hover']='false',q.title='Ponga el nombre de la calle sin escribir calle o c/ o paseo o avenida, etc...',q.onChange=this.handleCalle,q.required='required',q.placeholder='C/Falsa',q.value=datos.inmueble.calle,q)),React.createElement('label',{htmlFor:'numero'},'n\xFAmero '),React.createElement('input',(r={name:'numero',type:'text',className:'form_boton',id:'numero','data-tooltip':!0,'aria-haspopup':'true'},r.className='has-tip-right',r['data-disable-hover']='false',r.title='Inserte aqu\xED va el n\xFAmero de su portal',r.placeholder='22',r.onChange=this.handleNumero,r.required='required',r.value=datos.inmueble.numero,r.size='3',r.maxLength='3',r)),React.createElement('label',{htmlFor:'piso'},'piso (escriba ',React.createElement('strong',null,'B'),' para un bajo y ',React.createElement('strong',null,'A'),' para un \xE1tico)'),React.createElement('input',(s={name:'piso',type:'text',className:'form_boton',id:'piso','data-tooltip':!0,'aria-haspopup':'true'},s.className='has-tip-right',s['data-disable-hover']='false',s.title='Inserte aqu\xED la altura de su piso, ponga A para un \xE1tico o B para un bajo',s.placeholder='2',s.onChange=this.handlePiso,s.value=datos.inmueble.piso,s.size='2',s.maxLength='2',s)),React.createElement('label',{htmlFor:'letra'},'letra'),React.createElement('input',{name:'letra',type:'text',id:'letra','data-tooltip':!0,'aria-haspopup':'true',className:'has-tip-right','data-disable-hover':'false',title:'Escriba aqu\xED la letra de su inmueble',placeholder:'A',onChange:this.handleLetra,value:datos.inmueble.letra,size:'2'}),React.createElement('label',{htmlFor:'cp'},'c\xF3digo costal (CP) '),React.createElement('input',{name:'cp',type:'text',id:'cp','data-tooltip':!0,'aria-haspopup':'true',className:'has-tip-right','data-disable-hover':'false',title:'Es necesario que ponga el codigo postal de su inmueble',placeholder:'00000',onChange:this.handleCp,required:'required',value:datos.inmueble.codigoPostal,size:'5',maxLength:'5'}),React.createElement('label',{htmlFor:'tlf'},'tel\xE9fono de contacto '),React.createElement('input',{name:'tlf',type:'text',id:'tlf',placeholder:'983423000','data-tooltip':!0,'aria-haspopup':'true',className:'has-tip-right','data-disable-hover':'false',title:'Un telefono de contacto le ayudar\xE1 a mejorar la comunicaci\xF3n',onChange:this.handleTlfContacto,required:'required',value:datos.inmueble.tlfContacto,size:'10',maxLength:'9'}),React.createElement('label',{htmlFor:'localidad'},'localidad'),React.createElement('select',(t={name:'localidad',id:'localidad','data-tooltip':!0,'aria-haspopup':'true',className:'has-tip-right','data-disable-hover':'false',title:'Seleccione una ciudad en el desplegable para ver los barrios'},t.className='form_boton',t.onChange=this.changeSelectCiudades,t),React.createElement('option',null,'Selecciona una ciudad'),f),React.createElement('label',{htmlFor:'barrio'},'barrio'),React.createElement('select',(u={name:'barrio',id:'barrio','data-tooltip':!0,'aria-haspopup':'true',className:'has-tip-right','data-disable-hover':'false',title:'Seleccione un barrio de la ciudad previamente seleccionada'},u.className='form_boton',u.onChange=this.changeSelectBarrios,u),React.createElement('option',null,'Selecciona un barrio'),g))),React.createElement('div',{className:'small-12 cell'},React.createElement('p',null,'Se muestra en color ',React.createElement('strong',null,'rojo'),' aquellos elementos que pueden estar mal.')),React.createElement('div',{className:'small-12 cell'},p))}}else return null},d}(React.Component),Paso2=function(c){function d(f){_classCallCheck(this,d);var g=_possibleConstructorReturn(this,c.call(this,f));return g.state={precio:'',descripcion:''},g.handlePrecio=g.handlePrecio.bind(g),g.handleDescripcion=g.handleDescripcion.bind(g),g.handleAddprecio=g.handleAddprecio.bind(g),g.handleDeletePrecio=g.handleDeletePrecio.bind(g),g}return _inherits(d,c),d.prototype.handlePrecio=function handlePrecio(f){this.setState({precio:f.target.value})},d.prototype.handleDescripcion=function handleDescripcion(f){this.setState({descripcion:f.target.value})},d.prototype.handleAddprecio=function handleAddprecio(){''!=this.state.precio&&''!=this.state.descripcion&&datos.precios.push({precio:this.state.precio,descripcion:this.state.descripcion}),this.setState({precio:'',descripcion:''}),this.forceUpdate()},d.prototype.handleDeletePrecio=function handleDeletePrecio(f){datos.precios.splice(f,1),this.forceUpdate()},d.prototype.componentWillMount=function componentWillMount(){},d.prototype.render=function render(){var h=this,f=React.Fragment,g=datos.precios.map(function(j,k){return React.createElement(f,{key:k},React.createElement('tr',null,React.createElement('td',null,j.precio,' \u20AC'),React.createElement('td',null,j.descripcion),React.createElement('td',null,React.createElement('a',{onClick:h.handleDeletePrecio.bind(h,k)},React.createElement('i',{className:'fi-x'})))))});if(2===this.props.paso){var j;return React.createElement(f,null,React.createElement('div',{className:'small-12 cell'},React.createElement('h2',{className:'headline'},'Precio'),React.createElement('p',null,'A continuaci\xF3n indique el precio y el porque del precio. Puede poner precio a diferentes habitaciones o poner un precio comun para todas o precio por el piso completo.'),React.createElement('p',null,React.createElement('strong',null,'El precio es necesario hasta que no tenga un precio no podra continuar con el proceso'),'.')),React.createElement('div',{className:'small-12 medium-4 cell'},React.createElement('label',null,'precio',React.createElement('input',{type:'number',name:'precio',onChange:this.handlePrecio,value:this.state.precio,required:'required',placeholder:'50'}))),React.createElement('div',{className:'small-12 medium-6 cell'},React.createElement('label',null,'referente a',React.createElement('input',{type:'text',name:'descripcion',onChange:this.handleDescripcion,value:this.state.descripcion,size:'20',maxLength:'50',placeholder:'habitacion doble',required:'required'}))),React.createElement('div',{className:'small-12 medium-2 cell'},React.createElement('label',{className:'marginTop20'},React.createElement('input',{className:'button',onClick:this.handleAddprecio,name:'precio_enviar',defaultValue:'a\xF1adir precio'}))),React.createElement('div',{className:'small-12 cell'},React.createElement('h2',{className:'headline'},'Precios anteriormente a\xF1adidos')),React.createElement('div',{className:'small-12 cell'},React.createElement('div',(j={className:'precios'},j.className='margin0Auto',j),React.createElement('table',{width:'100'},React.createElement('thead',null,React.createElement('tr',null,React.createElement('td',{width:'50%'},'Precio'),React.createElement('td',null,'Descripci\xF3n'),React.createElement('td',null))),React.createElement('tbody',null,g)))),React.createElement('div',{className:'small-12 cell'},React.createElement('button',{className:'button right',onClick:this.props.change2a1},'Volver al paso anterior'),'\xA0',React.createElement('button',{className:'button right',onClick:this.props.change2a3},'Continuar en el  paso 3')))}return null},d}(React.Component),Paso3=function(c){function d(f){_classCallCheck(this,d);var g=_possibleConstructorReturn(this,c.call(this,f));return g.ficheros=[],g.state={descripcion:'',files:[],boton:!1},g.handleFileChoose=g.handleFileChoose.bind(g),g.handleDrop=g.handleDrop.bind(g),g.handleOnDragOver=g.handleOnDragOver.bind(g),g.handleChangeDescripcion=g.handleChangeDescripcion.bind(g),g.handleUpload=g.handleUpload.bind(g),g.handleFinish=g.handleFinish.bind(g),g.handleChangeOrder=g.handleChangeOrder.bind(g),g.handleDeleteFile=g.handleDeleteFile.bind(g),g}return _inherits(d,c),d.prototype.handleFileChoose=function handleFileChoose(f){var k=this;if(f.target.files[0]){var g=f.target.files[0];this.ficheros.push({name:g.name,dataFile:g});var h=document.getElementById('drop_image');h.src=window.URL.createObjectURL(g)}var j=JSON.stringify({id:datos.id});fetch('/index.php/components/mis/devuelveImagenes',{headers:{Accept:'application/json','Content-Type':'application/json'},method:'POST',body:j}).then(function(l){return l.json()}).then(function(l){datos.imagenes=[],l.forEach(function(m){datos.imagenes.push({imagen:m.imagen,descripcion:m.descripcion,orden:m.orden})}),k.setState({files:datos.imagenes})}).catch(function(l){throw alert('Error al recuperar las imagenes. Error I0x012'),'Error al recuperar las imagenes: '+l}),this.forceUpdate()},d.prototype.handleDrop=function handleDrop(f){var o=this;if(f.preventDefault(),f.dataTransfer.items){for(var g=0;g<f.dataTransfer.items.length;g++)if('file'===f.dataTransfer.items[g].kind){var h=f.dataTransfer.items[g].getAsFile();this.ficheros.push({name:h.name,dataFile:h});var j=document.getElementById('drop_image');j.src=window.URL.createObjectURL(h)}}else for(var l,k=0;k<f.dataTransfer.files.length;k++){l=f.dataTransfer.files[k],this.ficheros.push({name:l.name,dataFile:l});var m=document.getElementById('drop_image');m.src=window.URL.createObjectURL(l)}removeDragData(f);var n=JSON.stringify({id:datos.id});fetch('/index.php/components/mis/devuelveImagenes',{headers:{Accept:'application/json','Content-Type':'application/json'},method:'POST',body:n}).then(function(p){return p.json()}).then(function(p){datos.imagenes=[],0<p.length&&(console.log(p.length),p.forEach(function(q){datos.imagenes.push({imagen:q.imagen,descripcion:q.descripcion,orden:q.orden})})),o.setState({files:datos.imagenes})}).catch(function(p){throw alert('Error al recuperar las imagenes. Error I0x012'),'Error al recuperar las imagenes: '+p}),this.forceUpdate()},d.prototype.handleOnDragOver=function handleOnDragOver(f){f.preventDefault()},d.prototype.handleUpload=function handleUpload(){var g=this,f=new FormData;f.append('upload',this.ficheros[0].dataFile),f.append('descripcion',this.state.descripcion),f.append('idpiso',datos.id),f.append('ws','json'),fetch('/index.php/pisos/addpiso3',{method:'POST',body:f}).then(function(h){return h.json()}).then(function(h){datos.imagenes=[],0<h.imagenes_piso.length&&(h.imagenes_piso.forEach(function(j){datos.imagenes.push({imagen:j.imagen,descripcion:j.descripcion,orden:j.orden})}),g.setState({files:datos.imagenes}))}).catch(function(h){throw alert('Lo sentimos:\r\nHa ocurrido un error al subir la imagen'),'Ha ocurrido un error al subir la imagen: '+h}),this.setState({descripcion:'',files:datos.imagenes}),this.ficheros=[],document.getElementById('drop_image').src='/img/subir_fichero.png'},d.prototype.handleChangeDescripcion=function handleChangeDescripcion(f){this.setState({descripcion:f.target.value}),''!=f.target.value&&0<this.ficheros[0].name.length?this.setState({boton:!0}):this.setState({boton:!1})},d.prototype.handleFinish=function handleFinish(){alert('Los datos del piso han sido completados con exito.\r\nEn el menu de MIS PISOS puede verlo y modificarlo.'),window.location='http://ipa.uva.es'},d.prototype.handleChangeOrder=function handleChangeOrder(f,g,h){var l=this,k=new FormData;k.append('idpiso',datos.id),k.append('nuevo',g),k.append('actual',h),k.append('imagen',f),k.append('ws','json'),fetch('/index.php/pisos/cambiarorden',{method:'POST',body:k}).then(function(m){return m.json()}).then(function(m){datos.imagenes=[],m.imagenes_piso.forEach(function(n){datos.imagenes.push({imagen:n.imagen,descripcion:n.descripcion,orden:n.orden})}),l.setState({files:datos.imagenes})}).catch(function(m){throw alert('Ha habido un error al cambiar el orden'),'Ha habido un error al cambiar el ordern: '+m}),this.forceUpdate()},d.prototype.handleDeleteFile=function handleDeleteFile(f,g,h){var l=this,k=new FormData;k.append('idpiso',datos.id),k.append('orden',h),k.append('imagen_borrar',f),k.append('descripcion_borrar',g),k.append('ws','json'),fetch('/index.php/pisos/del_img',{method:'POST',body:k}).then(function(m){return m.json()}).then(function(m){datos.imagenes=[],m.imagenes_piso.forEach(function(n){datos.imagenes.push({imagen:n.imagen,descripcion:n.descripcion,orden:n.orden})}),l.setState({files:datos.imagenes})}).catch(function(m){throw alert('Ha habido un error al eliminar la imagen'),'Ha habido un error al eliminar la imagen: '+m})},d.prototype.render=function render(){var j=this,f=React.Fragment,g=void 0,h=void 0;return 3===this.props.paso?(g=!0===this.state.boton?React.createElement('button',{className:'button right',onClick:this.handleUpload},'A\xF1adir imagen'):React.createElement('button',{className:'button right',onClick:this.handleUpload,disabled:'disabled'},'A\xF1adir imagen'),h=0<datos.imagenes.length?datos.imagenes.map(function(k,l){var m='/img_pisos/'+datos.id+'/'+k.imagen;return React.createElement('div',{key:l,id:'trozo',className:'final'},React.createElement('div',{className:'final_substilo'},React.createElement('img',{src:m,className:'imagenes',width:'130'}),React.createElement('br',null),React.createElement('em',null,React.createElement('p',null,k.descripcion)),React.createElement('div',{id:'formularios_img'},React.createElement('a',{onClick:j.handleChangeOrder.bind(j,k.imagen,parseInt(k.orden)-1,k.orden),className:'button tiny',role:'link'},React.createElement('i',{className:'fi-arrow-left'})),'\xA0',React.createElement('a',{onClick:j.handleChangeOrder.bind(j,k.imagen,parseInt(k.orden)+1,k.orden),className:'button tiny',role:'link'},React.createElement('i',{className:'fi-arrow-right'})),'\xA0',React.createElement('a',{onClick:j.handleDeleteFile.bind(j,k.imagen,k.descripcion,k.orden),className:'button tiny',role:'link'},React.createElement('i',{className:'fi-x'})),React.createElement('div',{id:'clear'}))))}):React.createElement('p',null,'No ha subido ninguna imagen.'),React.createElement(f,null,React.createElement('div',{className:'small-12 medium-12 cell'},React.createElement('div',{onDrop:this.handleDrop,onDragOver:this.handleOnDragOver,className:'dragOver',id:'drop_zone'},React.createElement('input',{type:'file',id:'upload_file',name:'upload_file',className:'hide',onChange:this.handleFileChoose}),React.createElement('label',{htmlFor:'upload_file'},React.createElement('img',{src:'/img/subir_fichero.png',alt:'Subir fichero',width:'100%',id:'drop_image'}))),React.createElement('p',{className:'text-center'},'Pulse de nuevo o arrastre una nueva imagen si quiere cambiarla')),React.createElement('div',{className:'small-12 medium-12 cell'},React.createElement('label',null,'Descripci\xF3n de la imagen'),React.createElement('input',{type:'text',name:'descripcion',onChange:this.handleChangeDescripcion}),g),React.createElement('div',{className:'small-12 medium-12 cell imagenes_subidas'},h),React.createElement('div',{className:'small-12 medium-12 cell'},React.createElement('button',{className:'button right',onClick:this.props.change3a2},'Volver al paso anterior'),'\xA0',React.createElement('button',{className:'button right',onClick:this.handleFinish},'Finalizar')))):null},d}(React.Component),Pasador=function(c){function d(f){_classCallCheck(this,d);var g=_possibleConstructorReturn(this,c.call(this,f));return g.state={paso:1,datos:{consulta:[],ciudades:[],ciudad:[],barrio:[]}},g.change1a2=g.change1a2.bind(g),g.change2a3=g.change2a3.bind(g),g.change2a1=g.change2a1.bind(g),g.change3a2=g.change3a2.bind(g),g}return _inherits(d,c),d.prototype.componentWillMount=function componentWillMount(){var f=this;fetch('/index.php/components/mis/devuelveCiudadesBarrios').then(function(h){return h.json()}).then(function(h){f.setState({datos:{consulta:h.barriosCiudades,ciudades:[],ciudad:[],barrio:[]}})}).then(function(){fetch('/index.php/components/mis/devuelveCiudades').then(function(h){return h.json()}).then(function(h){f.setState({datos:{consulta:f.state.datos.consulta,ciudades:h.ciudades,ciudad:[],barrio:[]}})})});var g=parseInt(window.location.search.substring(1).split('=')[1]);isNaN(g)&&0==datos.id||(0!=datos.id||!1==isNaN(g)?(datos.id=g,fetch('/index.php/components/mis/datosPiso?id='+datos.id,{method:'GET'}).then(function(h){return h.json()}).then(function(h){datos.inmueble.descripcion=h.inmueble[0].descripcion,datos.inmueble.calle=h.inmueble[0].calle,datos.inmueble.piso=h.inmueble[0].piso,datos.inmueble.letra=h.inmueble[0].letra,datos.inmueble.numero=h.inmueble[0].numero,datos.inmueble.codigoPostal=h.inmueble[0].cp,datos.inmueble.ciudad=h.inmueble[0].idlocalizacion,datos.inmueble.barrio=h.inmueble[0].idbarrio,datos.inmueble.tlfContacto=h.inmueble[0].tlf,datos.precios=h.precios,datos.imagenes=h.imagenes}).catch(function(h){throw alert('Ha habido un error consultando los datos del inmueble\r\nError: '+h),'Ha habido un error al consultar los datos del inmueble. '+h})):alert('Si has llegado aqui es mejor que corras!'))},d.prototype.change1a2=function change1a2(){this.setState({paso:2})},d.prototype.change2a3=function change2a3(){var f=JSON.stringify(datos);fetch('/index.php/components/mis/addPiso',{headers:{Accept:'application/json','Content-Type':'application/json'},method:'POST',body:f}).then(function(g){return g.json()}).then(function(g){datos.id=g.idpiso}),this.setState({paso:3})},d.prototype.change2a1=function change2a1(){this.setState({paso:1})},d.prototype.change3a2=function change3a2(){this.setState({paso:2})},d.prototype.render=function render(){return React.createElement('div',{className:'App'},React.createElement('div',{className:'grid-container contenido'},React.createElement('div',{className:'grid-x grid-margin-x'},React.createElement('div',{className:'small-12 medium-8 cell'},React.createElement(Breadcrumb,{paso:this.state.paso})))),React.createElement('div',{className:'grid-container contenido'},React.createElement('div',{className:'grid-x grid-margin-x'},React.createElement(Paso1,{paso:this.state.paso,datos:this.state.datos,change1a2:this.change1a2}))),React.createElement('div',{className:'grid-container contenido'},React.createElement('div',{className:'grid-x grid-margin-x'},React.createElement(Paso2,{paso:this.state.paso,datos:this.state.datos,change2a3:this.change2a3,change2a1:this.change2a1}))),React.createElement('div',{className:'grid-container contenido'},React.createElement('div',{className:'grid-x grid-margin-x'},React.createElement(Paso3,{paso:this.state.paso,datos:this.state.datos,change3a2:this.change3a2}))))},d}(React.Component);function App(){return React.createElement('div',null,React.createElement(Pasador,null))}ReactDOM.render(React.createElement(App,null),document.getElementById('addpiso'));function compruebaPaso1(c,d,f,g){return{calle:0===c.length,numero:0===d.length,codigoPostal:0===f.length,telefonoContacto:0===g.length}}function removeDragData(c){c.dataTransfer.items?c.dataTransfer.items.clear():c.dataTransfer.clearData()}
