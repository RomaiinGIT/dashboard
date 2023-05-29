const express = require('express');
var app = express();
const fs = require("fs");

app.get('/read', (req, res )=> {
    res.header("Content-Type", 'application/json');
    fs.readFile('./config.json', "utf8", (err, jsonString) => {
        const config = JSON.parse(jsonString);

        res.json({
            'config': config,
        })
      });
})

app.get('/write/:firstarg/:secondarg/:newValue', (req, res) => {

    firstarg = req.params["firstarg"];
    secondarg = req.params["secondarg"];
    newValue = req.params["newValue"];
    params = `${firstarg}${secondarg == 0 ? "" : ":" + secondarg}`;

    firstarg == "0" ? firstarg = `` : firstarg = `["${firstarg}"]`; 
    secondarg == "0" ? secondarg = `` : secondarg = `["${secondarg}"]`; 

    fs.readFile('./config.json', "utf8", (err, jsonString) => {
        const config = JSON.parse(jsonString);

        oldValue = eval(`config${firstarg}${secondarg}`)

        eval(`res.json({
            "params":   "${params}",
            "oldValue": "${oldValue}",
            "newValue": "${newValue}"
          })`)

        eval(`config${firstarg}${secondarg} = "${newValue}"`)
      
        const jsonStringifed = JSON.stringify(config)

        fs.writeFile('./config.json', jsonStringifed, err => {})
      });   

})

app.listen("8080", () => {

})