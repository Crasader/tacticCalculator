$("#calculateButton").click(function() {
    actualMoney = $("#startMoney").html() * 1;
    round=0;
    console.log(actualMoney);

    maxMoney = actualMoney;

    bets = [60.24, 132.82, 292.84, 645.86, 1423.57, 3138.71];
    odd = 1.83;

    sumRound = 0;
    lostNumber = 0;
    maxRound = 0;
    minRound = 99999999999;
    win = 0;
    lost = 0;

    while (actualMoney < 50000 && sumRound < 1000) {
        sumRound++;
        actualMoney=5000;

        if(maxRound < round) {
            maxRound = round;
        }
        if(minRound > round && round != 0) {
            minRound = round;
        }
        round = 0;
        while (actualMoney > 0 && actualMoney < 50000) {

            //if(lostNumber == 0) {
                myTip = (Math.floor((Math.random() * 100)));
            //}
            result = (Math.floor((Math.random() * 100)));

            if (myTip%2 == result%2) {
                grow = Math.round(bets[lostNumber]*odd-bets[lostNumber]);
                actualMoney = Math.round(actualMoney + grow);
                lostNumber=0;
                win++;
            } else {
                actualMoney = Math.round(actualMoney - bets[lostNumber]);
                grow = - bets[lostNumber];
                if(lostNumber<5) {
                    lostNumber++;
                }
                lost++;
            }

            if (actualMoney > maxMoney) {
                maxMoney = actualMoney;
            }

            //console.log(actualMoney + " " + lostNumber + " g:" + grow);
            round++;
            $("div#round").html(round);

            $("div#actualMoney").html(actualMoney);
            $("div#maxMoney").html(maxMoney);
            $("div#lost").html(lost);
            $("div#win").html(win);
        }
        $("div#sumRound").html(sumRound);

        $("div#maxRound").html(maxRound);
        $("div#minRound").html(minRound);
    }    
  });