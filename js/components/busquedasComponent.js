// Busquedas Component

class Busquedas extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      query: '',
      resultados: [],
      idBarriosCiudades: [],
      // Datos de configuracion del componente
      itemsPerPage: 10,
      page: 1,
      isLoading: true
    }
  }

  componentWillMount() {
    // Cuando el componente se monta hay que hacer las busquedas

    // Cogemos la URL, lo que nos interesa, la busqueda
    let datosBusqueda = window.location.search.substring(1).split('=')[1];

    // Decodeamos que nunca se sabe
    datosBusqueda = decodeURIComponent(datosBusqueda);

    // Hacemos el fetch bien montado
    fetch('/index.php/components/busqueda/busqueda?q='+datosBusqueda)
      .then((respuesta) =>  respuesta.json())
      .then((respuestaJSON) => {
        // Cambiamos el estado del componente con el resultado
        this.setState({
          resultados: respuestaJSON.resultados,
          query: respuestaJSON.q,
          idBarriosCiudades: respuestaJSON.idBarriosCiudades,
          // Y que ya ha acabado
          isLoading: false
        });
      })
      .catch((error) => {
        // Error!!
        alert('Lo sentimos\n\rHa habido un error al realizar la busqueda');
        throw 'Error en busqueda: '.error;
      });
  }

  componentDidMount() {

  }

  render() {
    // Fragmento React
    let Fragment = React.Fragment;
    // El hostname que nunca se sabe
    var hostname = window.location.hostname;

    // Los elementos encontrados
    let encontrados = this.state.resultados.map((elemento) => {
      let style100 = {
        width: '100%',
        height: '100%'
      }

      if (elemento.imagen == 'sin_imagen.png') {
        // Si no tiene imagen
        var divStyle = {
          width: '100%',
          height: '100%',
          background: 'url(http://via.placeholder.com/350x350?text=sin+imagen) no-repeat center center',
          backgroundSize: '100%'
        }
      } else {
        // Si tiene imagen
        var divStyle = {
          width: '100%',
          height: '100%',
          background: 'url(http://ipa.uva.es/img_pisos/'+ elemento.idpiso +'/'+ elemento.imagen +') no-repeat center center',
          backgroundSize: '100%'
        }
      }

      console.log(divStyle);

      let hrefPiso = hostname + 'index.php/pisos/producto_piso?id=' + elemento.idpiso;
      let descripcionPiso = elemento.descripcion.replace('[', ':').replace(']', '').substr(0, 250);

      return (
        <div className="grid-x grid-margin-x elemento" key={elemento.idpiso}>
          <div className="small-12 medium-3 cell">
           <div style={divStyle}><a href="#" role="link"><div style={style100}></div></a></div>
         </div>
         <div className="small-9 cell">
          <p><a href={hrefPiso} role="link">{descripcionPiso}</a></p>
         </div>
        </div>
      );

    });

    if (this.state.isLoading === false) {
      return (
        <Fragment>
          {encontrados}
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
