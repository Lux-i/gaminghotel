<!-- Password reset api handling -->

<section id="resetSection" class="flex-column form-container" hidden>
  <form class="flex-column" method="POST">
  <section class="input_group container form-floating">
      <input
        class="inputfield container-md form-control"
        type="password"
        name="new_pwd"
        required
        aria-label="Neues Passwort" />
      <label for="new_pwd">Neues Passwort:</label>
    </section>
    <section class="input_group container form-floating">
      <input
        class="inputfield container-md form-control"
        type="password"
        name="new_pwd_r"
        aria-label="Neues Passwort wiederholen" />
      <label for="new_pwd_r">Neues Passwort wiederholen</label>
    </section>
    <input class="submit_button" type="submit" value="Passwort zurücksetzen" />
  </form>
</section>