// == Import : npm
import { connect } from 'react-redux';

// == Import : local
import Logs from 'src/components/Logs';

// Action Creators
import { exampleAction } from 'src/store/reducer/LogsReducer/logsReducer';

/* === State (données) === */
const mapStateToProps = (state, ownProps) => ({

});

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
