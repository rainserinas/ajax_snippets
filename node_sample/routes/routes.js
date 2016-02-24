var appRouter = function (app) {



    app.get("/", function (req, res) {
        res.send("Hello World");
    });


    app.get("/account", function (req, res) {
        var accountMock = {
            "username": "nraboy",
            "password": "1234",
            "twitter": "@nraboy"
        };
        if (!req.query.username) {
            return res.send({"status": "error", "message": "missing username"});
        } else if (req.query.username != accountMock.username) {
            return res.send({"status": "error", "message": "wrong username"});
        } else {
            return res.send(accountMock);
        }
    });

    app.get('/api/users', function(req, res) {
        var user_id = req.param('id');
        var token = req.param('token');
        var geo = req.param('geo');

        res.send(user_id + ' ' + token + ' ' + geo);
    });


    app.get('/api/:version', function(req, res) {
        res.send(req.params.version);
    });

    app.post("/account", function (req, res) {
        if (!req.body.username || !req.body.password || !req.body.twitter) {
            return res.send({"status": "error", "message": "missing a parameter"});
        } else {
            return res.send(req.body);
        }
    });

    // parameter middleware that will run before the next routes
    app.param('name', function (req, res, next, name) {

        // check if the user with that name exists
        // do some validations
        // add -dude to the name
        var modified = name + '-dude';

        // save name to the request
        req.name = modified;

        next();
    });


    // http://localhost:8080/api/users/chris
    app.get('/api/users/:name', function (req, res) {
        // the user was found and is available in req.user
        res.send('What is up ' + req.name + '!');
    });


    // POST http://localhost:8080/api/users
    // parameters sent with
    app.post('/api/users', function(req, res) {
        var user_id = req.body.id;
        var token = req.body.token;
        var geo = req.body.geo;

        res.send(user_id + ' ' + token + ' ' + geo);
    });

    app.post('/', function (req, res) {
        res.send('POST request to the homepage');
    });


};

module.exports = appRouter;



