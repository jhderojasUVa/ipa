// Slideshow Component

class SlideshowComponent extends React.Component {

  contructor(props) {
    super(props);
    this.state = {
      slideshowdata: [],
      isloading: true,
    }
  }

  componentWillMount() {
    return fetch ('/index.php/componentes/portada/slideshow')
            .then((response) => response.json())
            .then((responsejson) => {
              this.setState({
                isloading: false,
                slideshowdata: responsejson.slideshow
              });
            })
            .catch((error) => {
              alert('Oh!\n\rHa habido un error al cargar el JSON del slideshow');
              throw new Error('Ha habido un error al cargar el JSON del slideshow:\n\r' + error);
            });
  }

  render() {
    if (this.state.isloading == false) {
      var imagesSlideshow = this.state.slideshowdata.foreach((datospiso, index) => {
        return (
          <div className="caja" key={index}>
            <a href=`/index.php/pisos/producto_piso?id=${datospiso.id_piso}` role="link">
              <img src=`/img_pisos/${datospiso.id_piso}/${datospiso.imagen}` alt={datospiso.descripcion} />
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

ReactDOM.render(<SlideshowComponent />, document.getElementById('slideshowcomponent'));
