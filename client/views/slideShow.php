<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slideshow with Buttons</title>
    <link rel="stylesheet" href="./assets/css/client/SlideShow.css">
    <link 
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="slideshow-container">
        <!-- Nút prev -->
        <a class="prev" onclick="plusSlides(-1)">
            <i class="fa-solid fa-angle-left"></i>
        </a>

        <!-- Image slides -->
        <div class="mySlides">
            <img src="../Upload/Slides/banner6.jpeg">
        </div>
        <div class="mySlides">
            <img src="../Upload/Slides/banner7.jpg">
        </div>
        <div class="mySlides">
            <img src="../Upload/Slides/banner3.jpg">
        </div>

        <div class="mySlides">
            <img src="../Upload/Slides/banner4.jpg">
        </div>

        <div class="mySlides">
            <img src="../Upload/Slides/banner6.jpeg">
        </div>

        <div class="mySlides">
            <img src="../Upload/Slides/banner7.jpg">
        </div>

        <div class="mySlides">
            <img src="../Upload/Slides/banner3.jpg">
        </div>

        <div class="mySlides">
            <img src="../Upload/Slides/banner4.jpg">
        </div>

        <!-- Nút next -->
        <a class="next" onclick="plusSlides(1)">
            <i class="fa-solid fa-angle-right"></i>
        </a>
    </div>
    <script src="./assets/js/slideShow.js"></script>
</body>
</html>
