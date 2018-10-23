// Añadir piso Component
// Este componente reamente son 4 componentes, es decir, es un componente padre con 4 componentes hijos

// Revisar
// https://codepen.io/gaearon/pen/vXdGmd?editors=1010

// Objeto que va a tener los datos, el storage a traves de un singleton
var datosPiso = {
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
                  localidad: 0,
                  tlfContacto: '',
                  barrio: 0,
                  extras: []
                },
                libre: 0,
                precios: [],
                imagenes: []
              }

// Pasador (donde estan todos los pasos), el componente padre y almacen de datos
class Pasador extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      visiblePaso1: true,
      visiblePaso2: false,
      visiblePaso3: false,
      paso: 1,
      // Creamos un almacen de datos coherente para todos los subcomponentes (child components)
      // con los datos del inmueble, de esta forma si se edita, los podemos coger
      // del webservice y tal, se pasa por props que cambian esto

      }

    // Metodos del paso de uno a otro
    this.change1a2 = this.change1a2.bind(this);
    this.change2a3 = this.change2a3.bind(this);

    this.change2a1 = this.change2a1.bind(this);
    this.change3a2 = this.change3a2.bind(this);
  }

  componentWillMount() {
    // Lectura en caso de que se este editando y lo metemos en el almacen de datos para todos
    if (this.props.editar.id) {
      // Se supone que lo esta editando, sin hay que ver como tratamos el "NO"
      return fetch ('/index.php/components/mis/datosPiso', {
                method: 'POST',
                body: {
                  ws: 'json',
                  id: this.props.editar.id
                }
              })
              .then((response) => response.json())
              .then((responsejson) => {
                datosPiso.inmueble.descripcion = responsejson.inmueble.descripcion;
                datosPiso.inmueble.calle = responsejson.inmueble.calle;
                datosPiso.inmueble.numero = responsejson.inmueble.numero;
                datosPiso.inmueble.piso = responsejson.inmueble.piso;
                datosPiso.inmueble.letra = responsejson.inmueble.eltra;
                datosPiso.inmueble.codigoPostal = responsejson.inmueble.cp;
                datosPiso.inmueble.localidad = responsejson.inmueble.idlocalizacion;
                datosPiso.inmueble.tlfContacto = responsejson.inmueble.tlf;
                datosPiso.inmueble.barrio = responsejson.inmueble.idbarrio;
                datosPiso.inmueble.extras= responsejson.inmueble.extras.split('|');
                datosPiso.libre =responsejson.inmueble.libre;
                datosPiso.precios = responsejson.precios;
                datosPiso.imagenes = responsejson.imagenes;
              })
              .catch((error) => {
                alert('Oh!\n\rHa habido un error al pintar el editor de datos');
                throw new Error('Ha habido un error al crear el componente del editor de datos:\n\r' + error);
              });
    } else {
      // En principio nada, pero nunca se sabe si se quiere hacer algo
      // ya sabes, fiate de la virgen y no corras
    }
  }

  render() {
    // Fragmentos
    const Fragment = React.Fragment;

    return (
        <Fragment>
          <Breadcrumb paso={this.state.pasoVisible} />
          <Paso1 visible={this.state.visiblePaso1} change1a2={this.change1a2} />
          <Paso2 visible={this.state.visiblePaso2} change2a3={this.change2a3} change2a1={this.change2a1} />
          <Paso3 visible={this.state.visiblePaso3} change3a2={this.change3a2} />
        </Fragment>
    );
  }
}

//ReactDOM.render(<Pasador />, document.getElementById("insertar_piso"));

