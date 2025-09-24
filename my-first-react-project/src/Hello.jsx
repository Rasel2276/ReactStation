function Hello(){
  let name = 'Rasel Hossain';
  let number = 520;
  let fullname = () => {
    return 'Md.Rasel Hossain';
  }
  return <h1>MessageNo. {number} Hello, I am your teacher {fullname()}</h1>
}
export default Hello;