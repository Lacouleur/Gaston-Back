// == Import : npm
import { connect } from 'react-redux';

// == Import : local
import Logs from 'src/components/MainContent/';



/* === State (données) === */
const mapStateToProps = (state, ownProps) => {
 
    return {
        authenticated: state.auth.authenticated
    }
 }

/* === Actions === */
const mapDispatchToProps = (dispatch, ownProps) => ({
  changeValue: (value) => {
    const action = changeValue(value);
    dispatch(action);
  },
});

// Container
const LogsContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(Logs);

// == Export
export default LogsContainer;
