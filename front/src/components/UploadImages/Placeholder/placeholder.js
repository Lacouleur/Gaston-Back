import React from "react";
import PropTypes from "prop-types";
import { MdCloudUpload } from "react-icons/md";
import { IconContext } from "react-icons";

const Placeholder = ({ getInputProps, getRootProps, error, touched }) => (
  <>
  <p className="uploader-desc">
    Cliquez ou glisser pour ajouter une image</p> 
    <p className="uploader-desc uploader-desc-types">(jpeg,png,gif,bmp)</p> 
    
  <div
    {...getRootProps()}
    className={`uploader-placeholder-preview ${error && touched ? "uploader-has-error" : ""}`}
  >
    
    <input {...getInputProps()} />
    <IconContext.Provider value={{ className: 'uploader-icon' }}>
      <MdCloudUpload  />
    </IconContext.Provider>

  </div>
  </>
);

Placeholder.propTypes = {
  error: PropTypes.string,
  getInputProps: PropTypes.func.isRequired,
  getRootProps: PropTypes.func.isRequired,
  touched: PropTypes.bool
};

export default Placeholder;
