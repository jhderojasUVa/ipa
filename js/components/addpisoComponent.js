// Componente del añadir piso (que son 4)
// Objeto singleton que contiene los datos
var datos = {
  inmueble: {
    descripcion: `[Datos del inmueble]

[Número habitaciones]

[Plazas ofertadas]

[Tipo de calefacción]

[Comunidad incluida]

[Mobiliario]

[Otros]

[Preguntar por]
Nombre y Apellidos

[Email]

`,
    calle: '',
    numero: '',
    piso: '',
    letra: '',
    codigoPostal: '',
    ciudad: 0,
    tlfContacto: '',
    barrio: 0,
    extras: []
  },
  libre: 0,
  precios: [],
  imagenes: []
}

// Ruta de migas, donde te dice en que paso estas
class Breadcrumb extends React.Component {
  constructor(props) {
    super(props);
  }

  render() {
    // Fragmentos
    const Fragment = React.Fragment;

    if (this.props.paso == 1) {
      return(
          <Fragment>
            <ul className="menu simple">
              <li className="active">1. Descripci&oacute;n</li>
              <li>2. Precio</li>
              <li>3. Im&aacute;genes</li>
            </ul>
          </Fragment>
      );
    } else if (this.props.paso == 2) {
      return(
          <Fragment>
            <ul className="menu simple">
            <li>1. Descripci&oacute;n</li>
            <li className="active">2. Precio</li>
            <li>3. Im&aacute;genes</li>
            </ul>
          </Fragment>
      );
    } else if (this.props.paso == 3) {
      return(
          <Fragment>
            <ul className="menu simple">
            <li>1. Descripci&oacute;n</li>
            <li>2. Precio</li>
            <li className="active">3. Im&aacute;genes</li>
            </ul>
          </Fragment>
      );
    } else {
      return(
          <Fragment>
            <ul className="menu simple">
            <li>1. Descripci&oacute;n</li>
            <li>2. Precio</li>
            <li>3. Im&aacute;genes</li>
            </ul>
          </Fragment>
      );
    }
  }
}

// Primer paso, donde el usuario mete la descripcion, telefono, calle, ciudad, barrio, y las cosas que tiene
class Paso1 extends React.Component {
  constructor(props) {
    super(props);
    // Estado temporal de esta parte
    this.state = {
      contenido: ['Cocina', 'Frigo', 'Lavadora', 'Vajilla', 'Cama', 'Horno', 'Secadora', 'Bano', 'TV', 'Tlf', 'WIFI', 'Compartido'],
      barrios: [],
      ciudad: 0,
      barrio: 0,
      inmueble: {
        descripcion: '',
        calle: '',
        numero: 0,
        piso: '',
        letra: '',
        cp: '',
        tlfContacto: ''
      }
    }

    // Handles del formulario (que son muchos)
    this.handleLibres = this.handleLibres.bind(this);
    this.changeSelectCiudades = this.changeSelectCiudades.bind(this);
    this.changeSelectBarrios = this.changeSelectBarrios.bind(this);

    this.handleDescripcion = this.handleDescripcion.bind(this);
    this.handleCalle = this.handleCalle.bind(this);
    this.handleNumero = this.handleNumero.bind(this);
    this.handlePiso = this.handlePiso.bind(this);
    this.handleLetra = this.handleLetra.bind(this);
    this.handleCp = this.handleCp.bind(this);
    this.handleTlfContacto = this.handleTlfContacto.bind(this);

  }

  handleLibres(e) {
    // Cambia si esta libre o no
    (datos.libre == 1 ? datos.libre = 0 : datos.libre = 1);
    // Necesitamos re renderizar el componente (ouch!)
    this.forceUpdate();
  }

  handleDescripcion(e) {
    // Cambia la descripcion
    datos.inmueble.descripcion = e.target.value;
    this.setState({inmueble: {descripcion: e.target.value}});
  }

  handleCalle(e) {
    // Cambia el storage de la calle
    datos.inmueble.calle = e.target.value;
    this.setState({inmueble: {calle: e.target.value}});
  }

  handleNumero(e) {
    // Cambia el storage del numero
    datos.inmueble.numero = e.target.value;
    this.setState({inmueble: {numero: e.target.value}});
  }

