import 'bootstrap';
import './scss/confirmation.scss';
import $ from 'jquery';
import config from './config';

const { ids } = config.confirmation;

$(`#${ids.toHomeButton}`).click(() => { window.location.href = '/'; });
