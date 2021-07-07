import React, {Component} from 'react';
import axios from 'axios';

class Producer extends Component {
    constructor() {
        super();
        this.state = {producer: [], loading: true};
    }

    componentDidMount() {
        this.getActors();
    }

    getActors() {
        setTimeout(() => {
            axios.get(`http://localhost:8000/api/producers`).then(producer => {
                this.setState({producer: producer.data.['hydra:member'], loading: false})
            })
        }, 10000)
    }

    render() {
        const loading = this.state.loading;
        return (
            <div>
                <section className="row-section">
                    <div className="container">
                        <div className="row">
                            <h2 className="text-center"><span>Les producteurs populaires</span></h2>
                        </div>
                        {loading ? (
                            <div className={'row text-center'}>
                                <span className="fa fa-spin fa-spinner fa-4x"></span>
                            </div>
                        ) : (
                            <div className={'row'}>
                                {this.state.producer.map(producer =>
                                    <div className="col-md-10 offset-md-1 row-block" key={producer.id}>
                                        <ul id="sortable">
                                            <li>
                                                <div className="media">
                                                    <div className="media-body">
                                                        <h4>{producer.name}</h4>
                                                        <p>Email : {producer.email}</p>
                                                        <p>Website : {producer.website}</p>
                                                    </div>
                                                    <div className="media-right align-self-center">
                                                        <a href="#" className="btn btn-default">Contacter</a>
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

export default Producer;
