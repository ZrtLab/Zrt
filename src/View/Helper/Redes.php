<?php

class Zrt_View_Helper_Redes
        extends Zend_View_Helper_Abstract
    {

    public function Redes()
        {
        $separator = "";

        return $this->Facebook1() . $this->Xing() . $this->Google();
        }

    public function Facebook1()
        {

        $html = "<div id='facebook'>";
        $html .= '
            <div id="fb-root">
            </div>
<script>(function (d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/de_DE/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>
<div class="fb-like" data-href="http://www.medtechtrade.com"
data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>';
        $html .= "</div>";

        return $html;
        }

    public function Facebook()
        {

        $html = "<div id='facebook'>";
        $html .= '
            <iframe src="//www.facebook.com/plugins/like.php?locale=en_US&href=http%3A%2F%2Fwww.facebook.com%2Fpages%2FMedTechTrade%2F140425816037036&amp;send=false&amp;layout=button_count&amp;width=100&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=arial&amp;height=21&amp;appId=204002202992819" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe>';
        $html .= "</div>";

        return $html;
        }

    public function Xing()
        {

        $html = "<div id='xing'>";
        $html .= '<a href="https://www.xing.com/app/user?op=share;url=medtechtrade.com" target="_blank" title="Ihren XING-Kontakten zeigen">
<img src="http://www.xing.com/img/n/xing_icon_16x16.png" width="16" height="16" alt="Ihren XING-Kontakten zeigen" />
</a>';
        $html .= "</div>";

        return $html;
        }

    public function Google()
        {

        $html = "<div id='plus1'>";
        $html .= '<script type="text/javascript">
  (function () {
    var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;
    po.src = "https://apis.google.com/js/plusone.js";
    var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<g:plusone size="small" annotation="inline" width="120"></g:plusone>';
        $html .= "</div>";

        return $html;
        }

    public function Linkedin()
        {

        $html = "<div id='linkedin'>";
        $html .= '<script src="http://platform.linkedin.com/in.js" type="text/javascript"></script>
<script type="IN/Share" data-url="www.medtechtrade.com" data-counter="right"></script>';
        $html .= "</div>";

        return $html;
        }

    }
