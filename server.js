var express = require('express');
var bodyParser = require('body-parser');
var app = express()
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({
  extended: true
}));
var directory = require('serve-index');


var sqlite3 = require('sqlite3').verbose();


var db = new sqlite3.Database('Northwind.sqlite');
var presidentsdb = new sqlite3.Database('Presidents.sqlite');

app.set('views', __dirname);
app.set('view engine', 'jade');

app.post('/Login', function(req, res) {
  var username = req.param('username');
  var password = req.param('password');
  var respondWith = '';

  var sql = "SELECT FirstName, LastName FROM Presidents WHERE Username='" + username + "' AND Password='" + password + "'";
  var respondWith = 'failed';
  presidentsdb.serialize(function() {
    presidentsdb.get(sql, function(err, row) {
      if (err !== null) {
        res.status(500).send("An error has occurred -- " + err);
      } else {
        if (row) {
          var firstName = row.FirstName;
          var lastName = row.LastName;
          respondWith = firstName + ' ' + lastName;
          res.status(200);
          return res.send(respondWith);
        } else {
          res.status(200);
          return res.send(respondWith);
        }
      }
    });
  });
});

app.get('/Lookup', function(req, res) {
  var orderNum = req.param('orderNum');
  var sql = "SELECT OrderID FROM Orders WHERE OrderID = " + orderNum;
  db.serialize(function() {
    db.get(sql, function(err, row) {
      if (err !== null) {
        res.status(500).send("An error has occurred -- " + err);
      } else {
        if (row) {
          res.status(200);
          return res.send("success");
        } else {
          res.status(200);
          return res.send("failed");
        }
      }
    });
  });
});


app.get('/SlideShow', function(req, res) {
  presidentsdb.serialize(function() {
    var Slide = req.param('Slide');
    var sql = "SELECT FirstName, LastName, StartYear, EndYear, ImagePath FROM Presidents WHERE PresidentID=" + Slide;
    res.setHeader('Content-type', 'text/xml');
    presidentsdb.all(sql, function(err, row) {
      if (err !== null) {
        res.status(500).send("An error has occurred -- " + err);
      } else {
        res.render('SlideShow.xml.jade', {
          presidents: row
        }, function(err, xml) {
          res.status(200).send(xml);
        });
      }
    });
  });
});

app.get('/SlideShow-preloaded', function(req, res) {
  presidentsdb.serialize(function() {
    var Slide = req.param('Slide');
    var prevSlide = parseInt(Slide) - 1;
    var nextSlide = parseInt(Slide) + 1;
    var sql = "SELECT FirstName, LastName, StartYear, EndYear, ImagePath FROM Presidents WHERE PresidentID BETWEEN " + prevSlide + " AND " + nextSlide;
    res.setHeader('Content-type', 'text/xml');
    presidentsdb.all(sql, function(err, row) {
      if (err !== null) {
        res.status(500).send("An error has occurred -- " + err);
      } else {
        res.render('SlideShow-preloaded.xml.jade', {
          presidents: row
        }, function(err, xml) {
          res.status(200).send(xml);
        });
      }
    });
  });
});

app.use(directory(__dirname));
app.use(express.static(__dirname));

//listen on port 8080 for webserver:
app.listen(8080);

