// == Import : npm
import React from 'react';

import PropTypes from 'prop-types';
import { NavLink } from 'react-router-dom';


// == Import : local
import './succeed.scss';


// == Composant
// https://medium.com/@bopaiahmd.mca/how-to-pass-props-using-link-and-navlink-in-react-router-v4-75dc1d9507b4
const Succeed = () => {

    return (
    <div className="container">

        <NavLink exact to="/postlist" className="succeed" >
            <img
            className="succeed-logo"
            src="/public/DumpsterLogos.svg"
            alt="Logo Gaston Racoon"
            />
            <p className="succeed-text">
                Votre post à bien été ajouté, cliquez pour retourner au fil d'actualités. 
            </p>

            <button className="succeed-button"> fil d'actualités </button>

        </NavLink>

    </div>

    );
}

// == Export
export default Succeed;
