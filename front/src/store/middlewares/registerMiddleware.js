import axios from 'axios';

//actions ajoutés à authReducer
export const REGISTRED = 'registred_user';
export const NOT_REGISTRED = 'not_registred_user';
export const REGISTER_ERROR = 'register_error';

import { UrlProd } from "src/store/middlewares/connect_data.js";

  // Pour Prod :
  // 'http://backend.dumpsters.grxl.fr';

// {
//     "username": "test",
//     "email": "test@test.com",
//     "password": "test",
//     "addressLabel": "99, place de Ramos\n42 759 Chretienboeuf",
//     "lat": 47.896236,
//     "lng": 13.632601
//   }

export function registerAction(values) {
  // console.log('registerMiddleware is working');
  //   console.log('Here is a state Sir :', adresse{adresse}, ...values);
  // console.log('History, second argument of registerAction :', history);
  // console.log("TOKEN ?", res.data.token)
  return async (dispatch) => {
    //https://github.com/O-clock-Universe/react-e17-challenge-github-login-Lacouleur-v2-/blob/master/src/store/middlewares/ajaxMiddleware.js
    try {
      const res = await axios.post(`${UrlProd}/user-new`, {
        ...values,
      });
      dispatch({ type: REGISTRED });

      // localStorage.setItem('user', res.data.token);
      history.push('/log/in');
    } catch (error) {
      dispatch({
        type: REGISTER_ERROR,
        // If "{#~¹`\^@]}" special character not authorized
        // if less than 4 character "please minimum 4 charater"
        // pull and display erros from server ... ??? possible ?
        payload: 'Erreur Formulaire',
      });
    } finally {
    }
  };
}
