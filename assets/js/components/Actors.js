import React, {Component} from 'react';
import axios from 'axios';

class Actors extends Component {
    constructor() {
        super();
        this.state = {actors: [], loading: true};
    }

    componentDidMount() {
        this.getActors();
    }

    getActors() {
        axios.get(`http://localhost:8000/api/actors`).then(actors => {
            this.setState({actors: actors.data.['hydra:member'], loading: false})
        })
    }

    render() {
        const loading = this.state.loading;
        return (
            <div>
                <section className="row-section">
                    <div className="container">
                        <div className="row">
                            <h2 className="text-center"><span>Les acteurs du monde entier</span></h2>
                        </div>
                        {loading ? (
                            <div className={'row text-center'}>
                                <span className="fa fa-spin fa-spinner fa-4x"></span>
                            </div>
                        ) : (
                            <div className={'row'}>
                                {this.state.actors.map(actor =>
                                    <div className="col-md-10 offset-md-1 row-block" key={actor.id}>
                                        <ul id="sortable">
                                            <li>
                                                <div className="media">
                                                    <div className="media-body">
                                                        <h4>{actor.fullName}</h4>
                                                        <p>{actor.notes}</p>
                                                    </div>
                                                    <div className="media-right align-self-center">
                                                        <a href="#" className="btn btn-default">En savoir plus</a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                )}
                            </div>
                        )}
                    </div>
                </section>
            </div>
        )
    }
}

export default Actors;
