$("#calculateButton").click(function() {
    actualMoney = $("#startMoney").html() * 1;
    startMoney = $("#startMoney").html() * 1;
    round=0;
    console.log(actualMoney);

    var maxMoney = [];

    //hanyados = [100, 45.45, 20.66, 9.39, 4.27, 1.94, 0.88];
    
    hanyados = [50, 22.7, 10.33, 4.7, 2.13, 1, 0.44]; // legjobb arány 50%os bejövési arány
    //hanyados = [25.01, 10, 4.17, 1.6, 0.62, 0.28, 0.13];
    //bets = [60.24, 132.82, 292.84, 645.86, 1423.57, 3138.71, 6300, 13000];

    //bets = [50, 110, 242, 472, 911, 1717, 3216, 5991, 11142];

    //bets = [100, 220, 484, 944, 1822, 3424, 6404, 11911];
    //bets = [200, 440, 940, 1800, 3600, 7800];
    //bets = [50, 100, 350, 750, 1500, 3000, 6000, 12000];
    odd = 1.83;

    bets = getBets(startMoney, hanyados);

    console.log(bets);
    sumCase = 0;
    lostNumber = 0;
    maxRound = 0;
    minRound = 99999999999;
    win = 0;
    lost = 0;

    winRound = 0;
    lostRound = 0;
    finishMoney = actualMoney*3;

    while (sumCase < 1000) {
        console.log(sumCase + ": " +actualMoney);
        console.log(bets);
        sumCase++;
        if (sumCase > 1) {   
            maxMoney[maxMoney.length] = actualMoney; 
            //maxMoney.push(actualMoney+' ');
            if(actualMoney >= finishMoney) {
                winRound++; 
            } else {
                lostRound++;
            }
        }
        actualMoney = $("#startMoney").html() * 1;

        if(maxRound < round) {
            maxRound = round;
        }
        if(minRound > round && round != 0) {
            minRound = round;
        }
        round = 0;
        lostNumber=0;
        while (actualMoney > 0 && actualMoney < finishMoney) {

            //if(lostNumber == 0) {
                myTip = (Math.floor((Math.random() * 100)));
            //}
            //myTip=0;
            result = (Math.floor((Math.random() * 100)));

            if (myTip%2 == result%2) {
                grow = Math.round(bets[lostNumber]*odd-bets[lostNumber]);
                actualMoney = Math.round(actualMoney + grow);
                lostNumber=0;
                win++;
                bets = getBets(actualMoney, hanyados);
            } else {
                actualMoney = Math.round(actualMoney - bets[lostNumber]);
                grow = - bets[lostNumber];
                if(lostNumber<bets.length-1) {
                    lostNumber++;
                }
                lost++;
            }

            //if(lostNumber == bets.length) {
                //lostNumber = 0;
            //}

           // if (actualMoney > maxMoney) {
           //     maxMoney = actualMoney;
           // }
//break;
            //console.log(actualMoney + " " + lostNumber + " g:" + grow);
            round++;
            $("div#round").html(round);

            $("div#actualMoney").html(actualMoney);
            //$("div#maxMoney").html(maxMoney);
            $("div#lost").html(lost);
            $("div#win").html(win);
        }
        $("div#sumCase").html(sumCase);

        $("div#maxRound").html(maxRound);
        $("div#minRound").html(minRound);

        $("div#sumRound").html(lost+win);
    }    


    console.log(maxMoney);
    $("div#lostRound").html(lostRound);
    $("div#winRound").html(winRound);
    
  });

function getBets(money, hanyados) {
    return [
        Math.round(money/hanyados[0]), 
        Math.round(money/hanyados[1]), 
        Math.round(money/hanyados[2]), 
        Math.round(money/hanyados[3]), 
        Math.round(money/hanyados[4]), 
        Math.round(money/hanyados[5]),
        Math.round(money/hanyados[6])
    ];
}
  //esetek: 
  // - kis tét duplázás végig nyeremény,
  // - kis tét duplázás nincs nyeremény csak 1. 2.,
  // - nagy tét duplázás nincs nyeremény,
  // - nagy tét duplázás végig nyeremény,