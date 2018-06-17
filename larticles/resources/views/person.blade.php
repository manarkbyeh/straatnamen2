@extends('main') @section('title', 'Street detail page') @section('content')
<div class="straatnaam text-center">
  <div class="container ">
    <div class="topTile tile-content" id="c1">
      <h4>Welke personen kregen een straat naar zich vernoemd in Vlaanderen of Brussel? en wie zijn deze mensen? Elke
cirkel hieronder vertegenwoordigt een persoon. Het aantal straten,lanen,pleinen,... die naar elke persoon
vernoemd zijn, bepaald de grote van de cirkel.</h4>
    </div>
    <div>
      <div id="personcontainer">
        <div id="bubblechart"></div>
      </div>
      <div class="hoofdperson">

        <div class="row">
          <div class="tile col-xs-12 col-sm-6 col-md-8" id="c2">
            <div>
              <div class="left">
                <div>
                  <span>Mannen</span>
                </div>
              </div>
              <div class="center">
                <h4>Er zijn er meer straten naar mannen genoemd dan vrouwen!</h4>
              </div>
              <div class="right">
                <div>
                  <span>Vrouwen</span>
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="tile" id="c3">
          <div class="titleTop">
            <div style="background-color:#0277BD">Politici</div>
            <div style="background-color:#FFCA28">Wetenschappers</div>
            <div style="background-color:#42A5F5">Muziek</div>
            <div style="background-color:#F9A825">Kunstenaars</div>
          </div>
          <h4>Er zijn er meer straten naar mannen genoemd dan vrouwen!</h4>
          <div class="titleBottom">
            <div style="background-color:#675589">Schrijvers</div>
            <div style="background-color:#35ad9e">Monarchies</div>
            <div style="background-color:#99999c">Overige</div>
            <div style="background-color:#827717">Religieus</div>
          </div>
        </div>
        <div class="tile" id="c4">
          <div class="titleTop">
            <div style="background-color:#0277BD">Twintigst eeeuw</div>
            <div style="background-color:#FFCA28;width: 30%">zestiende eeuw</div>
            <div style="background-color:#42A5F5">Negentiende eeuw</div>
          </div>
          <h4>Er zijn er meer straten naar mannen genoemd dan vrouwen!</h4>
          <div class="titleTop">

            <div style="background-color:#675589">Vijftiende eeuw</div>
            <div style="background-color:#99999c;width: 30%">Overige</div>
            <div style="background-color:#35ad9e">Zeventiende eeuw</div>

          </div>
        </div>
        <div class="tile" id="c5">
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="
https://cdnjs.cloudflare.com/ajax/libs/d3/4.13.0/d3.min.js"></script>
<script src="../js/person.js?v={{time()}}"></script>
@endSection