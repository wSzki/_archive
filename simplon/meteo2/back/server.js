const mysql = require('mysql');
const connection = mysql.createConnection({
  host: 'localhost',
  user: 'wsz',
  password: 'pp',
  database: 'meteo'
});

connection.connect((err) => {
  if (err) throw err;
  console.log('Connected to MySQL Server!');
});