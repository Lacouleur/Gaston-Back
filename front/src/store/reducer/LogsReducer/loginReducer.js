// - initialState
const initialState = {
    Examplename : 'ExampleValue'
  };
  
  // - Actions Types
  const EXAMPLE_ACTION = 'EXAMPLE_ACTION';
  export const EXAMPLE_MIDDLEWARE_ACTION = 'EXAMPLE_MIDDLEWARE_ACTION';
  
  // - Reducer
  const reducer = (state = initialState, action = {}) => {
    switch (action.type) {
      case EXAMPLE_ACTION:
        return {
          ...state,
          Examplename : action.value,
        };
      default:
        return state;
    }
  };
  
  // - Actions Creators
  export const exampleAction = (value) => ({
    type: EXAMPLE_ACTION,
    value,
  });
  
  export const exampleMiddlewareAction = () => ({
    type: EXAMPLE_MIDDLEWARE_ACTION,
  });
  
  // - Selectors
  
  // - Export
  export default reducer;