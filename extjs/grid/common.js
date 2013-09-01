Ext.define('Toys.grid.model.Person', {
  extend: 'Ext.data.Model',
  fields: [
    {name: 'id', type: 'int'},
    {name: 'name'},
    {name: 'email'},
    {name: 'age', type: 'int'},
    {name: 'active', type: 'boolean'},
    {name: 'birthday', type: 'date', dateFormat: 'Y-m-d H:i:s'}
  ]
});
Ext.define('Toys.grid.store.Person', {
  extend: 'Ext.data.Store',
  model: 'Toys.grid.model.Person',
  proxy: {
    type: 'ajax',
    url: './data.php',
    reader: {
      type: 'json',
      root: 'data',
      totalProperty: 'total'
    }
  }
});
