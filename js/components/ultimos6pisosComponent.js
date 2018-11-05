// Ultimos 6 pisos component

class Ultimos6Pisos extends React.Component {

  constructor(props) {
    // Constructor
    super(props);
    this.state = {
      ultimos_6_pisos: [],
      isloading: true
    }
  }

  componentWillMount() {
    // Fetch de los datos
    return fetch ('/index.php/components/portada/ultimos_6')
            .then((response) => response.json())
            .then((responsejson) => {
              this.setState({
                isloading: false,
                ultimos_6: responsejson.ultimos_6
              });
            })
            .catch((error) => {
              alert('Oh!\n\rHa habido un error pintando ultimos pisos');
              throw new Error('Ha habido un error al crear el componente de los ultimos pisos:\n\r' + error);
            });
  }

  render() {
    // El hostname
    var hostname = window.location.hostname;

    // Fragmentos
    const Fragment = React.Fragment;

    if (this.state.isloading == false) {
      var totalcards = this.state.ultimos_6.map((datospisos, index) => {
        let extras = datospisos.extras.split('|');

        let extrasPiso = extras.map((datosextras, index) => {
          // El case de las cosas
          switch (datosextras) {
            case 'Cocina':
              return(
                <li key={index}><img className="extras" src="/img/icons/009-cocina.png" alt="Cocina" /></li>
              );
              break;
            case 'Frigo':
              return(
                <li key={index}><img className="extras" src="/img/icons/004-frigorifico.png" alt="Frigorigico" /></li>
              );
              break;
            case 'Lavadora':
              return(
                <li key={index}><img className="extras" src="/img/icons/010-lavadora.png" alt="Lavadora" /></li>
              );
              break;
            case 'Vajilla':
              return(
                <li key={index}><img className="extras" src="/img/icons/005-vajilla.png" alt="Vajilla" /></li>
              );
              break;
            case 'Cama':
              return(
                <li key={index}><img className="extras" src="/img/icons/006-cama.png" alt="Cama" /></li>
              );
              break;
            case 'Bano':
              return(
                <li key={index}><img className="extras" src="/img/icons/011-servicio.png" alt="Baño" /></li>
              );
              break;
            case 'Horno':
              return(
                <li key={index}><img className="extras" src="/img/icons/008-horno.png" alt="Horno" /></li>
              );
              break;
            case 'Secadora':
              return(
                <li key={index}><img className="extras" src="/img/icons/012-secadora.png" alt="Secadora" /></li>
              );
              break;
            case 'TV':
              return(
                <li key={index}><img className="extras" src="/img/icons/002-television.png" alt="TV" /></li>
              );
              break;
            case 'Telefono':
              return(
                <li key={index}><img className="extras" src="/img/icons/003-phone.png" alt="Telefono" /></li>
              );
              break;
            case 'WIFI':
              return(
                <li key={index}><img className="extras" src="/img/icons/001-wifi.png" alt="Internet" /></li>);
              break;
            case 'Compartido':
              return(
                <li key={index}><img className="extras" src="/img/icons/013-compartido.png" alt="Compartido" /></li>
              );
              break
            default:
              break;
          }
        });

        let divStyleBack = {
          width: '100%',
          height: '100%',
          backgroundImage: 'url(http://'+ hostname +'/img_pisos/'+ datospisos.idpiso +'/'+ datospisos.imagen +')',
          backgroundPosition: 'center',
          backgroundRepeat: 'no-repeat',
          backgroundSize: 'cover'
        }

        let divStyleFront = {
          height: '250px'
        }

        let pisoHref = 'http://'+ hostname +'/index.php/pisos/producto_piso?id='+ datospisos.idpiso;
        let pisoGmap = 'http://maps.google.es/maps?f=q&amp;source=embed&amp;hl=es&amp;geocode=&amp;q='+ datospisos.direccion +'&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear='+ datospisos.direccion +'&amp;t=m&amp;z=50&amp';

        return (
          <div className="medium-4 cell">
            <div className="card">
              <div style={divStyleBack}><div style={divStyleFront}></div></div>
              <div className="card-section">
                <p className="texto">
                  {datospisos.descripcion.replace('[Plazas ofertadas]', '').replace('[Número habitaciones]', '').replace('[Datos del inmueble]', '').replace('[Tipo de calefacción]', '').replace('[Comunidad]', 'Comunidad: ').substr(1, 60)}...
                </p>
                <ul className="opciones">
                  {extrasPiso}
                </ul>
              </div>
              <div className="card-section">
              <center>
                <a href={pisoHref} className="button" role="link">Ver piso</a>&nbsp;
                <a href={pisoGmap} className="button" role="link" target="_blank">Google Maps</a>
              </center>
              </div>
            </div>
          </div>
        )
      });
    }

    if (this.state.isloading == false) {
      return (
        <Fragment>
          {totalcards}
        </Fragment>
      );
    } else {
      return (
        <Fragment>
          <p className="text-center"><img src="http://ipa.uva.es/img/loading2.gif" alt="Cargando..." width="150"/>  Cargando ultimos pisos...</p>
        </Fragment>
      );
    }
  }

}

ReactDOM.render(<Ultimos6Pisos />, document.getElementById("ultimos_6_pisos"));
