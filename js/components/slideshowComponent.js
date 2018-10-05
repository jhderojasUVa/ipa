// Slideshow Component

class SlideshowComponent extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      slideshowdata: [],
      isloading: true,
    }
  }

  componentWillMount() {
    return fetch ('/index.php/components/portada/slideshow')
            .then((response) => response.json())
            .then((responsejson) => {
              console.log(responsejson.slideshow);
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

    var hostname = window.location.hostname;
    var imagesSlideshow;

    if (this.state.isloading == false) {
      imagesSlideshow = this.state.slideshowdata.map((datospiso, index) => {
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
      <div className="slideshow">
        {imagesSlideshow}
      </div>
    );
  }
}

ReactDOM.render(<SlideshowComponent />, document.getElementById('slideshowcomponent'));
