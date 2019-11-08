const initialState = {
  loading: false,
  mapboxApiAccessToken:
    'pk.eyJ1IjoiY29vbHNraW4yYiIsImEiOiJjazFtaTBwZ3IwMHdqM3ByMGs1ZW42MjB5In0.4_OP7fER3iedwRMZqfDppg',
  mapStyle: 'mapbox://styles/coolskin2b/ck2owomzl0ekk1cqh38czrwbn',
};

// // - Actions Types
// const UPDATE_VIEWPORT = 'UPDATE_VIEWPORT';

// - Reducer
const reducer = (state = initialState, action = {}) => {
  switch (action.type) {
    // case UPDATE_VIEWPORT:
    //   // console.log(action);
    //   return {
    //     ...state,
    //     viewport: action.viewport,
    //   };
    default:
      return state;
  }
};

// - Actions Creators
// export const updateViewport = (viewport) => ({
//   type: UPDATE_VIEWPORT,
//   viewport,
// });
// - Selectors

// - Export
// !important! ne pas modifier le nom de l export!
export default reducer;
