days = 0;

window.onload = () => {
  editField = document.getElementById("bookform");
  checkin = document.getElementById("check_in");
  checkout = document.getElementById("check_out");

  displayField = document.getElementById("price-txt");

  editField.addEventListener("input", function () {
    console.log("change detected");
    if (checkin.value == "" || checkout.value == "") {
      days = 0;
    } else {
      const start = new Date(checkin.value);
      const end = new Date(checkout.value);
      days = Math.floor((end - start) / (1000 * 60 * 60 * 24));
      if (days < 0) {
        days = 0;
      } else {
        price = days * 15;
      }

      displayField.innerText = `Aufenthalt von ${days} tagen.
      Zimmer: ${days * 50}€
      Parken: ${days * 10}€\n
      Gesamt: ${days * 60}€`;
    }
  });
  displayField.innerText = `Aufenthalt von ${days} tagen.
  Zimmer: ${days * 50}€
  Parken: ${days * 10}€\n
  Gesamt: ${days * 60}€`;
};