  handlePiso(e) {
    // Cambia el storage del piso
    datos.inmueble.piso = e.target.value;
    this.setState({inmueble: {piso: e.target.value}});
  }

  handleLetra(e) {
    // Cambia el storage de la letra
    datos.inmueble.letra = e.target.value;
    this.setState({inmueble: {letra: e.target.value}});
  }

  handleCp(e) {
    // Cambia el storage del cp
    datos.inmueble.cp = e.target.value;
    this.setState({inmueble: {cp: e.target.value}});
  }

  handleTlfContacto(e) {
    // Cambia el storage del telefono de contact
    datos.inmueble.tlfContacto = e.target.value;
    this.setState({inmueble: {tlfContacto: e.target.value}});
  }

  changeSelectCiudades(e) {
    // Cuando cambia la ciudad en el select
    let barriostmp = this.props.datos.consulta.filter((item, index) => {
        if (item.idlocalizacion == e.target.value) {
          return item;
        }
      });

    barriostmp.sort((a,b) => {
      if (a.barrio > b.barrio) {
        return 1;
      } else if (a.barrio < b.barrio) {
        return -1;
      } else {
        return 0;
      }
    });
    this.setState({
      barrios: barriostmp,
      ciudad: e.target.value
    });
    // Metemos la ciudad
    datos.inmueble.ciudad = e.target.value;

  }

  changeSelectBarrios(e) {
    // Cuando elige el barrio
    // Metemos el barrio
    datos.inmueble.barrio = e.target.value;
    // Cambiamos los estados
    this.setState({
      ciudad: e.target.value,
      barrio: e.target.value
    });
  }

