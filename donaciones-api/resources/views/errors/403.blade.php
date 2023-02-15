<div class="wrapper">
    <div class="box">
        <h1>403</h1>
        <p>Lo siento, ¡no está permitido ir más allá de este punto!</p>
        <p><a href="/home">Por favor, vuelve por aquí.</a></p>
        <img src="" alt="">
    </div>
</div>

<style>
    html { box-sizing: border-box; }

*,
*::before,
*::after { box-sizing: inherit; }

body * {
  margin: 0;
  padding: 0;
}

body {
  font: normal 100%/1.15 "Merriweather", serif;
  background: #fff  repeat 0 0;
  color: #fff;
}

/* https://www.vecteezy.com/vector-art/87721-wood-fence-vectors */
.wrapper {
  position: relative;
  max-width: 1298px;
  height: auto;
  margin: 2em auto 0 auto;
  /* background: transparent url("https://www.dropbox.com/s/qq5n8w99q40wtrg/wood-fence.png?raw=1") no-repeat center top 24em; */
}

/* https://www.vecteezy.com/vector-art/237238-dog-family-colored-doodle-drawing */
.box {
  max-width: 80%;
  height: 400px;
  margin: 0 auto;
  padding: 1em 1em;
  text-align: center;
  background: transparent url({{asset('/icon/logotipo_cre.png')}}) no-repeat top 10em center;
  background-size: 70%;
}

h1 {
  margin: 0 0 1rem 0;
  font-size: 8em;
  text-shadow: 0 0 6px red;
}

p {
  margin-bottom: 0.5em;
  font-size: 1.75em;
  color: #ea8a1a;
}

p:first-of-type {
  margin-top: 8em;
  text-shadow: none;
}

p > a {
  border-bottom: 1px dashed #837256;
  font-style: italic;
  text-decoration: none;
  color: #837256;
}

p > a:hover { text-shadow: 0 0 3px #8b4d1a; }

p img { vertical-align: bottom; }

@media screen and (max-width: 600px) {
  .wrapper {
    background-size: 300px 114px;
    background-position: center top 22em;
    }

  .box {
    max-width: 100%;
    margin: 0 auto;
    padding: 0;
    background-size: 320px 185px;
  }

  p:first-of-type { margin-top: 12em; }
}
</style>