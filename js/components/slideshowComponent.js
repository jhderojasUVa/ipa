// Slideshow Component

class SlideshowComponent extends React.Component {

  contructor(props) {
    super(props);
    this.state = {
      ultimos_6: [],
      isloading: true,
    }
  }

  componentWillMount() {
    return fetch ('/index.php/componentes/slideshow/slideshow')
            .then((response) => response.json())
            .then((responsejson) => {
              this.setState({
                isloading: false,
                ultimos_6: responsejson.ultimos_6
              });
            })
            .catch((error) => {
              alert('Oh!\n\rHa habido un error al cargar el JSON del slideshow');
              throw new Error('Ha habido un error al cargar el JSON del slideshow:\n\r' + error);
            })
  }

  render() {
    if (this.state.isloading === false) {
      // Si ya ha cargado
      return (
      );
    } else {
      // Si esta cargando
      return (
      );
    }
  }
}

ReactDOM.render(<SlideshowComponent />, document.getElementById('slideshowcomponent'));
