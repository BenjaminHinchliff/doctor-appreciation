import 'bootstrap';
import './scss/index.scss';
import $ from 'jquery';
import 'jquery-backstretch';

$.backstretch('/assets/img/background-draft.jpg');

$.getJSON('http://localhost/api/get-entries.php').done((entries) => {
  const cards = $('#cards');
  entries.forEach((entry) => {
    console.log(entry);
    const { enterer, content } = entry;
    cards.append(`
      <div class="card bg-light">
        <h5 class="card-title">${enterer}</h5>
        <p class="card-text">${content}</p>
      </div>
    `);
  });
});
