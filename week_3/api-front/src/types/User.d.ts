declare type User = Promise<{
  data: {
    id: number,
    name: string,
    email: string,
    // eslint-disable-next-line camelcase
    access_token: string,
}}>

export default User;
