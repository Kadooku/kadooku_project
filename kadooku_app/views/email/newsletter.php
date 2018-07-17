<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>   
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Copernica Marketing Software</title>
    <style type="text/css">
      /* Default CSS */
      body,#body_style {margin: 0; padding: 0; background: #f9f9f9; font-size: 14px; color: #5b656e;}
      a {color: #09c;}
      a img {border: none; text-decoration: none;}
      table, table td {border-collapse: collapse;}
      td, h1, h2, h3 {font-family: tahoma, geneva, sans-serif; color: #313a42;}
      h1, h2, h3, h4 {color: #313a42 !important; font-weight: normal; line-height: 1.2;}
      h1 {font-size: 24px;}
      h2 {font-size: 18px;}
      h3 {font-size: 16px;}
      p {margin: 0 0 1.6em 0;}
      
      /* Force Outlook to provide a "view in browser" menu link. */
      #outlook a {padding:0;}
      
      /* Preheader and webversion */
      .preheader {background-color: #5b656e;}
      .preheaderContent,.webversion,.webversion a {color: white; font-size: 10px;}
      .preheaderContent{width: 440px;}
      .preheaderContent,.webversion {padding: 5px 10px;}
      .webversion {width: 200px; text-align: right;}
      .webversion a {text-decoration: underline;}
      .webversion,.webversion a {color: #ffffff; font-size: 10px;}
      
      /* Topheader */
      .topHeader {background: #ffffff;}
      
      /* Logo (branding) */
      .logoContainer {padding: 20px 0 10px 0px; width: 320px;}
      .logoContainer a {color: #ffffff;}
      
      /* Whitespace (imageless spacer) and divider */
      .whitespace, .whitespaceDivider {font-family: 0px; line-height: 0px;}
      .whitespaceDivider {border-bottom: 1px solid #cccccc;}
      
      /* Button */
      .buttonContainer {padding: 10px 0px 10px 0px;}
      .button {padding: 5px 5px 5px 5px; text-align: center; background-color: #51c4d4}
      .button a {color: #ffffff; text-decoration: none; font-size: 13px;}
      
      /* Section */
      .sectionMainTitle{font-family: Tahoma, sans-serif; font-size: 16px; padding: 0px 0px 5px 0;}
      .sectionArticleTitle, .sectionMainTitle {color: #5b656e;}
      
      /* An article */
      .sectionArticleTitle, .sectionArticleContent {text-align: center; padding: 0px 5px 0px 5px;}
      .sectionArticleTitle {font-size: 12px; font-weight: bold;}
      .sectionArticleContent {font-size: 10px; line-height: 12px;}
      .sectionArticleImage {padding: 8px 0px 0px 0px;}
      .sectionArticleImage img {padding: 0px 0px 10px 0px; -ms-interpolation-mode: bicubic; display: block;}
      
      /* Footer and Social media */
      .footer {background-color: #51c4d4;}
      .footNotes {padding: 0px 20px 0px 20px;}
      .footNotes a {color: #ffffff; font-size: 13px;}
      .socialMedia {background: #5b656e;}
      
      /* Article image */
      .sectionArticleImage {padding: 8px 0px 0px 0px;}
      .sectionArticleImage img {padding: 0px 0px 10px 0px; -ms-interpolation-mode: bicubic; display: block;}
      
      /* Product card */
      .card {background-color: #ffffff; border-bottom: 2px solid #5b656e;}
      
      /* Column */
      .column {padding-bottom: 20px;}
      
      
      /* CSS for specific screen width(s) */
      @media only screen and (max-width: 480px) {
          body[yahoofix] table {width: 100% !important;}
          body[yahoofix] .webversion {display: none; font-size: 0; max-height: 0; line-height: 0; mso-hide: all;}
          body[yahoofix] .logoContainer {text-align: center;}
          body[yahoofix] .logo {width: 80%;}
          body[yahoofix] .buttonContainer {padding: 0px 20px 0px 20px;}
          body[yahoofix] .column {float: left; width: 100%; margin: 0px 0px 30px 0px;}
          body[yahoofix] .card {padding: 20px 0px;}
        }
    </style>
  </head>
  <body yahoofix>
    <span id="body_style" style="display:block">
      
      <!-- topHeader -->
      <table border="0" cellspacing="0" cellpadding="0" width="100%" summary="" class="topHeader">
        <tr>
          <td>
            <table border="0" cellspacing="0" cellpadding="0" width="640" align="center" summary="">
              <tr>
                <td class="logoContainer">
                    <img class="logo" src="<?='https://kadooku.castcoding.web.id/kadooku_assets/public/images/logo/logo.png';?>" alt="Kadooku Indonesia" />
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <!-- End topHeader -->
      
      <table border="0" cellspacing="0" cellpadding="0" summary="" width="100%">
        <tr>
          <td valign="top">
            <table border="0" cellspacing="0" cellspacing="" summary="" width="640" align="center">
              <tr><td class="whitespace" height="20">&nbsp;</td></tr>
              <tr><td align="center" class="sectionMainTitle">Hallo, <?=$nama;?></td></tr>
              <tr><td align="center" class="sectionMainContent">
                Sudah dapat hadiah belum buat ulang tahun si dia? <br>
                Kalo masih bingung kami mau rekomendasiin produk yang tentunya cocok buat hadiah si Dia.
              </td></tr>
              <tr><td class="whitespaceDivider" height="10">&nbsp;</td></tr>
              <tr><td class="whitespace" height="20">&nbsp;</td></tr>
            </table>
            <table border="0" cellspacing="0" cellspacing="" summary="" width="640" align="center">
              <tr>
                <!-- Column and product card -->
                <?php foreach($product[0] as $row) : ?>
                <td class="column" valign="top">
                  <table border="0" cellpadding="0" cellspacing="0" width="200" summary="" class="card">
                    <tr>
                      <td class="sectionArticleImage" align="center">
                        <img src="<?='https://kadooku.castcoding.web.id/kadooku_uploads/product/img/'.$row['product_image'];?>" width="190" height="190" alt="" />
                      </td>
                    </tr>
                    <tr><td class="sectionArticleTitle" valign="top"><?=$row['product_name'];?></td></tr>
                    <tr>
                      <td class="sectionArticleContent" valign="top" align="left">
                        <span style="font-weight: bold;"><?=rupiah($row['product_price']);?></span>
                      </td>
                    </tr>
                    <tr>
                      <td class="buttonContainer">
                        <table border="0" cellpadding="0" cellspacing="0" summary="" align="center" width="50%">
                          <tr><td class="button"><a href="<?='https://kadooku.castcoding.web.id/product_detail/'.$row['product_url'];?>" title="Lihat Produk">Lihat Produk</a></td></tr>
                        </table>
                      </td>
                    </tr>  
                  </table>  
                </td>
                <?php endforeach;?>
                <!-- End Column -->
              </tr>
            </table>
          </td>
        </tr>
      </table>

      <table border="0" cellspacing="0" cellpadding="0" summary="" width="100%">
        <tr>
          <td valign="top">
            <table border="0" cellspacing="0" cellspacing="" summary="" width="640" align="center">
              <tr><td class="whitespace" height="20">&nbsp;</td></tr>
              <tr><td align="center" class="sectionMainTitle">Masih bingung?</td></tr>
              <tr><td align="center" class="sectionMainContent">Coba rekomendasi yang ini</td></tr>
              <tr><td class="whitespaceDivider" height="10">&nbsp;</td></tr>
              <tr><td class="whitespace" height="20">&nbsp;</td></tr>
            </table>
            <table border="0" cellspacing="0" cellspacing="" summary="" width="640" align="center">
              <tr>
                <!-- Column and product card -->
                <?php foreach($product[1] as $row) : ?>
                <td class="column" valign="top">
                  <table border="0" cellpadding="0" cellspacing="0" width="200" summary="" class="card">
                    <tr>
                      <td class="sectionArticleImage" align="center">
                        <img src="<?='https://kadooku.castcoding.web.id/kadooku_uploads/product/img/'.$row['product_image'];?>"  width="190" height="190" alt="" />
                      </td>
                    </tr>
                    <tr><td class="sectionArticleTitle" valign="top"><?=$row['product_name'];?></td></tr>
                    <tr>
                      <td class="sectionArticleContent" valign="top" align="left">
                        <span style="font-weight: bold;"><?=rupiah($row['product_price']);?></span>
                      </td>
                    </tr>
                    <tr>
                      <td class="buttonContainer">
                        <table border="0" cellpadding="0" cellspacing="0" summary="" align="center" width="50%">
                          <tr><td class="button"><a href="<?='https://kadooku.castcoding.web.id/product_detail/'.$row['product_url'];?>" title="Lihat Produk">Lihat Produk</a></td></tr>
                        </table>
                      </td>
                    </tr>  
                  </table>  
                </td>
                <?php endforeach;?>
                <!-- End Column -->
              </tr>
            </table>
          </td>
        </tr>
      </table>
      
      <!-- Social media 
      <table border="0" cellspacing="0" cellpadding="0" width="100%" summary="" class="socialMedia">
        <tr><td class="whitespace" height="20">&nbsp;</td></tr>
        <tr>
          <td>
            <table border="0" cellspacing="0" cellpadding="0" width="120" align="center" summary="">
              <tr>
                <td align="center" width="32">
                  <a href="https://www.twitter.com" title="Twitter"><img src="twitt.png" width="29"  alt="Twitter" /></a>
                </td>
                <td align="center" width="32">
                  <a href="https://www.facebook.com" title="Facebook"><img src="faceb.png" width="29" alt="Facebook" /></a>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr><td class="whitespace" height="10">&nbsp;</td></tr>
      </table>
      End Social media -->
      
      <!-- Footer -->
      <table border="0" cellspacing="0" cellspacing="" summary="" width="640" align="center">
        <tr><td class="whitespace" height="20">&nbsp;</td></tr>
        <tr><td align="center" class="sectionMainTitle">Lorem ipsum dolor sit amet.</td></tr>
        <tr><td align="center" class="sectionMainContent">@ <?=date("Y");?> Kadooku Indonesia</td></tr>
      </table>
      <!-- End Footer -->
    </span>
  </body>
</html>