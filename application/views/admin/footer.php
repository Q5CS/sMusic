        <!-- Footer html -->
        <footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">关于</h5>
                <p class="grey-text text-lighten-4">sMusic 是一个开源的点歌程序，你可以在 <a class="grey-text text-lighten-3" href="https://github.com/fly3949/Smusic">Github</a> 上看到它的代码，并且和我们一起完善它。</br>Made with ❤ by <a class="grey-text text-lighten-3" href="https://www.qz5z.tech">泉州五中电研社</a></p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">友情链接</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="http://www.qz5z.com">泉州五中官网</a></li>
                  <li><a class="grey-text text-lighten-3" href="https://www.qz5z.tech">泉州五中电研社</a></li>
                  <li><a class="grey-text text-lighten-3" href="https://fly.moe">Fly の 宅基地</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2017 <a class="grey-text text-lighten-3" href="https://fly.moe">Fly</a>
            <!--<a class="grey-text text-lighten-4 right" href="#!">More Links</a>-->
            </div>
          </div>
        </footer>

	</body>
	<!--Import jQuery before materialize.js-->
	<script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
	<!-- Compiled and minified JavaScript -->
	<script src="https://cdn.bootcss.com/materialize/0.98.0/js/materialize.min.js"></script>
    <script src="assets/js/main.js"></script>
  <?php
    for ($i=1;$i<=count($add_js);$i++) {
      echo '<script src="assets/js/'. $add_js[$i-1] . '"></script>' . PHP_EOL;
    }
  ?>
</html>
