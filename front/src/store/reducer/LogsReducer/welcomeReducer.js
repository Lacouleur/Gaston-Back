// - initialState
const initialState = {

  };
  
  // - Actions Types
  const CHANGE_VIEW = 'CHANGE_VIEW';
  export const EXAMPLE_MIDDLEWARE_ACTION = 'EXAMPLE_MIDDLEWARE_ACTION';
  
  // - Reducer
  const reducer = (state = initialState, action = {}) => {
    switch (action.type) {
      case CHANGE_VIEW:
        return {
          ...state,
          currentView: action.value,
        };
      default:
        return state;
    }
  };
  
  // - Actions Creators
  export const qzetfgqze = (value) => ({
    type: CHANGE_VIEW,
    value,
  });
  
  export const exampleMiddlewareAction = () => ({
    type: EXAMPLE_MIDDLEWARE_ACTION,
  });
  
  // - Selectors
  
  // - Export
  export default reducer;