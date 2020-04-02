import 'bootstrap';
import './scss/admin.scss';
import $ from 'jquery';

function setApproval(id, state) {
  $.get(window.location, { id, state }).done(() => {
    window.location.reload();
  });
}

$('.approve').each((_, ele) => $(ele).click((eve) => {
  setApproval(eve.target.id, 1);
}));

$('.disapprove').each((_, ele) => $(ele).click((eve) => {
  setApproval(eve.target.id, 0);
}));
