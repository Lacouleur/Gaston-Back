import axios from 'axios';
import querystring from 'querystring';
//actions ajoutés à authReducer
export const ADD_POST = 'add_post';
export const ADDPOST_ERROR = 'addpost_error';

import { UrlProd } from 'src/store/middlewares/connect_data.js';
import {
  RECEIVE_POSTS,
  FETCH_POSTS,
  addPostFromUser,
} from 'src/store/reducer/PostsListReducer/postsListReducer';
export function addPostAction(values) {
  // var bodyFormData = new FormData();
  // bodyFormData.append('category', values.category);
  // const catTest =
  const JWTToken = localStorage.user;
  const headers = {
    headers: {
      Authorization: `Bearer ${JWTToken}`,
      'Content-Type': 'multipart/form-data',
    },
  };
  return async (dispatch) => {
    try {
      console.log('Posting post...');
      const res = await axios.post(`${UrlProd}/api/post-new`, values, headers);
      console.log("res.data l26 addPostMiddlzWare =>", res.data);
      //res.data
      dispatch({ type: ADD_POST });
      // localStorage.setItem('user', res.data.token);
      //     console.log('je cherche a reprendre la liste des postes apres une publication')
      dispatch({
        type: FETCH_POSTS,
      });
      const addPostFromUserAction = addPostFromUser(res.data);
      store.dispatch(addPostFromUserAction);
    } catch (error) {
      console.log(error);
      dispatch({
        type: ADDPOST_ERROR,
        payloadAddPost: 'Erreur Formulaire',
      });
    } finally {
    }
  };
}