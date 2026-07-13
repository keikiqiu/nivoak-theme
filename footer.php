<?php
/**
 * Footer template.
 *
 * @package Nivoak
 * @since   2.1.0
 */
?>
<footer class="site-footer">
  <div class="footer-inner">
    <div>
      <div class="footer-brand">Nivoak<span>.</span></div>
      <p class="footer-desc">Premium bar accessories for whiskey, wine, and cocktail enthusiasts. Every piece curated for craftsmanship and experience.</p>
    </div>
    <div class="footer-col">
      <h4>Collections</h4>
      <ul>
        <li><a href="<?php echo esc_url( home_url( '/category/whiskey-accessories/' ) ); ?>">Whiskey</a></li>
        <li><a href="<?php echo esc_url( home_url( '/category/wine-accessories/' ) ); ?>">Wine</a></li>
        <li><a href="<?php echo esc_url( home_url( '/category/cocktail-accessories/' ) ); ?>">Cocktail</a></li>
        <li><a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>">All Products</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Resources</h4>
      <ul>
        <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Buying Guides</a></li>
        <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About Us</a></li>
        <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a></li>
        <li><a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>">Shop</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Support</h4>
      <ul>
        <li><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy Policy</a></li>
        <li><a href="<?php echo esc_url( home_url( '/terms-of-service/' ) ); ?>">Terms of Service</a></li>
        <li><a href="<?php echo esc_url( home_url( '/affiliate-disclosure/' ) ); ?>">Affiliate Disclosure</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <span>&copy; <?php echo date('Y'); ?> Nivoak. All rights reserved.</span>
    <span>Crafted for connoisseurs.</span>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>