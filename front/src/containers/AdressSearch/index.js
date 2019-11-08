// == Import : npm
import { connect } from 'react-redux';

// == Import : local
import AdressSearch from 'src/components/AdressSearch';

// Action Creators

import {
  updateQuery,
  selectAdress,
  changeSelectAdress,
  fetchQuery,
} from 'src/store/reducer/AdressSearchReducer/AdressSearchReducer';
/* === State (données) === */
const mapStateToProps = (state, ownProps) => {
  return {
    queryInput: state.adressSearch.queryInput,
    results: state.adressSearch.results,
    isSelected: state.adressSearch.isSelected,
  };
};
/* === Actions === */
const mapDispatchToProps = (dispatch) => ({
  changeQuery: (value) => {
    const action = updateQuery(value);
    dispatch(action);
  },

  handleFetchQuery: (value) => {
    const action = fetchQuery(value);
    dispatch(action);
  },

  changeAdress: (adresseSelected, lat, long) => {
    const action = selectAdress(adresseSelected, lat, long);
    dispatch(action);
  },
  HandeChangeSelectedAdress: () => {
    const action = changeSelectAdress();
    dispatch(action);
  },
});

// Container
const AdressSearchContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(AdressSearch);

// == Export
export default AdressSearchContainer;
