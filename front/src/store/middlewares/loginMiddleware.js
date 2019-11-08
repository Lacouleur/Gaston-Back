import axios from 'axios';
import jwt_decode from 'jwt-decode';
import { getUserInformations } from 'src/store/reducer/UserReducer/userReducer';

export const AUTHENTICATED = 'authenticated_user';
export const UNAUTHENTICATED = 'unauthenticated_user';
export const AUTHENTICATION_ERROR = 'authentication_error';

import { UrlProd } from "src/store/middlewares/connect_data.js";

// export function logOutAction({}, history) {
//   return (dispatch) => {
//       dispatch({ type: UNAUTHENTICATED });
//       history.push('/');
//   };

export function logInAction({ username, password }, history) {
  return async (dispatch) => {
    try {
      const res = await axios.post(`${UrlProd}/api/login_check`, {
        username,
        password,
      });
      // console.log(res.data.token);

      let token = res.data.token;
      let tokenDecoded = jwt_decode(token);
      const { user_id } = tokenDecoded;
      //je recupere les informations de l'utilisateur en decryptant le token
      // console.log(tokenDecoded);
      localStorage.setItem('user', res.data.token);
      // console.log(getUserInformations);
      const getUserInformationsAction = getUserInformations(username, user_id);
      dispatch(getUserInformationsAction);
      // console.log('j envois username id au state');
      dispatch({ type: AUTHENTICATED });
      localStorage.setItem('user', res.data.token);

      history.push('/postList');
    } catch (error) {
      // console.log(error);
      dispatch({
        type: AUTHENTICATION_ERROR,
        payload: 'Pseudo ou Password invalide',
      });
    }
  };
}
