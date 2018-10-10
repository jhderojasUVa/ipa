class Breadcrumb extends React.Component {
  constructor(props) {
    super(props);
  }


  render() {
    return(
      <div className="breadcrumb">
        Paso por props = {this.props.paso}<br />
      </div>
    )
  }
}

class Paso1 extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      caca: 1
    }

  }

  render() {
    if (this.props.visible === true) {
      return (
        <div className="Paso1">

        <h5>Paso1</h5>
        <button onClick={this.props.change1a2}>Ir al paso 2</button>
        </div>
      );
    } else {
      return (
        <h5>Paso 1 no visible</h5>
      );
    }

  }
}

class Paso2 extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      caca: 1
    }

  }

  render() {
    if (this.props.visible === true) {
      return (
        <div className="Paso2">

        <h5>Paso2</h5>
        <button onClick={this.props.change2a1}>Ir al paso 1</button>
        <button onClick={this.props.change2a3}>Ir al paso 3</button>
        </div>
      );
    } else {
      return (
        <h5>Paso 2 no visible</h5>
      );
    }

  }
}

class Paso3 extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      caca: 1
    }

  }

  render() {
    if (this.props.visible === true) {
      return (
        <div className="Paso3">

        <h5>Paso3</h5>
        <button onClick={this.props.change3a2}>Ir al paso 2</button>
        </div>
      );
    } else {
      return (
        <h5>Paso 3 no visible</h5>
      );
    }

  }
}

class Pasador extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      visiblePaso1: true,
      visiblePaso2: false,
      visiblePaso3: false,
      paso: 1
    }

    this.change1a2 = this.change1a2.bind(this);
    this.change2a3 = this.change2a3.bind(this);

    this.change2a1 = this.change2a1.bind(this);
    this.change3a2 = this.change3a2.bind(this);
  }

  change1a2() {
    this.setState ({
      visiblePaso1: false,
      visiblePaso2: true,
      visiblePaso3: false,
      paso: 2
    });
  }

  change2a3() {
    this.setState ({
      visiblePaso1: false,
      visiblePaso2: false,
      visiblePaso3: true,
      paso: 3
    });
  }

  change2a1() {
    this.setState ({
      visiblePaso1: true,
      visiblePaso2: false,
      visiblePaso3: false,
      paso: 1
    });
  }

  change3a2() {
    this.setState ({
      visiblePaso1: false,
      visiblePaso2: true,
      visiblePaso3: false,
      paso: 2
    });
  }

  render() {
    return (
      <div className="App">

      <h1>Pasador</h1>
      <Breadcrumb paso={this.state.paso} />
      <Paso1 visible={this.state.visiblePaso1} change1a2={this.change1a2} />
      <Paso2 visible={this.state.visiblePaso2} change2a3={this.change2a3} change2a1={this.change2a1} />
      <Paso3 visible={this.state.visiblePaso3} change3a2={this.change3a2}/>
      </div>
    );
  }
}

function App() {

  return (
    <div>
      <Pasador />
    </div>
  );
}

ReactDOM.render(<App />, document.getElementById('root'));
