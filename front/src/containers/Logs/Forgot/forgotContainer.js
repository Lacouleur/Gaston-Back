// == Import : npm
import { connect } from 'react-redux';

// == Import : local
import Forgot from 'src/components/Logs/Forgot';

// Action Creators
import { exampleAction } from 'src/store/reducer/LogsReducer/forgotReducer';

/* === State (données) === */
const mapStateToProps = (state, onwProps) => ({
  
});

/* === Actions === */
const mapDispatchToProps = (dispatch, onwProps) => ({
  /*changeValue: (value) => {
    const action = changeInput(value);
    dispatch(action);
  },*/
});

// Container
const ForgotContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(Forgot);

// == Export
export default ForgotContainer;