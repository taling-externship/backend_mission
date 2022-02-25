declare type ResponseArticle = {
  id: number,
  title: string,
  body: string,
  love: [unknown],
  // eslint-disable-next-line camelcase
  created_at: string,
  // eslint-disable-next-line camelcase
  updated_at: string,
}

export default ResponseArticle;
