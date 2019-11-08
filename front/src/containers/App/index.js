// == Import : npm
import { connect } from 'react-redux';

// == Import : local
import App from 'src/components/App';

// Action Creators
import {
  fetchPosts,
  stopLoadPosts,
  fetchPostsDetails,
} from 'src/store/reducer/PostsListReducer/postsListReducer';
import { changeView } from 'src/store/reducer/AppReducer/appReducer';

/* === State (données) === */
const mapStateToProps = (state) => {
  // console.log ("STATE App = ", state);
  return {

  }
};
/* === Actions === */
const mapDispatchToProps = (dispatch) => ({
 

  //   updateViewport: (mapChange) => {
  //   dispatch(updateViewport(mapChange));
  //   // console.log(mapChange);
  // },

  // const mapDispatchToProps = (dispatch, ownProps) => ({
  // // doSomething: () => {
  // //   dispatch(doSomething("Coucou"));
  // // }
  fetchPosts: () => {
    dispatch(fetchPosts());
    // console.log(mapChange);
  },
// });

});

// Container
const AppContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(App);

// == Export
export default AppContainer;
