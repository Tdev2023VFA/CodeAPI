<!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "110707898294922");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v13.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
<script>
$(document).ready(function() {
    $('#mytable').DataTable();
});
$(document).ready(function() {
    $('#mytable1').DataTable();
});
</script>
<script src="<?=BASE_URL('')?>template/js/locdz.js"></script>
<script src="<?=BASE_URL('')?>template/js/app.js"></script>
<script src="<?=BASE_URL('')?>template/dist/js/toastr.min.js"></script>
</body>

</html>