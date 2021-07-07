import React, {Component} from 'react';
import {Route, Switch, Redirect, Link, withRouter} from 'react-router-dom';
import Actors from './Actors';
import Posts from './Posts';
import Films from './Films';
import Producer from "./Producer";

class Home extends Component {

    render() {
        return (
            <div>
                <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
                    <Link className={"navbar-brand"} to={"/"}> ALLOCINÉ </Link>
                    <div className="collapse navbar-collapse" id="navbarText">
                        <ul className="navbar-nav mr-auto">
                            <li className="nav-item">
                                <Link className={"nav-link"} to={"/actors"}> Acteurs </Link>
                            </li>

                            <li className="nav-item">
                                <Link className={"nav-link"} to={"/posts"}> Actus </Link>
                            </li>
                            <li className="nav-item">
                                <Link className={"nav-link"} to={"/films"}> Top 10 films </Link>
                            </li>
                            <li className="nav-item">
                                <Link className={"nav-link"} to={"/producer"}> Les producteurs populaires </Link>
                            </li>
                        </ul>
                    </div>
                </nav>
                <Switch>
                    <Redirect exact from="/" to="/actors"/>
                    <Route path="/actors" component={Actors}/>
                    <Route path="/posts" component={Posts}/>
                    <Route path="/films" component={Films}/>
                    <Route path="/producer" component={Producer}/>
                </Switch>
            </div>
        )
    }
}

export default Home;
