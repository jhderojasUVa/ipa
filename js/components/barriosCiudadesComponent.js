// Barrios & Ciudades Tab Component

class BarriosciudadesComponent extends React.Component {

  contructor(props) {
    super(props);
    this.state = {
      barrios: [],
      ciudades: []
      isloading: true,
    }

    this.onChangeHandler = this.onChangeHandler.bind();
  }

  onChangeHandler() {

  }

  componentWillMount() {
    return fetch ('/index.php/componentes/portada/barriosciudades')
            .then((response) => response.json())
            .then((responsejson) => {
              this.setState({
                isloading: false,
                barrios: responsejson.barrios,
                ciudades: responsejson.ciudades
              });
            })
            .catch((error) => {
              alert('Oh!\n\rHa habido un error al cargar el JSON de los barrios o en las ciudades');
              throw new Error('Ha habido un error al cargar el JSON de los barrios/ciudades:\n\r' + error);
            });
  }

  render() {

    var hostname = window.location.hostname;

    if (this.state.isloading == false) {
      var imagesSlideshow = this.state.slideshowdata.foreach((datospiso, index) => {
        return (
          <div className="caja" key={index}>
            <a href=`${hostname}/index.php/pisos/producto_piso?id=${datospiso.id_piso}` role="link">
              <img src=`${hostname}/img_pisos/${datospiso.id_piso}/${datospiso.imagen}` alt={datospiso.descripcion} />
            </a>
          </div>
        )
      })
    };

    if (this.state.isloading === false) {
      // Si ya ha cargado
      return (
        <div className="slideshow">
          {imagesSlideshow}
        </div>
      );
    } else {
      // Si esta cargando
      return (
        <div className="slideshow">
          <p>Cargando... espere por favor...</p>
        </div>
      );
    }
  }
}

ReactDOM.render(<BarriosciudadesComponent />, document.getElementById('barriosciudadescomponent'));
