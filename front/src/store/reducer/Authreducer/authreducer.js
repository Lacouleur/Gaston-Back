import {
  AUTHENTICATED,
  UNAUTHENTICATED,
  AUTHENTICATION_ERROR,
} from 'src/store/middlewares/loginMiddleware';
import {
  REGISTER_ERROR,
  REGISTRED,
  NOT_REGISTRED,
} from 'src/store/middlewares/registerMiddleware';
import {
  ADD_POST,
  ADDPOST_ERROR,
} from 'src/store/middlewares/addPostMiddleware';

export default function(state = {}, action) {
  switch (action.type) {
    //SIGNIN
    case AUTHENTICATED:
      return { ...state, authenticated: true };
    case UNAUTHENTICATED:
      return { ...state, authenticated: false };
    case AUTHENTICATION_ERROR:
      return { ...state, error: action.payload };

    //REGISTERING
    case REGISTRED:
      return { ...state, authenticated: true };
    case NOT_REGISTRED:
      return { ...state, authenticated: false };
    case REGISTER_ERROR:
      return { ...state, error: action.payload };

    //ADDPOST
    case ADD_POST :
        return {...state, validation: "Nouveau post ajouté"};
    case ADDPOST_ERROR:
        return { ...state, error: action.payloadAddPost};
  }


  return state;
}
