<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index(Request $request) {

        //$text = $("#calculateText").val();
        $html = file_get_contents('http://www.eredmenyek.com');
        $url = 'https://eredmenyek.com';


        return view('statistic', ['data' => [
            'html' => ''//$html,
        ]]);

        //results = $('td').html( text );
//        footballResultsContainers = $('td.cell_sa.score.bold', output);
//        results = [];
//        odd = 0;
//        even = 0;
//        over2goal = 0;
//        underOrEqual2goal = 0;
//        home = 0;
//        draw = 0;
//        away = 0;
//        bug = 0;
//
//        exactResults = [];
//        regEx = /([0-9]+)/g;
//    $.each( footballResultsContainers, function( i, el ) {
//        text = el.innerText;
//        number = text.match(regEx);
//        if(number) {
//            goals = number[0]*1 + number[1]*1;
//            if (goals % 2 == 0) {
//                even++;
//            } else {
//                odd++;
//            }
//
//            if(goals > 2.5) {
//                over2goal++;
//            } else {
//                underOrEqual2goal++;
//            }
//
//            if(number[0]*1 > number[1]*1) {
//                home++;
//            } else if (number[0]*1 == number[1]*1) {
//                draw++;
//            } else if(number[0]*1 < number[1]*1) {
//                away++;
//            } else {
//                bug--;
//            }
//
//            if ( isNaN(exactResults["r"+number[0]+number[1]]) ) {
//                exactResults["r"+number[0]+number[1]] = 1;
//            } else {
//                exactResults["r"+number[0]+number[1]] += 1;
//            }
//        } else {
//            bug--;
//        }
//
//        //results[ i ] = goals + " -- " + number[0] + 'aa' + number[1];
//    });
//
//    console.log(exactResults);
//    for (var key in exactResults) {
//            $("div#"+key).html(exactResults[key]);
//        }
//
//
//    $("div#even").html(even);
//    $("div#odd").html(odd);
//    $("div#under").html(underOrEqual2goal);
//    $("div#over").html(over2goal);
//    $("div#sum").html(footballResultsContainers.length);
//
//    $("div#home").html(home);
//    $("div#draw").html(draw);
//    $("div#away").html(away);
//
//    $("div#bug").html(bug);
//
    }
}
