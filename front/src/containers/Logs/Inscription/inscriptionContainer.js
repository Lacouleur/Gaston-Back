// == Import : npm
import { connect } from 'react-redux';

// == Import : local
import Inscription from 'src/components/Logs/Inscription';

// Action Creators
// import { exampleAction } from 'src/store/reducer/LogsReducer/inscriptionReducer';

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
)(Inscription);

// == Export
export default ForgotContainer;