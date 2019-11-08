import React from 'react';
import { NavLink } from 'react-router-dom';

//POSTLIST BUTTON
export const postListButton = (
  <NavLink
    to="/postlist"
    key="postlist"
    exact
    activeClassName="navigation-item--active"
    className="navigation-item"
  >
    <button className="navbar-button-addpost" type="button">
      Fil d'actualités
    </button>
  </NavLink>
);

//ADDPOST BUTTON
export const addPostButton = (
  <NavLink
    to="/addPost"
    key="addpost"
    exact
    activeClassName="navigation-item--active"
    className="navigation-item"
  >
    <button className="navbar-button-addpost" type="button">
      Ajouter une annonce
    </button>
  </NavLink>
);



//SIGNIN BUTTON
export const signInButton = (
  <NavLink
    to="/sign/in"
    key="sign/in"
    exact
    activeClassName="navigation-item--active"
    className="navigation-item"
  >
    <button className="navbar-button-postlist" type="button">
      Se connecter
    </button>
  </NavLink>
);

//SIGNUP BUTTON
export const signUpButton = (
  <NavLink
    to="/sign/up"
    key="/sign/up"
    exact
    activeClassName="navigation-item--active"
    className="navigation-item"
  >
    <button className="navbar-button-postlist" type="button">
      S'incrire
    </button>
  </NavLink>
);

// //PROFIL USER
// export const profilUserButton = (
//   <NavLink
//     to="/user"
//     key="user"
//     exact
//     activeClassName="navigation-item--active"
//     className="navbar-user"
//   >
//     <p className="navbar-user-hello"><span className="navbar-user-hello-bold">Bonjour</span> Raton Généreux</p>
//     <img
//       className="navbar-user-profile"
//       src="/public/petit-raton-laveur.jpg"
//       alt="image profile"
//     />


//   </NavLink>
// );

