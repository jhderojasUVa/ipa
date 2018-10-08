// Slideshow Component

class SlideshowComponent extends React.Component {

  constructor(props) {
    // construimos la clase
    super(props);
    this.state = {
      slideshowdata: [],
      isloading: true,
    }
  }

  componentWillMount() {
    // Antes de montar, hacemos el fetch
    return fetch ('/index.php/components/portada/slideshow')
            .then((response) => response.json())
            .then((responsejson) => {
              this.setState({
                isloading: false,
                slideshowdata: responsejson.slideshow
              });
              // Esta es una ñapa para que pinte el carrousel de forma correcta
              // tras el fetch
              $('.slideshow').slick({
                autoplay: true,
                autoplayspeed: 3000,
                dots: true,
                arrows: true,
                speed: 800,
                infinite: true,
                slidesToShow: 1,
                variableWidth: true,
                centerMode: true,
              });
            })
            .catch((error) => {
              alert('Oh!\n\rHa habido un error al pintar el slideshow');
              throw new Error('Ha habido un error al crear el componente del slideshow:\n\r' + error);
            });
  }

  componentDidMount() {
  }

  render() {
    // Renderizado
    // Cogemos el hostname
    var hostname = window.location.hostname;

    // Si ya ha cargado los datos, montamos el tinglado
    if (this.state.isloading == false) {
      var imagesSlideshow = this.state.slideshowdata.map((datospiso, index) => {
        let theHref = 'http://' + hostname + '/index.php/pisos/producto_piso?id=' + datospiso.id_piso;
        let imgHref = 'http://' + hostname + '/img_pisos/' + datospiso.id_piso + '/' + datospiso.imagen;
        return (
          <div className="caja" key={index}>
            <a href={theHref} role="link">
              <img src={imgHref} alt={datospiso.descripcion} />
            </a>
          </div>
        )
      });
    };

    return (
      <div className="grid-x">
        <div className="cell">
          <div className="slideshow">
            {imagesSlideshow}
          </div>
        </div>
      </div>
    );
  }
}

ReactDOM.render(<SlideshowComponent />, document.getElementById('slideshowcomponent'));
