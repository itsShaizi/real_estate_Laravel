<style type="text/css">
    .learn-menu {
      list-style: none;
      font-weight: bold;
      line-height: normal;
      font-size: 19px;
      margin-bottom: 50px;
      text-align: center;
      margin-top: 30px;
      display: flex;
    }
    .learn-menu li {
      position: relative;
      display: inline-block;
      min-width: 150px;
      height: 203px;
      overflow: hidden;
      padding: 0;
      background: #FFFFFF;
      box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
      border-radius: 16px;
      cursor: pointer;
      text-align: center;
    }
    .learn-menu li a {
      position: absolute;
      top: 62%;
      right: 0;
      left: 0;
      margin: auto;
      color: #000;
    }

    .learn-menu .active {
      background-image: url('/img/learn-more/001-search-active.png');
      background-size: auto !important;
      background-repeat: no-repeat !important;
      background-position-x: center !important;
      background-position-y: 20px !important;
      background: #4792FD;
    }
    .learn-menu .active a {
      color: #fff;
      display: block;
    }
    .learn-menu .due-diligence {
      background-image: url('/img/learn-more/001-search.png');
      background-size: auto;
      background-repeat: no-repeat;
      background-position-x: center;
      background-position-y: 20px;
    }
    .learn-menu .due-diligence.active,
    .learn-menu .due-diligence:hover {
      background-size: auto !important;
      background-repeat: no-repeat !important;
      background-position-x: center !important;
      background-position-y: 20px !important;
      background: #4792FD;
      background-image: url('/img/learn-more/001-search-active.png');
    }
    .learn-menu .due-diligence.active a,
    .learn-menu .due-diligence:hover a {
      color: #fff;
      display: block;
    }
    .learn-menu .auction-process {
      background-image: url('/img/learn-more/001-search.png');
      background-size: auto;
      background-repeat: no-repeat;
      background-position-x: center;
      background-position-y: 20px;
      background-image: url('/img/learn-more/002-auction.png');
    }
    .learn-menu .auction-process.active,
    .learn-menu .auction-process:hover {
      background-image: url('/img/learn-more/001-search-active.png');
      background-size: auto !important;
      background-repeat: no-repeat !important;
      background-position-x: center !important;
      background-position-y: 20px !important;
      background: #4792FD;
      background-image: url('/img/learn-more/002-auction-active.png');
    }
    .learn-menu .auction-process.active a,
    .learn-menu .auction-process:hover a {
      color: #fff;
      display: block;
    }
    .learn-menu .traditional-process {
      background-image: url('/img/learn-more/001-search.png');
      background-size: auto;
      background-repeat: no-repeat;
      background-position-x: center;
      background-position-y: 20px;
      background-image: url('/img/learn-more/003-for-sale.png');
    }
    .learn-menu .traditional-process.active,
    .learn-menu .traditional-process:hover {
      background-image: url('/img/learn-more/001-search-active.png');
      background-size: auto !important;
      background-repeat: no-repeat !important;
      background-position-x: center !important;
      background-position-y: 20px !important;
      background: #4792FD;
      background-image: url('/img/learn-more/003-for-sale-active.png');
    }
    .learn-menu .traditional-process.active a,
    .learn-menu .traditional-process:hover a {
      color: #fff;
      display: block;
    }
    .learn-menu .licensing {
      background-image: url('/img/learn-more/001-search.png');
      background-size: auto;
      background-repeat: no-repeat;
      background-position-x: center;
      background-position-y: 20px;
      background-image: url('/img/learn-more/004-id-card.png');
    }
    .learn-menu .licensing.active,
    .learn-menu .licensing:hover {
      background-image: url('/img/learn-more/001-search-active.png');
      background-size: auto !important;
      background-repeat: no-repeat !important;
      background-position-x: center !important;
      background-position-y: 20px !important;
      background: #4792FD;
      background-image: url('/img/learn-more/004-id-card-active.png');
    }
    .learn-menu .licensing.active a,
    .learn-menu .licensing:hover a {
      color: #fff;
      display: block;
    }
</style>


<ul class="learn-menu flex-col md:flex-row justify-center md:mx-16 mx-auto mb-8 max-w-7xl">
    <li class="due-diligence mx-4 md:mx-1 mb-8 md:w-1/4" onClick="location.href='/learn-more/due-diligence/';"><a href="/learn-more/due-diligence/">Due Diligence</a></li>
    <li class="auction-process mx-4 md:mx-1 mb-8 md:w-1/4" onClick="location.href='/learn-more/auction-process/';"><a href="/learn-more/auction-process/">Auction<br/>Process</a></li>
    <li class="traditional-process mx-4 md:mx-1 mb-8 md:w-1/4" onClick="location.href='/learn-more/traditional-process/';"><a href="/learn-more/traditional-process/">Traditional<br/>Process</a></li>
    <li class="licensing mx-4 md:mx-1 mb-8 md:w-1/4" onClick="location.href='/learn-more/licensing/';"><a href="/corporate/licensing/">Licensing</a></li>
</ul>