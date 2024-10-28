const logout = () => {
  console.log(document.cookie);
  console.log(document.cookie.split(";"));
  isSet = document.cookie
    .split(";")
    .some((cookie) => cookie.startsWith("loginToken="));

  console.log(isSet);

  if (isSet) {
    document.cookie = `loginToken=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
    window.location.href = "/index.php";
  }
};
