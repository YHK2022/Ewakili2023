import React, { Component } from 'react'
import ReactDOM from 'react-dom'

export default class App extends Component {
    render() {
        return (
            <div className="">

                <header>
                    <nav className="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                        <a className="navbar-brand" href="#">eCMS</a>

                        <div className="collapse navbar-collapse" id="navbarCollapse">
                            <ul className="navbar-nav mr-auto">
                                <li className="nav-item active">
                                    <a className="nav-link" href="#">Home <span className="sr-only">(current)</span></a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </header>

                <div className="container">
                    <h2 className="mt-5 pt-5">eCase Management System</h2>
                </div>

                <footer className="footer">
                    <div className="container">
                        <span className="text-muted">&copy; 2021. eCase Management System.</span>
                    </div>
                </footer>

            </div>
        )
    }
}

if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('app'))
}