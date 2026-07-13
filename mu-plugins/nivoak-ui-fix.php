<?php
// Nivoak UI Fix - reveals visible + nav URL fix
add_action('wp_head',function(){
echo '<script>document.documentElement.className+=" js";</script>
<style>
.reveal{opacity:1!important;transform:none!important}
.js .reveal{opacity:0;transform:translateY(40px);transition:opacity .9s cubic-bezier(.22,1,.36,1),transform .9s cubic-bezier(.22,1,.36,1)}
.js .reveal.visible{opacity:1;transform:translateY(0)}
.hero-eyebrow,.hero-title,.hero-sub,.hero-actions,.hero-scroll{opacity:1!important;animation:none!important}
.js .hero-eyebrow{opacity:0;animation:fadeUp 1s .3s forwards}
.js .hero-title{opacity:0;animation:fadeUp 1.2s .5s forwards}
.js .hero-sub{opacity:0;animation:fadeUp 1s .8s forwards}
.js .hero-actions{opacity:0;animation:fadeUp 1s 1s forwards}
.js .hero-scroll{opacity:0;animation:fadeIn 1s 1.5s forwards}
.page-wrapper{padding-top:80px}
.page-header-section{padding:60px 48px 40px;background:linear-gradient(180deg,#14100d,#0a0807);border-bottom:1px solid rgba(200,147,47,.15)}
.page-header-inner{max-width:1200px;margin:0 auto}
.page-header-inner .page-title{font-family:"Playfair Display",Georgia,serif;font-size:clamp(2rem,5vw,3.5rem);font-weight:700;color:#f5ede0;margin-top:10px}
.page-content-section{padding:60px 48px}
.page-content-inner{max-width:800px;margin:0 auto;font-size:16px;line-height:1.8;color:#a89b88}
.page-content-inner h2{font-family:"Playfair Display",Georgia,serif;color:#f5ede0;margin:1.5em 0 .5em}
.page-content-inner h3{font-family:"Playfair Display",Georgia,serif;color:#f5ede0;margin:1.2em 0 .4em}
.page-content-inner p{margin-bottom:1.2em}
.page-content-inner a{color:#c8932f}
</style>
<script>window.addEventListener("DOMContentLoaded",function(){var h=document.querySelector(".site-header");if(h)window.addEventListener("scroll",function(){if(window.scrollY>40)h.classList.add("scrolled");else h.classList.remove("scrolled")});var io=new IntersectionObserver(function(e){e.forEach(function(en){if(en.isIntersecting){en.target.classList.add("visible");io.unobserve(en.target)}})},{threshold:.1,rootMargin:"0px 0px -60px 0px"});document.querySelectorAll(".reveal").forEach(function(el){io.observe(el)});setTimeout(function(){document.querySelectorAll(".reveal:not(.visible)").forEach(function(el){el.classList.add("visible")})},3e3)})</script>';
},1);
add_action('template_redirect',function(){ob_start(function($h){return str_replace(array('nivoak.com/whiskey-accessories/','nivoak.com/wine-accessories/','nivoak.com/cocktail-accessories/','nivoak.com/contact-us/','nivoak.com/best-sellers/'),array('nivoak.com/category/whiskey-accessories/','nivoak.com/category/wine-accessories/','nivoak.com/category/cocktail-accessories/','nivoak.com/contact/','nivoak.com/shop/'),$h);});});
