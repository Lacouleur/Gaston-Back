// == Import : npm
import React from 'react';
import PropTypes from 'prop-types';
import { NavLink } from 'react-router-dom';
import { Field, reduxForm } from 'redux-form';
import { addPostAction } from 'src/store/middlewares/addPostMiddleware';
import { connect } from 'react-redux';
import { Receiver } from 'react-file-uploader';

//FOR UPLOAD IMAGES
import UploadForm from 'src/containers/UploadForm';
import 'uikit/dist/css/uikit.min.css';

// == Import : local
import AdressSearch from 'src/containers/AdressSearch';
import './addPostForm.scss';

//hum ?
// == Composant
class AddPostForm extends React.Component {
  submit = (values) => {
    const { addressLabel, imageForm, lat, lng } = this.props;
    const post_status_id = { 'post_status_id': 112 };
    const visibility_id = { 'visibility_id': 112 };
    const wear_condition_id = { 'wear_condition_id': 112 };
    const category_id = { 'category_id': 112 };

    const { file: image } = imageForm.values.imageToUpload;
    const { category } = this.props.location.infos;
    const latitude = { lat: parseFloat(lat) };
    const longitude = { lng: parseFloat(lng) };
    const allValues = {

      image,
      ...values,
      category,
      addressLabel,
      ...latitude,
      ...longitude,
    };

    this.convertToFormData(allValues);
    this.props.history.push('/postlist');
    // this.props.addPostAction(allValues, this.props.history);
    // // console.log('Value soumission:', allValues);
  };

  convertToFormData = (fields) => {
    if (fields) {
      const form_data = new FormData();

      for (var key in fields) {
        if (key === 'file') {
          form_data.append(key, fields[key][0]);
        } else {
          form_data.append(key, fields[key]);
        }
      }
      this.props.addPostAction(form_data);
    }
  };

  render() {
    // const stylecss = 'don';
    const userName = 'Raton Généreux';
    const { handleSubmit } = this.props;
    // console.log('CATEGORY', this.props.location.infos);

    const { stylecss, category, catNum } = this.props.location.infos;
    // console.log ("STYLECSS", stylecss);

    return (
      <div className="addPostForm">
        <div className={`addPostForm-cat--${stylecss}`}>{category}</div>
        <div className="addPostForm-user">
          <img
            src="/public/petit-raton-laveur.jpg"
            alt="user avatar"
            className="addPostForm-user-avatar"
          />

          <p className="addPostForm-user-username">{userName}</p>
          <div className="addPostForm-user-line" />
        </div>

        <form
          className="addPostForm-form"
          onSubmit={
            handleSubmit(this.submit) /* handleSubmit comming from Redux-Form */
          }
        >
          <p className="addPostForm-form-desc">titre de l'annonce</p>
          <Field
            key="title"
            name="title"
            component="input"
            placeholder="Titre de l'annonce"
            type="text"
            className={`addPostForm-form-title--${stylecss}`}
          />

          <p className="addPostForm-form-desc">description</p>
          <Field
            key="description"
            name="description"
            component="textarea"
            placeholder="Description de l'annonce"
            type="text"
            className={`addPostForm-form-description--${stylecss}`}
          />

          <AdressSearch css={`addPostForm-form-adress--${stylecss}`} />
          <UploadForm />

          <button
            className={`addPostForm-form-submit--${stylecss}`}
            type="submit"
          >
            Publier
          </button>
        </form>

        <NavLink to="/addPost" key="back">
          <p className="addPostForm-form-retour">Retour</p>
        </NavLink>
      </div>
    );
  }
}

const mapStateToProps = (state, ownProps) => {
  return {
    addressLabel: state.adressSearch.queryInput,
    lat: state.adressSearch.lat,
    lng: state.adressSearch.lon,
    imageForm: state.form.UploadImageForm,
  };
};

const reduxFormAddPost = reduxForm({
  form: 'addpost',
})(AddPostForm);

// Config Properties
// IMPORTANT: All of these configuration options may be passed into reduxForm() at "design time" or passed in as props to your component at runtime.

// Required
// form : String [required]     <----
// the name of your form and the key to where your form's state will be mounted under the redux-form reducer

export default connect(
  mapStateToProps,
  { addPostAction },
)(reduxFormAddPost);

// const reduxFormRegister = reduxForm({
//     form: 'register',
//   })(Register);

//   export default connect(
//     mapStateToProps,
//     { registerAction },
//   )(reduxFormRegister);
//PropTypes

AddPostForm.propTypes = {};

AddPostForm.defaultProps = {
  stylecss: 'don',
  imageForm: '',
};
