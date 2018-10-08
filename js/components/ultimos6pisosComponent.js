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

    var hostname = window.location.hostname;

    if (this.state.isloading == false) {
      var totalcards = this.state.ultimos_6.map((datospisos, index) => {
        var extras = datospisos.extras.split('|');
        var extras_img = [];
        extras.sort();
        extras.foreach((datosextras, index) => {
          switch (datosextras) {
            case 'Cocina':
              extras_img.push('<img class="extras" src="'+hostname+'/img/icons/009-cocina.png" alt="Cocina" />');
              break;
            case 'Frigo':
              extras_img.push('<img class="extras" src="'+hostname+'/img/icons/004-frigorifico.png" alt="Frigorigico" />');
              break;
            case 'Lavadora':
              extras_img.push('<img class="extras" src="'+hostname+'/img/icons/010-lavadora.png" alt="Lavadora" />');
              break;
            case 'Vajilla':
              extras_img.push('<img class="extras" src="'+hostname+'/img/icons/005-vajilla.png" alt="Vajilla" />');
              break;
            case 'Cama':
              extras_img.push('<img class="extras" src="'+hostname+'/img/icons/006-cama.png" alt="Cama" />');
              break;
            case 'Bano':
              extras_img.push('<img class="extras" src="'+hostname+'/img/icons/011-servicio.png" alt="Baño" />');
              break;
            case 'Horno':
              extras_img.push('<img class="extras" src="'+hostname+'/img/icons/008-horno.png" alt="Horno" />');
              break;
            case 'Secadora':
              extras_img.push('<img class="extras" src="'+hostname+'/img/icons/012-secadora.png" alt="Secadora" />');
              break;
            case 'TV':
              extras_img.push('<img class="extras" src="'+hostname+'/img/icons/002-television.png" alt="TV" />');
              break;
            case 'Telefono':
              extras_img.push('<img class="extras" src="'+hostname+'/img/icons/003-phone.png" alt="Telefono" />');
              break;
            case 'WIFI':
              extras_img.push('<img class="extras" src="/img/icons/001-wifi.png" alt="Internet" />');
              break;
            case 'Compartido':
              extras_img.push('<img class="extras" src="'+hostname+'img/icons/013-compartido.png" alt="Compartido" />');
              break
            default:
              break;
          }
        });
        var divstyle = {
          width: '100%',
          height: '100%',
          backgroundImage: `url(${hostname}/img_pisos/${datospisos.idpiso}/${datospisos.imagen})`,
          backgroundPosition: 'center',
          backgroundRepeat: 'no-repeat',
          backgroundSize: 'cover'
        }
        return (
          <div className="medium-4 cell">
            <div className="card">
              <div style={divstyle}></div>
              <div className="card-section">
                <p className="texto">
                  {datospisos.descripcion.replace('[Plazas ofertadas]', '').replace('[Número habitaciones]', '').replace('[Datos del inmueble]', '')}
                </p>
                <ul className="opciones">
                  <li>{datosextras}</li>
                </ul>
              </div>
              <div className="card-section">
              <center>
                <a href=`${hostname}/index.php/pisos/producto_piso?id=${datospisos.idpiso}` className="button" role="link">Ver piso</a>
                <a href=`http://maps.google.es/maps?f=q&amp;source=embed&amp;hl=es&amp;geocode=&amp;q=${datospisos.direccion}&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear=${datospisos.direccion}&amp;t=m&amp;z=50&amp` className="button" role="link" target="_blank">Google Maps</a>
              </center>
              </div>
            </div>
          </div>
        )
      });
    }

    if (this.state.isloading == false) {
      return (
        <div className="Ultimos6Pisos">
          {totalcards}
        </div>
      );
    } else {
      return (
        <div className="Ultimos6Pisos">
          <p>Cargando...</p>
        </div>
      );
    }
  }

}

ReactDOM.render(<Ultimos6Pisos />, document.getElementById("ultimos_6_pisos"));
