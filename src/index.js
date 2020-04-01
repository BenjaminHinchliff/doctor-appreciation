import 'bootstrap';
import './scss/index.scss';
import $ from 'jquery';
import 'jquery-backstretch';

import config from './config';

const { ids } = config;

$.getJSON('http://localhost/api/get-entries.php').done((entries) => {
  entries.forEach((entry) => {
    const { enterer, content } = entry;
    const card = $.parseHTML(`
      <div class="card bg-light my-1 entry">
        <h5 class="card-title"></h5>
        <p class="card-text"></p>
      </div>
    `);
    $(card).find('.card-title').text(enterer);
    $(card).find('.card-text').text(content);
    $(`#${ids.entries}`).append(card);
  });
});
