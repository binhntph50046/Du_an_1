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
            <img src="../Upload/Slides/64d4f79e86895.jpg">
        </div>
        <div class="mySlides">
            <img src="../Upload/Slides/64d4f951e34f9.png">
        </div>
        <div class="mySlides">
            <img src="../Upload/Slides/64d4fab909de9.jpg">
        </div>

        <div class="mySlides">
            <img src="../Upload/Slides/64d4ffdbaa30f.jpg">
        </div>

        <div class="mySlides">
            <img src="../Upload/Slides/64d50d9ae5f64.jpg">
        </div>

        <div class="mySlides">
            <img src="../Upload/Slides/64d5197fec88c.png">
        </div>

        <div class="mySlides">
            <img src="../Upload/Slides/64d51c558f749.jpg">
        </div>

        <!-- Nút next -->
        <a class="next" onclick="plusSlides(1)">
            <i class="fa-solid fa-angle-right"></i>
        </a>
    </div>
    <script src="./assets/js/slideShow.js"></script>
</body>
</html>