  render() {
    // Fragmentos
    const Fragment = React.Fragment;

    // Si esta visible
    if (this.props.visible === true) {
      var ciudades, barrios, contenidos, descripcion, estaLibrePiso;
      // Rellena la ciudad
      if (this.props.datos.ciudades && this.props.datos.ciudades.length > 0) {
        ciudades = this.props.datos.ciudades.map((item, index) => {
          return (
            <option key={index} value={item.idlocalizacion}>{item.localizacion}</option>
          )
        })
      }
      // Rellena el barrio segun lo elegido
      if (this.state.barrios.length > 0) {
        barrios = this.state.barrios.map((item, index) => {
          return(
            <option key={index} value={item.idbarrio}>{item.barrio}</option>
          )
        });
      }

      // Los contenidos
      let contenidos = this.state.contenido.map((objeto, index) => {
        if (datos.inmueble.extras.length > 0 && datos.imueble.extras.includes(objeto)) {
          // Si lo tiene puesto
          return(
            <Fragment>
              <input type="checkbox" checked="checked" name="contenido[]" value={objeto} /> {objeto}<br/>
            </Fragment>
          );
        } else {
          // Si no lo tiene puesto
          return(
            <Fragment>
              <input type="checkbox" name="contenido[]" value={objeto}/> {objeto}<br/>
            </Fragment>
          );
        }
      });

      if (datos.inmueble.ciudad != 0 && datos.inmueble.barrio == 0) {
        return (
          <Fragment>

            <div className="small-12 medium-8 cell">
              <h2 className="headline">Descripci&oacute;n</h2>
              <textarea width="100%" cols="40" rows="18" name="descripcion" onChange={this.handleDescripcion} value={datos.inmueble.descripcion}></textarea>
            </div>

            <div className="small-12 medium-4 cell">
              <h2 className="headline">Contenido</h2>
                {contenidos}
              <div id="libre" onClick={this.handleLibres}>
                <button className="button large alert">{datos.libre == 1 ? `NO Existen plazas libres` : `Existen plazas libres`}</button>
              </div>
            </div>

            <div className="small-12 cell">

    						<legend><i className="fi-home"></i> Direcci&oacute;n</legend>
    						<label htmlFor="calle">calle</label>
    						<input id="calle" name="calle" type="text" className="form_boton" onChange={this.handleCalle} placeholder="C/Falsa" value={datos.inmueble.calle} />
    						<label htmlFor="numero">n&uacute;mero</label>
    						<input name="numero" type="text" className="form_boton" id="numero" placeholder="22" onChange={this.handleNumero} value={datos.inmueble.numero} size="3" maxLength="3"/>
    						<label htmlFor="piso">piso (escriba <strong>B</strong> para un bajo y <strong>A</strong> para un &aacute;tico)</label>
    						<input name="piso" type="text" className="form_boton" id="piso" placeholder="2" onChange={this.handlePiso} value={datos.inmueble.piso} size="2" maxLength="2"/>
    						<label htmlFor="letra">letra</label>
    							<input name="letra" type="text" id="letra" placeholder="A" onChange={this.handleLetra} value={datos.inmueble.letra} size="2"/>
    							<label htmlFor="cp">c&oacute;digo costal (CP)</label>
    							<input name="cp" type="text" id="cp" placeholder="00000" onChange={this.handleCp} value={datos.inmueble.cp} size="5" maxLength="5" />
    							<label htmlFor="tlf">tel&eacute;fono de contacto</label>
    							<input name="tlf" type="text" id="tlf" placeholder="983423000" onChange={this.handleTlfContacto} value={datos.inmueble.tlfContacto} size="10" maxLength="9" />
                  <label htmlFor="localidad">localidad</label>
                  <select name="localidad" id="localidad" className="form_boton" onChange={this.changeSelectCiudades}>
                    <option>Selecciona una ciudad</option>
                    {ciudades}
                  </select>
                  <label htmlFor="barrio">barrio</label>
                  <select name="barrio" id="barrio" className="form_boton" onChange={this.changeSelectBarrios}>
                    <option>Selecciona un barrio</option>
                    {barrios}
                  </select>

    					</div>

              <div className="small-12 cell">
                <button className="button right" disabled="disabled">Continuar en el Paso 2</button>
              </div>

          </Fragment>
        );
      } else if (datos.inmueble.ciudad != 0 && datos.inmueble.barrio != 0) {
        return (
          <Fragment>

            <div className="small-12 medium-8 cell">
              <h2 className="headline">Descripci&oacute;n</h2>
              <textarea width="100%" cols="40" rows="18" name="descripcion" onChange={this.handleDescripcion} value={datos.inmueble.descripcion}></textarea>
            </div>

            <div className="small-12 medium-4 cell">
              <h2 className="headline">Contenido</h2>
                {contenidos}
              <div id="libre" onClick={this.handleLibres}>
                <button className="button large alert">{datos.libre == 1 ? `NO Existen plazas libres` : `Existen plazas libres`}</button>
              </div>
            </div>

            <div className="small-12 cell">

    						<legend><i className="fi-home"></i> Direcci&oacute;n</legend>
    						<label htmlFor="calle">calle</label>
    						<input id="calle" name="calle" data-tooltip title="Introduzca el nombre de la calle" type="text" className="form_boton" onChange={this.handleCalle} placeholder="C/Falsa" value={datos.inmueble.calle} />
    						<label htmlFor="numero">n&uacute;mero</label>
    						<input name="numero" type="text" className="form_boton" id="numero" onChange={this.handleNumero} placeholder="22" value={datos.inmueble.numero} size="3" maxLength="3"/>
    						<label htmlFor="piso">piso (escriba <strong>B</strong> para un bajo y <strong>A</strong> para un &aacute;tico)</label>
    						<input name="piso" type="text" className="form_boton" id="piso" placeholder="2" onChange={this.handlePiso} value={datos.inmueble.piso} size="2" maxLength="2"/>
    						<label htmlFor="letra">letra</label>
    							<input name="letra" type="text" id="letra" placeholder="A" onChange={this.handleLetra} value={datos.inmueble.letra} size="2"/>
    							<label htmlFor="cp">c&oacute;digo costal (CP)</label>
    							<input name="cp" type="text" id="cp" placeholder="00000" onChange={this.handleCp} value={datos.inmueble.cp} size="5" maxLength="5" />
    							<label htmlFor="tlf">tel&eacute;fono de contacto</label>
    							<input name="tlf" type="text" id="tlf" placeholder="983423000" onChange={this.handleTlfContacto} alue={datos.inmueble.tlfContacto} size="10" maxLength="9" />
                  <label htmlFor="localidad">localidad</label>
                  <select name="localidad" id="localidad" className="form_boton" onChange={this.changeSelectCiudades}>
                    <option>Selecciona una ciudad</option>
                    {ciudades}
                  </select>
                  <label htmlFor="barrio">barrio</label>
                  <select name="barrio" id="barrio" className="form_boton" onChange={this.changeSelectBarrios}>
                    <option>Selecciona un barrio</option>
                    {barrios}
                  </select>

    					</div>

              <div className="small-12 cell">
                <button className="button right " onClick={this.props.change1a2}>Continuar en el Paso 2</button>
              </div>

          </Fragment>
        );
      } else {
        return (
          <Fragment>

            <div className="small-12 medium-8 cell">
              <h2 className="headline">Descripci&oacute;n</h2>
              <textarea width="100%" cols="40" rows="18" name="descripcion" onChange={this.handleDescripcion} value={datos.inmueble.descripcion}></textarea>
            </div>

            <div className="small-12 medium-4 cell">
              <h2 className="headline">Contenido</h2>
                {contenidos}
              <div id="libre" onClick={this.handleLibres} className="plazasLibres">
                <button className="button large alert">{datos.libre == 1 ? `NO Existen plazas libres` : `Existen plazas libres`}</button>
              </div>
            </div>

            <div className="small-12 cell">
    						<legend><i className="fi-home"></i> Direcci&oacute;n</legend>
    						<label htmlFor="calle">calle</label>
    						<input id="calle" name="calle" type="text" className="form_boton" data-tooltip aria-haspopup="true" className="has-tip-right" data-disable-hover="false" title="Ponga el nombre de la calle sin escribir calle o c/ o paseo o avenida, etc..." onChange={this.handleCalle} placeholder="C/Falsa" value={datos.inmueble.calle} />
    						<label htmlFor="numero">n&uacute;mero</label>
    						<input name="numero" type="text" className="form_boton" id="numero" data-tooltip aria-haspopup="true" className="has-tip-right" data-disable-hover="false" title="Inserte aquí va el número de su portal" placeholder="22" onChange={this.handleNumero} value={datos.inmueble.numero} size="3" maxLength="3"/>
    						<label htmlFor="piso">piso (escriba <strong>B</strong> para un bajo y <strong>A</strong> para un &aacute;tico)</label>
    						<input name="piso" type="text" className="form_boton" id="piso" data-tooltip aria-haspopup="true" className="has-tip-right" data-disable-hover="false" title="Inserte aquí la altura de su piso, ponga A para un ático o B para un bajo" placeholder="2" onChange={this.handlePiso} value={datos.inmueble.piso} size="2" maxLength="2"/>
    						<label htmlFor="letra">letra</label>
    							<input name="letra" type="text" id="letra" data-tooltip aria-haspopup="true" className="has-tip-right" data-disable-hover="false" title="Escriba aquí la letra de su inmueble" placeholder="A" onChange={this.handleLetra} value={datos.inmueble.letra} size="2"/>
    							<label htmlFor="cp">c&oacute;digo costal (CP)</label>
    							<input name="cp" type="text" id="cp" data-tooltip aria-haspopup="true" className="has-tip-right" data-disable-hover="false" title="Es necesario que ponga el codigo postal de su inmueble" placeholder="00000" onChange={this.handleCp} value={datos.inmueble.cp} size="5" maxLength="5" />
    							<label htmlFor="tlf">tel&eacute;fono de contacto</label>
    							<input name="tlf" type="text" id="tlf" placeholder="983423000" data-tooltip aria-haspopup="true" className="has-tip-right" data-disable-hover="false" title="Un telefono de contacto le ayudará a mejorar la comunicación" onChange={this.handleTlfContacto} value={datos.inmueble.tlfContacto} size="10" maxLength="9" />
                  <label htmlFor="localidad">localidad</label>
                  <select name="localidad" id="localidad" data-tooltip aria-haspopup="true" className="has-tip-right" data-disable-hover="false" title="Seleccione una ciudad en el desplegable para ver los barrios" className="form_boton" onChange={this.changeSelectCiudades}>
                    <option>Selecciona una ciudad</option>
                    {ciudades}
                  </select>
                  <label htmlFor="barrio">barrio</label>
                  <select name="barrio" id="barrio" data-tooltip aria-haspopup="true" className="has-tip-right" data-disable-hover="false" title="Seleccione un barrio de la ciudad previamente seleccionada" className="form_boton" onChange={this.changeSelectBarrios}>
                    <option>Selecciona un barrio</option>
                    {barrios}
                  </select>

    					</div>

              <div className="small-12 cell">
                <button className="button right" disabled="disabled">Continuar en el Paso 2</button>
              </div>

          </Fragment>
        );
      }


    }

  }
}

