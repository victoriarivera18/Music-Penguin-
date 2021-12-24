function script(){ 
  const app = document.getElementById('root');

  const container = document.createElement('div');
  container.setAttribute('class', 'container');

  app.appendChild(container);

  var request = new XMLHttpRequest();
  request.open('GET', 'https://rest.bandsintown.com/artists/justin%20bieber?app_id=1bf378cb4101c7170d43dee1b36d3f0b', true);
  request.onload = function () {

    // Begin accessing JSON data here
    var data = JSON.parse(this.response);
    if (request.status >= 200 && request.status < 400) {

        const card = document.createElement('div');
        card.setAttribute('class', 'card');
        card.style.backgroundColor= "#c5c500";

        const h1 = document.createElement('h1');
        h1.textContent = `${data.name}`;
        h1.style.color = "black";

      const p = document.createElement('p');
        p.textContent = `${data.id}`;

        container.appendChild(card);
        card.appendChild(h1);
        card.appendChild(p);
    } else {
      const errorMessage = document.createElement('marquee');
      errorMessage.textContent = `Gah, it's not working!`;
      app.appendChild(errorMessage);
    }
  }

  request.send();
 }
 

$( document ).ready(function() {
  script();
});