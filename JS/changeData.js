var dataField;
var editField;
var submitButton;
var inputs;
var ogData = {
  username: "",
  email: "",
  vorname: "",
  nachname: "",
  gender: "",
};

window.onload = () => {
  dataField = document.getElementById("userdata");
  editField = document.getElementById("edit");
  submitButton = document.getElementById("submitButton");

  inputs = document.querySelectorAll("input, select");
  for (const input of inputs) {
    ogData[input.name] = input.value;
  }

  editField.addEventListener("input", function () {
    console.log("change detected");
    for (const input of inputs) {
      console.log(
        `Input value: ${input.value}, ogValue: ${ogData[input.name]}`
      );
      if (input.value != ogData[input.name] && input.value != "") {
        submitButton.hidden = false;
        submitButton.disabled = false;
        return;
      } else {
        submitButton.hidden = true;
        submitButton.disabled = true;
      }
    }
  });
};

const changeVisibility = (elem) => {
  if (!dataField || !editField) {
    return;
  }
  elem.innerText = elem.innerText == "Edit" ? "Abbrechen" : "Edit";
  dataField.hidden = !dataField.hidden;
  editField.hidden = !editField.hidden;
};
