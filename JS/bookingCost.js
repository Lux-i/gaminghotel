var days = 0;
var price = 0;

const prices = {
  single: 100,
  duo: 170,
  squad: 400,
  Parkplatz: 13,
  Frühstück: 18,
  Haustiere: 10,
};

window.onload = () => {
  editField = document.getElementById("bookform");
  checkin = document.getElementById("check_in");
  checkout = document.getElementById("check_out");
  submitButton = document.getElementById("submitButton");

  displayField = document.getElementById("price-txt");

  editField.addEventListener("input", () => {
    if (checkin.value == "" || checkout.value == "") {
      days = 0;
    } else {
      const start = new Date(checkin.value);
      const end = new Date(checkout.value);
      days = Math.floor((end - start) / (1000 * 60 * 60 * 24));
      if (days < 0) {
        days = 0;
      }
    }

    //load selected room
    room = document.querySelector('input[name="zimmer"]:checked').value;

    //initial price (room only)
    price = days * prices[room];

    //string display code
    displayField.innerText = `Aufenthalt von ${days} Tagen.
      Zimmer: ${days * prices[room]}€`;

    //load selected options and display if found
    document
      .querySelectorAll('input[name="extras[]"]:checked')
      .forEach((extra) => {
        console.log(`executing foreach for ${extra}`);
        price += days * prices[extra.value];
        displayField.innerText += `\n${extra.value}: ${
          days * prices[extra.value]
        }€`;
      });

    //write total price
    displayField.innerText += `\n\nGesamt: ${price}€`;

    if (days > 0) {
      //submitButton.hidden = false;
      submitButton.disabled = false;
    } else {
      //submitButton.hidden = true;
      submitButton.disabled = true;
    }
  });
  displayField.innerText = `Aufenthalt von ${days} Tagen.
  Zimmer: ${days * 50}€\n
  Gesamt: ${days * 60}€`;
};
