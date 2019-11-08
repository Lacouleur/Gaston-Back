import Logs from "src/components/Logs";

// - initialState
const initialState = {
  contentView: 'logs', 
  currentView: 'welcome',
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
        contentView: action.contentvalue,
        currentView: action.value,
      };
    default:
      return state;
  }
};

// - Actions Creators
export const changeView = (value, contentvalue) => ({
  type: CHANGE_VIEW,
  value,
  contentvalue,
});

export const exampleMiddlewareAction = () => ({
  type: EXAMPLE_MIDDLEWARE_ACTION,
});

// - Selectors

// - Export
export default reducer;
