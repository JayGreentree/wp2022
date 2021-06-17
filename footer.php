</div><!-- /.row -->

</div><!-- /.container -->


      <!-- FOOTER -->
      <footer class="container">
        <p class="float-right"><a href="#">Back to top</a></p>
        <p><?php if ( is_active_sidebar( 'footer-copyright-text' ) ) { dynamic_sidebar( 'footer-copyright-text' ); } ?></p>
      </footer>
    </main>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/jquery-slim.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/popper.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/holder.min.js"></script>

<?php wp_footer(); ?>
</body>
</html>
