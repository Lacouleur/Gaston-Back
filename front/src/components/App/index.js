// == Import : npm
import React from 'react';

// == Import : local
import './app.scss';
import NavBar from 'src/components/NavBar';
import MainContent from 'src/containers/MainContent/mainContentContainer.js';

// == Composant
class App extends React.Component {
  componentDidMount() {
    // console.log("je suis ici");
    const { fetchPosts } = this.props;
    // fetchPostsAction();
    // console.log('je refecht les posts');
    fetchPosts();
    console.log('APP APPP APPPAPPPDIDMOUNT');
    // const { postsListsDetails } = this.props;
    // console.log(postsListsDetails);
    // console.log('-------------');
  }
  render() {
    return (
      <div id="app">
        <NavBar className="navBar" />
        <MainContent />
      </div>
    );
  }
}

// == Export
export default App;
