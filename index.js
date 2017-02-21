// content of index.js
// from https://blog.risingstack.com/your-first-node-js-http-server/

// index.js
const path = require('path')  
const express = require('express')  
const exphbs = require('express-handlebars')
const bodyParser = require('body-parser')
const multer = require('multer')
const fs = require('fs')

const app = express()
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());
var upload = multer({ dest: '/tmp/'});

app.engine('.hbs', exphbs({  
  defaultLayout: 'main',
  extname: '.hbs',
  layoutsDir: path.join(__dirname, 'views/layouts')
}))
app.set('view engine', '.hbs')  
app.set('views', path.join(__dirname, 'views'))

// File input field name is simply 'file'
app.post('/file_upload', upload.single("file"), function (req, res) {
   var file = __dirname + "/" + req.file.originalname;
   fs.readFile( req.file.path, function (err, data) {
        fs.writeFile(file, data, function (err) {
         if( err ){
              console.error( err );
              response = {
                   message: 'Sorry, file couldn\'t be uploaded.',
                   filename: req.file.originalname
              };
         }else{
               response = {
                   message: 'File uploaded successfully',
                   filename: req.file.originalname
              };
          }
          res.end( JSON.stringify( response ) );
       });
   });
})


app.post('/', (request, response) => {
    console.log(request)
    response.render('home', {
    name: request.animal
  })
})
app.get('/', (request, response) => {  
  response.render('home', {
    name: 'John'
  })
    //console.log(request.foo)
})

app.listen(3000) 
