import ResponseArticle from './ResponseArticle.d';

declare type PaginatedArticles = {
  data: {
    data: [ResponseArticle],
    // eslint-disable-next-line camelcase
    last_page: number,
  },
}

export default PaginatedArticles;
