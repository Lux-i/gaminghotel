const express = require("express");
const app = express();

const { port } = require("./config.json");

//List to check if ip of request is unique or not
//Only used for debugging
const uips = [];

app.use(
  express.static(__dirname + "/public", {
    //max age about one week in ms
    maxAge: 3456700000 / 5,
  })
);
app.engine("html", require("ejs").renderFile);
app.set("html", __dirname + "/HTML");
app.set("view engine", "ejs");

//#region sitemap
app.get("/sitemap", (req, res) => {
  res.sendFile(`${__dirname}/HTML/sitemap.html`);
});
app.get("/sitemap.xml", (req, res) => {
  res.sendFile(`${__dirname}/sitemap.xml`);
});
//#endregion

//#region Browser Endpoints

app.get("/", (req, res) => {
  res.render(`${__dirname}/index.html`);
});

app.get("/hilfe", (req, res) => {
  res.render(`${__dirname}/HTML/hilfe.html`);
});

app.get("/login", (req, res) => {
  res.render(`${__dirname}/HTML/login.html`);
});

app.get("/register", (req, res) => {
  res.render(`${__dirname}/HTML/register.html`);
});

app.get("/impressum", (req, res) => {
  res.render(`${__dirname}/HTML/impressum.html`);
});

app.get("*", (req, res) => {
  res.render(`${__dirname}/HTML/error.html`);
});

//#endregion

app.listen(port, function () {
  console.log(`Started webserver. Listening on port ${port}`);
});

/**
 * @brief Logs IPs if not already in *uips*
 *
 * Add this function into get requests
 * for debugging purposes only
 *
 * @param {String} ip ip of the request
 */
async function logIP(ip) {
  if (!uips.includes(ip)) {
    console.log(`req from ${ip}`);
    uips.push(ip);
  }
}
