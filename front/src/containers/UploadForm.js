import React, { Component } from "react";
import { Form, Field, reduxForm } from "redux-form";
import DropZoneField from "src/components/UploadImages/DropzoneField/dropzoneField";

import 'src/components/UploadImages/uploadImages.scss';

const imageIsRequired = value => (!value ? "Required" : undefined);

class UploadImageForm extends Component {
  state = { imageFile: [] };

  // handleFormSubmit = formProps => {
  //   const fd = new FormData();
  //   fd.append("imageFile", formProps.imageToUpload.file);
  //   // append any additional Redux form fields
  //   // create an AJAX request here with the created formData

  //   alert(JSON.stringify(formProps, null, 4));
  // };

  handleOnDrop = (newImageFile, onChange) => {
    const imageFile = {
      file: newImageFile[0],
      name: newImageFile[0].name,
      preview: URL.createObjectURL(newImageFile[0]),
      size: newImageFile[0].size
    };

    this.setState({ imageFile: [imageFile] }, () => onChange(imageFile));
  };

  resetForm = () => this.setState({ imageFile: [] }, () => this.props.reset());
  //<Form onSubmit={this.props.handleSubmit(this.handleFormSubmit)}> </Form>
  render = () => (
    <>
    <div className="uploader">
        <Field
          className="uploader-field"
          name="imageToUpload"
          component={DropZoneField}
          type="file"
          imagefile={this.state.imageFile}
          handleOnDrop={this.handleOnDrop}
          validate={[imageIsRequired]}
        />
    </div>

        <button
        type="button"
        className="uploader-clear"
        // className="uk-button uk-button-default uk-button-large clear"
        disabled={this.props.pristine || this.props.submitting}
        onClick={this.resetForm}
        >
        Vider
        </button>
    </>
  );
}

export default reduxForm({ form: "UploadImageForm" })(UploadImageForm);
