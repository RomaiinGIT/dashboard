const express = require('express');
var app = express();
const fs = require("fs");

app.get('/read/:project', (req, res )=> {
    res.header("Content-Type", 'application/json');
    project = req.params["project"];
    dir = project + "/config.json";
    fs.readFile(dir, "utf8", (err, jsonString) => {
        const config = JSON.parse(jsonString);

        res.json({
            'config': config,
        })
      });
})

app.get('/write/:project/:firstarg/:secondarg/:newValue', (req, res) => {

    project = req.params["project"];
    firstarg = req.params["firstarg"];
    secondarg = req.params["secondarg"];
    newValue = req.params["newValue"];
    params = `${firstarg}${secondarg == 0 ? "" : ":" + secondarg}`;

    firstarg == "0" ? firstarg = `` : firstarg = `["${firstarg}"]`; 
    secondarg == "0" ? secondarg = `` : secondarg = `["${secondarg}"]`; 

    dir = project + "/config.json";

    fs.readFile(dir, "utf8", (err, jsonString) => {
        const config = JSON.parse(jsonString);

        oldValue = eval(`config${firstarg}${secondarg}`)

        eval(`res.json({
            "params":   "${params}",
            "oldValue": "${oldValue}",
            "newValue": "${newValue}"
          })`)

        eval(`config${firstarg}${secondarg} = "${newValue}"`)
      
        const jsonStringifed = JSON.stringify(config)

        fs.writeFile(dir, jsonStringifed, err => {})
      });   

})

app.get('/pm2/status/:firstarg/', (req, res) => {

  firstarg = req.params["firstarg"];  

})

app.listen("8080", () => {

})