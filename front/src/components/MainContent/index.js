// == Import : npm
import React from 'react';
import { Route, Switch } from 'react-router-dom';
import store from 'src/store/store.js';

// == Import : local
import './maincontent.scss';
// import { AUTHENTICATED } from 'src/store/middlewares/loginMiddleware.js';
import Logs from 'src/components/Logs';
import Map from 'src/containers/Map';
import AddPostForm from 'src/components/AddPost/AddPostForm';
import PostsList from 'src/containers/PostsList';
import Welcome from 'src/containers/Logs/Welcome/welcomeContainer.js';
import AdressSearch from 'src/components/AdressSearch';
import Forgot from 'src/components/Logs/Forgot';
import Inscription from 'src/components/Logs/Inscription';
import AddPost from 'src/components/AddPost';





//== Securtity
import requireAuth from 'src/security/requireAuth';
import noRequireAuth from 'src/security/noRequireAuth';

// == Composant
class MainContent extends React.Component {
  state = {
    isMobile: false,
  };

  handleWindowResize = () => {
    this.setState({ isMobile: document.documentElement.clientWidth < 480 });
  };

  componentDidMount() {
    this.setState({ isMobile: document.documentElement.clientWidth < 480 });
    window.addEventListener('resize', this.handleWindowResize);
  }

  componentWillUnmount() {
    window.removeEventListener('resize', this.handleWindowResize);
  }


  mapViewIfLog() {
    const authenticated = this.props.authenticated;
    
    if (authenticated === true ) {
      return (
        <div className="mapContainer">
        <Map />
       </div>
      );
    }else{
      return (
        <div className="mapContainer">
      <div className="mapContainer-image"></div>
      </div>
    );
    }
  };

  render() {
    const user = localStorage.getItem('user');
    const { isMobile } = this.state;
    console.log( "auth", this.props.authenticated);
    const authenticated = this.props.authenticated;
    //console.log(isMobile);
    //DEBUG
    // console.log("requireAuth ===> ", requireAuth);
    // console.log("noRequireAuth ===> ", noRequireAuth);

    // if (user) {
    //   store.dispatch({ type: AUTHENTICATED });
    // }
    // <Route exact path="/succeed" component={requireAuth(Succeed)}/>
    return (
      <main className="maincontainer">
        <section className="contentContainer">
          <Switch>
            <Route exact path="/" component={Welcome} />
            <Route exact path="/postlist" component={requireAuth(PostsList)} />
            <Route path="/sign/in" component={noRequireAuth(Logs)} />
            <Route path="/sign/up" component={noRequireAuth(Inscription)} />
            <Route path="/sign/forgot" component={noRequireAuth(Forgot)} />
            <Route exact path="/addPost" component={requireAuth(AddPost)}/>
            <Route exact path="/addPost/form" component={requireAuth(AddPostForm)}/>

            <Route>
              <div>
                <AdressSearch />
                <h1>Page non trouvée</h1>
              </div>
            </Route>
          </Switch>
        </section>
        {/* {!isMobile && ( */}
      {authenticated &&  
        <div className="mapContainer">
      <Map />
     </div>}
     {!authenticated && 
      <div className="mapContainer">
      <div className="mapContainer-image"></div>
      </div>}
     
        
      </main>
    );
  }
}

const mapStateToProps = (state) => {
  return {
    authenticated : state.auth.authenticated,
  };
};

MainContent.defaultProps = {
  authenticated : false,
};



// == Export
export default MainContent;
