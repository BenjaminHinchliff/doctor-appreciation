import 'bootstrap';
import './scss/add.scss';
import $ from 'jquery';
import config from './config';

const { ids, locations } = config.add;

$(`.${ids.form}`).attr('action', locations.entriesAddPage);
