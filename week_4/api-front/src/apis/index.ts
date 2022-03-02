import axios from 'axios';
import User from '@/types/User.d';
import PostArticle from '@/types/PostArticle.d';
import PaginatedArticles from '@/types/PaginatedArticles.d';
import ResponseArticle from '@/types/ResponseArticle.d';

const api = axios;

const config = {
  baseUrl: 'http://127.0.0.1:8000/api/v1',
  headers: {
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json',
    },
  },
};

type RegisterData = {
  name: string,
  email: string,
  password: string,
  // eslint-disable-next-line camelcase
  password_confirmation: string,
}

type LoginData = {
  email: string,
  password: string,
}

export const postRegister = (data: RegisterData): User => api.post(`${config.baseUrl}/register`, data, config.headers);

export const postLogin = (data: LoginData): User => api.post(`${config.baseUrl}/login`, data, config.headers);

export const fetchArticles = (page: number): Promise<PaginatedArticles> => api.get(`${config.baseUrl}/article?page=${page}`);

export const getArticle = (id: number): Promise<{data:ResponseArticle}> => api.get(`${config.baseUrl}/article/${id}`);

export const postArticle = (data: PostArticle, authorize: { Authorization: string }): Promise<ResponseArticle> => api.post(`${config.baseUrl}/article`, data, {
  headers: {
    ...config.headers.headers,
    ...authorize,
  },
});

export const patchArticle = (data: PostArticle, authorize: { Authorization: string }, id: number): Promise<ResponseArticle> => api.patch(`${config.baseUrl}/article/${id}`, data, {
  headers: {
    ...config.headers.headers,
    ...authorize,
  },
});

export const deleteArticle = (authorize: { Authorization: string }, id: number): Promise<{result: string}> => api.delete(`${config.baseUrl}/article/${id}`, {
  headers: {
    ...config.headers.headers,
    ...authorize,
  },
});
