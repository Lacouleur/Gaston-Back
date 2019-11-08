// - initialState
// token : 63535622ff913a1c37312859b1be50666de3008e
const initialState = {
  name1 : "teste1"
  name2 : "Le zizi"
  name3 : "un abricot"
  name4 : "Un ami corse"
};

// - Actions Types
const CHANGE_VALUE = 'CHANGE_VALUE';
export const SEARCH_REPOS = 'SEARCH_REPOS';


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
export const changeValue = (value, name) => ({
  type: CHANGE_VALUE,
  value,
});

// export const searchRepos = (value) => ({
//   type: SEARCH_REPOS, 

// })


// - Export
export default reducer;
