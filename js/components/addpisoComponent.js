// Añadir piso Component

// Paso 1 Component
// Datos del piso
class Paso1 extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      visible: true;
      nextVisible: false;
      data: {
        descripcion: '',
        calle: '',
        numero: '',
        piso: '',
        letra: '',
        codigoPostal: '',
        localidad: '',
        tlfContacto: '',
        barrio: ''
      }
    }

    this.handleNext = this.handleNext.bind(this);
    this.handleFromChild = this.handleFromChild.bind(this);
  }

  handleNext() {
    this.setState = {
      visible: false;
      nextVisible: true;
    }
  }

  handleFromChild(visible) {
    this.setState({
      visible: true,
      nextVisible: false
    })
  }

  render() {
    if (this.state.visible == true) {
      return (
        <Paso2 visible=true data={this.state.data} handleFromChild={this.handleFromChild}/>
      );
    }
  }
}

ReactDOM.render(<Paso1 />, document.getElementById("ultimos_6_pisos"));

// Paso 2 Component
// Precios del piso
class Paso2 extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      visible: false;
      nextVisible: false;
    }
  }

  render() {
    if (this.state.visible == true) {
      return (
        <Button onClick={this.props.handleFromChild} />
        <Paso3 visible=true />
      );
    }
  }
}

// Paso 3 Component
// Imagenes del piso
class Paso3 extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      visible: false;
      nextVisible: false;
    }
  }

  render() {
    if (this.state.visible == true) {
      return (
        <Paso2 visible=true />
      );
    }
  }
}
