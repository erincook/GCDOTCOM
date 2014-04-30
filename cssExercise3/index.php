<!DOCTYPE html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Google Api Image Search</title>
    <script src="//www.google.com/jsapi?key=AIzaSyA5m1Nc8ws2BbmPRwKu5gFradvD_hgq6G0" type="text/javascript"></script>
    <script type="text/javascript">
    google.load('search', '1');
    
    function searchGiftCards() {
      var searchControl = new google.search.SearchControl();
      var imageSearch = new google.search.ImageSearch();
      imageSearch.setRestriction(google.search.ImageSearch.RESTRICT_COLORIZATION,
                                 google.search.ImageSearch.COLORIZATION_GRAYSCALE);
      searchControl.addSearcher(imageSearch);
      searchControl.draw(document.getElementById("container"));
      searchControl.execute('giftcards.com');
    }
    google.setOnLoadCallback(searchGiftCards);
    </script>
  </head>
  <body>
    <div id="container">Loading...</div>
  </body>
</html>