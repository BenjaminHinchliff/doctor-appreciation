import 'bootstrap';
import './scss/index.scss';
import $ from 'jquery';

import config from './config';

const { ids, locations } = config.index;

$.getJSON(locations.entriesGetPage).done((entries) => {
  entries.forEach((entry) => {
    const { enterer, content } = entry;
    const card = $.parseHTML(`
      <div class="card bg-light my-1 entry">
        <p class="card-text mb-0 lead"></p>
        <h5 class="card-signature font-italic ml-3"></h5>
      </div>
    `);
    $(card).find('.card-signature').text(`-${enterer}`);
    $(card).find('.card-text').text(content);
    $(`#${ids.entries}`).append(card);
  });
});

$(`#${ids.addButton}`).click(() => { window.location.pathname = locations.addPage; });
