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

const showReset = () => {
  const reset_button = document.getElementById("resetButton");
  const reset_section = document.getElementById("resetSection");
  reset_button.hidden = true;
  reset_section.hidden = false;
};
