<?php

use \LINE\LINEBot\MessageBuilder\TextMessageBuilder as TextMessageBuilder;

function genemo($query, $userId){

  if ($query == null){
    $result = new TextMessageBuilder("EmoChar Generator.\n\nCara menggunakan:\n.genemo [keyword].\n\nSilahkan dicoba~");
  } else {
    $dict = [
    " "   => "   ",
    "0"   => "􂘁􀄾zero􏿿 􂜁􀄾zero􏿿 􂠁􀄾zero􏿿 􂤁􀄾zero􏿿",
    "1"   => "􂤁􀄵one􏿿 􂠁􀄵one􏿿 􂜁􀄵one􏿿 􂘁􀄵one􏿿",
    "2"   => "􂤁􀄶two􏿿 􂠁􀄶two􏿿 􂜁􀄶two􏿿 􂘁􀄶two􏿿",
    "3"   => "􂤁􀄷three􏿿 􂠁􀄷three􏿿 􂜁􀄷three􏿿 􂘁􀄷three􏿿",
    "4"   => "􂤁􀄸four􏿿 􂠁􀄸four􏿿 􂜁􀄸four􏿿 􂘁􀄸four􏿿",
    "5"   => "􂤁􀄹five􏿿 􂠁􀄹five􏿿 􂜁􀄹five􏿿 􂘁􀄹five􏿿",
    "6"   => "􂤁􀄺six􏿿 􂠁􀄺six􏿿 􂜁􀄺six􏿿 􂘁􀄺six􏿿",
    "7"   => "􂤁􀄻seven􏿿 􂠁􀄻seven􏿿 􂜁􀄻seven􏿿 􂘁􀄻seven􏿿",
    "8"   => "􂤁􀄼eight􏿿 􂠁􀄼eight􏿿 􂜁􀄼eight􏿿 􂘁􀄼eight􏿿",
    "9"   => "􂤁􀄽nine􏿿 􂠁􀄽nine􏿿 􂜁􀄽nine􏿿 􂘁􀄽nine􏿿",
    "a"   => "􂤁􀄁A􏿿 􂠁􀄛a􏿿 􂠁􀄁A􏿿 􂜁􀄁A􏿿 􂤁􀄛a􏿿 􂜁􀄛a􏿿 􂘁􀄛a􏿿 􂘁􀄁A􏿿",
    "b"   => "􂠁􀄂B􏿿 􂘁􀅷beta􏿿 􂤁􀅷beta􏿿 􂤁􀄜b􏿿 􂤁􀄂B􏿿 􂠁􀅷beta􏿿 􂠁􀄜b􏿿 􂜁􀅷beta􏿿 􂜁􀄜b􏿿 􂜁􀄂B􏿿 􂘁􀄜b􏿿 􂘁􀄂B􏿿",
    "c"   => "􂠁􀄃C􏿿 􂤁􀄝c􏿿 􂤁􀄃C􏿿 􂠁􀄝c􏿿 􂜁􀄝c􏿿 􂜁􀄃C􏿿 􂘁􀄝c􏿿 􂘁􀄃C􏿿",
    "d"   => "􂠁􀄄D􏿿 􂤁􀄞d􏿿 􂤁􀄄D􏿿 􂠁􀄞d􏿿 􂜁􀄞d􏿿 􂜁􀄄D􏿿 􂘁􀄞d􏿿 􂘁􀄄D􏿿",
    "e"   => "􂘁􀄟e􏿿 􂠁􀄅E􏿿 􂤁􀄟e􏿿 􂤁􀄅E􏿿 􂠁􀄟e􏿿 􂜁􀄟e􏿿 􂜁􀄅E􏿿 􂘁􀄅E􏿿",
    "f"   => "􂤁􀄠f􏿿 􂤁􀄆F􏿿 􂠁􀄠f􏿿 􂠁􀄆F􏿿 􂜁􀄠f􏿿 􂜁􀄆F􏿿 􂘁􀄠f􏿿 􂘁􀄆F􏿿",
    "g"   => "􂤁􀄇G􏿿 􂘁􀄡g􏿿 􂤁􀄡g􏿿 􂠁􀄡g􏿿 􂠁􀄇G􏿿 􂜁􀄡g􏿿 􂜁􀄇G􏿿 􂘁􀄇G􏿿",
    "h"   => "􂤁􀄢h􏿿 􂘁􀄢h􏿿 􂤁􀄈H􏿿 􂠁􀄢h􏿿 􂠁􀄈H􏿿 􂜁􀄢h􏿿 􂜁􀄈H􏿿 􂘁􀄈H􏿿",
    "i"   => "􂠁􀄣i􏿿 􂤁􀅙|􏿿 􂤁􀄣i􏿿 􂤁􀄉I􏿿 􂠁􀅙|􏿿 􂠁􀄉I􏿿 􂜁􀅙|􏿿 􂜁􀄣i􏿿 􂜁􀄉I􏿿 􂘁􀅙|􏿿 􂘁􀄣i􏿿 􂘁􀄉I􏿿",
    "j"   => "􂠁􀄤j􏿿 􂘁􀄤j􏿿 􂤁􀄤j􏿿 􂤁􀄊J􏿿 􂠁􀄊J􏿿 􂜁􀄤j􏿿 􂜁􀄊J􏿿 􂘁􀄊J􏿿",
    "k"   => "􂠁􀄥k􏿿 􂜁􀄥k􏿿 􂜁􀄋K􏿿 􂘁􀄥k􏿿 􂤁􀄥k􏿿 􂤁􀄋K􏿿 􂠁􀄋K􏿿 􂘁􀄋K􏿿",
    "l"   => "􂤁􀅙|􏿿 􂠁􀅙|􏿿 􂜁􀅙|􏿿 􂘁􀅙|􏿿 􂘁􀄌L􏿿 􂤁􀄦l􏿿 􂤁􀄌L􏿿 􂠁􀄦l􏿿 􂠁􀄌L􏿿 􂜁􀄦l􏿿 􂜁􀄌L􏿿 􂘁􀄦l􏿿",
    "m"   => "􂜁􀄧m􏿿 􂜁􀄍M􏿿 􂤁􀄧m􏿿 􂤁􀄍M􏿿 􂠁􀄧m􏿿 􂠁􀄍M􏿿 􂘁􀄧m􏿿 􂘁􀄍M􏿿",
    "n"   => "􂠁􀄎N􏿿 􂘁􀄎N􏿿 􂤁􀄨n􏿿 􂤁􀄎N􏿿 􂠁􀄨n􏿿 􂜁􀄨n􏿿 􂜁􀄎N􏿿 􂘁􀄨n􏿿",
    "o"   => "􂠁􀄩o􏿿 􂜁􀄩o􏿿 􂜁􀄏O􏿿 􂤁􀄩o􏿿 􂤁􀄏O􏿿 􂘁􀄩o􏿿 􂘁􀄏O􏿿",
    "p"   => "􂘁􀄐P􏿿 􂠁􀄪p􏿿 􂠁􀄐P􏿿 􂜁􀄪p􏿿 􂜁􀄐P􏿿 􂘁􀄪p􏿿",
    "q"   => "􂘁􀄑G􏿿 􂤁􀄫q􏿿 􂠁􀄫q􏿿 􂠁􀄑G􏿿 􂜁􀄫q􏿿 􂜁􀄑G􏿿 􂘁􀄫q􏿿",
    "r"   => "􂤁􀄬r􏿿 􂤁􀄒R􏿿 􂠁􀄬r􏿿 􂠁􀄒R􏿿 􂜁􀄬r􏿿 􂜁􀄒R􏿿 􂘁􀄬r􏿿 􂘁􀄒R􏿿",
    "s"   => "􂤁􀄓S􏿿 􂘁􀄭s􏿿 􂤁􀄭s􏿿 􂠁􀄭s􏿿 􂠁􀄓S􏿿 􂜁􀄭s􏿿 􂜁􀄓S􏿿 􂘁􀄓S􏿿",
    "t"   => "􂤁􀄮t􏿿 􂤁􀄔T􏿿 􂠁􀄮t􏿿 􂠁􀄔T􏿿 􂜁􀄮t􏿿 􂜁􀄔T􏿿 􂘁􀄮t􏿿 􂘁􀄔T􏿿",
    "u"   => "􂜁􀄕U􏿿 􂤁􀄯u􏿿 􂤁􀄕U􏿿 􂠁􀄯u􏿿 􂠁􀄕U􏿿 􂜁􀄯u􏿿 􂘁􀄯u􏿿 􂘁􀄕U􏿿",
    "v"   => "􂠁􀄖V􏿿 􂤁􀄰v􏿿 􂤁􀄖V􏿿 􂠁􀄰v􏿿 􂜁􀄰v􏿿 􂜁􀄖V􏿿 􂘁􀄰v􏿿 􂘁􀄖V􏿿",
    "w"   => "􂤁􀄗W􏿿 􂠁􀄗W􏿿 􂜁􀄗W􏿿 􂤁􀄱w􏿿 􂠁􀄱w􏿿 􂠁􀄱w􏿿 􂜁􀄱w􏿿 􂘁􀄱w􏿿 􂘁􀄗W􏿿",
    "x"   => "􂤁􀄲x􏿿 􂤁􀄘X􏿿 􂠁􀄲x􏿿 􂠁􀄘X􏿿 􂜁􀄲x􏿿 􂜁􀄘X􏿿 􂘁􀄲x􏿿 􂘁􀄘X􏿿",
    "y"   => "􂤁􀄳y􏿿 􂜁􀄳y􏿿 􂤁􀄙Y􏿿 􂠁􀄳y􏿿 􂠁􀄙Y􏿿 􂜁􀄙Y􏿿 􂘁􀄳y􏿿 􂘁􀄙Y􏿿",
    "z"   => "􂤁􀄴z􏿿 􂤁􀄚Z􏿿 􂠁􀄴z􏿿 􂠁􀄚Z􏿿 􂜁􀄴z􏿿 􂜁􀄚Z􏿿 􂘁􀄴z􏿿 􂘁􀄚Z􏿿",
    "~"   => "􂜁􀄿~􏿿",
    "*"   => "􂘁􀅋*􏿿",
    "("   => "􂜁􀅍(􏿿",
    ")"   => "􂜁􀅎)􏿿",
    "-"   => "􂠁􀅦-􏿿",
    "="   => "􂠁􀅑=􏿿",
    "_"   => "􂤁􀅥_􏿿",
    "+"   => "􂘁􀅏+􏿿",
    "/"   => "􂘁􀅟/􏿿",
    ","   => "􂜁􀅝,􏿿",
    "."   => "􂠁􀅞.􏿿",
    "<"   => "􂠁􀅠<􏿿",
    ">"   => "􂜁􀅡>􏿿",
    ";"   => "􂘁􀅚;􏿿",
    "?"   => "􂜁􀅤?􏿿",
    "'"   => "􂜁􀅛'􏿿",
    ":"   => "􂠁􀅜:􏿿",
    "\""   => "􂜁􀅾\"􏿿",
    "{"   => "􂠁􀅘}􏿿",
    "}"   => "􂠁􀅘}􏿿",
    "!"   => "􂘁􀅃!􏿿 􂜁􀅃!􏿿 􂠁􀅃!􏿿 􂤁􀅃!􏿿",
    "@"   => "􂘁􀅄@􏿿 􂜁􀅄@􏿿 􂠁􀅄@􏿿 􂤁􀅄@􏿿",
    "#"   => "􂘁􀅅#􏿿 􂜁􀅅#􏿿 􂠁􀅅#􏿿 􂤁􀅅#􏿿",
    '$'   => '􂘁􀅆$􏿿 􂜁􀅆$􏿿 􂠁􀅆$􏿿 􂤁􀅆$􏿿',
    "&"   => "􂘁􀅊&􏿿 􂜁􀅊&􏿿 􂠁􀅊&􏿿 􂤁􀅊&􏿿",
    "%"   => "􂘁􀅇%􏿿 􂜁􀅇%􏿿 􂠁􀅇%􏿿 􂤁􀅇%􏿿",
    "^"   => "􂘁􀅈^􏿿 􂜁􀅈^􏿿 􂠁􀅈^􏿿 􂤁􀅈^􏿿"
  ];

  $generate_emo = (
  $str = strtolower($query);
  $str_len = strlen($query);
  $hasil = [];
  $i=0;$i<$str_len;$i++;
    if($str[$i] == " "){
      $hasil[] = "\x20\x20\x20";
    }elseif(isset($dict[$str[$i]])){
      $array = explode(" ",$dict[$str[$i]]);
      $chr = $array[rand(0,count($array)-1)];
      $hasil[] = $chr;
    }else{
      $hasil[] = $str[$i];
    }
      return implode("",$hasil);
);
		$array = explode(" ",$query);
			if($array[0] == "/t"){
				$emo = str_replace($generate_emo("/t ","",$query));
			} else {
				$result = new TextMessageBuilder($emo);
				}
				return $result;
			}
   }