class Paso2 extends React.Component {
  constructor(props) {
    super(props);
  }

  render() {
    if (this.props.visible === true) {
      return (
        <div className="Paso2">

        <h5>Paso2</h5>
        <strong>IDCiudad: {datos.inmueble.ciudad}</strong><br/>
        <strong>IDBarrio: {datos.inmueble.barrio}</strong>
        <br/>
        <button onClick={this.props.change2a1}>Ir al paso 1</button>
        <button onClick={this.props.change2a3}>Ir al paso 3</button>
        </div>
      );
    } else {
      return (
        <h5>Paso 2 no visible</h5>
      );
    }

  }
}

class Paso3 extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      caca: 1
    }

  }

  render() {
    if (this.props.visible === true) {
      return (
        <div className="Paso3">

        <h5>Paso3</h5>
        <button onClick={this.props.change3a2}>Ir al paso 2</button>
        </div>
      );
    } else {
      return (
        <h5>Paso 3 no visible</h5>
      );
    }

  }
}

class Pasador extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      visiblePaso1: true,
      visiblePaso2: false,
      visiblePaso3: false,
      paso: 1,
      datos: {
        consulta: [],
        ciudades: [],
        ciudad: [],
        barrio: []
      }
    }

    this.change1a2 = this.change1a2.bind(this);
    this.change2a3 = this.change2a3.bind(this);

    this.change2a1 = this.change2a1.bind(this);
    this.change3a2 = this.change3a2.bind(this);
  }

  componentWillMount() {
    fetch('/index.php/components/mis/devuelveCiudadesBarrios')
        .then((respuesta) => respuesta.json())
        .then((respuestajson) => {
          this.setState({
            datos: {
              consulta: respuestajson.barriosCiudades,
              ciudades: [],
              ciudad: [],
              barrio: []
            }
          })
        })
        .then(() => {
          fetch('/index.php/components/mis/devuelveCiudades')
              .then((respuesta) => respuesta.json())
              .then((respuestajson) => {
                this.setState({
                  datos: {
                    consulta: this.state.datos.consulta,
                    ciudades: respuestajson.ciudades,
                    ciudad: [],
                    barrio: []
                  }
                })
              });
        });
  }

  change1a2() {
    this.setState ({
      visiblePaso1: false,
      visiblePaso2: true,
      visiblePaso3: false,
      paso: 2
    });
  }

  change2a3() {
    this.setState ({
      visiblePaso1: false,
      visiblePaso2: false,
      visiblePaso3: true,
      paso: 3
    });
  }

  change2a1() {
    this.setState ({
      visiblePaso1: true,
      visiblePaso2: false,
      visiblePaso3: false,
      paso: 1
    });
  }

  change3a2() {
    this.setState ({
      visiblePaso1: false,
      visiblePaso2: true,
      visiblePaso3: false,
      paso: 2
    });
  }

  render() {

    return (
      <div className="App">

      <div className="grid-container contenido">
    		<div className="grid-x grid-margin-x">
    			<div className="small-12 medium-8 cell">
            <Breadcrumb paso={this.state.paso} />
          </div>
        </div>
      </div>

      <div className="grid-container contenido">
    		<div className="grid-x grid-margin-x">
          <Paso1 visible={this.state.visiblePaso1} datos={this.state.datos} change1a2={this.change1a2} />
        </div>
      </div>

      <Paso2 visible={this.state.visiblePaso2} datos={this.state.datos} change2a3={this.change2a3} change2a1={this.change2a1} />
      <Paso3 visible={this.state.visiblePaso3} datos={this.state.datos} change3a2={this.change3a2}/>
      </div>
    );
  }
}

function App() {

  return (
    <div>
      <Pasador />
    </div>
  );
}

ReactDOM.render(<App />, document.getElementById('addpiso'));
