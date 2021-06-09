import React, {Component} from 'react';
import axios from 'axios';

class Actors extends Component {
    constructor() {
        super();
        this.state = {actors: [], loading: true};
    }

    componentDidMount() {
        this.getUsers();
    }

    getUsers() {
        axios.get(`http://localhost:8000/api/actor`).then(actors => {
            console.log(actors)
            this.setState({actors: actors.data, loading: false})
        })
    }

    render() {
        const loading = this.state.loading;
        return (
            <div>
                <section className="row-section">
                    <div className="container">
                        <div className="row">
                            <h2 className="text-center"><span>List of actors</span>Created with <i
                                className="fa fa-heart"></i> by ESGI Team</h2>
                        </div>
                        {loading ? (
                            <div className={'row text-center'}>
                                <span className="fa fa-spin fa-spinner fa-4x"></span>
                            </div>
                        ) : (
                            <div className={'row'}>
                                {this.state.actors.map(user =>
                                    <div className="col-md-10 offset-md-1 row-block" key={user.id}>
                                        <ul id="sortable">
                                            <li>
                                                <div className="media">
                                                    <div className="media-left align-self-center">
                                                        <img className="rounded-circle"
                                                             src={user.imageURL}/>
                                                    </div>
                                                    <div className="media-body">
                                                        <h4>{user.name}</h4>
                                                        <p>{user.description}</p>
                                                    </div>
                                                    <div className="media-right align-self-center">
                                                        <a href="#" className="btn btn-default">Contact Now</a>
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
