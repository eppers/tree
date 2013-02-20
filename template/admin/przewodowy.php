{% extends 'layout.php' %}

{% block page_title %}Internet przewody{% endblock %}
{% block content %} 
    <div id="internet-text-container">
          <div id="left">
              <div class="text-content">
                  <p class="title">
                      <span class="bigger">Internet</span><br/>
                      przewodowy już od <span class="orange">1 zł</span>!
                  </p>
                  <p class="grey-light-16">
                      Stabilny Internet o niespotykanej prędkości. <br />
                      <span class="orange">Nawet do 60Mbit/s !</span>
                  </p>
                  <img src="images/cable.png" alt="Światłowody" />
                  <p class="description">
                      <span class="grey-dark bold">Sieć szkieletowa</span> - zbudowana na światłowodach daje Ci gwarancję<br /> niezawodności i niespotykanej
                      prędkości przy najniższej cenie.
                  </p>
                  <p class="description">
                      <span class="grey-dark bold">Umowa bezterminowa</span> - nie musisz podpisywać umowy na czas określony.
                  </p>
              </div>
              <div class="button">
                  <a href="" class="active">INTERNET PRZEWODOWY</a>
              </div>
          </div>
          <div id="right">
              <div class="text-content">
                  <p class="title">
                    <span class="bigger">Router WiFi za 1 zł</span><br/>
                    Bezprzewodowy router do 150mbit/s
                  </p>
                  <p class="grey-light-16">
                      Nie ograniczaj się
                  </p>
                  <img src="images/router.jpg" alt="Router WiFi" />
                  <p class="description">
                      <span class="grey-dark bold">Dowiedz się więcej ></span>
                  </p>
              </div>
              <div class="button">
                  <a href="" class="deactive">INTERNET BEZPRZEWODOWY</a>
              </div>
          </div>
      </div>
      <p class="podlaczenie grey-dark">
          Podłączenie przewodowe już od 1zł !<br />
          Oferta dla mieszkańców osiedli.
      </p>
      <div class="oferta-tabela">
          <table>
              <tbody>
                  <tr>
                      <td class="title"></td>
                      <td class="title"><h2>FIBER LAN</h2></td>
                      <td class="title"><h2>FIBER PRO</h2></td>
                      <td class="title"><h2>FIBER EXTRA</h2></td>
                  </tr>
                  <tr>
                      <td>POBIERANIE</td>
                      <td><span class="bigger">30 Mbit/s</span></td>
                      <td><span class="bigger">40 Mbit/s</span></td>
                      <td><span class="bigger">60 Mbit/s</span></td>
                  </tr>
                  <tr>
                      <td>WYSYŁANIE</td>
                      <td><span class="bigger">1 Mbit/s</span></td>
                      <td><span class="bigger">2 Mbit/s</span></td>
                      <td><span class="bigger">3 Mbit/s</span></td>
                  </tr>
                  <tr>
                      <td>CENA</td>
                      <td class="cena">39 zł/m-c</td>
                      <td class="cena">59 zł/m-c</td>
                      <td class="cena">89 zł/m-c</td>
                  </tr>
                  <tr>
                      <td></td>
                      <td><a href="" class="choose">WYBIERAM</a></td>
                      <td><a href="" class="choose">WYBIERAM</a></td>
                      <td><a href="" class="choose">WYBIERAM</a></td>
                  </tr>
              </tbody>
          </table>

      </div>
{% endblock %}      