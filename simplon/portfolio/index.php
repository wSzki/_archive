<html>

<head>
  <title>//////</title>
  <script src="https://kit.fontawesome.com/6a39950e34.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/style.css">

</head>


<body class="flex bgBlack5">

  <div class="flex fill row">
    <!--Left Column - CONTACT ICONS-->
    <?php include "php/elements/leftColumn.php" ?>
    <!---------------------------------------------------------------------------------------->
    <!--MAIN COLUMN-->
    <div class="flex column relative w100 h100 minw750px frame">
      <!-- Nav Bar -->
      <?php include "php/elements/navBar.php" ?>

      <!--Overlay-->
      <div class="flex  column relative h100 w100">
        <?php include "php/overlays/mainWindowOverlay.php" ?>

        <!-- Main window -->
        <?php include "php/main/mainWindow.php" ?>

        <!--Contact Form-->
        <?php include "php//main/contact.php" ?>

        <!--About-->
        <?php include "php/main/about.php" ?>

        <!--Work-->
        <?php include "php/main/work.php" ?>

        <!--CV-->
        <?php include "php/main/cv.php" ?>

      </div>

      <!-- Bottom Row -->
      <div id="bot" class="flex relative h75px w100 frame">
        <?php include "php/overlays/bottomRowOverlay.php" ?>
        <?php include "php/elements/bottomRow.php" ?>
      </div>
    </div>
    <!---------------------------------------------------------------------------------------->
    <!--RightColumn-->
    <div class="flex relative h100 w75px frame">
      <?php include "php/overlays/rightColumnOverlay.php" ?>
      <?php include "php/elements/rightColumn.php" ?>
    </div>
  </div>
</body>

</html>