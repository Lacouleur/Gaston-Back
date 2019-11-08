// == Import : npm
import React from 'react';
import PropTypes from 'prop-types';
import { NavLink } from 'react-router-dom';

// == Import : local
import './welcome.scss';

// == Composant
const Welcome = ({}) => {
  // // const clickHandler = //changeView('login');
  //   console.log("1",changeView);
  // const clickHandler = () => {
  //   changeView('login')
  // };

  // console.log("I'm the welcome component");
  return (
    <div className="welcome">
      <img
        className="welcome-logo"
        src="/public/DumpsterLogos.svg"
        alt="Logo Gaston Racoon"
      ></img>
      <h1 className="welcome-appTitle"> Gaston </h1>
      <h2 className="welcome-subTitle"> L'appli anti-gaspi</h2>
      <div className="welcome-text"> 
        <p className="welcome-text-list">
          * <b>Gaston</b> vous aide à trouver des trésors autour de vous.
        </p>
        <p className="welcome-text-list">
          * <b>Gaston</b> lutte contre le gaspillage allimentaire et matériel.{' '}
        </p>
        <p className="welcome-text-list">
          * <b>Gaston</b> vous met en contact avec les autres acteurs de la
          lutte anti-gaspillage autour de vous.
        </p>
        <p className="welcome-text-list">
          * <b>Gaston</b> vous permet de trouver des événements associatifs dans
          votre ville.
        </p>
        <p className="welcome-text-list">
          * Faites comme <b>Gaston</b> , recyclez, partagez, donnez.
        </p>
        </div>
      <NavLink exact to="/sign/in" exact className="welcome-buttonStart">
        Gaston, montre moi des trésors
      </NavLink>
    </div>
  );
};

//PropTypes
Welcome.propTypes = {
  // changeView: PropTypes.func.isRequired,
};

// == Export
export default Welcome;
