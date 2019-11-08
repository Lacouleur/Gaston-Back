// Import Local NPM
import React from 'react';
import { NavLink } from 'react-router-dom';
import { connect } from 'react-redux';
import { Field, reduxForm } from 'redux-form';
// Import Local
import './navbar.scss';
import AdressSearch from 'src/components/AdressSearch';
import {
  postListButton,
  addPostButton,
  signInButton,
  signUpButton,
} from './ressources';
import { UNAUTHENTICATED } from 'src/store/middlewares/loginMiddleware';
/*

SCHEMA DE LA NAVBAR

#####case CONNECTE######### [PostList] ##### [ajouter une annonce]####### bonjour "Jesus" - se déconnecter - AVATAR
                                                                                  <-----------/


#####case NON CONNECTE######### [Se connecte] ##### [s'inscrire]####### PAS DAVATAR

*/

//  Composant

class Navbar extends React.Component {
  // const clickHandler = changeView('addPost');

  signOutAction = () => () => {
    console.log ("déconnexion !!")
    localStorage.clear();
    return {
      type: UNAUTHENTICATED,
    };
  };
  navbarLinks() {
    //CASE IS CONNECTED
    if (this.props.authenticated) {
      return [
        //(see ./ressources.js)
        postListButton,
        addPostButton,
      ];
    }
    //CASE NON-CONNECTE
    return [
      //(see ./ressources.js)
      signInButton,
      signUpButton,
    ];
  }

  navbarUser() {
    //CASE IS CONNECTED
    if (this.props.authenticated) {
      return (
        <NavLink
          to="/postlist"
          key="user"
          exact
          activeClassName="navigation-item--active"
          className="navbar-user"
        >
          <p className="navbar-user-hello">
            <span className="navbar-user-hello-bold">Bonjour</span>{' '}
            {this.props.username}
          </p>
          <img
            className="navbar-user-profile"
            src="/public/petit-raton-laveur.jpg"
            alt="image profile"
          />
        </NavLink>
      );
    }
  }

  navbarLogOut() {
    //signinOUT BUTTON
    if (this.props.authenticated) {
      return (
        <NavLink
          to="/"
          key="logout"
          exact
          // className="navbar-button-logout"
        >
          <button className="navbar-button-logout" onClick={this.signOutAction()} type="button">
            Se déconnecter
          </button>
        </NavLink>
      );
    }
  }

  render() {
    return (
      <nav className="navbar">
        {/* // LOGO GASTON */}
        <NavLink
          to="/"
          exact
          activeClassName="navigation-item--active"
          className="navigation-item"
        >
          <img
            className="navbar-logo"
            src="/public/DumpsterLogoswhite.png"
            alt="Logo Gaston Racoon white"
          />
        </NavLink>
        {this.navbarLinks()}
        {this.navbarLogOut()}
        {this.navbarUser()}
      </nav>
    );
  }
}

function mapStateToProps(state) {
  return {
    authenticated: state.auth.authenticated,
    unauthenticated: state.auth.unauthenticated,
    username: state.user.username,
  };
}

export default connect(mapStateToProps)(Navbar);
