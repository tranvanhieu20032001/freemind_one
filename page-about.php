<?php

/**
 * about template
 * 
 * @package Freemind
 */
get_header();
?>

<div id="primary">
    <main id="main" class="site-main mt-5" role="main">
        <div class="container">
            <h2 class="text-center bg-title">About</h2>
            <img class="banner-xl" alt="aboutus.png" src="<?php echo get_template_directory_uri(); ?>/assets/images/aboutus.png">
            <h2 class="text-center title-about">WHO IS FREEMIND?</h2>
            <p class="text-center text-about my-3">Freemind is a software development company based in Đà Nẵng, Việt Nam dedicated to providing businesses worldwide with customized technology solutions. Our team will deliver the extended features you desire. At the same time, you will have 100% ownership so you can edit or develop it later. With over 10 years of experience working with mobile systems, we have the skills and experience to create custom products.</p>
            <div class="row my-3">
                <div class="col-md-4 col-12">
                    <div class="information__inner box-shadow text-center">
                        <img src="https://freemind.vn/uploads/mini_icon_about_1_113806809d.png" alt="">
                        <h3 class="heading-3">Misson &amp; Vision</h3>
                        <p class="para-1">Our mission is to help businesses accelerate adoption of new technology, untangle the complexities of digital evolution, and orchestrate ongoing innovation.</p>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="information__inner box-shadow text-center">
                        <img src="https://freemind.vn/uploads/mini_icon_about_2_fa108cf215.png" alt="">
                        <h3 class="heading-3">Professional Team</h3>
                        <p class="para-1">With 10 years of experience in providing technology solutions in many fields. Freemind always has a professional working process, ensuring to meet the criteria that exceed the expectations of customers.</p>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="information__inner box-shadow text-center">
                        <img src="https://freemind.vn/uploads/mini_icon_about_3_7e81cd6688.png" alt="">
                        <h3 class="heading-3">Transparency & Credible</h3>
                        <p class="para-1">Freemind offers a competitive and stable pricing policy with the perfect balance between quality and price. We bring effective solutions that come from creative thinking and put credibility first</p>
                    </div>
                </div>
            </div>
            <h2 class="title-about">TECHNOLOGIES AND PLATFORMS WE USE</h2>
            <p class="text-desc my-3">We work with the world's top developers to deliver high performance that meets all of our customers' expectations.</p>
            <div class="content-img">
                <img src="https://freemind.vn/uploads/technology/tech.svg" alt="">
            </div>
        </div>
    </main>
</div>

<?php
get_footer();
?>