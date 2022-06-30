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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.1/mode/xml/xml.min.js" integrity="sha512-UWfBe6aiZInvbBlm91IURVHHTwigTPtM3M4B73a8AykmxhDWq4EC/V2rgUNiLgmd/i0y0KWHolqmVQyJ35JsNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.1/mode/javascript/javascript.min.js" integrity="sha512-IS1FyxQkiJHT1SAvLXBaJu1UTFSIw0GT/DuzxHl69djqyLoEwGmR2davcZUnB8M7ppi9nfTGZR/vdfqmWt+i6A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.1/mode/css/css.min.js" integrity="sha512-2gAMyrBfWPuTJDA2ZNIWVrBBe9eN6/hOjyvewDd0bsk2Zg06sUla/nPPlqQs75MQMvJ+S5AmfKmq9q3+W2qeKw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.1/mode/htmlmixed/htmlmixed.min.js" integrity="sha512-IC+qg9ITjo2CLFOTQcO6fBbvisTeJmiT5D5FnXsCptqY8t7/UxWhOorn2X+GHkoD1FNkyfnMJujt5PcB7qutyA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.1/mode/clike/clike.min.js" integrity="sha512-GAled7oA9WlRkBaUQlUEgxm37hf43V2KEMaEiWlvBO/ueP2BLvBLKN5tIJu4VZOTwo6Z4XvrojYngoN9dJw2ug==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>


    </style>
</head>
<body style="display:flex">
    <div style="height:100vh;width:50vw;" id="edit"></div>
    <div style="height:100vh;width:50vw;" id="cont"></div>
    <button onclick="subphp()" style="position:absolute;bottom:0;">SUBMIT</button>
    <script>
function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  let expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + escape(cvalue) + ";" + expires + ";path=/";
}

function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return unescape(c.substring(name.length, c.length));
    }
  }
  return "";
}



        var cont=document.querySelector("#cont");
        var counter=0;
        phpeditor = CodeMirror(document.querySelector("#edit"), {
            value: getCookie("code") ? getCookie("code")  : "\<\?php\n\n",
            mode:  "php",
            lineNumbers: true,
            styleActiveLine: true,
            matchBrackets: true,

            extraKeys: {
                "Ctrl-Space": "autocomplete"
            },

        });
        phpeditor.setSize("50vw", "100vh");



        function subphp(){
            setCookie('code', phpeditor.getValue(), 100);
            var url = '/exec';
            
            fetch(url, {
                method: 'POST', 
                body: JSON.stringify({exec: phpeditor.getValue()}),
                mode: "same-origin",
                credentials: "same-origin",

                })
            .then(function (response) {
            return response.text();
            })
            .then(function (body) {
            cont.insertAdjacentHTML("afterbegin", `<div style="margin:1vw; padding:1vw; border:1px solid #333;border-radius:3px;width:100%;"> ${counter}: `+body+`</div>`);
            });
            counter++;
        }

        phpeditor.setOption('extraKeys', {
              'Ctrl-Enter': function() {
                subphp();
              }, 
              'Cmd-Enter': function () {
                subphp();
              }
            });



    </script>
</body>
</html>

<?php
exit;