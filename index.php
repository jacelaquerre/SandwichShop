<?php
include ("top.php");

?>
<main>
    <div class="slideshow-container">
        <div class="mySlides fade">
            <div class="numbertext"></div>
            <img src="https://i.postimg.cc/hGJjmWhX/sandwhich-1.jpg" alt="" style="width:50%"/>
        </div>

        <div class="mySlides fade">
            <div class="numbertext"></div>
            <img src="https://i.postimg.cc/KzB89PPF/sandwhich-2.jpg" alt="" style="width:50%"/>
        </div>

        <div class="mySlides fade">
            <div class="numbertext"></div>
            <img src="https://i.postimg.cc/rsTF7Dj4/sandwhich-3.jpg" alt="" style="width:50%"/>
        </div>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br>

    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>

    <!-- JavaScript -->
    <script src="js/jquery.js" type="text/javascript"></script>
</main>
<?php
include ("footer.php");
?>