<?php
include ("top.php");

?>
    <h1 style="text-align: center">Bob;s Sandwiches</h1>
    <section class="container">
        <section class="slideshow-container">
            <article class="mySlides fade">
                <article class="numbertext"></article>
                <img src="https://i.postimg.cc/N0QDGD0C/sandwhich-1-1.jpg" alt="" style="width:50%"/>
            </article>

            <article class="mySlides fade">
                <article class="numbertext"></article>
                <img src="https://i.postimg.cc/RFFTK0Kc/sandwhich-2-1.jpg" alt="" style="width:50%"/>
            </article>

            <article class="mySlides fade">
                <article class="numbertext"></article>
                <img src="https://i.postimg.cc/mrVwP9zL/sandwhich-3-1.jpg" alt="" style="width:50%"/>
            </article>
        </section>

        <section style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </section>


        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
            magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>
    </section>

    <!-- JavaScript -->
    <script src="js/jquery.js" type="text/javascript"></script>
<?php
include ("footer.php");
?>