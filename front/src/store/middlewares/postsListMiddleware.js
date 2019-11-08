import axios from 'axios';

import { UrlProd} from 'src/store/middlewares/connect_data.js';
import { filterPostList } from 'src/Utils/postsList';
// Import Reducer
import {
  FETCH_POSTS,
  FETCH_USERS,
  FETCH_CATEGORIES,
  STORE_POSTS_DETAILS,
  FETCH_POSTS_DETAILS,
  RECEIVE_POSTS,
  receivePosts,
  stopLoad,
  storePostsDetails,
  fetchPostsDetails,
} from 'src/store/reducer/PostsListReducer/postsListReducer';



import { UPDATE_VIEWPORT } from 'src/store/reducer/PostsListReducer/postsListReducer';
const postsListMiddleware = (store) => (next) => (action) => {
  const JWTToken = localStorage.user;
  let storeState = store.getState();
  const { viewport } = storeState.user;

  const { posts: postsList, postsListsDetails } = storeState.postsList;
  switch (action.type) {
    case FETCH_POSTS:
      // console.log('JE RECOIS LES POSTES §');
      // ici je vais réagir à FETCH_RECIPES (qui a été émise depuis componentDidMount dans App)
      // console.log("POSTLISTmiddleware(ligne29) / Case: FETCHPOST / la carte à été modifié, j'essaie de mettre à jour"),
      axios({
        method: 'POST',
        url:
          `${UrlProd}/api/map`,
        headers: { Authorization: `Bearer ${JWTToken}` },
        data: {
          zoom: viewport.zoom,
          lat: viewport.latitude,
          lng: viewport.longitude,
        },
      })
        .then((response) => {
          console.log('Reception des posts les plus proche sur La CARTE');
          console.log('succès', response.data);
          const receivePostsAction = receivePosts(response.data);
          store.dispatch(receivePostsAction);
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          const actionStopLoad = stopLoad();
          store.dispatch(actionStopLoad);
        });

    // case RECEIVE_POSTS:
    //   // console.log('JE RECOIS LES POSTES §');
    //   // ici je vais réagir à FETCH_RECIPES (qui a été émise depuis componentDidMount dans App)
    //   // console.log("POSTLISTmiddleware(ligne29) / Case: FETCHPOST / la carte à été modifié, j'essaie de mettre à jour"),
    //   const fetchPostsDetailsAction = fetchPostsDetails();
    //   store.dispatch(fetchPostsDetailsAction);

    case FETCH_POSTS_DETAILS:
      if (
        !postsList.hasOwnProperty('fail')
      ) {
        const props = ['id', 'distance'];
        var result = postsList
          .filter(function(o1) {
            // filter out (!) items in result2
            return !postsListsDetails.some(function(o2) {
              return o1.id !== o2.id; // assumes unique id
            });
          })
          .map(function(o) {
            // use reduce to make objects with only the required properties
            // and map to apply this to the filtered array as a whole
            return props.reduce(function(newo, distance) {
              newo[distance] = o[distance];
              return newo;
            }, {});
          });
        result.forEach((element) => {
          // console.log('======->', element);
          axios({
            method: 'GET',
            url: `${urlProd}/api/post/${element.id}`,
            headers: { Authorization: `Bearer ${JWTToken}` },
          })
            .then((response) => {
              // console.log('je suis la réponse GET DETAILS DU POST', {
              //   ...element,
              //   ...response.data,
              // });
              const postDetails = {
                ...element,
                ...response.data,
              };
              // console.log('succès', response.data);
              // je veux faire en sorte d'alimenter le state avec la réponse
              const storePostsDetailsAction = storePostsDetails(postDetails);
              store.dispatch(storePostsDetailsAction);
            })
            .catch((error) => {
              console.log(error);
            })
            .finally(() => {
              // dans tous les cas j'arrête de considérer qu'on charge
              console.log('JAI FINI DE TOUT CHARGER');
              const actionStopLoad = stopLoad();
              store.dispatch(actionStopLoad);
            });
        });
      } else {
        console.log('ERREUR TOO MUCH POST');
      }
      break;
    default:
      // je laisse passer les autres actions
      next(action);
  }
};

export default postsListMiddleware;
