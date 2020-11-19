<?php
include ("top.php");

?>
<main>
    <div class="slideshow-container">
        <div class="mySlides fade">
            <div class="numbertext"></div>
            <img src="https://i.postimg.cc/N0QDGD0C/sandwhich-1-1.jpg" alt="" style="width:50%"/>
        </div>

        <div class="mySlides fade">
            <div class="numbertext"></div>
            <img src="https://i.postimg.cc/RFFTK0Kc/sandwhich-2-1.jpg" alt="" style="width:50%"/>
        </div>

        <div class="mySlides fade">
            <div class="numbertext"></div>
            <img src="https://i.postimg.cc/mrVwP9zL/sandwhich-3-1.jpg" alt="" style="width:50%"/>
        </div>
    </div>

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