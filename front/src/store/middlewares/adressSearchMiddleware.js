import axios from 'axios';

import {
  UPDATE_QUERY,
  FETCH_QUERY,
  stopLoad,
  receiveResults,
  updateQuery,
  fetchQuery,
} from 'src/store/reducer/AdressSearchReducer/AdressSearchReducer';

const adressSearchMiddleware = (store) => (next) => (action) => {
  // console.log('je suis une action', action);
  // console.log('je suis la l adresse', action.query);
  switch (action.type) {
    case FETCH_QUERY:
      // ici je vais réagir à FETCH_RECIPES (qui a été émise depuis componentDidMount dans App)
      axios
        .get(
          `https://api-adresse.data.gouv.fr/search/?q=${action.query}&limit=5`,
        )
        .then((response) => {
          // console.log('succès', response.data.features);
          // je veux faire en sorte d'alimenter le state avec la réponse
          const receiveResultsAction = receiveResults(response.data.features);
          store.dispatch(receiveResultsAction);
        })
        .catch((error) => {
          console.error(error);
        })
        .finally(() => {
          // dans tous les cas j'arrête de considérer qu'on charge
          // const receiveUpdateQueryAction = updateQuery(action.query);
          // store.dispatch(receiveUpdateQueryAction);
        });
      // dans un switch on stoppe l'execution du switch à la fin de chaque case à l'aide de l'instruction break
      // l'instruction break permet de sortir du switch (fonctionne également dans un for, while)
      // on peut noter l'absence de break dans le reducer
      // parce qu'il y a un return dans chaque case, return est l'instruction qui stoppe l'execution d'une fonction
      break;
    default:
      // je laisse passer les autres actions
      next(action);
  }
};

export default adressSearchMiddleware;
