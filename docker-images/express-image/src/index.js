var Chance = require('chance');
var chance = new Chance();

var express = require('express');
var app = express();


// If GET and tager resources is a '/', we execute the callback
app.get('/', function(req, res){
    res.send("Hello");
});

app.listen(3000, function(){
    console.log('Acception resuqueste on port 3000');
});
