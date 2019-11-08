const initialState = {
  queryInput: '',
  results: [],
  isSelected: false,
  lat: '',
  lon: '',
};

// - Actions Types
export const UPDATE_QUERY = 'UPDATE_QUERY';
const RECEIVE_RESULTS = 'UPDATE_RESULTS';
export const FETCH_QUERY = 'FETCH_QUERY';
export const SELECTED_ADRESS = 'SELECTED_RESULT';
export const CHANGE_SELECTED_ADRESS = 'CHANGE_SELECTED_ADRESS';
export const STOP_LOAD = 'STOP_LOAD';
// - Reducer
const reducer = (state = initialState, action = {}) => {
  switch (action.type) {
    case UPDATE_QUERY:
      // console.log('UPDATE_QUERY', action);
      return {
        ...state,
        queryInput: action.query,
      };
    case RECEIVE_RESULTS:
      return {
        ...state,
        results: action.results,
      };
    case SELECTED_ADRESS:
      // console.log('je suis action', action);
      return {
        ...state,
        queryInput: action.adresseSelected,
        lat: action.lat,
        lon: action.lon,
        isSelected: true,
      };
    case CHANGE_SELECTED_ADRESS:
      // console.log('je suis action', action);
      return {
        ...state,
        isSelected: false,
      };
    default:
      return state;
  }
};

// - Actions Creators
export const updateQuery = (query) => ({
  type: UPDATE_QUERY,
  query,
});
export const fetchQuery = (query) => ({
  type: FETCH_QUERY,
  query,
});
export const receiveResults = (results) => ({
  type: RECEIVE_RESULTS,
  results,
});

export const selectAdress = (adresseSelected, lat, lon) => ({
  type: SELECTED_ADRESS,
  adresseSelected,
  lat,
  lon,
});

export const changeSelectAdress = () => ({
  type: CHANGE_SELECTED_ADRESS,
});

// export const fetchQuery = ( )=> ({
//   type: FETCH_QUERY,
// });

export const stopLoad = () => ({
  type: STOP_LOAD,
});
// - Selectors

// - Export
// !important! ne pas modifier le nom de l export!
export default reducer;
