// Busquedas Component

class Busquedas extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      query: '',
      palabrasQueryArreglada: [],
      resultados: [],
      idBarriosCiudades: [],
      // Datos de configuracion del componente
      itemsPerPage: 10,
      page: 0,
      isLoading: true
    }

    // Paginacion
    this.handlePaginacion = this.handlePaginacion.bind(this);
  }

  handlePaginacion(indice, event) {
    // Handle de la paginacion que simplemente, cambia la pagina
    event.preventDefault();
    this.setState({
      page: indice
    })
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
          palabrasQueryArreglada: respuestaJSON.palabrasQueryQuisoDecir,
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

    // Por donde comenzamos, el elemento por el que comenzamos
    var ItemInicio = (this.state.page) * this.state.itemsPerPage;

    // Discriminemos si hay resultados o no
    if (this.state.resultados.length > 0){
      // Los elementos encontrados hechos trocitos para mostrar para la paginacion
      var encontrados = this.state.resultados.slice(ItemInicio, (ItemInicio + this.state.itemsPerPage)).map((elemento) => {
        // Estilo del 100% en ancho y alto para las imagenes (si, esto se puede pasar a un CSS, I know)
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

        // La URL del piso
        let hrefPiso = 'http://'+ hostname + '/index.php/pisos/producto_piso?id=' + elemento.idpiso;

        // Descripcion del piso antes de hacerla cochinadas
        let descripcionPiso = ''

        // Ponemos ... si es grande o nada si no lo es
        // Meramente estetico, vamos
        if (elemento.descripcion.length > 250) {
          descripcionPiso = elemento.descripcion.substr(0, 250).replace('[', '').replace(']', '') + ' ...';
        } else {
          descripcionPiso = elemento.descripcion.substr(0, 250).replace('[', '').replace(']', '');
        }

        // Los elementos extras, los iconos
        // Vamos estetico estetico estetico pero es lo que le mola al usuario
        // Dividimos por el separador para sacar cada elemento
        let extras = elemento.extras.split('|');
        // Pintamos cada elemento
        let extrasPiso = extras.map((datosextras, index) => {
          // El case de las cosas
          switch (datosextras) {
            case 'Cocina':
              return(
                <img className="extras" src="/img/icons/009-cocina.png" alt="Cocina" key={index} />
              );
              break;
            case 'Frigo':
              return(
                <img className="extras" src="/img/icons/004-frigorifico.png" alt="Frigorigico" key={index} />
              );
              break;
            case 'Lavadora':
              return(
                <img className="extras" src="/img/icons/010-lavadora.png" alt="Lavadora" key={index} />
              );
              break;
            case 'Vajilla':
              return(
                <img className="extras" src="/img/icons/005-vajilla.png" alt="Vajilla" key={index} />
              );
              break;
            case 'Cama':
              return(
                <img className="extras" src="/img/icons/006-cama.png" alt="Cama" key={index} />
              );
              break;
            case 'Bano':
              return(
                <img className="extras" src="/img/icons/011-servicio.png" alt="Baño" key={index} />
              );
              break;
            case 'Horno':
              return(
                <img className="extras" src="/img/icons/008-horno.png" alt="Horno" key={index} />
              );
              break;
            case 'Secadora':
              return(
                <img className="extras" src="/img/icons/012-secadora.png" alt="Secadora" key={index} />
              );
              break;
            case 'TV':
              return(
                <img className="extras" src="/img/icons/002-television.png" alt="TV" key={index} />
              );
              break;
            case 'Telefono':
              return(
                <img className="extras" src="/img/icons/003-phone.png" alt="Telefono" key={index} />
              );
              break;
            case 'WIFI':
              return(
                <img className="extras" src="/img/icons/001-wifi.png" alt="Internet" key={index} />
              );
              break;
            case 'Compartido':
              return(
                <img className="extras" src="/img/icons/013-compartido.png" alt="Compartido" key={index} />
              );
              break
            default:
              break;
          }
        });

        // Montado de la URL de la direccion
        let urlGoogleMaps = 'http://maps.google.es/maps?f=q&amp;source=embed&amp;hl=es&amp;geocode=&amp;q='+ elemento.direccion +',España&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear='+ elemento.direccion + ',España&amp;t=m&amp;z=50&amp';

        // El montaje del asunto (del elemento)
        return (
          <div className="grid-x grid-margin-x elemento" key={elemento.idpiso}>
            <div className="small-12 medium-3 cell">
             <div style={divStyle}><a href="#" role="link"><div style={style100}></div></a></div>
           </div>
           <div className="small-9 cell">
            <p><a href={hrefPiso} role="link">{descripcionPiso}</a></p>
            <p className="text-right extras">{extrasPiso}</p>
            <div className="small-4 cell text-right">
              <p><a href={urlGoogleMaps} className="button small" role="link" target="_blank"><i className="fi-marker"></i>&nbsp;&nbsp;Google Maps</a></p>
            </div>
           </div>
          </div>
        );
      });
    } else {
      var encontrados = []
    }

    // Paginacion
    // Calculamos el numero de paginas
    var paginas = Math.trunc(this.state.resultados.length/this.state.itemsPerPage);

    // Creamos un array temporal con las paginas
    let arrayTmpPaginacion = []
    for (let i = 0; i <= (paginas - 1); i++) {
      arrayTmpPaginacion.push(i);
    }

    // Lo que pone la primera y la ultima pagina con sus enlaces
    if (this.state.page == 0) {
      // Si esta en la primera, se disablea y se quita el enlace
      var primero = <li className="pagination-previous disabled">Anterior</li>;
    } else {
      // Sino, lo normal
      var primero = <li className="pagination-previous"><a href="#" aria-label="Anterior" onClick={this.handlePaginacion.bind(this, (this.state.page - 1))}>Anterior</a></li>;
    }

    if (this.state.page == (paginas - 1)){
      // Si esta en la ultima pagina, se disablea y se quita el enlace
      var ultimo = <li className="pagination-next disabled">Siguiente</li>;
    } else {
      // Sino lo normal
      var ultimo = <li className="pagination-next"><a href="#" aria-label="Siguiente" onClick={this.handlePaginacion.bind(this, (this.state.page + 1))}>Siguiente</a></li>;
    }


    // Creamos la paginacion
    let paginacionElementos = arrayTmpPaginacion.map((item, key) => {
      let paginaNumero = "Pagina "+ key;
      return (
        <li key={key} className={key == this.state.page ? 'active' : 'no_active'}><a href="#" aria-label={paginaNumero} onClick={this.handlePaginacion.bind(this, key)}>{item + 1}</a></li>
      )
    });


    // Si hay palabras mal escritas que hemos revisado y las hemos puesto bien

    var quisoDecir = this.state.query.split(" ");
    var quisoDecirRespuesta;

    if (this.state.palabrasQueryArreglada.length > 0) {
      // Formamos la nueva query
      quisoDecir = quisoDecir.map((valor, indice) => {
        // Recorremos y mirarmos que no es null

        // Creamos una variable para ver el retorno si esta o no esta
        let retorno = false;

        for (let i = 0; i < this.state.palabrasQueryArreglada.length; i++) {

          if(this.state.palabrasQueryArreglada[i][valor] !== undefined) {
            // Si no es undefined, esta y tenemos que devolverlo
            retorno = true;
            return this.state.palabrasQueryArreglada[i][valor];
          }
        }

        if (retorno == true) {
          // No lo necesitamos pero lo dejamos por si acaso
          // en una refactorizacion esto se elininara
        } else {
          // Si no, devolvemos el texto original
          return valor;
        }
      });

      // Montamos la URL de vuelta para el enlace
      let urlMontar = 'http://ipa.uva.es/index.php/buscar/busquedas?q='+ quisoDecir.join(' ');
      // Montamos el string a mostrar (feo, pero funcional)
      quisoDecirRespuesta = <p>Quizas usted quiso decir: <strong><a href={urlMontar}>{quisoDecir.join(' ')}</a></strong></p>;

    } else {
      var quisoDecirRespuesta = <br/>;
    }

    if (this.state.isLoading === false && encontrados.length > 0) {
      let stylePaginacion = {
        marginTop: '1em'
      }

      if (paginacionElementos.length > 1) {
        return (
          <Fragment>
            {quisoDecirRespuesta}
            {encontrados}
            <nav aria-label="Paginacion de resultados">
              <ul className="pagination text-center" style={stylePaginacion}>
                {primero}
                {paginacionElementos}
                {ultimo}
              </ul>
            </nav>
          </Fragment>
        );
      } else {
        return (
          <Fragment>
            {quisoDecirRespuesta}
            {encontrados}
          </Fragment>
        );
      }
    } else if (this.state.isLoading === false && encontrados.length == 0) {
      let arrayImgRandom = [
        'https://media.giphy.com/media/OUEaBMDGNueha/200w_d.gif',
        'https://media.giphy.com/media/qNQFUVIKAt9Ek/giphy.gif',
        'https://media.giphy.com/media/LtyywqYw5NgNq/giphy.gif',
        'https://media.giphy.com/media/PyRe0PRZtXGOA/giphy.gif',
        'https://media.giphy.com/media/nlwmJQjtbfNZu/giphy-downsized.gif',
        'https://media.giphy.com/media/slbQo8QFOUi1W/giphy-downsized.gif',
        'https://media.giphy.com/media/IVDYYv6Cto6LS/200w_d.gif',
        'https://media.giphy.com/media/GnqgAJvlpkK76/200w_d.gif',
        'https://media.giphy.com/media/WClVp8rnMThvi/200w_d.gif',
        'https://media.giphy.com/media/26BGpzKXLCgVZHdHa/giphy.gif',
        'https://media.giphy.com/media/yNvlalDnIAATu/giphy.gif',
        'https://media.giphy.com/media/IVDYYv6Cto6LS/giphy.gif',
        'https://media.giphy.com/media/R2KdCa5UmhPS8/giphy.gif',
        'https://media.giphy.com/media/oRmVa4IWfMRJm/giphy.gif',
        'https://media.giphy.com/media/11atWmDHcwRuqA/giphy.gif',
        'https://media.giphy.com/media/108KUzjTMEp2gw/giphy.gif',
        'https://media.giphy.com/media/BtIpahM6na1tm/giphy.gif',
        'https://media.giphy.com/media/UG3gvvrop9S6I/giphy.gif'
      ]
      let randomImg = arrayImgRandom[Math.floor((Math.random()*arrayImgRandom.length)+1)];

      return (
        <Fragment>
          <h2 className="borderBottom">Sin resultados</h2>
          <div className="grid-x grid-margin-x">
            <div className="small-12 medium-4 cell">
              <p className="text-center"><img src={randomImg} width="320" /></p>
            </div>
            <div className="small-12 medium-8 cell">
              <p>Lo sentimos, <strong>no se han encontrado resultados de su busqueda</strong>.</p>
              {quisoDecirRespuesta}
              <p>Pruebe a modificar su busqueda:</p>
              <ul>
                <li>Pruebe a poner palabras más simples.</li>
                <li>Revise que ciudad y por que barrio este buscando, quizas no exista ese barrio en esa ciudad.</li>
                <li>Busque sinonimos de las palabras que este buscando.</li>
              </ul>
            </div>
          </div>
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
