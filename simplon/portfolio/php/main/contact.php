<style>
  input,
  button {
    background-color: #22222A;
    text-align: center;
    color: #fbf1c7;
  }

  input:focus {
    border: none;
    border: 0px solid white;

    background-color: none;
  }

  ::placeholder {
    color: #fbf1c7;
  }
</style>


<div id="contactPage" class="flex navi none fill absolute jcsa aic">

  <div class="flex w50 h100 jcc aic">

    <div class="flex column h90 w75 aic jcc textL bgyellow">
      <div class="h10 w100 bgamber jcc aic flex">
        <p>CONTACT INFO</p>
      </div>9
      <div class="h90 w100 flex jcc aic column">
        <p>Email : placeholder@mail.com</p>
        <br>
        <p>Phone : +33 6 87 67 56 48 65 43</p>
        <br>
        <p>Adress : 37 juin 2026, Brest</p>
      </div>
    </div>

  </div>


  <div class="flex w50 h100 jcc aic">

    <div class="flex column h90 w75 aic jcc textL bggreen">
      <div class="h10 w100 bggrass jcc aic flex">
        <p>CONTACT FORM</p>
      </div>

      <form class="flex column h90 w100 aic jcc bggreen" action="">
        <input class="h10 w50" type="text" placeholder="Name">
        <input class="h10 w50" type="text" placeholder="E-mail">
        <input class="h10 w50" type="text" placeholder="Phone">
        <input class="h50 w50" class="h50 w100" type="text" placeholder="Message">
        <button class="h10 w50" type="submit">SUBMIT</button>
      </form>

    </div>
  </div>
</div>