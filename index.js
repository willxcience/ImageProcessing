// content of index.js
// from https://blog.risingstack.com/your-first-node-js-http-server/

// index.js
const path = require('path')  
const express = require('express')  
const exphbs = require('express-handlebars')

const app = express()


app.engine('.hbs', exphbs({  
  defaultLayout: 'main',
  extname: '.hbs',
  layoutsDir: path.join(__dirname, 'views/layouts')
}))
app.set('view engine', '.hbs')  
app.set('views', path.join(__dirname, 'views'))

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
    console.log(request.foo)
})

app.listen(3000) 
