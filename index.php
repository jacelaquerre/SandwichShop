<?php
include ("top.php");

?>
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

        <p style="padding-left: 3em; padding-right: 3em">
            Bob’s Sandwiches is locally owned and operated and famous for the biggest and best sandwiches around.
            Bob’s also offers a full line of catering options including platters, party sandwiches, pastas and salads.
            Bob’s bakery is stocked with fresh baked muffins, breads, cookies and brownies.
            You can order online, for pickup or delivery. We also have catering options for small or large events.
        </p>

        <p style="padding-left: 3em; padding-right: 3em">
            We have also worked to adapt during the Coronavirus pandemic which a special contactless delivery option and
            we have worked to keep our prices steady in the face of rising food costs. We appreciate your support for
            local businesses.
        </p>

    </section>
    <!-- JavaScript -->
    <script src="js/jquery.js"></script>
<?php
include ("footer.php");
?>