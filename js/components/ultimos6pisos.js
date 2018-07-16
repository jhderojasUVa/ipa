// Ultimos 6 pisos component

class Ultimos6Pisos extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      ultimos_6_pisos: [],
      isloading: true;
    }
  }

  componentWillMount() {
    return fetch ('/index.php/componentes/portada/ultimos_6')
            .then((response) => response.json())
            .then((responsejson) => {
              this.setState({
                isloading: false,
                ultimos_6: responsejson.ultimos_6
              });
            })
            .catch((error) => {
              alert('Oh!\n\rHa habido un error al cargar el JSON de los ultimos pisos');
              throw new Error('Ha habido un error al cargar el JSON de los ultimos pisos:\n\r' + error);
            });
  }

  render() {

    if (this.state.isloading == false) {
      var totalcards = this.state.ultimos_6.foreach((datospisos, index) {
        var divstyle = {
          width: '100%',
          height: '100%',
          background: 
        }
        return (
          <div className="card">
            <div></div>
            <div className="card-section">
            </div>
          </div>
        )
      });
    }

    if (this.state.isloading == false) {
      return (
        <div className="">
        </div>
      );
    } else {
      return (
        <div className="">
        </div>
      );
    }
  }

}

export default Ultimos6Pisos;
