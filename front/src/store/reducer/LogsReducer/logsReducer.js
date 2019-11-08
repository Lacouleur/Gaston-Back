// - initialState
const initialState = {

};

// - Actions Types
const CHANGE_VALUE = 'CHANGE_VALUE';
export const EXAMPLE_MIDDLEWARE_ACTION = 'EXAMPLE_MIDDLEWARE_ACTION';

// - Reducer
const reducer = (state = initialState, action = {}) => {
  switch (action.type) {
    case CHANGE_VALUE:
      return {
        ...state,
        [action.name] : action.value,
      };
    default:
      return state;
  }
};

// - Actions Creators
export const changeValue = (value) => ({
  type: CHANGE_VALUE,
  value,
});

export const exampleMiddlewareAction = () => ({
  type: EXAMPLE_MIDDLEWARE_ACTION,
});

// - Selectors

// - Export
export default reducer;