// == Import : npm
import React from 'react';
import PropTypes from 'prop-types';
import { NavLink } from 'react-router-dom';
import { Field, reduxForm } from 'redux-form';
import { registerAction } from 'src/store/middlewares/registerMiddleware';
import { connect } from 'react-redux';
// == Import : local
import './register.scss';
import fieldsData from './fieldsData';
import AdressSearch from 'src/containers/AdressSearch';


// == Composant
class Register extends React.Component {
  submit = (values) => {
    const { addressLabel, lat, lng } = this.props;
    const latitude = { lat: parseFloat(lat) };
    const longitude = { lng: parseFloat(lng) };
    const allValues = { ...values, addressLabel, ...latitude, ...longitude };
    this.props.registerAction(allValues, this.props.history);
    // console.log('Value soumission:', allValues);
  };
  /* SOUCIS : Le mlessage d'erreur est aussi déclenché par les erreurs dans le champ login ... même state : state.auth
  // errorMessage() {
  //   if (this.props.errorMessage) {
  //     return (
  //       <div className="inscription-info-red">{this.props.errorMessage}</div>
  //     );
  //   }
  // }
 */
  render() {
    // Field infos import from ./fieldsdata
    const { handleSubmit, adresse } = this.props;
    const datasFields = fieldsData.fields;
    return (
      <div className="inscription">
        <img
          className="inscription-logo"
          src="/public/DumpsterLogos.svg"
          alt="Logo Gaston Racoon"
        ></img>
        <h2 className="inscription-subTitle"> Inscription </h2>
        <p className="inscription-text">
          Merci de bien vouloir remplir ces champs pour vous inscrire
        </p>
        {/*this.errorMessage()*/}
        <form
          className="inscription-form"
          onSubmit={
            handleSubmit(this.submit) /* handleSubmit comming from Redux-Form */
          }
        >
          {datasFields.map((field) => (
            <Field
              key={field.name}
              name={field.name}
              component="input"
              placeholder={field.placeholder}
              type={field.type}
              className="inscription-form-input"
            />
          ))}
          <AdressSearch css={"inscription-form-input"} />
          <button className="inscription-form-submit" type="submit">
            S'inscrire
          </button>
        </form>

        {/*this.errorMessage()*/}
        <NavLink exact to="/sign/in" exact>
          <button className="inscription-retour" type="button">
            Retour
          </button>
        </NavLink>
      </div>
    );
  }
}

const mapStateToProps = (state) => {
  return {
    errorMessage: state.auth.error,
    addressLabel: state.adressSearch.queryInput,
    lat: state.adressSearch.lat,
    lng: state.adressSearch.lon,
  };
};

const reduxFormRegister = reduxForm({
  form: 'register',
})(Register);

export default connect(
  mapStateToProps,
  { registerAction },
)(reduxFormRegister);

//PropTypes
Register.propTypes = {};
