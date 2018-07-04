$("#calculateButton").click(function() {
    text = $("#calculateText").val();
    output = $('<output>').append($.parseHTML(text));
    //results = $('td').html( text );
    footballResultsContainers = $('td.cell_sa.score.bold', output);
    results = [];
    odd = 0;
    even = 0;
    over2goal = 0;
    underOrEqual2goal = 0;
    home = 0;
    draw = 0; 
    away = 0;
    bug = 0;
    regEx = /([0-9]+)/g;
    $.each( footballResultsContainers, function( i, el ) {
        text = el.innerText;
        number = text.match(regEx);
        if(number) {
            goals = number[0]*1 + number[1]*1;
            if (goals % 2 == 0) {
                even++;
            } else {
                odd++;
            }

            if(goals > 2.5) {
                over2goal++;
            } else {
                underOrEqual2goal++;
            }

            if(number[0]*1 > number[1]*1) {
                home++;
            } else if (number[0]*1 == number[1]*1) {
                draw++;
            } else if(number[0]*1 < number[1]*1) {
                away++;
            } else {
                bug--;
            }
        } else {
            bug--;
        }
        //results[ i ] = goals + " -- " + number[0] + 'aa' + number[1];
    });

    $("div#even").html(even);
    $("div#odd").html(odd);
    $("div#under").html(underOrEqual2goal);
    $("div#over").html(over2goal);
    $("div#sum").html(footballResultsContainers.length);

    $("div#home").html(home);
    $("div#draw").html(draw);
    $("div#away").html(away);

    $("div#bug").html(bug);

  });

$("#downloadButton").click(function() {
    console.log('asdas');
    var settings = {
        "async": true,
        "crossDomain": true,
        "url": "https://eredmenyek.com",
        "method": "GET",
        "headers": {
          "X-Requested-With": "XMLHttpRequest",
          "Cache-Control": "no-cache",
          'Content-Type':'application/x-www-form-urlencoded'
        }
      }
      
      $.ajax(settings).done(function (response) {
        console.log(response);
      });
});


function setHeader(xhr) {
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
  }