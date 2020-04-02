// configurable information for the rest of the js code
const config = {
  index: {
    ids: {
      entries: 'cards',
      addButton: 'add-button',
    },
    locations: {
      addPage: '/add.html',
      entriesGetPage: 'http://localhost/api/get-entries.php',
    },
  },
  add: {
    ids: {
      enterer: 'name',
      content: 'content',
      form: 'add-form',
    },
    locations: {
      entriesAddPage: 'http://localhost/api/add-entry.php',
    },
  },
};

export default config;
