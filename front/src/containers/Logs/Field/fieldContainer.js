// == Import : npm
import { connect } from 'react-redux';

// == Import : local
import Field from 'src/components/Logs/Field';

// Action Creators
import { handleInput } from 'src/store/reducer/LogsReducer/fieldReducer';

/* === State (données) === */
const mapStateToProps = (state, ownProps) => {
  // console.log("Input state =", state);
  return {
  fieldState: state.field

}
};

/* === Actions === */
const mapDispatchToProps = (dispatch, onwProps) => ({
  handleInput: (value, name) => {
    const action = changeValue(value, name);
    dispatch(action);
  },
});

// Container
const FieldContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(Field);

// == Export
export default FieldContainer;