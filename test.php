<?php

if (isset($_POST['date_utilisateur'])) {
  $date_utilisateur = $_POST['date_utilisateur'];
  $date_aujourdhui = date('Y-m-d');

  echo $date_aujourdhui ;
  echo $date_utilisateur ;

  $timestamp_utilisateur = strtotime($date_utilisateur);
  $timestamp_aujourdhui = strtotime($date_aujourdhui);

  if ($timestamp_utilisateur < $timestamp_aujourdhui) {
    echo "La date saisie est antérieure à la date d'aujourd'hui.";
  } elseif ($timestamp_utilisateur > $timestamp_aujourdhui) {
    echo "La date saisie est postérieure à la date d'aujourd'hui.";
  } else {
    echo "La date saisie est la même que la date d'aujourd'hui.";
  }
}

?>

<form method="post">
  <label for="date_utilisateur">Date :</label>
  <input type="date" name="date_utilisateur" id="date_utilisateur">
  <button type="submit">Comparer</button>
</form>