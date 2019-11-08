// == Import : npm
import React from 'react';

import PropTypes from 'prop-types';
import { NavLink } from 'react-router-dom';
import AddPostForm from "src/components/AddPost/AddPostForm";

// == Import : local
import './addPost.scss';


// == Composant
// https://medium.com/@bopaiahmd.mca/how-to-pass-props-using-link-and-navlink-in-react-router-v4-75dc1d9507b4
const AddPost = () => {

    return (
    <div className="Container">
        <div className="addPost">

            <h1 className="addPost-title">Que voulez vous ajouter ?</h1>

            <NavLink to={{
                pathname:"/addPost/form",
                infos : {
                    stylecss : "don",
                    category : "don", 
                } 
                }}
                key="don" >
                <p className="addPost-desc">J'ai quelque chose à donner</p>
                <button className="addPost-don">DON</button>
            </NavLink>
            

            <NavLink to={{
                pathname:"/addPost/form",
                infos : {
                    stylecss : "tresor",
                    category : "trésor", 
                } 
                }} key="tresor" stylecss="tresor">
                <p className="addPost-desc">Il y a quelque chose à récupérer dans la rue</p>
                <button className="addPost-tresor">TRÉSOR</button>
            </NavLink>

            <NavLink to={{
                pathname:"/addPost/form",
                infos : {
                    stylecss : "event",
                    category : "événement", 
                } 
                }} key="event" stylecss="event">
                <p className="addPost-desc">J'organise un événement</p>
                <button className="addPost-evenement">ÉVÉNEMENT</button>
            </NavLink>

            <NavLink to={{
                pathname:"/addPost/form",
                infos : {
                    stylecss : "help",
                    category : "aide", 
                } 
                }} key="help" stylecss="help">
                <p className="addPost-desc">Faire une demande d'aide</p>
                <button className="addPost-aide">AIDE</button>
            </NavLink>

            <NavLink to="/postlist" key="back" className="addPost-retour">
            retour
            </NavLink>
      </div>
    </div>

);
    }

//PropTypes

AddPost.propTypes = {

};

// == Export
export default AddPost;