// Paso 1 Component
// Datos del piso
class Paso1 extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      isloading: true,
      contenido: ['Cocina', 'Frigo', 'Lavadora', 'Vajilla', 'Cama', 'Horno', 'Secadora', 'Bano', 'TV', 'Tlf', 'WIFI', 'Compartido'],
      barriosCiudades: [],
      barrios: [],
      ciudades: []
    }

    this.changeSelectCiudades = this.changeSelectCiudades.bind(this);
    this.changeSelectBarrios = this.changeSelectBarrios.bind(this);
  }

  changeSelectCiudades(e) {
    // Funcion para cuando se selecciona una ciudad que aparezca solo los barrios de ella
    // Primero filtamos los barrios de la ciudad seleccionada
    let barriostmp = this.props.datos.barriosCiudades.filter((item, index) => {
        if (item.idlocalizacion == e.target.value) {
          return item;
        }
      });

    // Los ordenamos (esto se puede refactorizar)
    barriostmp.sort((a,b) => {
      if (a.barrio > b.barrio) {
        return 1;
      } else if (a.barrio < b.barrio) {
        return -1;
      } else {
        return 0;
      }
    });

    // Los metemos en el estado
    this.setState({
      isloading: false,
      contenido: this.state.contenido,
      barriosCiudades: this.state.barriosCiudades,
      barrios: barriostmp,
      ciudad: e.target.value
    });

    datosPiso.inmueble.ciudad = e.target.value;
  }

  changeSelectBarrios(e) {
    // Funcion que retorna el barrio seleccionado
    datosPiso.inmueble.barrio = e.target.value;
    this.setState({
      isloading: false,
      contenido: this.state.contenido,
      barrios: barriostmp,
      ciudad: e.target.value,
      barrio: e.target.value
    });
  }

  componentWillMount() {
    // Esto hay que refactorizarlo para hacerlo de un solo golpe ambas cosas y ordenarlo con un filter
    // El primer fetch lo devuelve todo
    fetch ('/index.php/components/mis/devuelveCiudadesBarrios')
            .then((response) => response.json())
            .then((responsejson) => {
              this.setState({
                isloading: false,
                contenido: this.state.contenido,
                barriosCiudades: responsejson.barriosCiudades
              });
            })
            .catch((error) => {
              alert('Oh!\n\rHa habido un error al pintar el primer paso');
              throw new Error('Ha habido un error al crear el componente del primer paso de la introduccion de datos (Ciudades y Barrios):\n\r' + error);
            });
    // El segundo fetch solo las ciudades
    fetch ('/index.php/components/mis/devuelveCiudades')
            .then((response) => response.json())
            .then((responsejson) => {
              this.setState({
                isloading: false,
                contenido: this.state.contenido,
                barriosCiudades: this.state.barriosCiudades,
                ciudades: responsejson.ciudades
              })
            })
            .catch((error) => {
              alert('Oh!\n\rHa habido un error al pintar el primer paso');
              throw new Error('Ha habido un error al crear el componente del primer paso de la introduccion de datos (Ciudades):\n\r' + error);
            });
  }

  render() {

    // Fragmentos
    const Fragment = React.Fragment;

    // Elemento para los extras o contenidos del inmueble
    let contenidos = this.state.contenido.map((objeto, index) => {
      if (datosPiso.imueble.extras.includes(objeto)) {
        // Si lo tiene puesto
        return(
          <input key={index} type="checkbox" checked="checked" name="contenido[]" value={objeto} />
        );
      } else {
        // Si no lo tiene puesto
        return(
          <input key={index} type="checkbox" name="contenido[]" value={objeto} />
        );
      }
    });

    // Elemento para si el piso esta libre o no
    let estaLibrePiso = () => {
      if (datosPiso.libre == 0) {
        return(
          <input type="checkbox" name="libre" value="1" />
        );
      } else {
        <input type="checkbox" checked="checked" name="libre" value="1" />
      }
    }

    if (this.props.visible == true) {

      var ciudades, barrios;

      if (this.props.datos.ciudades) {
        ciudades = this.props.datosPiso.ciudades.map((item, index) => {
          return (
            <option key={index} value={item.idlocalizacion}>{item.localizacion}</option>
          )
        })
      }

      if (this.state.barrios.length > 0) {
        barrios = this.state.barrios.map((item, index) => {
          return(
            <option key={index} value={item.idbarrio}>{item.barrio}</option>
          )
        });
      }

      return (
        <Fragment>
        <div className="grid-container contenido">
          <div className="grid-x grid-margin-x">
            <div className="small-12 medium-8 cell">
              <h2 className="headline">Descripci&oacute;n</h2>
              <textarea width="100%" cols="40" rows="18" name="descripcion">{this.props.datos.inmueble.descripcion}</textarea>
            </div>
            <div className="small-12 medium-4 cell">
              <h2 className="headline">Contenido</h2>
                {contenidos}
              <div id="libre">
                {estaLibrePiso}
              </div>
            </div>
          </div>


            <div className="grid-x grid-margin-x">
              <div className="small-12 cell">
                <fieldset className="fieldset">
                  <legend><i className="fi-home"></i> Direcci&oacute;n</legend>
                  <label for="calle">calle</label>
                  <input id="calle" name="calle" type="text" className="form_boton" placeholder="C/Falsa" value={this.props.datos.inmueble.calle} />
                  <label for="numero">numero</label>
                  <input name="numero" type="text" className="form_boton" id="numero" placeholder="22" value={this.props.datos.inmueble.numero} size="3" maxlength="3"/>
                  <label for="piso">piso (escriba <strong>B</strong> para un bajo y <strong>A</strong> para un &aacute;tico)</label>
                  <input name="piso" type="text" className="form_boton" id="piso" placeholder="2" value={this.props.datos.inmueble.piso} size="2" maxlength="2"/>
                  <label for="letra">letra</label>
                    <input name="letra" type="text" id="letra" placeholder="A" value={this.props.datos.inmueble.letra} size="2"/>
                    <label for="cp">codigo costal (CP)</label>
                    <input name="cp" type="text" id="cp" placeholder="00000" value={this.props.datos.inmueble.cp} size="5" maxlength="5" />
                    <label for="localidad">localidad</label>
                    <select name="localidad" id="localidad" className="form_boton" onChange={this.changeSelectCiudades}>

                    </select>
                    <label for="tlf">tel&eacute;fono de contacto</label>
                    <input name="tlf" type="text" id="tlf" placeholder="983423000" value={this.props.datos.inmueble.tlf} size="10" maxlength="9" />
                    <label for="barrio">barrio</label>
                    <select name="barrio" id="barrio" className="form_boton" onChange={this.changeSelectBarrios}>

                    </select>
                  </fieldset>
                </div>
              </div>
            </div>
        </Fragment>
      );
    }
  }
}

//ReactDOM.render(<Paso1 />, document.getElementById("ultimos_6_pisos"));

// Paso 2 Component
// Precios del piso
class Paso2 extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      visible: false,
      nextVisible: false
    }
  }

  render() {
    if (this.state.visible == true) {

      // Fragmentos
      const Fragment = React.Fragment;

      return (
        <Fragment>
          <Button onClick={this.props.handleFromChild} />
          <Paso3 visible={true} />
        </Fragment>
      );
    }
  }
}

// Paso 3 Component
// Imagenes del piso
class Paso3 extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      visible: false,
      nextVisible: false
    }
  }

  render() {

    // Fragmentos
    const Fragment = React.Fragment;

    if (this.state.visible == true) {
      return (
          <div className="Ala">asdasd</div>
      );
    }
  }
}

// De un paso a otro (breadcrumb)
// Imagenes del piso
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

function AddNewApp() {
  // Base para montar el resto de componentes en React
  return (
    <div>
      <Pasador />
    </div>
  );
}
// Punto de montaje en la web
ReactDOM.render(<AddNewApp />, document.getElementById('addpiso'));
