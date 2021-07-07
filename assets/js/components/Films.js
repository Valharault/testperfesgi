import React, {Component} from 'react';
import axios from 'axios';

class Films extends Component {
    constructor() {
        super();
        this.state = {films: [], loading: true};
    }

    componentDidMount() {
        this.getFilms();
    }

    getFilms() {
        axios.get(`http://localhost:8000/api/films`).then(films => {
            console.log(films)
            this.setState({films: films.data.['hydra:member'], loading: false})
        })
    }

    render() {
        const loading = this.state.loading;
        return (
            <div>
                <section className="row-section">
                    <div className="container">
                        <div className="row">
                            <h2 className="text-center"><span>Top 10 des films</span></h2>
                        </div>
                        {loading ? (
                            <div className={'row text-center'}>
                                <span className="fa fa-spin fa-spinner fa-4x"></span>
                            </div>
                        ) : (
                            <div className={'row'}>
                                {this.state.films.map(film =>
                                    <div className="col-md-10 offset-md-1 row-block" key={film.id}>
                                        <ul id="sortable">
                                            <li>
                                                <div className="media">
                                                    <div className="media-body">
                                                        <h4>{film.title}</h4>
                                                        <p>{film.story}</p>
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

export default Films;
