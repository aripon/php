<?php
/* 40 じゃんけんを作成しよう！
下記の要件を満たす「じゃんけんプログラム」を開発してください。
要件定義
・使用可能な手はグー、チョキ、パー
・勝ち負けは、通常のじゃんけん
・PHPファイルの実行はコマンドラインから。
ご自身が自由に設計して、プログラムを書いてみましょう！ */

//変数名をスネークケースで統一

//定数設定
const HAND_TYPE = ["グー" , "チョキ" , "パー"];
const YES_NO = ["はい" , "いいえ"];

//ゲーム開始の関数
function gameStart(){

    echo "じゃんけんをしよう！" . PHP_EOL ;
    $user_choice = userChoice();
    $cp_choice = cpChoice();
    $result = judge($user_choice , $cp_choice);
    echo show($result);

    if(gameContinue()){
        return gameStart();
    }

    gameEnd();

}

//ユーザーによるじゃんけん選択
//関数名をキャメルケースで統一
function userChoice(){
    echo "グー、チョキ、パーの何をだす？" . PHP_EOL;
    $choice = trim(fgets(STDIN));
    $convert = mb_convert_kana($choice , 'C');
    $check = userChoiceCheck($convert);
    if(!$check){
        return userChoice();
    }

    $handtype_num = array_search($convert , HAND_TYPE);
    return $handtype_num;
}

//ユーザーのじゃんけん選択のバリデーション
function userChoiceCheck($convert){
    if(in_array($convert , HAND_TYPE)){
        return true;
    }    
    echo "グー、チョキ、パーのどれかを出してね！" . PHP_EOL;
    return false;
}

//コンピューターによるじゃんけん選択
function cpChoice(){
    //定数を使用
    $randam = mt_rand(0 , count(HAND-TYPE));
    $cp_choice = $randam;

    return $cp_choice;
}

//じゃんけんの結果判定
function judge($user_choice , $cp_choice){
    echo "OK！ それでは…　じゃんけんぽん！" . PHP_EOL;
    echo "コンピューター：　" . HAND_TYPE[$cp_choice] . PHP_EOL;
    echo "あなた：　" . HAND_TYPE[$user_choice] . PHP_EOL;

    $result = ($user_choice - $cp_choice + 3) % 3 ;
    return $result;
}

//じゃんけん結果表示
function show($result){

    switch($result){
    case 0:
        echo "あいこでもう一勝負！" . PHP_EOL;
        $userRechoice = userChoice();
        $cpRechoice = cpChoice();
        $nextResult = judge($userRechoice , $cpRechoice);
        return show($nextResult);
    break;
    case 1:
        echo "あなたの負けです！" . PHP_EOL;
    break;
    case 2:
        echo "あなたの勝ちです！" . PHP_EOL;
    break;

    }

}

//ゲーム継続の確認
function gameContinue(){
    echo 'もう一度勝負する？ "はい" か "いいえ"で答えてね！' . PHP_EOL;
    $answer = trim(fgets(STDIN));
    $check = gameContinue_check($answer);

    if(!$check){
        return gameContinue();
    }

    $yesno_num = array_search($answer , YES_NO);
    if($yesno_num === 0){
        return true;
    }

    return false;
}


//ゲーム継続確認のバリデーション
function gameContinue_check($answer){
    if(in_array($answer , YES_NO)){
        return true;
    }    
    echo '"はい" か "いいえ" で答えてね' . PHP_EOL;
    return false;
}

//ゲーム終了
function gameEnd(){
    echo "また遊んでね！";
    exit;
}

echo gameStart();

