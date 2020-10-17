<html>

<head>
  <title>//////</title>
  <script src="https://kit.fontawesome.com/6a39950e34.js" crossorigin="anonymous"></script>

</head>

<link rel="stylesheet" href="css/style.css">

<body class="flex row fill frame bgBlack5">

  <div class=" flex row fill frame">
    <!--Left Column - CONTACT ICONS-->
    <?php include "php/leftColumn.php" ?>
    <!---------------------------------------------------------------------------------------->
    <!--MAIN COLUMN-->
    <div class="flex column relative w100 h100 frame">
      <!-- Top Row -->
      <?php include "php/topRow.php" ?>

      <!-- Main window -->
      <!--About-->
      <div class="flex column relative h100 w100">
      <?php include "php/mainWindowOverlay.php" ?>
      <?php include "php/work.php"?>
      </div>



      <!-- Bottom Row -->
      <div id="bot" class="flex relative h75px w100 frame">
        <?php include "php/bottomRowOverlay.php" ?>
        <?php include "php/bottomRow.php" ?>
      </div>
    </div>
    <!---------------------------------------------------------------------------------------->
    <!--RightColumn-->
    <?php include "php/rightColumn.php" ?>
  </div>
</body>

</html>