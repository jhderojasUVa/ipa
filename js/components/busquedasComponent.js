// Busquedas Component

class Busquedas extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      resultados: {
        datosInmueble: '',
        direccion: '',
        imagen: ''
      },
      itemsPerPage: 10,
      page: 1,
      isLoading: true,
      query: '',
      idbarrio: 0,
      idlocalizacion: 0
    }
  }

  componentWillMount() {
    // Cuando el componente se monta hay que hacer las busquedas

    // Sobre que es la busqueda
    let sobreBusqueda = window.location.search.substring(1).split('=')[0];
    // Que buscamos
    let datosBusqueda = window.location.search.substring(1).split('=')[1];

    let formData = new FormData();

    // Añadimos el modo JSON
    formData.append('ws', 'json');

    switch(sobreBusqueda) {
      case 'q':
        // Si es una query de texto estandar
        formData.append('q', datosBusqueda);
        fetch('/index.php/components/busquedas/busquedas', {
          method: 'POST',
          body: formData
        })
        .then((respuesta) => respuesta.json())
        .then((respuestajson) => {
          this.setState({
            query: datosBusqueda
          });
        })
        .catch((error) => {
          alert('Ha habido un error al realizar las busquedas\r\nError Bx01q');
          throw 'Ha habido un error al realizar la busqueda por query: '+ error;
        });
        break;
      case 'barrios':
        // Si queremos ver los barrios
        formData.append('id', datosBusqueda);
        fetch('/index.php/principal/barrios', {
          method: 'POST',
          body: formData
        })
        .then((respuesta) => respuesta.json())
        .then((respuestajson) => {
          this.setState({
            idbarrio: datosBusqueda
          });
        })
        .catch((error) => {
          alert('Ha habido un error al realizar las busquedas\r\nError Bx02b');
          throw 'Ha habido un error al realizar la busqueda por barrios: '+ error;
        });
        break;
      case 'ciudades':
        // Si queremos ver las ciudades
        formData.append('id', datosBusqueda);
        fetch('/index.php/principal/ciudades', {
          method: 'POST',
          body: formData
        })
        .then((respuesta) => respuesta.json())
        .then((respuestajson) => {
          this.setState({
            idlocalizacion: datosBusqueda
          });
        })
        .catch((error) => {
          alert('Ha habido un error al realizar las busquedas\r\nError Bx03c');
          throw 'Ha habido un error al realizar la busqueda por ciudades: '+ error;
        });
        break;
    }
  }

  componentDidMount() {

  }

  render() {
    let Fragment = React.Fragment;

    if (isLoading === false) {
      return (
        <Fragment>
        </Fragment>
      );

    } else {
      return (
        <Fragment>
          <p className="text-center"><img src="http://ipa.uva.es/img/loading2.gif" alt="Cargando..." width="150"/>  Estamos buscando, por favor espere...</p>
        </Fragment>
      );
    }

  }
}

ReactDOM.render(<Busquedas />, document.getElementById("busquedas"));
