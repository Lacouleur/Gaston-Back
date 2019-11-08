// == Import : npm
import React from 'react';
import PropTypes from 'prop-types';
import { Route, Switch } from 'react-router-dom';

// == Import : local
import './logs.scss';
import Welcome from 'src/containers/Logs/Welcome/welcomeContainer.js';
import Inscription from 'src/containers/Logs/Inscription/inscriptionContainer.js';
//import Login from 'src/containers/Logs/Login/loginContainer';
import Login from './Login';
import Forgot from './Forgot';


// == Composant
const Logs = () => {
  // console.log('2 CHANGE_VIEW LOGS :', changeView);

  return (
    <div className="logs">
      <Switch>
        <Route exact path="/sign/in" component={Login} />
        <Route exact path="/sign/up" component={Inscription} />
        <Route exact path="/sign/forgot" component={Forgot} />
      </Switch>
    </div>
  );
};

Logs.propTypes = {};

// == Export
export default Logs;
