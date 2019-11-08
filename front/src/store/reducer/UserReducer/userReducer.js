const initialState = {
  userID: '',
  username: '',
  viewport: {
    // !Order : latitude Longitude!
    latitude: 0,
    longitude: 0,
    zoom: 15,
  },
};

// - Actions Types
export const UPDATE_VIEWPORT = 'UPDATE_VIEWPORT';
export const GET_USER_INFORMATIONS = 'GET_USER_INFORMATIONS';
export const SAVE_USER_INFORMATIONS = 'SAVE_USER_INFORMATIONS';
export const GET_USER_ADRESS_DETAILS = 'GET_USER_ADRESS_DETAILS';
export const GET_USER_GEOGRAPHICAL_DETAILS = 'GET_USER_GEOGRAPHICAL_DETAILS';
// - Reducer
const reducer = (state = initialState, action = {}) => {
  switch (action.type) {
    case SAVE_USER_INFORMATIONS:
      // console.log('je passe ca au state', action);
      return {
        ...state,
        userID: action.userID,
        username: action.username,
        // viewport: action.viewport,
      };
    case GET_USER_GEOGRAPHICAL_DETAILS:
      // console.log(action);
      return {
        ...state,
        viewport: {
          latitude: action.latitude,
          longitude: action.longitude,
          zoom: 15,
        },
        // viewport: action.viewport,
      };
    case UPDATE_VIEWPORT:
      // console.log(action);
      return {
        ...state,
        viewport: action.viewport,
      };
    default:
      return state;
  }
};

// - Actions Creators
export const updateViewport = (viewport) => ({
  type: UPDATE_VIEWPORT,
  viewport,
});
export const getUserInformations = (username, userID) => ({
  type: GET_USER_INFORMATIONS,
  username,
  userID,
});
export const saveUserInformations = (username, userID) => ({
  type: SAVE_USER_INFORMATIONS,
  username,
  userID,
});
export const getGeographicalInformations = (latitude, longitude) => ({
  type: GET_USER_GEOGRAPHICAL_DETAILS,
  latitude,
  longitude,
});

// - Selectors

// - Export
// !important! ne pas modifier le nom de l export!
export default reducer;
