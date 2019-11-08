// == Import : npm
import { connect } from 'react-redux';

// == Import : local
import PostsList from 'src/components/PostsList';

// Action Creators
import {
  fetchPosts,
  stopLoadPosts,
  fetchPostsDetails,
} from 'src/store/reducer/PostsListReducer/postsListReducer';

/* === State (données) ===
 * - mapStateToProps retroune un objet de props pour le composant de présentation
 * - mapStateToProps met à dispo 2 params
 *  - state : le state du store (getState)
 *  - ownProps : les props passées au container
 * Pas de data à transmettre ? const mapStateToProps = null;
 */
const mapStateToProps = (state, ownProps) => {
  console.log('Current Store State in PostListsContainer: ', state);

  return {
    postsListsDetails: state.postsList.postsListsDetails,
    posts:state.postsList.posts,
    loading: state.postsList.loading,
  };
};

/* === Actions ===
 * - mapDispatchToProps retroune un objet de props pour le composant de présentation
 * - mapDispatchToProps met à dispo 2 params
 *  - dispatch : la fonction du store pour dispatcher une action
 *  - ownProps : les props passées au container
 * Pas de disptach à transmettre ? const mapDispatchToProps = {};
 */
const mapDispatchToProps = (dispatch, ownProps) => ({
  // fetchPostsDetailsAction: () => {
  //   dispatch(fetchPostsDetails());
  // },
  fetchPostsAction: () => {
    dispatch(fetchPosts());
    // console.log(mapChange);
  },
});

// Container
const PostsListContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(PostsList);

// == Export
export default PostsListContainer;

/* = export à la volée
export default connect(
  mapStateToProps,
  mapDispatchToProps,
)(Map);
*/
