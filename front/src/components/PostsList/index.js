// == Import : npm
import React from 'react';
import PropTypes from 'prop-types';
import { BeatLoader } from 'react-spinners';

// == Import : local
import './postsList.scss';
import PostsFilters from './PostsFilters';
import PostsCard from './PostsCard';

// == Composant

// const PostsList = ({ postsListsDetails, loading }) => {
class PostsList extends React.Component {
  componentDidMount() {
    // console.log("je suis ici");
    const { fetchPostsAction, posts } = this.props;
    fetchPostsAction();
    console.log('DIDMOUNT');
    const { loading, postsListsDetails } = this.props;
    console.log(postsListsDetails);
    console.log('-------------');
  }
  // componentDidUpdate() {
  //   // const { fetchPostsAction, fetchPostsDetailsAction } = this.props;
  //   console.log('DIDUPDATE');
  //   const { loading, postsListsDetails } = this.props;
  //   console.log(postsListsDetails);
  //   console.log('-------------');
  // }
  // componentWillUnmount() {
  //   // const { fetchPostsAction, fetchPostsDetailsAction } = this.props;
  //   console.log('WillUnmount');
  //   const { loading, postsListsDetails, posts } = this.props;
  //   console.log(postsListsDetails);
  //   console.log('-------------');
  // }
  render() {
    const { loading, postsListsDetails, posts } = this.props;
    return (
      <>
        <PostsFilters />
        {loading && (
          <div className="sweet-loading">
            <div className="sweet-loading--center">
              <BeatLoader color={'#123abc'} loading={loading} />
            </div>
          </div>
        )}
        {!loading && (
          <article className="posts-container">
            {postsListsDetails.map((post) => (
              <PostsCard postdetails={post} key={post.id} />
            ))}
          </article>
        )}
      </>
    );
  }
}

PostsList.propTypes = {
  postsListsDetails: PropTypes.arrayOf(
    PropTypes.shape({
      id: PropTypes.number.isRequired,
    }),
  ).isRequired,
};
// == Export
export default PostsList;
