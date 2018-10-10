// Añadir piso Component
// Este componente reamente son 4 componentes, es decir, es un componente padre con 4 componentes hijos

// Revisar
// https://codepen.io/gaearon/pen/vXdGmd?editors=1010

// Pasador (donde estan todos los pasos), el componente padre y almacen de datos
class Pasador extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      visiblePaso1: true,
      visiblePaso2: false,
      visiblePaso3: false,
      pasoVisible: 1,
      // Creamos un almacen de datos coherente para todos los subcomponentes (child components)
      // con los datos del inmueble, de esta forma si se edita, los podemos coger
      // del webservice y tal, se pasa por props que cambian esto
      datos: {
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
          localidad: '',
          tlfContacto: '',
          barrio: '',
          extras: []
        },
        libre: 0,
        precios: [],
        imagenes: []
      }
    }

    this.changeState = this.changeState.bind(this);
    this.changeSiVisibleONo = this.this.changeSiVisibleONo.bind(this);
  }

  changeState(elQue, valor) {
    // Cambia a uno o varios valores del state a traves de lo que le envian

  }

  changeSiVisibleONo(elQue, valor) {
    // Cambia a visible (o no) lo que sea

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
                this.setState({
                  // Aqui van los datos!!!
                  datos: {
                    inmueble {
                      descripcion: responsejson.inmueble.descripcion,
                      calle: responsejson.inmueble.calle,
                      numero: responsejson.inmueble.numero,
                      piso: responsejson.inmueble.piso,
                      letra: responsejson.inmueble.eltra,
                      codigoPostal: responsejson.inmueble.cp,
                      localidad: responsejson.inmueble.idlocalizacion,
                      tlfContacto: responsejson.inmueble.tlf,
                      barrio: responsejson.inmueble.idbarrio,
                      extras: responsejson.inmueble.extras.split('|')
                    },
                    libre: responsejson.inmueble.libre,
                    precios: responsejson.precios,
                    imagenes: responsejson.imagenes
                  }
                });
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
          <Paso1 visible={this.state.visiblePaso1} datos={this.state.datos} changeState={this.changeState} changeSiVisibleONo={this.changeSiVisibleONo} />
          <Paso2 visible={this.state.visiblePaso2} datos={this.state.datos} changeState={this.changeState} changeSiVisibleONo={this.changeSiVisibleONo} />
          <Paso3 visible={this.state.visiblePaso3} datos={this.state.datos} changeState={this.changeState} changeSiVisibleONo={this.changeSiVisibleONo} />
        </Fragment>
    );
  }
}

ReactDOM.render(<Pasador />, document.getElementById("insertar_piso"));

// Paso 1 Component
// Datos del piso
class Paso1 extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      isloading: true,
      contenido: ['Cocina', 'Frigo', 'Lavadora', 'Vajilla', 'Cama', 'Horno', 'Secadora', 'Bano', 'TV', 'Tlf', 'WIFI', 'Compartido'],
      barriosCiudades: [],
      ciudades: [],
      isCiudadSelected: false
    }
  }

  componentWillMount() {
    return fetch ('/index.php/components/mis/devuelveCiudadesBarrios')
            .then((response) => response.json())
            .then((responsejson) => {
              this.setState({
                isloading: false,
                barriosCiudades: responsejson.barriosCiudades
                ciudades: responsejson.barriosCiudades.filter((item, index, self) => self.indexOf(item) === index;)
              });
            })
            .catch((error) => {
              alert('Oh!\n\rHa habido un error al pintar el primero paso');
              throw new Error('Ha habido un error al crear el componente del primer paso de la introduccion de datos:\n\r' + error);
            });
  }

  render() {

    // Fragmentos
    const Fragment = React.Fragment;

    // Elemento para los extras o contenidos del inmueble
    let contenidos = this.state.contenido.map((objeto, index) => {
      if (this.props.datos.extras.includes(objeto)) {
        // Si lo tiene puesto
        return(
          <input key={index} type="checkbox" checked="checked" name="contenido[]" value={objeto} />&nbsp;{objeto}<br />
        );
      } else {
        // Si no lo tiene puesto
        return(
          <input key={index} type="checkbox" name="contenido[]" value={objeto} />&nbsp;{objeto}<br />
        );
      }
    });

    // Elemento para el selector de ciudad
    let selectorCiudad, selectorBarrio;
    if (this.state.isCiudadSelected == true) {
      selectorCiudad = ciudades.map((ciudad, index) => {
        return(
          <option key={index} value={ciudad.idlocalizacion}>{ciudad.localizcion}/option>
        );
      });
    } else {
      selectorBarrio = barriosCiudades.map(());
    }
    // Si ha seleccionado la ciudad ponemos sus barrios
    if (selectorCiudad) {
      selectorBarrio = ciudad.filter((elemento) => {
        return ;
      });
    }

    // Elemento para si el piso esta libre o no
    let estaLibrePiso = () => {
      if (this.props.datos.libre == 0) {
        return(
          <input type="checkbox" name="libre" value="1" />&nbsp;Existen plazas libres
        );
      } else {
        <input type="checkbox" checked="checked" name="libre" value="1" />&nbsp;Existen plazas libres
      }
    }

    if (this.props.visible == true) {
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
                  <label for="letra">letra
                    <input name="letra" type="text" id="letra" placeholder="A" value={this.props.datos.inmueble.letra} size="2"/>
                    <label for="cp">codigo costal (CP)</label>
                    <input name="cp" type="text" id="cp" placeholder="00000" value={this.props.datos.inmueble.cp} size="5" maxlength="5" />
                    <label for="localidad">localidad</label>
                    <select name="localidad" id="localidad" className="form_boton">
                      <? foreach ($localidades as $row) { ?>
                        <? if ($idlocalidad == $row -> idlocalizacion) { ?>
                          <option value="<?=$row -> idlocalizacion?>" selected="selected"><?=$row -> localizacion?></option>
                        <? } else { ?>
                          <option value="<?=$row -> idlocalizacion?>"><?=$row -> localizacion?></option>
                        <? } ?>
                      <? } ?>
                    </select>
                    <label for="tlf">tel&eacute;fono de contacto</label>
                    <input name="tlf" type="text" id="tlf" placeholder="983423000" value={this.props.datos.inmueble.tlf} size="10" maxlength="9" />
                    <label for="barrio">barrio</label>
                    <select name="barrio" id="barrio" className="form_boton">
                      <? foreach ($barrios as $row) { ?>
                        <? if ($idbarrio == $row -> idbarrio) { ?>
                          <option value="<?=$row -> idbarrio?>" selected="selected"><?=$row -> barrio?></option>
                        <? } else { ?>
                          <option value="<?=$row -> idbarrio?>"><?=$row -> barrio?></option>
                        <? } ?>
                      <? } ?>
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

ReactDOM.render(<Paso1 />, document.getElementById("ultimos_6_pisos"));

// Paso 2 Component
// Precios del piso
class Paso2 extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      visible: false;
      nextVisible: false;
    }
  }

  render() {
    if (this.state.visible == true) {
      return (
        <Button onClick={this.props.handleFromChild} />
        <Paso3 visible={true} />
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
      visible: false;
      nextVisible: false;
    }
  }

  render() {
    if (this.state.visible == true) {
      return (

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
