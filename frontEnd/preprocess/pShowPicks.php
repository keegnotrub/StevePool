<?php
  // see if they changed to a different week
  if( isset($_POST["showPicksWeek"]) && isset($_POST["showPicksSeason"]) && isset($_POST["showPicksSplit"]) )
  {
    // reset the week if we need to
    $inPlayoffs = (($_SESSION["showPicksSplit"] == "playoffs") || ($_SESSION["showPicksSplit"] == "consolation"));
    $toPlayoffs = (($_POST["showPicksSplit"] == "playoffs") || ($_POST["showPicksSplit"] == "consolation"));
    if( $inPlayoffs && !$toPlayoffs )
    {
      $_POST["showPicksWeek"] = 17;
    }
    if( !$inPlayoffs && $toPlayoffs )
    {
      $_POST["showPicksWeek"] = 18;
    }

    // see if we need to cap the playoffs stuff
    $seasonResult = mysqli_fetch_assoc( runQuery( "select value from Constants where name='fetchSeason'" ) );
    $weekResult = mysqli_fetch_assoc( runQuery( "select value from Constants where name='fetchWeek'" ) );
    if( /*$_SESSION["showPicksSplit"] == "playoffs" &&*/ $_POST["showPicksSeason"] == $seasonResult["value"] && 
        $_POST["showPicksWeek"] > $weekResult["value"] )
    {
      $_POST["showPicksWeek"] = $weekResult["value"];
    }

    $_SESSION["showPicksWeek"] = $_POST["showPicksWeek"];
    $_SESSION["showPicksSeason"] = $_POST["showPicksSeason"];
    $_SESSION["showPicksSplit"] = $_POST["showPicksSplit"];
  }
?>
