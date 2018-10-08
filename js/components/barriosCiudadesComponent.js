// Barrios & Ciudades Tab Component

class BarriosciudadesComponent extends React.Component {

  constructor(props) {
    // Constructor del objeto
    super(props);
    this.state = {
      barrios: [],
      ciudades: [],
      isloading: true
    }
    // Bind del onChange
    this.onChangeHandler = this.onChangeHandler.bind();
  }

  onChangeHandler() {

  }

  componentWillMount() {
    // Seria aqui bueno poner el hostname??
    return fetch ('/index.php/components/portada/barriosciudades')
            .then((response) => response.json())
            .then((responsejson) => {
              this.setState({
                isloading: false,
                barrios: responsejson.barrios,
                ciudades: responsejson.ciudades
              });
              // El tab de cambio de barrios
              cambia_tab("barrios");
            })
            .catch((error) => {
              alert('Oh!\n\rHa habido un error al pintar los barrios o en las ciudades');
              throw new Error('Ha habido un error al crear el componente de los barrios/ciudades:\n\r' + error);
            });
  }

  render() {

    let hostname = window.location.hostname;

    const Fragment = React.Fragment;

    if (this.state.isloading == false) {
      var barrios = this.state.barrios.map((datosbarrio, index) => {
        return (
          <li key={index}>
            <a href='{hostname}index.php/principal/barrios?id=${datosbarrio.idbarrio}' role="link">
              {datosbarrio.barrio} ({datosbarrio.ciudad})
            </a>
          </li>
        )
      });
      var ciudades = this.state.ciudades.map((datosciudad, index) => {
        return (
          <li key={index}>
            <a href='{hostname}index.php/principal/ciudades?id={datosciudad.idlocalizacion}' role="link">
              {datosciudad.localizacion}
            </a>
          </li>
        )
      });
    };

    if (this.state.isloading === false) {
      // Si ya ha cargado
      return (
        <Fragment>
          <div className="medium-12 cell barrios">
            <ul>
              {barrios}
            </ul>
          </div>
          <div className="medium-12 cell ciudades">
            <ul>
              {ciudades}
            </ul>
          </div>
        </Fragment>
      );
    } else {
      // Si esta cargando
      return (
        <Fragment>
          <div className="medium-12 cell">
            <p>Cargando... espere por favor...</p>
          </div>
        </Fragment>
      );
    }
  }
}

ReactDOM.render(<BarriosciudadesComponent />, document.getElementById('barriosciudadescomponent'));
