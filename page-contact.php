<?php
/**
 * Template Name: Contact Page
 * Contact page with form.
 *
 * @package Nivoak
 */

get_header();

while (have_posts()) : the_post();
?>
<div class="page-wrapper">
  <div class="page-header-section">
    <div class="page-header-inner">
      <?php if (function_exists('nivoak_breadcrumb')) nivoak_breadcrumb(); ?>
      <h1 class="page-title"><?php the_title(); ?></h1>
    </div>
  </div>

  <div class="page-content-section">
    <div class="contact-layout">
      <div class="contact-info-side">
        <?php the_content(); ?>
      </div>

      <div class="contact-form-side">
        <form class="nivoak-contact-form" method="POST" action="">
          <div class="form-field">
            <label for="contact-name">Name</label>
            <input type="text" id="contact-name" name="contact_name" placeholder="Your name" required>
          </div>
          <div class="form-field">
            <label for="contact-email">Email</label>
            <input type="email" id="contact-email" name="contact_email" placeholder="you@example.com" required>
          </div>
          <div class="form-field">
            <label for="contact-subject">Subject</label>
            <input type="text" id="contact-subject" name="contact_subject" placeholder="How can we help?">
          </div>
          <div class="form-field">
            <label for="contact-message">Message</label>
            <textarea id="contact-message" name="contact_message" rows="6" placeholder="Tell us more..." required></textarea>
          </div>
          <button type="submit" class="btn-primary contact-submit-btn">Send Message</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php endwhile; ?>

<?php get_footer(); ?>
