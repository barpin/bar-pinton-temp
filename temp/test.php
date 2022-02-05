<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.1/codemirror.min.js" integrity="sha512-UczTlJPfdNqI2hb02wot6lMzwUNtjywtRSz+Ut/Q+aR0/D6tLkIxRB+GgjxjX6PSA+0KrQJuwn4z6J+3EExilg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.1/addon/hint/show-hint.min.js" integrity="sha512-kCn9g92k3GM90eTPGMNwvpCAtLmvyqbpvrdnhm0NMt6UEHYs+DjRO4me8VcwInLWQ9azmamS1U1lbQV627/TBQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.1/codemirror.min.css" integrity="sha512-uf06llspW44/LZpHzHT6qBOIVODjWtv4MxCricRxkzvopAlSWnTf6hpZTFxuuZcuNE9CBQhqE0Seu1CoRk84nQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.1/mode/php/php.min.js" integrity="sha512-VoNvAZ5k1KyV+FeeKLhddu9NeFGFKgGVDyPs07F3BzEO9b9aMDwMTmOgGfmr0dGP6IR+3OH6o/47uMnGNV38WA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.1/addon/selection/active-line.min.js" integrity="sha512-UNVAZmixdjeBtJVQcH5eSKXuVdzbSV6rzfTfNVyYWUIIDCdI9/G8/Z/nWplnSHXXxz9U8TA1BiJ1trK7abL/dg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.1/addon/edit/matchbrackets.min.js"  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body style="display:flex">
    <div style="height:100vh;width:50vw;" id="edit"></div>
    <div style="height:100vh;width:50vw;"></div>
    <button onclick="subphp()"></button>
    <script>

phpeditor = CodeMirror(document.querySelector("#edit"), {
            value: codehtmldata,
            mode:  "php",
            lineNumbers: true,
            styleActiveLine: true,
            matchBrackets: true,

            extraKeys: {
                "Ctrl-Space": "autocomplete"
            },

        });


function subphp(){
    phpeditor.getValue();

}


var url = '/your/url';
var formData = new FormData();
formData.append('x', 'hello');

fetch(url, { method: 'POST', body: formData })
.then(function (response) {
  return response.text();
})
.then(function (body) {
  console.log(body);
});

    </script>
</body>
</html>